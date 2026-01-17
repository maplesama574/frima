@extends('site.common2')

@section('css')
<link rel="stylesheet" href="{{asset('css/profile-edit.css')}}">
@endsection

@section('content')
<div class="profile">
    <h2>プロフィール設定</h2>
    <div class="profile-content">
        <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="profile-image-wrapper">
                <label for="image-upload" class="image-label">
                    <div class="profile-image" id="profileImage" 
                    style="background-image: url('{{ $user->profile_image ? asset('storage/' . $user->profile_image) : '' }}')">
                    </div>
                    <span class="image-text">画像を選択する</span>
                </label>
                <input type="file" id="image-upload" name="image" accept="image/*" hidden>
            </div>


<div class="upload-item">
    <label class="upload-item__title">ユーザー名</label>
    <input class="upload-input" type="text" name="name" value="{{ old('name', $user->name ?? '') }}">
</div>

<div class="upload-item">
    <label class="upload-item__title">郵便番号</label>
    <input class="upload-input" type="number" name="postal_code" value="{{ old('postal_code', $user->postal_code ?? '') }}">
</div>

<div class="upload-item">
    <label class="upload-item__title">住所</label>
    <input class="upload-input" type="text" name="address" value="{{ old('address', $user->address ?? '') }}">
</div>

<div class="upload-item">
    <label class="upload-item__title">建物名</label>
    <input class="upload-input" type="text" name="building" value="{{ old('building', $user->building ?? '') }}">
</div>
            <div class="button">
                <button class="upload-button">更新する</button>
            </div>

<!--モーダル-->
<script>
const imageInput = document.getElementById('image-upload');
const profileImage = document.getElementById('profileImage');

imageInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            profileImage.style.backgroundImage = `url(${e.target.result})`;
        }
        reader.readAsDataURL(file);
    }
});
</script>

        </form>
    </div>
</div>
@endsection