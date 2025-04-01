<x-logout-layout>
    <!-- 適切なURLを入力してください -->

  {!! Form::open(['url' => '/user/create']) !!}

    <h2 class=create>新規ユーザー登録</h2>

    <div class=username>
      {{ Form::label('user name') }}
    </div>

    <div class=username_form>
      {{ Form::text('username',null,['class' => 'form-control']) }}
    </div>

    <div class=email>
      {{ Form::label('mail address') }}
     </div>

    <div class=email_form>
      {{ Form::email('email',null,['class' => 'form-control']) }}
    </div>

    <div class=password>
        {{ Form::label('password') }}
    </div>

    <div class=password_form>
        {{ Form::password('password',['class' => 'form-control']) }}
    </div>

    <div class=password>
        {{ Form::label('password confirm') }}
    </div>

    <div class=password_form>
        {{ Form::password('password_confirmation',['class' => 'form-control']) }}
    </div>

    <div class=button>
        {{ Form::submit('REGISTER',['class'=>'btn btn-danger']) }}
    </div>

<p class=login_p><a class=login href="/auth/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


</x-logout-layout>
