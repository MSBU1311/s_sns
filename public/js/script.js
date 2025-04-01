// ナビゲーションウィンドウを表示させる
$(function () {
  $('.menu_trigger').click(function () {        //.menu-triggerをタップすると、
    $(this).toggleClass('active');              //.menu-triggerに.activeを追加・削除する。
    if ($(this).hasClass('active')) {           //もし、.menu-triggerに.activeがあれば、
      $('.nav_content').addClass('active');     //.nav_contentにも.activeを追加する。
    } else {                                    //それ以外の場合は、
      $('.nav_content').removeClass('active');  //.nav_contentにある.activeを削除する。
    }
  });
  $('.nav_list li a').click(function () { //各メニューリンク（.nav-wrapper ul li a）をタップすると、
    $('.menu_trigger').removeClass('active');   //ハンバーガーボタン（.menu-trigger）にある（.active）を削除する。
    $('.nav_content').removeClass('active');         //(.nav_contentにある（.active）も削除する。
  });
});

// 編集モーダルを表示させる
$(function () {
  $('.edit_trigger').click(function () {
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
      $('.edit_container').addClass('active');
    } else {
      $('.edit_container').removeClass('active');
    }
  });
  $('.edit_close').click(function () {
    $('.edit_trigger').removeClass('active');
    $('.edit_container').removeClass('active');
  });
});

// 編集モーダルにpostとidの値を渡す
$(function () {
  // triggerをクリックをしたら発火させる
  $('.edit_trigger').on('click', function () {
    // クリックした要素のpostの値を、変数postへ格納
    var post = $(this).attr('post');
    // クリックした要素のidの値を、変数post_idへ格納
    var post_id = $(this).attr('post_id');
    // モーダルへpostを渡す
    $('.modal_post').text(post);
    // モーダルへidを渡す
    $('.modal_id').val(post_id);
    return false;
  });
});

// 削除モーダルを表示させる
$(function () {
  $('.delete_trigger').click(function () {
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
      $('.modal').addClass('active');
    } else {
      $('.modal').removeClass('active');
    }
  });
  $('.btn-secondary').click(function () {
    $('.delete_trigger').removeClass('active');
    $('.modal').removeClass('active');
  });
});

// 削除モーダルにidの値を渡す
$(function () {
  // triggerをクリックをしたら発火させる
  $('.delete_trigger').on('click', function () {
    // クリックした要素のidの値を、変数post_idへ格納
    var post_id = $(this).attr('post_id');
    // モーダルへidを渡す
    $('.delete_id').val(post_id);
    return false;
  });
});
