<!DOCTYPE html>
<html lang="zh">
  <head>
    <?php echo isset ($meta_list) ? $meta_list : ''; ?>

    <title><?php echo isset ($title) ? $title : ''; ?></title>

<?php echo isset ($css_list) ? $css_list : ''; ?>

<?php echo isset ($js_list) ? $js_list : ''; ?>

  </head>
  <body lang="zh-tw">
    <?php echo isset ($hidden_list) ? $hidden_list : ''; ?>

    <div id='container' class=''>
      <div id='main_row'>
        <div id='left_side'>
          
          <header>
            <a href='<?php echo base_url ();?>'>Ｚ</a>
            <span>Zeus Design Studio!</span>
          </header>

          <div id='login_user'>
            <figure class='_i'>
              <img src="<?php echo User::current ()->avatar ();?>">
            </figure>
            <div>
              <span>Hi, 您好!</span>
              <span><?php echo User::current ()->name;?></span>
            </div>
          </div>

          <ul id='main_menu'>
      <?php if (User::current ()->in_roles (array ('member'))) { ?>
              <li>
                <label data-role='schedule' data-cnt='0'>
                  <input type='checkbox' />
                  <span class='icon-u'>個人管理</span>
                  <ul>
                    <li><a href="<?php echo $url = base_url ('admin');?>" class='icon-home<?php echo $now_url == $url ? ' active' : '';?>'>後台首頁</a></li>
                  </ul>
                </label>
              </li>
      <?php }
            if (User::current ()->in_roles (array ('admin'))) { ?>
              <li>
                <label data-role='schedule' data-cnt='0'>
                  <input type='checkbox' />
                  <span class='icon-user-secret'>管理員</span>
                  <ul>
                    <li><a href="<?php echo $url = base_url ('admin', 'deploys');?>" class='icon-pi<?php echo $now_url == $url ? ' active' : '';?>'>部署紀錄</a></li>
                    <li><a href="<?php echo $url = base_url ('admin', 'users');?>" class='icon-bo<?php echo $now_url == $url ? ' active' : '';?>'>權限管理</a></li>
                  </ul>
                </label>
              </li>
      <?php }
            if (User::current ()->in_roles (array ('maps'))) { ?>
              <li>
                <label data-role='schedule' data-cnt='0'>
                  <input type='checkbox' />
                  <span class='icon-settings'>地圖管理</span>
                  <ul>
                    <li><a href="<?php echo $url = base_url ('admin', 'paths');?>" class='icon-op<?php echo $now_url == $url ? ' active' : '';?>'>路關管理</a></li>
                    <li><a href="<?php echo $url = base_url ('admin', 'path_infos');?>" class='icon-d2<?php echo $now_url == $url ? ' active' : '';?>'>路關資訊</a></li>
                  </ul>
                </label>
              </li>
      <?php }
            if (User::current ()->in_roles (array ('article'))) { ?>
              <li>
                <label data-role='schedule' data-cnt='0'>
                  <input type='checkbox' />
                  <span class='icon-f'>文章管理</span>
                  <ul>
                    <li><a href="<?php echo $url = base_url ('admin', 'articles');?>" class='icon-fa<?php echo $now_url == $url ? ' active' : '';?>'>文章管理</a></li>
                    <li><a href="<?php echo $url = base_url ('admin', 'homes');?>" class='icon-home<?php echo $now_url == $url ? ' active' : '';?>'>首頁文章</a></li>
                    <li><a href="<?php echo $url = base_url ('admin', 'authors');?>" class='icon-user-secret<?php echo $now_url == $url ? ' active' : '';?>'>關於作者</a></li>
                    <li><a href="<?php echo $url = base_url ('admin', 'licenses');?>" class='icon-c<?php echo $now_url == $url ? ' active' : '';?>'>授權聲明</a></li>
                  </ul>
                </label>
              </li>
      <?php }
            if (User::current ()->in_roles (array ('media'))) { ?>
              <li>
                <label data-role='schedule' data-cnt='0'>
                  <input type='checkbox' />
                  <span class='icon-ims'>影音管理</span>
                  <ul>
                    <li><a href="<?php echo $url = base_url ('admin', 'albums');?>" class='icon-ims<?php echo $now_url == $url ? ' active' : '';?>'>相簿管理</a></li>
                    <li><a href="<?php echo $url = base_url ('admin', 'youtubes');?>" class='icon-youtube<?php echo $now_url == $url ? ' active' : '';?>'>影片管理</a></li>
                  </ul>
                </label>
              </li>
      <?php } ?>

          </ul>

        </div>
        <div id='right_side'>
          <div id='top_side'>
            <button type='button' id='hamburger' class='icon-m'></button>
            <span>
              <a data-role='natification' data-cnt='0' class='icon-no_a<?php echo $now_url == $url ? ' active' : '';?>'></a>
              <a href='<?php echo base_url ('logout');?>' class='icon-o'></a>
            </span>
          </div>
          <div id='main'>
      <?php if ($_flash_danger = Session::getData ('_flash_danger', true)) { ?>
              <div id='_flash_danger'><?php echo $_flash_danger;?></div>
      <?php } else if ($_flash_info = Session::getData ('_flash_info', true)) { ?>
              <div id='_flash_info'><?php echo $_flash_info;?></div>
      <?php }?>
      <?php echo isset ($content) ? $content : ''; ?>
          </div>
          <div id='bottom_side'>
            後台版型設計 by 宙思 <a href='http://www.ioa.tw/' target='_blank'>OA Wu</a>
          </div>
        </div>
      </div>
    </div>
    
    <div id='loading'>
      <div class='cover'></div>
      <div class='contant'>編譯中，請稍候..</div>
    </div>
  </body>
</html>