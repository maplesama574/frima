@extends('site.common2')

@section('css')
<link rel="stylesheet" href="{{asset('css/purchase.css')}}">
@endsection

@section('content')
<div class="purchase">
    <div class="detail">
        <div class="detail-1">
            <div class="detail-img">
                <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : asset('images/no-image.png') }}" alt="{{ $item->name }}">
            </div>
            <div class="detail-text">
                <h2>{{ $item->name }}</h2>
                <p class="detail-price">￥{{ number_format($item->price) }}</p>
            </div>
        </div>

        <div class="line"></div>

        <form action="{{ route('item.checkout', $item->id) }}" method="POST">
            @csrf

            <div class="detail-2">
                <p class="detail-title">支払い方法</p>
                <select class="detail-select" name="payment_method" id="payment-select">
                    <option value="" selected disabled>選択してください</option>
                    @foreach(['convenience' => 'コンビニ払い', 'card' => 'カード払い'] as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                    @error('payment_method')
                        <div class="input-error">{{ $message }}</div>
                    @enderror
            </div>

            <div class="line"></div>

            <div class="detail-3">
                <div class="address-title">
                    <p class="detail-title">配送先</p>
                    <a class="detail-blue" href="{{ route('profile.edit') }}">変更する</a>
                </div>
                <div class="address">
                    <p class="address-content">
                        〒{{ auth()->user()->postal_code ?? '' }}<br>
                        {{ auth()->user()->address ?? '' }}
                        <br>
                        {{ auth()->user()->building ?? '' }}
                    </p>
                </div>
            </div>

            <div class="line"></div>

    </div>

    <div class="price">
        <table class="table">
            <tr class="table-wrapper">
                <th class="table-header">商品代金</th>
                <td class="table-data--price">¥{{ $item->price }}</td>
            </tr>

            <tr class="table-wrapper">
                <th class="table-header">支払い方法</th>
                <td class="table-data payment-output"></td>
            </tr>
        </table>
        <button type="submit" class="submit">購入する</button>
    </div>
        </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.querySelector('select[name="payment_method"]');
        const output = document.querySelector('.payment-output');

        select.addEventListener('change', function () {
            const label = select.options[select.selectedIndex].text;
            output.textContent = label;
        });
    });
</script>

@endsection
