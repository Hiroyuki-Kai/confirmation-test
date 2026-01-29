@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/contact/index.css') }}" />
@endsection

@section('content')
<div class="contact-form__content">
  <div class="contact-form__heading">
    <h2>Contact</h2>
  </div>
  <form class="form" action="{{ route('contact.confirm') }}" method="POST" novalidate>
    @csrf
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お名前</span>
        <span class="form__label--required">※</span>
      </div>

      <div class="form__group-content">
        <div class="form__group-content--row">
          <div class="form__input--name">
            <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}"/>
          </div>
          <div class="form__input--name">
            <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}"/>
          </div>
        </div>

        @if($errors->has('last_name') || $errors->has('first_name'))
          <div class="form__error">
            @if($errors->has('last_name') && $errors->has('first_name'))
              <p>{{ $errors->first('name') }}</p>
            @elseif($errors->has('last_name'))
              <p>{{ $errors->first('last_name') }}</p>
            @elseif($errors->has('first_name'))
              <p>{{ $errors->first('first_name') }}</p>
            @endif
          </div>
        @endif
      </div>
    </div>

    <div class="form__group form__group--radio">
      <div class="form__group-title">
        <span class="form__label--item">性別</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--radio">
          <label>
            <input type="radio" name="gender" value="1" {{ old('gender', 1) == 1 ? 'checked' : ''}} />男性
          </label>
          <label>
            <input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : ''}}  />女性
          </label>
          <label>
            <input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : ''}} />その他
          </label>
        </div>

        @error('gender')
        <div class="form__error">
          <p>{{ $message }}</p>
        </div>
        @enderror
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">メールアドレス</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}"/>
        </div>

        @if ($errors->has('email'))
        <div class="form__error">
          @error('email') <p>{{ $message }}</p> @enderror
        </div>
        @endif
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">電話番号</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--tel">
          <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}"/>
          <span class="tel__hyphen">-</span>
          <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}"/>
          <span class="tel__hyphen">-</span>
          <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}"/> 
        </div>

        @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))  
        <div class="form__error">
          @error('tel') <p>{{ $message }}</p> @enderror
        </div>
        @endif
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">住所</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}"/>
        </div>

        @if ($errors->has('address'))
        <div class="form__error">
          @error('address') <p>{{ $message }}</p> @enderror
        </div>
        @endif
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">建物名</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}"/>
        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お問い合わせの種類</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--select">
          <select name="category_id">
            <option value="" disabled selected>選択してください</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}"
                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->content }}
              </option>
            @endforeach
          </select>
        </div>

        @if($errors->has('category_id'))
        <div class="form__error">
          @error('category_id') <p>{{ $message }}</p> @enderror
        </div>
        @endif
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お問い合わせ内容</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--textarea">
          <textarea name="content" placeholder="お問い合わせ内容をご記載ください">{{ old('content') }}</textarea>
        </div>

        @if($errors->has('content'))
        <div class="form__error">
          @error('content') <p>{{ $message }}</p> @enderror
        </div>
        @endif
      </div>
    </div>

    <div class="form__button">
      <button class="form__button-submit" type="submit">確認画面</button>
    </div>
  </form>
</div>
@endsection
