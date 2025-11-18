<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class FrimaController extends Controller
{
    public function register(){
        return view('site.register');
    }
    public function email(){
        return view('site.email');
    }
    public function login(){
        return view('site.login');
    }
    public function first(){
        return view('site.first-login');
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

//画像保存
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

        return redirect('/');
    }

}


