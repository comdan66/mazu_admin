<div class='panel'>
  <header>
    <h2>新增相簿</h2>
    <a href='<?php echo base_url ($uri_1);?>' class='icon-x'></a>
  </header>

  <form class='form full' method='post' action='<?php echo base_url ($uri_1);?>' enctype='multipart/form-data'>
    
    <div class='row n2'>
      <label>* 相簿作者</label>
      <div>
        <select name='user_id'>
    <?php if ($users = User::all (array ('select' => 'id, name'))) {
            foreach ($users as $user) { ?>
              <option value='<?php echo $user->id;?>'<?php echo (isset ($posts['user_id']) ? $posts['user_id'] : User::current ()->id) == $user->id ? ' selected': '';?>><?php echo $user->name;?></option>
      <?php }
          }?>
        </select>
      </div>
    </div>

    <div class='row n2'>
      <label>* 相簿標題</label>
      <div>
        <input type='text' name='title' value='<?php echo isset ($posts['title']) ? $posts['title'] : '';?>' placeholder='請輸入相簿標題..' maxlength='200' pattern='.{1,200}' required title='輸入相簿標題!' autofocus />
      </div>
    </div>

    <div class='row n2'>
      <label>* 相簿封面</label>
      <div class='img_row'>
        <div class='drop_img no_cchoice'>
          <img src='' />
          <input type='file' name='cover' />
        </div>
      </div>
    </div>
    
    <div class='row n2'>
      <label>相簿內容</label>
      <div>
        <textarea name='content' class='pure autosize cke' placeholder='請輸入相簿內容..'><?php echo isset ($posts['content']) ? $posts['content'] : '';?></textarea>
      </div>
    </div>

    <div class='row n2'>
      <label>圖片</label>
      <div class='imgs_row'>

        <div class='drop_img no_cchoice'>
          <img src='' />
          <input type='file' name='images[]' />
          <a class='icon-t'></a>
        </div>

      </div>
    </div>

    <div class='row n2 sources' data-i='0' data-sources='<?php echo json_encode ($sources);?>'>
      <label>內容參考</label>
      <div>
        <div class='add_source'>
          <button type='button' class='icon-r add'></button>
        </div>
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
