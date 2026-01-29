@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/delete.css') }}">
@endsection

@section('content')
<div class="modal-overlay">
  <div class="modal-card">

    {{-- 閉じる（管理画面へ戻る） --}}
    <a href="{{ route('admin.admin') }}" class="modal-close">×</a>

    <h3 class="modal-title">お問い合わせ詳細</h3>

    <div class="modal-body">
      <div class="modal-row">
        <span>お名前</span>
        <span>{{ $contact->full_name }}</span>
      </div>

      <div class="modal-row">
        <span>性別</span>
        <span>{{ $contact->gender_label }}</span>
      </div>

      <div class="modal-row">
        <span>メールアドレス</span>
        <span>{{ $contact->email }}</span>
      </div>

      <div class="modal-row">
        <span>電話番号</span>
        <span>{{ $contact->tel }}</span>
      </div>

      <div class="modal-row">
        <span>住所</span>
        <span>{{ $contact->address }}</span>
      </div>

      <div class="modal-row">
        <span>建物名</span>
        <span>{{ $contact->building }}</span>
      </div>

      <div class="modal-row">
        <span>お問い合わせの種類</span>
        <span>{{ $contact->category->content }}</span>
      </div>

      <div class="modal-row">
        <span>お問い合わせ内容</span>
        <span>{{ $contact->detail }}</span>
      </div>
    </div>

    {{-- 削除 --}}
    <form method="POST" action="{{ route('admin.delete', $contact->id) }}">
      @csrf
      @method('DELETE')
      <button class="delete-btn">削除</button>
    </form>

  </div>
</div>
@endsection
