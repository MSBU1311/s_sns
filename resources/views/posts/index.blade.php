<x-login-layout>
    <div class="form_group">
      <!-- 投稿フォーム -->
      <div class="postuser_img">
        <img src="/storage/{{ Auth::user()->icon_image }}" width="40" height="40" alt="user_picture">
      </div>
      <div class="post_form">
          {{ Form::open(['url' => '/posts/index'])}}
          {{ Form::textarea('post',null,['required','class'=>'form-control','placeholder' => '投稿内容を記入してください。'])}}
      </div>
      <div class="post_button">
          {{ Form::input('image','submit',null,['src' => "/images/post.png"])}}
          {{ Form::close()}}
      </div>
    </div>
  <div class="post_area">
    @foreach($list as $list)
      <ul class="post_list">
        <div class="post_first">
          <li class="post_image">
            <img src="/storage/{{ $list->user->icon_image }}" width="40" height="40" alt="user_picture">
          </li>

          <li class="post_username">
            {{$list->user->username}}
          </li>

          <li class="post_time">
            <!-- substr():文字列の一部を返す関数。０番目〜１６番目までを表示させている -->
            {{ substr($list->created_at,0, 16) }}<br>
          </li>
        </div>

        <div class="post_second">
          <li class="post_post">
            {!! nl2br (e($list->post)) !!}
          </li>
        </div>

        <div class="post_third">
          @if (Auth::user()->id == $list->user_id)
          <!-- 更新 -->
          <li>
            <a type="button" class="edit_trigger" post="{{$list->post}}" post_id="{{$list->id}}">
                <img src="/images/edit.png" onmouseover="this.src='/images/edit_h.png'" onmouseout="this.src='/images/edit.png'" width="40" height="40" alt="user_picture">
            </a>
          </li>
          <!-- 更新用モーダル -->
          <div class="edit_container">
            <div class="edit_modal">
                {{ Form::open(['url' => ['/post/update']]) }}
                {{ Form::hidden('id', '',['class'=>'modal_id']) }}
                <div class="edit_form">
                  {{ Form::textarea('updatePost','',['required','class'=>'modal_post'])}}
                </div>
                <div class="edit_button">
                  <button type="submit" class="edit_close">
                    <img src="/images/edit.png" onmouseover="this.src='/images/edit_h.png'" onmouseout="this.src='/images/edit.png'">
                  </button>
                </div>
                {{ Form::close()}}
            </div>
          </div>

          <!-- 削除 -->
          <li>
            <a type="button" class="delete_trigger" post_id="{{$list->id}}">
              <img src="/images/trash.png" onmouseover="this.src='/images/trash-h.png'" onmouseout="this.src='/images/trash.png'" width="40" height="40" alt="user_picture">
            </a>
          </li>

          <!-- 削除用モーダル -->
          <div class="modal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                  <p>この投稿を削除します。よろしいでしょうか？</p>
                  <div class="modal_btn">
                    {{ Form::open(['url' => ['/posts/delete']]) }}
                    {{ Form::hidden('id', '',['class'=>'delete_id']) }}
                    <button type="submit" class="btn btn-primary">OK</button>
                    {{ Form::close()}}
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          @endif
        </div>
      </ul>

      <div class="b-color1"></div>
    @endforeach


  </div>


</x-login-layout>
