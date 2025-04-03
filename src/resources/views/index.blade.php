@extends('layouts.app') 
@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
<!-- 既存のCSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<!-- jQuery を追加 (CDN) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- BootstrapのJS（ポップアップなどに必要） -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection @section('content')
<div class="todo__alert">
  @if (session('message'))
  <div class="todo__alert--success">{{ session('message') }}</div>
  @endif @if ($errors->any())
  <div class="todo__alert--danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>
<div class="section__title">
  <h2>Admin</h2>
</div>
<form class="search-form" action="/admin/search" method="get">
    @csrf
   <div class="search-form__item">
     <!-- キーワード入力欄に old() を適用 -->
     <input class="search-form__item-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" style="color: #8a7967;" value="{{ old('keyword', request('keyword')) }}">

     <!-- 性別セレクトボックスに old() を適用 -->
     <select class="search-form__item-select_gender" name="gender" style="color: #8a7967;">
        <option value="">性別 ▼</option>
        <option value="1" {{ old('gender', request('gender')) == 1 ? 'selected' : '' }}>男性</option>
        <option value="2" {{ old('gender', request('gender')) == 2 ? 'selected' : '' }}>女性</option>
        <option value="3" {{ old('gender', request('gender')) == 3 ? 'selected' : '' }}>その他</option>
     </select>

      <!-- カテゴリセレクトボックスに old() を適用 -->
      <select class="search-form__item-select" name="category_id" style="color: #8a7967;">
        <option value="">お問い合わせの種類 ▼</option>
        @foreach ($categories as $category)
          <option value="{{ $category['id'] }}" {{ old('category_id', request('category_id')) == $category['id'] ? 'selected' : '' }}>
            {{ $category['name'] }}
          </option>
        @endforeach
      </select>

      <!-- 日付入力フィールドに old() を適用 -->
      <input class="search-form__item-input_time" type="date" name="created_at" style="color: #8a7967;" value="{{ old('created_at', request('created_at')) }}">
    </div>
   <div class="search-form__button">
     <button class="search-form__button-submit" type="submit">検索</button>
     <!-- リセットボタン追加 -->
     <button class="search-form__button-reset" type="reset" onclick="window.location.href='/admin'">リセット</button>
   </div>
</form>
<div class="pagination-wrapper"></div>
{{ $contacts->appends(request()->query())->onEachSide(1)->links('vendor.pagination.custom') }}
<div class="todo__content">
  <div class="todo-table">
    <table class="todo-table__inner">
  <thead>
    <tr class="todo-table__row">
      <th class="todo-table__header">お名前</th>
      <th class="todo-table__header">性別</th>
      <th class="todo-table__header">メールアドレス</th>
      <th class="todo-table__header">お問い合わせの種類</th>
      <th class="todo-table__header"></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($contacts as $contact)
      <tr class="contact-table__row">
        <td class="contact-table__item">{{ $contact->last_name }} {{ $contact->first_name }}</td>
        <td class="contact-table__item">
          {{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}
        </td>
        <td class="contact-table__item">{{ $contact->email }}</td>
        <td class="contact-table__item">{{ $contact->category->name ?? 'カテゴリなし' }}</td>
        <td class="contact-table__item">
          <button type="button" class="detail-button"
            data-bs-toggle="modal"
            data-bs-target="#detailModal"
            data-contact="{{ json_encode([
              'id' => $contact->id,
              'first_name' => $contact->first_name,
              'last_name' => $contact->last_name,
              'gender' => $contact->gender,
              'email' => $contact->email,
              'tell' => $contact->tell, 
              'address' => $contact->address, 
              'building' => $contact->building, 
              'category' => $contact->category,
              'detail' => $contact->detail
            ]) }}">
            詳細
          </button>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

  </div>
  <!-- モーダルのHTMLを content の最後に追加 -->
  <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel"></h5>
          <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">✕</button>      </div>
      <div class="modal-body">
        <div id="contactDetail">
          <!-- 詳細情報がここに表示される -->
        </div>
        <div class="modal-footer">
        <!-- 削除フォーム -->
        <form id="deleteForm" action="/delete" method="post" style="display:inline;">
          @method('DELETE')
          @csrf
          <input type="hidden" id="contactId" name="id" value="">
          <button type="submit" class="btn btn-danger">削除</button>
        </form>
      </div>
    </div>
  </div>
</div>
  <script>
  // モーダルが開かれたときに呼ばれるイベントリスナー
  $('#detailModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // 詳細ボタン
    var contactData = button.data('contact'); // 詳細ボタンのデータ属性から連絡先情報を取得

   // 性別の処理（数値に変換してから処理）
  var genderText = '';
  var gender = parseInt(contactData.gender, 10);  // ここで型を数値に変換

  if (gender === 1) {
    genderText = '男性';
  } else if (gender === 2) {
    genderText = '女性';
  } else if (gender === 3) {
    genderText = 'その他';
  } else {
    genderText = '不明';
  }

  // お問い合わせの種類（カテゴリ）
  var categoryName = contactData.category ? contactData.category.name : 'カテゴリなし';

    // モーダルのボディに表示する内容を設定
    var modalBody = $(this).find('.modal-body #contactDetail');
    modalBody.html(`
      <p><strong>お名前:</strong> ${contactData.last_name}  ${contactData.first_name} </p>
      <p><strong>性別:</strong> ${genderText}</p>
      <p><strong>メールアドレス:</strong> ${contactData.email}</p>
      <p><strong>電話番号:</strong> ${contactData.tell}</p>
      <p><strong>住所:</strong> ${contactData.address}</p>
      <p><strong>建物名:</strong> ${contactData.building}</p>
      <p><strong>お問い合わせの種類:</strong> ${categoryName}</p>
      <p><strong>お問い合わせの内容:</strong> ${contactData.detail}</p>
    `);

    // 削除フォームに連絡先IDをセット
    var deleteForm = $(this).find('#deleteForm');
    var contactId = contactData.id; // 連絡先のIDを取得
    $('#contactId').val(contactId); // 隠しフィールドにIDをセット
  });
  </script>

</div>
@endsection

