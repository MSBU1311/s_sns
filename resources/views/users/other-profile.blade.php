<x-login-layout>
  <div class="other_profile">

    <div class="otheruser_icon">
      <img src="{{ asset('storage/' . $user->icon_image) }}" width="40" height="40" alt="user_picture">
    </div>

    <div class="other_user">
      <div class="otheruser_name">
        <p class="name">name</p>
        <p class="username">{{ $user->username }}</p>
      </div>

      <div class="otheruser_bio">
        <p class="bio">bio</p>
        <p class="user_bio"> {{ $user->bio }}</p>
      </div>
    </div>

    <div class="follow_button">
      <div class="unfollow">
        @if (Auth::user()->follows()->where('followed_id', $user->id)->exists())
          <!-- もし、一致するものがあれば、この処理を行う -->
          <form action="{{ route('users.unfollow', $user) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">フォロー解除</button>
          </form>
      </div>
      <div class="follow">
        @else
        <!-- 一致するものがなければ、この処理を行う -->
        <form action="{{ route('users.follow', $user) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-primary">フォローする</button>
        </form>
        @endif
      </div>
    </div>

  </div>

  <div class="userpost_area">
    @foreach($posts as $posts)
      <ul class="post_list">
        <div class="post_first">
          <li class="post_image">
            <img src="{{ asset('storage/' . $posts->user->icon_image) }}" width="40" height="40" alt="user_picture">
          </li>
          <li class="post_username">{{$posts->user->username}}</li>
          <li class="post_time">{{substr($posts->created_at,0, 16) }}</li>
        </div>
        <div class="post_second">
          <li class="post_post">{{$posts->post}}</li>
        </div>
      </ul>
      <div class="b-color1"></div>
    @endforeach
  </div>


</x-login-layout>
