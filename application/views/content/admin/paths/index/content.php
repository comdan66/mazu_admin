<header>
  <div class='title'>
    <h1>路關</h1>
    <p>路關管理</p>
  </div>
</header>

<div class='panel'>
  <div id='maps_panel'>
    <div id='maps' data-url='<?php echo base_url ('admin', 'paths', 'update');?>' data-paths='<?php echo json_encode ($paths);?>'></div>

    <select id='select'>
<?php foreach (Path::$struct as $name => $items) { ?>
        <optgroup label='<?php echo $name;?>路關'>
    <?php foreach ($items as $key) { ?>
            <option value='<?php echo $key;?>'><?php echo Path::$typeNames[$key];?></option>
    <?php } ?>
        </optgroup>
<?php } ?>
    </select>
    <div id='z'><a>+</a><a>-</a></div>
    <button type='button' id='log'>更新</button>
    <button type='button' id='zoom'>全螢幕</button>
  </div>
</div>

