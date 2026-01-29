@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
@endsection

@section('header-nav')
<nav class="header__nav">
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="logout-btn">logout</button>
  </form>
</nav>
@endsection

@section('content')
<div class="admin">

  <h2 class="admin__title">Admin</h2>

  <div class="admin__container">

    <form class="admin__search" method="GET" action="{{ route('admin.admin') }}">
      <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

      <select name="gender">
        <option value="">性別</option>
        <option value="1" @selected(request('gender') == '1')>男性</option>
        <option value="2" @selected(request('gender') == '2')>女性</option>
        <option value="3" @selected(request('gender') == '3')>その他</option>
      </select>

      <input type="text" name="category" placeholder="お問い合わせの種類" value="{{ request('category') }}">

      <input type="date" name="date" value="{{ request('date') }}">

      <button class="search-btn">検索</button>
      <a href="{{ route('admin.admin') }}" class="reset-btn">リセット</a>
    </form>

    <div class="admin__export-row">
      <div class="admin__export">
        <a href="{{ route('admin.export', request()->query()) }}">エクスポート</a>
      </div>

      <div class="admin__pagination">
        @if ($contacts->hasPages())
        <nav>
          <ul>

            {{-- 前へ --}}
            @if ($contacts->onFirstPage())
              <li class="disabled"><span>&lt;</span></li>
            @else
              <li>
                <a href="{{ $contacts->previousPageUrl() }}">&lt;</a>
              </li>
            @endif

            {{-- ページ番号 --}}
            @foreach ($contacts->links()->elements[0] ?? [] as $page => $url)
              @if ($page == $contacts->currentPage())
                <li class="active"><span>{{ $page }}</span></li>
              @else
                <li><a href="{{ $url }}">{{ $page }}</a></li>
              @endif
            @endforeach

            {{-- 次へ --}}
            @if ($contacts->hasMorePages())
              <li>
                <a href="{{ $contacts->nextPageUrl() }}">&gt;</a>
              </li>
            @else
              <li class="disabled"><span>&gt;</span></li>
            @endif

          </ul>
        </nav>
        @endif
      </div>
    </div>
    
    <table class="admin__table">
      <thead>
        <tr>
          <th>お名前</th>
          <th>性別</th>
          <th>メールアドレス</th>
          <th>お問い合わせの種類</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($contacts as $contact)
        <tr>
          <td>{{ $contact->full_name }}</td>
          <td>{{ $contact->gender_label }}</td>
          <td>{{ $contact->email }}</td>
          <td>{{ $contact->category->content ?? '' }}</td>
          <td>
            <a href="#delete-{{ $contact->id }}" class="detail-btn">詳細</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>

@foreach($contacts as $contact)
<div id="delete-{{ $contact->id }}" class="modal">
  <div class="modal__content">
    <a href="#" class="modal__close">×</a>

    <dl class="modal__list">
      <dt>お名前</dt>
      <dd>{{ $contact->full_name }}</dd>

      <dt>性別</dt>
      <dd>{{ $contact->gender_label }}</dd>

      <dt>メールアドレス</dt>
      <dd>{{ $contact->email }}</dd>

      <dt>電話番号</dt>
      <dd>{{ $contact->tel }}</dd>

      <dt>住所</dt>
      <dd>{{ $contact->address }}</dd>

      <dt>建物名</dt>
      <dd>{{ $contact->building }}</dd>

      <dt>お問い合わせの種類</dt>
      <dd>{{ $contact->category->content }}</dd>

      <dt>お問い合わせ内容</dt>
      <dd>{{ $contact->detail }}</dd>
    </dl>

    <form method="POST" action="{{ route('admin.delete', $contact->id) }}">
      @csrf
      @method('DELETE')
      <button class="delete-btn">削除</button>
    </form>
  </div>
</div>
@endforeach
@endsection
