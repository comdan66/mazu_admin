<div class='panel'>
  <header>
    <h2>修改點資訊分類</h2>
    <a href='<?php echo base_url ($uri_1);?>' class='icon-x'></a>
  </header>


  <form class='form' method='post' action='<?php echo base_url ($uri_1, $obj->id);?>'>
    <input type='hidden' name='_method' value='put' />
    <input type='hidden' id='ap' value='<?php echo 'https://api.baishatun.godroad.tw/' . (ENVIRONMENT !== 'production' ? 'dev/' : '') . 'points.json';?>' />

    <div class='row n2'>
      <label>* 內容</label>
      <div>
        <input type='text' name='content' value='<?php echo isset ($posts['content']) ? $posts['content'] : $obj->content;?>' placeholder='請輸入分類名稱..' maxlength='200' pattern='.{1,200}' required title='輸入分類名稱!' autofocus />
      </div>
    </div>
    <div class='row n2'>
      <label>* 緯度</label>
      <div>
        <input type='text' id='lat' name='lat' value='<?php echo isset ($posts['lat']) ? $posts['lat'] : $obj->lat;?>' placeholder='請輸入選擇緯度..' maxlength='200' pattern='.{1,200}' required title='選擇緯度!' readonly />
      </div>
    </div>
    <div class='row n2'>
      <label>* 經度</label>
      <div>
        <input type='text' id='lng' name='lng' value='<?php echo isset ($posts['lng']) ? $posts['lng'] : $obj->lng;?>' placeholder='請輸入選擇經度..' maxlength='200' pattern='.{1,200}' required title='選擇經度!' readonly />
      </div>
    </div>

    <div class='row n2'>
      <label>點擊地圖決定位置</label>
      <div id='maps_panel'>
        <div id='maps' data-paths='<?php echo json_encode ($paths);?>'></div>
        <select id='select' name='type'>
    <?php foreach (Path::$struct as $name => $items) { ?>
            <optgroup label='<?php echo $name;?>路關'>
        <?php foreach ($items as $key) { ?>
                <option value='<?php echo $key;?>'<?php echo (isset ($posts['type']) ? $posts['type'] : $obj->type) == $key ? ' selected' : '';?>><?php echo Path::$typeNames[$key];?></option>
        <?php } ?>
            </optgroup>
    <?php } ?>
        </select>
        <div id='z'><a>+</a><a>-</a></div>
        <button type='button' id='zoom'>全螢幕</button>
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
