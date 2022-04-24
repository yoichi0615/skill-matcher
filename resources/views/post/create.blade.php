@extends('layouts.app')
@section('content')
<style>
  .card {
    padding: 40px;
    margin-bottom: 20px;
    box-sizing: border-box;
  }

  .heading_label {
    display: flex;
    margin-top: 20px;
  }

  .primaryButton {
    color: #fff;
    display: inline-block;
    box-shadow: 0 0 10px rgb(0 0 0 / 10%);
    box-sizing: border-box;
    font-weight: 600;
}

.store_btn {
  margin-top: 50px;
}

.btn {
    text-align: center;
    border-radius: 100px;
    border: 2px solid #13b1c0;
    color: #13b1c0;
    text-decoration: none;
    padding: 8px 16px;
    background: #fff;
    cursor: pointer;
    font-weight: 700;
    display: inline-block;
}
</style>
<div class="back_white pt-3">
  <h3>自己PRを投稿</h3>
  <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
  {{-- <form action="" method="POST"> --}}
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <div class="card">
      <div class="in">
        <div class="heading_label">
          <span>投稿内容①</span>
          <span style="margin-bottom: 0.5rem;">必須</span>
        </div>
        <div>
          <input type="file" name="image" accept="image/png,image/jpeg,image/gif">
        </div>
        <div class="heading_label">
          <span>投稿内容①</span>
          <span style="margin-bottom: 0.5rem;">必須</span>
        </div>
        <div>
          <input type="text" name="summary" placeholder="PHPについて教えてくれる方募集しています">
        </div>
        <div class="heading_label">
          <span>投稿内容①</span>
          <span style="margin-bottom: 0.5rem;">必須</span>
        </div>
        <div>
          <input type="text" name="want" placeholder="PHPについて教えてくれる方募集しています">
        </div>
        <div class="heading_label">
          <span>投稿を表示する</span>
          <span style="margin-bottom: 0.5rem;">必須</span>
        </div>
        <div>
          <input type="checkbox" name="display_flg" value="1">
        </div>
      
      </div>

      <div class="store_btn">
        <button type="submit" class="btn primaryButton">保存</button>
      </div>
    </div>
  </form>
</div>
@endsection
