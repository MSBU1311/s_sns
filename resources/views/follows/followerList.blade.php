<x-login-layout>

  <div class="follower_list">
    <h1>Follower List</h1>
    <div class="followed_icon">
      @foreach($icon as $icon)
        <span>
          <a href="{{ route('users.show', $icon) }}">
            <img src="/storage/{{ $icon->icon_image }}" width="40" height="40" alt="user_picture">
          </a>
        </span>
      @endforeach
    </div>
  </div>
  <div>
    @foreach($posts as $posts)
      <ul class="post_list">
        <div class="post_first">
          <li class="post_image">
            <a href="{{ route('users.show', $posts->user_id) }}">
              <img src="/storage/{{ $posts->user->icon_image }}" width="40" height="40" alt="user_picture">
            </a>
          </li>
          <li class="post_username">{{$posts->user->username}}</li>
          <li class="post_time">{{substr($posts->created_at,0, 16)}}<br></li>
        </div>

        <div class="post_second">
          <li class="post_post">{{$posts->post}}</li>
        </div>
      </ul>
      <div class="b-color1"></div>
    @endforeach
  </div>

</x-login-layout>
