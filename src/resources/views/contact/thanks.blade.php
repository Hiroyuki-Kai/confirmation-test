@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/contact/thanks.css') }}">
@endsection

@section('content')
<div class="thanks">
  <div class="thanks__inner">
    <p class="thanks__message">お問い合わせありがとうございました</p>
    <a href="{{ route('contact.index') }}" class="thanks__button">HOME</a>
  </div>
</div>
@endsection