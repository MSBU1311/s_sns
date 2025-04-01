        <div id="head">
            <h1 class=atlas_logo><a href="/posts/index"><img src="/images/atlas.png"></a></h1>
            <div id="menu_bar">
                <nav class="g_navi">
                    <div id="username">
                        <p>{{Auth::user()->username }}  さん</p>
                    </div>
                    <div class="menu_trigger">
                        <span></span>
                        <span></span>
                    </div>
                </nav>
                <div class="nav_content">
                    <ul class="nav_list">
                        <li><a href="/posts/index">HOME</a></li>
                        <li><a href="/profile">プロフィール編集</a></li>
                        <li><a href="/logout">ログアウト</a></li>
                    </ul>
                </div>
                <div class=user_img>
                    <img src="/storage/{{ Auth::user()->icon_image }}">
                </div>
            </div>
        </div>
