<x-logout-layout>
  <div id="clear">
    <div class=user_name>
      <p>{{session('username') }}さん</p>
      <p>ようこそ！AtlasSNSへ！</p>
    </div>
    <div class=done>
      <p>ユーザー登録が完了しました。</p>
      <p>早速ログインをしてみましょう。</p>
    </div>

    <a class="btn btn-danger" href="login">ログイン画面へ</a>
  </div>
</x-logout-layout>
