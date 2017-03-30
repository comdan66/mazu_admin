<div class='panel'>
  <header>
    <h2>新增首頁文章</h2>
    <a href='<?php echo base_url ($uri_1);?>' class='icon-x'></a>
  </header>

  <form class='form full' method='post' action='<?php echo base_url ($uri_1);?>' enctype='multipart/form-data'>

    <div class='row n2'>
      <label>* 首頁文章封面</label>
      <div class='img_row'>
        <div class='drop_img no_cchoice'>
          <img src='' />
          <input type='file' name='cover' />
        </div>
      </div>
    </div>

    <div class='row n2'>
      <label>* 首頁文章內容</label>
      <div>
        <textarea name='content' class='pure autosize cke' placeholder='請輸入首頁文章內容..' autofocus><?php echo isset ($posts['content']) ? $posts['content'] : '';?></textarea>
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
