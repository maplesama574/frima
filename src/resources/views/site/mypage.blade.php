@extends('site.common2')

@section('css')
<link rel="stylesheet" href="{{asset('css/mypage.css')}}">
@endsection

@section('content')

<div class="profile">

    <div class="profile-content">

        <form action="{{route('mypage')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="profile-image-wrapper">
                <label for="image-upload" class="image-label">
                    <div class="profile-image" id="profileImage" 
                    style="background-image: url('{{ $user->profile_image ? asset('storage/' . $user->profile_image) : '' }}')">
                    </div>
                    <span class="user">
                        {{ auth()->check() ? auth()->user()->name : '未登録' }}
                    </span>
                    <a class="profile-edit" href="{{route('profile.edit')}}">プロフィールを編集</a>
                </label>
                <input type="file" id="image-upload" name="image" accept="image/*" hidden>
            </div>

        </form>

    </div>

    <!-- タブ -->
    <div class="tabs">
        <button class="tab active" type="button" data-target="tab1">出品した商品</button>
        <button class="tab" type="button" data-target="tab2">購入した商品</button>
    </div>

    <div class="tab-underline"></div>
<!--出品した商品-->
    <div id="tab1" class="tab-content active">
    @foreach($listedItems as $item)
        <div class="item">
            <a href="{{ route('item.detail', ['item_id' => $item->id]) }}" 
               data-sold="{{ $item->is_sold ? '1' : '0' }}">
                <div class="image-wrapper">
                    <img src="{{ asset('storage/'.$item->image_path) }}" alt="{{ $item->name }}">
                    @if($item->is_sold)
                        <span class="soldout">Sold</span>
                    @endif
                </div>
                <p class="item-text">{{ $item->name }}</p>
            </a>
        </div>
    @endforeach
</div>

<div id="tab2" class="tab-content">
    @foreach($purchasedItems as $item)
        <div class="item">
            <a href="{{ route('item.detail', ['item_id' => $item->id]) }}" 
               data-sold="{{ $item->is_sold ? '1' : '0' }}">
                <div class="image-wrapper">
                    <img src="{{ asset('storage/'.$item->image_path) }}" alt="{{ $item->name }}">
                    @if($item->is_sold)
                        <span class="soldout">Sold</span>
                    @endif
                </div>
                <p class="item-text">{{ $item->name }}</p>
            </a>
        </div>
    @endforeach
</div>


</div> 

<script>
document.addEventListener("DOMContentLoaded", () => {
    // すべてのリンクを取得
    const links = document.querySelectorAll('.item a');

    links.forEach(link => {
        if(link.dataset.sold === "1") {
            // クリックを無効化
            link.addEventListener('click', function(e) {
                e.preventDefault();
            });
            // 見た目も薄くする
            link.style.pointerEvents = "none";
            link.style.cursor = "default";
        }
    });

    // タブ切り替え
    const tabs = document.querySelectorAll(".tab");
    const contents = document.querySelectorAll(".tab-content");

    tabs.forEach(tab => {
        tab.addEventListener("click", () => {
            tabs.forEach(t => t.classList.remove("active"));
            contents.forEach(c => c.classList.remove("active"));

            tab.classList.add("active");
            document.getElementById(tab.dataset.target).classList.add("active");
        });
    });
});
</script>

@endsection
