@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/contact/confirm.css') }}" />
@endsection

@section('content')
<div class="confirm__content">
  <div class="confirm__heading">
    <h2>Confirm</h2>
  </div>
  <div class="confirm-table">
    <table class="confirm-table__inner">
      <tr class="confirm-table__row">
        <th class="confirm-table__header">お名前</th>
        <td class="confirm-table__text">
          <input type="text" name="name" value="{{ $contact['last_name'] }}   {{ $contact['first_name'] }}" readonly />
        </td>
      </tr>

      @php
        $genderLabel = [
          1 => '男性',
          2 => '女性',
          3 => 'その他'
        ]
      @endphp

      <tr class="confirm-table__row">
        <th class="confirm-table__header">性別</th>
        <td class="confirm-table__text">
          <!-- <input type="text" name="gender" value="{{ $contact['gender'] }}" readonly /> -->
          <!-- {{ $genderLabel[$contact['gender']] ?? '' }} -->
          {{ $contact['gender_label'] }}
        </td>
      </tr>

      <tr class="confirm-table__row">
        <th class="confirm-table__header">メールアドレス</th>
        <td class="confirm-table__text">
          <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
        </td>
      </tr>

      <tr class="confirm-table__row">
        <th class="confirm-table__header">電話番号</th>
        <td class="confirm-table__text">
          <input type="tel" name="tel" value="{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}" readonly/>
        </td>
      </tr>

      <tr class="confirm-table__row">
        <th class="confirm-table__header">住所</th>
        <td class="confirm-table__text">
          <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
        </td>
      </tr>

      <tr class="confirm-table__row">
        <th class="confirm-table__header">建物名</th>
        <td class="confirm-table__text">
          <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
        </td>
      </tr>

      <tr class="confirm-table__row">
        <th class="confirm-table__header">お問い合わせの種類</th>
        <td class="confirm-table__text">
          <!-- {{ $category->content ?? '' }} -->
          {{ $contact['category_name'] }}
        </td>
      </tr>

      <tr class="confirm-table__row">
        <th class="confirm-table__header">お問い合わせ内容</th>
        <td class="confirm-table__text">
          <input type="text" name="content" value="{{ $contact['content'] }}" readonly />
        </td>
      </tr>
    </table>
  </div>

  <div class="form__button-group">
    <div class="form__button">
      <form action="{{ route('contact.store')}}" method="POST">
      @csrf

      @foreach($contact as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
      @endforeach

        <button class="form__button-submit" type="submit">送信</button>
      </form>

      <form action="{{ route('contact.revise')}}" method="POST">
      @csrf
          <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
          <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
          <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
          <input type="hidden" name="email" value="{{ $contact['email'] }}">
          <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
          <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
          <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
          <input type="hidden" name="address" value="{{ $contact['address'] }}">
          <input type="hidden" name="building" value="{{ $contact['building'] }}">
          <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
          <input type="hidden" name="content" value="{{ $contact['content'] }}">

        <button type="submit" class="form__button-revise">修正</button>
      </form>
    </div>
  </div>

</div>
@endsection
