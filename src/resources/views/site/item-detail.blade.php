@extends('site.common2')

@section('css')
<link rel="stylesheet" href="{{asset('css/item-detail.css')}}">
@endsection

@section('content')
<div class="item-detail">
    <div class="item-detail__img">
        <img src="{{ asset('storage/items/' . $item->image_path) }}" alt="{{ $item->name }}">
    </div>
    <div class="item-detail__text">
        <div class="purchase-form">
            <h2>{{ $item->name }}</h2>
            <span class="item-brand">{{ $item->brand }}</span>
            <p class="item-normal">￥{{ number_format($item->price) }}(税込)</p>
            <form method="POST" action="{{route('item.detail', ['item_id' => $item->id])}}">
                @csrf
                <button class="purchase-button">購入手続きへ</button>
            </form>
        </div>
        <div class="comment-form">
            <h3>商品説明</h3>
            <p class="item-small">{{$item->description}}</p>
            <h3>商品の情報</h3>
            <table class="information-table">
                <tr class="table-content">
                    <th class="table-header">カテゴリー</th>
                    <td class="table-detail">@foreach(explode(' ', $item->categories) as $category)
                    <span class="category-block">{{ $category }}</span>
                    @endforeach
                    </td>
                </tr>
                <tr class="table-content">
                    <th class="table-header">商品の状態</th>
                    <td class="table-detail">{{$item->condition}}</td>
                </tr>
            </table>
            <div class="comment">
                <h3>コメント</h3>
                <p class="comment-box">こちらにコメントが入ります。</p>
                <form action="{{ route('comment.store', ['item_id' => $item->id]) }}" method="POST">
                    @csrf
                    <label>
                        <p class="item-comment">商品へのコメント</p>
                        <textarea name="text"></textarea>
                    </label>
                        <button class="comment-button">コメントを送信する</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection