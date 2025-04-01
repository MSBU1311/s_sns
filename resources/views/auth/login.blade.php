<x-logout-layout>

  <!-- 適切なURLを入力してください -->
  {!! Form::open(['url' => '/auth/login']) !!}

  <p class=welcome>AtlasSNSへようこそ</p>
  <div class=email>
    {{ Form::label('mail address') }}
  </div>

  <div class=email_form>
    {{ Form::text('email',null,['class' => 'form-control']) }}
  </div>

  <div class=password>
    {{ Form::label('password') }}
  </div>

  <div class=password_form>
    {{ Form::password('password',['class' => 'form-control']) }}
  </div>

  <div class=button>
    {{ Form::submit('LOGIN',['class'=>'btn btn-danger']) }}
  </div>

  <p class=register_p><a class=register href="/register">新規ユーザーの方はこちら</a></p>

  {!! Form::close() !!}

</x-logout-layout>
