@extends('site.common2')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')

<div class="sell">
    <h2>商品の出品</h2>

    <form action="{{ route('sell') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="image">
            <p class="sell-title">商品画像</p>
            <div class="image-wrapper">
                <label for="image-upload" class="image-label">
                    <div class="image-sell" id="sellImage"></div>
                    <span class="image-text">画像を選択する</span>
                </label>
                <input type="file" id="image-upload" name="image" accept="image/*" hidden>
            </div>
        </div>

        <div class="category">
            <h3>商品の詳細</h3>
            <div class="line"></div>
            <p class="sell-title">カテゴリー</p>
            <div class="category-selection">
                @foreach($categories as $category)
                    <span class="category-item" data-value="{{ $category }}">{{ $category }}</span>
                @endforeach
                <input type="hidden" name="category" id="category-input">
            </div>
        </div>

        <div class="condition">
            <p class="sell-title">商品の状態</p>
            <select name="condition" id="condition">
                @foreach(['新品','良好','目立った傷や汚れなし','やや傷や汚れあり','状態が悪い'] as $condition)
                    <option value="{{ $condition }}">{{ $condition }}</option>
                @endforeach
            </select>
        </div>

        <div class="detail">
            <p class="sell-title">商品名</p>
            <input type="text" name="name">

            <p class="sell-title">ブランド名</p>
            <input type="text" name="brand">

            <p class="sell-title">商品の説明</p>
            <textarea name="description"></textarea>

            <p class="sell-title">販売価格</p>
            <input type="number" name="price" class="price-input">
        </div>

        <button class="sell-button">出品する</button>
    </form>
</div>

<!-- カテゴリー選択JS -->
<script>
const items = document.querySelectorAll('.category-item');
const input = document.getElementById('category-input');

items.forEach(item => {
    item.addEventListener('click', () => {
        item.classList.toggle('active');
        const selected = Array.from(items)
            .filter(i => i.classList.contains('active'))
            .map(i => i.dataset.value);

        input.value = selected.join(' ');
    });
});
</script>

@endsection
