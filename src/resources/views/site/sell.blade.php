@extends('site.common2')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')

<div class="sell">
    <h2>商品の出品</h2>

    <form action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="image">
            <p class="sell-title">商品画像</p>
            <div class="image-wrapper">
                <div class="image-border">
                <label for="image-upload" class="image-label">
                    <div class="image-sell" id="sellImage"></div>
                    <span class="image-text">画像を選択する</span>
                </label>
                </div>
                <input type="file" id="image-upload" name="image" accept="image/*" hidden>
            </div>
            @error('image')
                <div class="input-error">{{ $message }}</div>
            @enderror
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
            @error('category')
                <div class="input-error__category">{{ $message }}</div>
            @enderror
        </div>

        <div class="condition">
            <p class="sell-title">商品の状態</p>
            <select class="select-box" name="condition" id="condition">
                <option value="" selected disabled>選択してください</option>
                @foreach(['良好','目立った傷や汚れなし','やや傷や汚れあり','状態が悪い'] as $condition)
                    <option value="{{ $condition }}">{{ $condition }}</option>
                @endforeach
            </select>
            @error('condition')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="detail">
            <h3>商品名と説明</h3>
            <div class="line"></div>
        <div class="detail-box">
            <p class="sell-title">商品名</p>
            <input type="text" name="commodity_name">
            @error('commodity_name')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="detail-box">
            <p class="sell-title">ブランド名</p>
            <input type="text" name="brand">
            @error('brand')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="detail-box">
            <p class="sell-title">商品の説明</p>
            <textarea name="description"></textarea>
            @error('description')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="detail-box">
            <p class="sell-title">販売価格</p>
            <div class="price-wrapper">
                <input type="number" name="price" class="price-input">
            </div>
            @error('price')
                <div class="input-error">{{ $message }}</div>
            @enderror
        </div>
        </div>
        <button class="sell-button">出品する</button>
    </form>
</div>

<!-- カテゴリー選択JS -->
<script>
const imageInput = document.getElementById('image-upload');
const sellImage = document.getElementById('sellImage');

imageInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = (e) => {
        sellImage.style.backgroundImage = `url(${e.target.result})`;
        sellImage.style.backgroundSize = 'cover';
        sellImage.style.backgroundPosition = 'center';
        sellImage.style.width = '200px';   
        sellImage.style.height = '200px';  
        sellImage.style.borderRadius = '5px';
    };
    reader.readAsDataURL(file);
});


document.querySelectorAll('.category-item').forEach(item => {
    item.addEventListener('click', () => {

        item.classList.toggle('active');

        const selected = [...document.querySelectorAll('.category-item.active')]
            .map(i => i.dataset.value);

        document.getElementById('category-input').value = selected.join(',');
    });
});



</script>


@endsection
