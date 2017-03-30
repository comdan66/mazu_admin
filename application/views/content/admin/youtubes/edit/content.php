<div class='panel'>
  <header>
    <h2>修改影片</h2>
    <a href='<?php echo base_url ($uri_1);?>' class='icon-x'></a>
  </header>


  <form class='form full' method='post' action='<?php echo base_url ($uri_1, $obj->id);?>' enctype='multipart/form-data'>
    <input type='hidden' name='_method' value='put' />

    <div class='row n2'>
      <label>* 影片作者</label>
      <div>
        <select name='user_id'>
    <?php if ($users = User::all (array ('select' => 'id, name'))) {
            foreach ($users as $user) { ?>
              <option value='<?php echo $user->id;?>'<?php echo (isset ($posts['user_id']) ? $posts['user_id'] : $obj->user_id) == $user->id ? ' selected': '';?>><?php echo $user->name;?></option>
      <?php }
          }?>
        </select>
      </div>
    </div>

    <div class='row n2'>
      <label>* 影片標題</label>
      <div>
        <input type='text' name='title' value='<?php echo isset ($posts['title']) ? $posts['title'] : $obj->title;?>' placeholder='請輸入影片標題..' maxlength='200' pattern='.{1,200}' required title='輸入影片標題!' autofocus />
      </div>
    </div>

    <div class='row n2'>
      <label>* 原始網址</label>
      <div>
        <input type='text' name='url' value='<?php echo isset ($posts['url']) ? $posts['url'] : $obj->url;?>' placeholder='請輸入影片原始網址..' maxlength='250' pattern='.{1,250}' required title='輸入影片原始網址!' />
      </div>
    </div>


    <div class='row n2'>
      <label>影片內容</label>
      <div>
        <textarea name='content' class='pure autosize cke' placeholder='請輸入影片內容..'><?php echo htmlspecialchars (isset ($posts['content']) ? $posts['content'] : $obj->content);?></textarea>
      </div>
    </div>


    <div class='btns'>
      <div class='row n2'>
        <label></label>
        <div>
          <button type='reset'>取消</button>
          <button type='submit'>送出</button>
        </div>
      </div>
    </div>
  </form>
</div>
