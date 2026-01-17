@extends('site.common2')

@section('css')
<link rel="stylesheet" href="{{asset('css/item-detail.css')}}">
@endsection

@section('content')
<div class="item-detail">
    <div class="item-detail__img">
        <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : asset('images/no-image.png') }}" alt="{{ $item->name }}">
    </div>
    <div class="item-detail__text">
        <div class="purchase-form">
            <h2>{{ $item->name }}</h2>
            <span class="item-brand">{{ $item->brand }}</span>
            <p class="item-normal">￥{{ number_format($item->price) }}(税込)</p>

            <div class="reaction">
                <div class="reaction-icon">
                    <img
                    src="{{ in_array($item->id, $likedItemIds) ? asset('images/ハートロゴ_ピンク.png') : asset('images/ハートロゴ_デフォルト.png') }}"
                    class="like-icon"
                    data-liked="{{ in_array($item->id, $likedItemIds) ? 'true' : 'false' }}"
                    alt="いいね">
                    <div class="reaction-count">
                        <span>{{ $item->favorites_count }}</span>
                    </div>
                </div>
                <div class="reaction-icon">
                    <img src="{{ asset('images/ふきだしロゴ.png') }}" alt="ふきだし">
                    <div class="reaction-count">
                    <span>{{ $item->comments->count() }}</span>
                    </div>
                </div>
            </div>


            <form method="GET" action="{{ route('item.buy', ['item_id' => $item->id]) }}">
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
                    <td class="table-detail">@foreach(explode(',', $item->category) as $category)
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
    <h3>コメント（{{ $commentCount }}件）</h3>

    @foreach($item->comments as $comment)
    <div class="comment-item">
        <img
            src="{{ $comment->user->profile_image
                ? asset('storage/' . $comment->user->profile_image)
                : asset('images/default-user.png') }}"
            class="comment-icon"
            alt="ユーザーアイコン"
        >
        <p class="comment-user">
                {{ $comment->user->name }}
        </p>
    </div>
        <div class="comment-body">
            <p class="comment-box">
                {{ $comment->comment }}
            </p>
        </div>
@endforeach
                <form action="{{ route('comment.store', ['item_id' => $item->id]) }}" method="POST">
                    @csrf
                    <label>
                        <p class="item-comment">商品へのコメント</p>
                        <textarea name="comment"></textarea>
                        @error('comment')
    <p class="input-error">{{ $message }}</p>
@enderror

                    </label>
                        <button class="comment-button">コメントを送信する</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--いいね-->
<script>
document.querySelectorAll('.like-icon').forEach(icon => {
    icon.addEventListener('click', () => {
        const itemId = "{{ $item->id }}";
        const countSpan = icon.parentElement.querySelector('.reaction-count span');

        fetch(`/items/${itemId}/favorite`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'added') {
                icon.src = "{{ asset('images/ハートロゴ_ピンク.png') }}";
                icon.dataset.liked = 'true';
            } else {
                icon.src = "{{ asset('images/ハートロゴ_デフォルト.png') }}";
                icon.dataset.liked = 'false';
            }
            countSpan.textContent = data.count;
        })
        .catch(err => console.error(err));
    });
});
</script>





@endsection