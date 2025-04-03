<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/input.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        FashionablyLate
      </a>
    </div>
  </header>

  <main>
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>Contact</h2>
      </div>
      <form class="form" action="/confirm" method="post">
        @csrf
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お名前</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text-name">
              <input type="text" name="first_name" placeholder="    例: 山田" value="{{ old('first_name', session('contact.first_name', '')) }}"/>
              <input type="text" name="last_name" placeholder="    例: 太郎" value="{{ old('last_name', session('contact.last_name', '')) }}"/>
            </div>
            <div class="form__error">
                @error('first_name')
                {{ $message }}
                @enderror
                @error('last_name')
                {{ $message }}
                @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">性別</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content-radio">
            <label>
                <input type="radio" name="gender" value="1" checked {{ old('gender', session('contact.gender')) == 1 ? 'checked' : '' }}> 男性
            </label>
            <label>
                <input type="radio" name="gender" value="2" {{ old('gender', session('contact.gender')) == 2 ? 'checked' : '' }}> 女性
            </label>
            <label>
                <input type="radio" name="gender" value="3" {{ old('gender', session('contact.gender')) == 3 ? 'checked' : '' }}> その他
            </label>
            <div class="form__error">
                @error('gender')
                {{ $message }}
                @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="email" name="email" placeholder="    test@example.com" value="{{ old('email', session('contact.email', '')) }}"/>
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">電話番号</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text-phone">
              <input type="text" name="phone1" value="{{ old('phone1', session('contact.phone1', '')) }}" maxlength="4" placeholder="                  080" />
              -
              <input type="text" name="phone2" value="{{ old('phone2', session('contact.phone2', '')) }}" maxlength="4" placeholder="                  1234" />
              -
              <input type="text" name="phone3" value="{{ old('phone3', session('contact.phone3', '')) }}" maxlength="4" placeholder="                  5678" />
            </div>
            <div class="form__error">
                @error('phone1')
                {{ $message }}
                @enderror
                @error('phone2')
                {{ $message }}
                @enderror
                @error('phone3')
                {{ $message }}
                @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">住所</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="address" placeholder="    例:東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', session('contact.address', '')) }}"/>
            </div>
            <div class="form__error">
                @error('address')
                {{ $message }}
                @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">建物名</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="building" placeholder="    例:千駄ヶ谷マンション101" value="{{ old('building', session('contact.building', '')) }}"/>
            </div>
            <div class="form__error">
                @error('building')
                {{ $message }}
                @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お問い合わせの種類</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <select class="create-form__item-select" name="category_id" style="color: gray;">
                <option value="">   選択してください ▼</option>
            @foreach ($categories as $category)
                <option value="{{ $category['id'] }}" {{ old('category_id', session('contact.category_id')) == $category->id ? 'selected' : '' }}>{{ $category['name'] }}</option>
            @endforeach
            </select>
            <div class="form__error">
                @error('category_id')
                {{ $message }}
                @enderror
            </div>
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お問い合わせ内容</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--textarea">
              <textarea name="detail" placeholder="  お問い合わせ内容をご記載ください">{{ old('detail', session('contact.detail', '')) }}</textarea>
            </div>
                <div class="form__error">
                @error('detail')
                {{ $message }}
                @enderror
            </div>
          </div>
        </div>
        <div class="form__button">
          <button class="form__button-submit" type="submit">確認画面</button>
        </div>
      </form>
    </div>
  </main>
</body>

</html>
