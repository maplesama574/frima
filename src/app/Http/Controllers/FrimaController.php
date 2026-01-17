<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\Comment;
use Stripe\StripeClient;
use Illuminate\Auth\Events\Registered;
use App\Models\Purchase;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\SellItemRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\FirstLoginRequest;

class FrimaController extends Controller
{
    public function register()
    {
        dd('test');
        exit;
        $this->app->singleton(LoginResponseContract::class, function ($app) {
            return new class implements LoginResponseContract {
                public function toResponse($request)
                {
                    $user = $request->user();
                    dd($user);
                    exit;
                    if (! $user->hasVerifiedEmail()) {
                        return redirect()->route('verification.notice');
                    }

                    if ($user->is_first_login) {
                        return redirect()->route('login.first');
                    }

                    return redirect()->route('mypage');
                }
            };
        });

        $this->app->singleton(CreatesNewUsers::class, CreateNewUser::class);
    }

public function store(RegisterRequest $request)
{
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'is_first_login' => true,
    ]);

    event(new Registered($user));

    return redirect()->route('login');
}


//初回ログイン
public function showFirstLogin() {
        $user = auth()->user();
        if (!$user->is_first_login) {
            return redirect()->route('dashboard');
        }
        return view('site.first-login', compact('user'));
    }

    public function updateFirstLogin(FirstLoginRequest $request)
{
    $user = auth()->user();

    $user->postal_code = $request->postal_code;
    $user->address     = $request->address;
    $user->building    = $request->building;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('profile_images', 'public');
        $user->profile_image = $path;
    }

    $user->is_first_login = false;
    $user->save();

    return redirect()->route('mypage');
}

public function update(Request $request)
{
    $user = auth()->user();

    $user->postal_code = $request->postal_code;
    $user->address = $request->address;
    $user->building = $request->building;

    $user->is_first_login = false;
    $user->save();

    return redirect()->route('dashboard');
}

    public function index()
{
    if (!Auth::check()) {
        return view('site.dashboard', [
            'items' => collect(),
            'favorites' => [],
        ]);
    }

    $items = Item::where('user_id', '!=', Auth::id())
        ->get();

    $favorites = Favorite::with('item')
    ->where('user_id', Auth::id())
    ->get();

    return view('site.dashboard', [
        'items' => $items,
        'favorites' => $favorites,
    ]);
}

    public function search(Request $request)
{
    $keyword = $request->input('keyword');
    $user = auth()->user();

    $items = Item::where('name', 'like', "%{$keyword}%")
        ->when($user, function ($query) use ($user) {
            $query->where('user_id', '!=', $user->id);
        })
        ->get();

    $favorites = $user
        ? $user->favorites()->whereHas('item', function ($query) use ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        })->with('item')->get()
        : collect();

    return view('site.dashboard', compact('items', 'favorites', 'keyword'));
}


// GET: 購入画面表示
public function buy($item_id)
{
    $item = Item::findOrFail($item_id);
    return view('site.purchase', compact('item'));
}

    public function show($item_id)
{
    $item = Item::with(['comments.user'])
        ->withCount(['favorites', 'comments'])
        ->findOrFail($item_id);

    $comments = Comment::where('item_id', $item_id)->get();
    $commentCount = $comments->count();

    $likedItemIds = Auth::check()
        ? Favorite::where('user_id', Auth::id())->pluck('item_id')->toArray()
        : [];

    $commentCount = $item->comments_count;

    return view('site.item-detail', compact(
        'item',
        'comments',
        'commentCount',
        'likedItemIds'
    ));
}
    public function storeComment(CommentRequest $request, $item_id)
{
    Comment::create([
        'user_id' => auth()->id(),
        'item_id' => $item_id,
        'comment' => $request->comment,
    ]);

    return redirect()->route('item.detail', $item_id);
}

    public function showSell()
    {
        $categories = [
            'ファッション','家電','インテリア','レディース','メンズ',
            'コスメ','本','ゲーム','スポーツ','キッチン',
            'ハンドメイド','アクセサリー','おもちゃ','ベビー・キッズ',
        ];

        return view('site.sell', compact('categories'));
    }

    public function sell(SellItemRequest $request)
{
    $imagePath = $request->file('image')->store('items', 'public');

    Item::create([
        'user_id'     => auth()->id(),
        'brand'       => $request->brand,
        'name'        => $request->commodity_name,
        'description' => $request->description,
        'price'       => $request->price,
        'category'    => $request->category,
        'condition'   => $request->condition,
        'image_path'  => $imagePath,
    ]);

    return redirect()->route('dashboard');
}

public function showMypage()
{
    $user = auth()->user();
    $listedItems = Item::where('user_id', $user->id)->get();
    $purchasedItems = $user->purchasedItems()->get();
    $favorites = $user->favorites()->with('item')->get();

    return view('site.mypage', compact('user', 'listedItems', 'purchasedItems', 'favorites'));
}
    public function showProfileEdit()
    {
        return view('site.profile-edit', ['user' => auth()->user()]);
    }

    public function updateProfile(ProfileUpdateRequest $request)
{
    $user = auth()->user();

    $user->name        = $request->name;
    $user->postal_code = $request->postal_code;
    $user->address     = $request->address;
    $user->building    = $request->building;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('profile_images', 'public');
        $user->profile_image = $path;
    }

    $user->save();

    return redirect()->route('mypage');
}

    public function checkout(CheckoutRequest $request, $item_id)
{
    $item = Item::findOrFail($item_id);

    $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

    $session = $stripe->checkout->sessions->create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'jpy',
                'product_data' => ['name' => $item->name],
                'unit_amount' => (int) $item->price,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('stripe.success', ['item_id' => $item->id]),
        'cancel_url'  => route('item.buy', $item->id),
    ]);

    return redirect($session->url);
}




public function success(Request $request)
{
    $item_id = $request->query('item_id');
    $item = Item::findOrFail($item_id);

    $item->is_sold = true;
    $item->save();

    Purchase::create([
        'user_id' => auth()->id(),
        'item_id' => $item->id,
        'price' => $item->price,
    ]);

    return redirect()->route('dashboard');
}



//いいね機能　マイリスト機能
public function toggleFavorite($itemId)
{
    $user = auth()->user();
    $favorite = Favorite::where('user_id', $user->id)
                        ->where('item_id', $itemId)
                        ->first();

    if ($favorite) {
        $favorite->delete();
        $status = 'removed';
    } else {
        Favorite::create([
            'user_id' => $user->id,
            'item_id' => $itemId,
        ]);
        $status = 'added';
    }

    $count = Favorite::where('item_id', $itemId)->count();

    return response()->json([
        'status' => $status,
        'count' => $count,
    ]);
}

}
