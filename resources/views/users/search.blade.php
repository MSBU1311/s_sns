<x-login-layout>
    <div class="search_group">
      <!-- 検索フォーム -->
      <div class="search_contents">
        <div class="search_form">
          {{ Form::open(['url' => '/search', 'method'=>'GET'])}}
          {{ Form::input('text','keyword',null,['class'=>'search_form','placeholder' => 'ユーザー名'])}}
        </div>

        <div class="search_button">
          <button type="submit" class="search_btn">
            <img src="/images/search.png" width="40" height="40" alt="search_picture">
          </button>
        </div>
      </div>
      <div class="keyword">
        @if(isset($keyword))
        <p>検索ワード：{{$keyword}}</p>
        @endif
      </div>
            {{ Form::close()}}
    </div>

    <div class="search_result">
      @forelse ($users as $users)
          @if ($users->id !== Auth::user()->id)
            <ul class="search_list">
              <li class="search_user">
                <div class="post_image">
                  <img src="/storage/{{ $users->icon_image }}" width="20" height="20" alt="user_picture">
                </div>
                <div class="search_username">
                  <p>{{ $users->username }}</p>
                </div>
              </li>

              <!-- 現在認証されているユーザーが->Userモデルのfollowsメソッドにおいて->followed_idと$usersのidが一致するものがあるかどうかを検証する -->
              <li>
                @if (Auth::user()->follows()->where('followed_id', $users->id)->exists())
                  <div class="unfollow">
                    <!-- もし、一致するものがあれば、この処理を行う -->
                      <form action="{{ route('users.unfollow', $users) }}" method="POST">
                        <input type="hidden" name="from_search" value="1">
                        @csrf
                        <button type="submit" class="btn btn-danger">フォロー解除</button>
                      </form>
                  </div>
                @else
                  <div class="follow">
                    <!-- 一致するものがなければ、この処理を行う -->
                      <form action="{{ route('users.follow', $users) }}" method="POST">
                        <input type="hidden" name="from_search" value="1">
                        @csrf
                        <button type="submit" class="btn btn-primary">フォローする</button>
                      </form>
                  </div>
                @endif
              </li>
            </ul>
          @endif
        @empty
            <li>No users</li>
      @endforelse
    </div>
</x-login-layout>
