<x-login-layout>
  <div class="re_profile">
    {!! Form::open(['url' => '/profile/update','enctype'=>'multipart/form-data']) !!}
      <div class="profile_name">
        <div class=login_icon>
          <img src="/storage/{{ Auth::user()->icon_image }}" width="45" height="45">
        </div>
        {{ Form::hidden('id', Auth::user()->id) }}

        <div class=username>
          <p>user name</p>
        </div>

        <div class=username_form>
          {{ Form::text('username',$user->username,['required','class' => 'input']) }}
        </div>
      </div>

      <div class="profile_email">
        <div class=email>
          <p>mail address</p>
        </div>

        <div class=email_form>
          {{ Form::email('email',$user->email,['required','class' => 'input']) }}
        </div>
      </div>

      <div class="profile_password">
        <div class=password>
          <p>password</p>
        </div>

        <div class=password_form>
            {{ Form::password('password',null,['required','class' => 'input']) }}
        </div>
      </div>

      <div class="profile_confirm">
        <div class=confirm>
          <p>password confirm</p>
        </div>

        <div class=password_form>
            {{ Form::password('password_confirmation',null,['class' => 'input']) }}
        </div>
      </div>

      <div class="profile_bio">
        <div class=bio>
          <p>bio</p>
        </div>

        <div class=bio_form>
            {{ Form::text('bio',$user->bio,['class' => 'input']) }}
        </div>
      </div>

      <div class="profile_icon">
        <div class=icon>
          <p>icon image</p>
        </div>

        <div class=icon_form>
          <div class="icon_file">
            {{ Form::file('icon_image',['style'=>'opacity: 0;']) }}
          </div>
          <div class="icon_contents">
            <span class="photo">ファイルを選択
            </span>
          </div>
        </div>
      </div>

      <div class=profile_button>
          {{ Form::submit('更新',['class'=>'btn btn-danger']) }}
      </div>

    {!! Form::close() !!}
  </div>
</x-login-layout>
