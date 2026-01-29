@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
@endsection

@section('header-nav')
<nav class="header__nav">
  <a href="{{ route('login') }}">login</a>
</nav>
@endsection

@section('content')
<div class="auth-wrapper">
  <div class="auth">
    <div class="auth__title"><h2>Register</h2></div>

    <form method="POST" action="/register" novalidate>
      @csrf
      <div class="auth__card">

        <label class="auth__label">お名前</label>
        <input class="auth__input" type="text" name="name" placeholder="例: 山田　太郎">
        @error('name')
          <p class="auth__error">{{ $message }}</p>
        @enderror
        
        <label class="auth__label">メールアドレス</label>
        <input class="auth__input" type="email" name="email" placeholder="例: test@example.com">
        @error('email')
          <p class="auth__error">{{ $message }}</p>
        @enderror
        
        <label class="auth__label">パスワード</label>
        <input class="auth__input" type="password" name="password" placeholder="例: coachtech1106">
        @error('password')
          <p class="auth__error">{{ $message }}</p>
        @enderror

        <div class="auth__button">
          <button class="auth__button-submit">登録</button>
        </div>

      </div>
    </form>
  </div>
</div>
@endsection