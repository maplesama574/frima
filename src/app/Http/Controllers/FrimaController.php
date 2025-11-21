<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Models\Favorite;

class FrimaController extends Controller
{
    public function register(){
        return view('site.register');
    }

    //新規登録保存
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // 新規ユーザーを自動ログイン
    Auth::login($user);

    // 認証メール送信
    $user->sendEmailVerificationNotification();

    // メール認証ページへリダイレクト
    return redirect()->route('verification.notice');
}

    public function email(){
        return view('site.email');
    }

    public function login(){
        return view('site.login');
    }

    public function first()
    {
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login'); 
    }

    return view('site.first-login', compact('user'));
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Item::query();

        if (!empty($keyword)) {
            $query->where('name', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
        }

        $items = $query->get();

        return view('site.first-login', compact('items', 'keyword'));

    }

    public function update(Request $request){
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'name' => 'required|string|max:255',
            'postal_code' => 'required',
            'address' => 'required',
            'building' => 'nullable'
        ]);

        $user = Auth::user();

        // 画像保存
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profile', 'public');
            $user->image = $path;
        }

        // 情報更新
        $user->name = $request->name;
        $user->postal_code = $request->postal_code;
        $user->address = $request->address;
        $user->building = $request->building;
        $user->save();

        return redirect('/')->with('success', 'プロフィールを更新しました');
    }

    //ホームページ
    public function index()
{
    $items = Item::all();
    $favorites = Favorite::where('user_id', auth()->id())->get();

    return view('site.dashboard', compact('items', 'favorites'));
}


    



}
