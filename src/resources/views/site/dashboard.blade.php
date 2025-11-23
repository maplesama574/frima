@extends('site.common2')

@section('css')
<link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
@endsection

@section('content')
<div class="tab-wrapper">

<!--おすすめとマイリストの変更ボタン-->
    <div class="tabs">
        <button class="tab active" data-target="tab1">おすすめ</button>
        <button class="tab" data-target="tab2">マイリスト</button>
    </div>

    <div class="tab-underline"></div>

    <div id="tab1" class="tab-content active">
    @foreach($items as $item)
        <div class="item">
            <a href="{{ route('item.detail', ['item_id' => $item->id]) }}">
                <img src="{{ asset('storage/items/' . $item->image_path) }}" alt="{{ $item->name }}">
                <p class="item-text">{{ $item->name }}</p>
            </a>
        </div>
    @endforeach
</div>

<div id="tab2" class="tab-content">
    @foreach($favorites as $favorite)
        @if($favorite->item) 
            <div class="item">
                <a href="{{ route('item.detail', ['item_id' => $favorite->item->id]) }}">
                    <img src="{{ asset('storage/items/' . $favorite->item->image_path) }}" alt="{{ $favorite->item->name }}">
                    <p class="item-text">{{ $favorite->item->name }}</p>
                </a>
            </div>
        @endif
    @endforeach
</div>




</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".tab");
    const contents = document.querySelectorAll(".tab-content");

    tabs.forEach(tab => {
        tab.addEventListener("click", () => {

            // タブの active 切り替え
            tabs.forEach(t => t.classList.remove("active"));
            tab.classList.add("active");

            // コンテンツの active 切り替え
            contents.forEach(content => content.classList.remove("active"));
            document.getElementById(tab.dataset.target).classList.add("active");
        });
    });
});
</script>

@endsection
