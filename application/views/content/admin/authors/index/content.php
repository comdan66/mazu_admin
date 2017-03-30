<header>
  <div class='title'>
    <h1>關於</h1>
    <p>上稿管理</p>
  </div>

  <form class='select'>
    <button type='submit' class='icon-s'></button>

<?php 
    if ($columns) { ?>
<?php foreach ($columns as $column) {
        if (isset ($column['select']) && $column['select']) { ?>
          <select name='<?php echo $column['key'];?>'>
            <option value=''>請選擇 <?php echo $column['title'];?>..</option>
      <?php foreach ($column['select'] as $option) { ?>
              <option value='<?php echo $option['value'];?>'<?php echo (is_numeric ($column['value']) && ($column['value'] == $option['value'])) || ($option['value'] === $column['value']) ? ' selected' : '';?>><?php echo $option['text'];?></option>
      <?php } ?>
          </select>
  <?php } else { ?>
          <label>
            <input type='text' name='<?php echo $column['key'];?>' value='<?php echo $column['value'];?>' placeholder='<?php echo $column['title'];?>搜尋..' />
            <i class='icon-s'></i>
          </label>
<?php   }
      }?>
<?php 
    } ?>

  </form>
</header>


<div class='panel'>
  <header>
    <h2>關於列表</h2>
<?php if (!$objs) { ?>
        <a href='<?php echo base_url ($uri_1, 'add');?>' class='icon-r'></a>
<?php } ?>
  </header>

  <div class='content'>

    <table class='table'>
      <thead>
        <tr>
          <th width='50' class='center'>#</th>
          <th width='70' class='center'>封面</th>
          <th>內容</th>
          <th width='50'>PV</th>
          <th width='85' class='right'>預覽/修改</th>
        </tr>
      </thead>
      <tbody>
  <?php if ($objs) {
          foreach ($objs as $obj) { ?>
            <tr>
              <td class='center'><?php echo $obj->id;?></td>
              <td class='center'>
                <figure class='_i' href='<?php echo $obj->cover->url ('600x315c');?>'>
                  <img src='<?php echo $obj->cover->url ('600x315c');?>' />
                  <figcaption data-description='<?php echo $obj->mini_content ();?>'><?php echo $obj->mini_content ();?></figcaption>
                </figure>
              </td>
              <td><?php echo $obj->mini_content (50);?></td>
              <td><?php echo number_format ($obj->pv);?></td>
              <td class='right'>
                <a class='icon-y' href="<?php echo base_url ($uri_1, $obj->id, 'show');?>" target='_blank'></a>
                /
                <a class='icon-e' href="<?php echo base_url ($uri_1, $obj->id, 'edit');?>"></a>
              </td>
            </tr>
    <?php }
        } else { ?>
          <tr>
            <td colspan='5' class='no_data'>沒有任何資料。</td>
          </tr>
  <?php } ?>
      </tbody>
    </table>

    <div class='pagination'>
      <?php echo $pagination;?>
    </div>

  </div>
</div>

