<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 * @link        http://www.ioa.tw/
 */

class Articles extends Admin_controller {
  private $uri_1 = null;
  private $obj = null;

  public function __construct () {
    parent::__construct ();
    
    if (!User::current ()->in_roles (array ('article')))
      return redirect_message (array ('admin'), array ('_flash_danger' => '您的權限不足，或者頁面不存在。'));
    
    $this->uri_1 = 'admin/articles';

    if (in_array ($this->uri->rsegments (2, 0), array ('show', 'edit', 'update', 'destroy', 'sort')))
      if (!(($id = $this->uri->rsegments (3, 0)) && ($this->obj = Article::find ('one', array ('conditions' => array ('id = ?', $id))))))
        return redirect_message (array ($this->uri_1), array ('_flash_danger' => '找不到該筆資料。'));

    $this->add_param ('uri_1', $this->uri_1)
         ->add_param ('now_url', base_url ($this->uri_1));
  }
  public function index ($offset = 0) {
    $columns = array ( 
        array ('key' => 'content', 'title' => '內容', 'sql' => 'content LIKE ?'), 
        array ('key' => 'title',   'title' => '標題', 'sql' => 'title LIKE ?'), 
      );

    $configs = array_merge (explode ('/', $this->uri_1), array ('%s'));
    $conditions = conditions ($columns, $configs);

    $limit = 10;
    $total = Article::count (array ('conditions' => $conditions));
    $objs = Article::find ('all', array ('offset' => $offset < $total ? $offset : 0, 'limit' => $limit, 'order' => 'sort DESC', 'include' => array ('user'), 'conditions' => $conditions));

    return $this->load_view (array (
        'objs' => $objs,
        'columns' => $columns,
        'pagination' => $this->_get_pagination ($limit, $total, $configs),
      ));
  }
  public function add () {
    $posts = Session::getData ('posts', true);
    $sources = isset ($posts['sources']) ? $posts['sources'] : array ();
    
    return $this->load_view (array (
        'posts' => $posts,
        'sources' => $sources,
      ));
  }
  public function create () {
    if (!$this->has_post ())
      return redirect_message (array ($this->uri_1, 'add'), array ('_flash_danger' => '非 POST 方法，錯誤的頁面請求。'));

    $posts = OAInput::post ();
    $posts['content'] = OAInput::post ('content', false);
    $cover = OAInput::file ('cover');

    if ($msg = $this->_validation_create ($posts, $cover))
      return redirect_message (array ($this->uri_1, 'add'), array ('_flash_danger' => $msg, 'posts' => $posts));

    $posts['sort'] = Article::count ();
    if (!Article::transaction (function () use (&$obj, $posts, $cover) { return verifyCreateOrm ($obj = Article::create (array_intersect_key ($posts, Article::table ()->columns))) && $obj->cover->put ($cover); }))
      return redirect_message (array ($this->uri_1, 'add'), array ('_flash_danger' => '新增失敗！', 'posts' => $posts));

    if ($posts['sources'])
      foreach ($posts['sources'] as $i => $source)
        ArticleSource::transaction (function () use ($i, $source, $obj) { return verifyCreateOrm (ArticleSource::create (array_intersect_key (array_merge ($source, array ('sort' => $i, 'article_id' => $obj->id)), ArticleSource::table ()->columns))); });

    return redirect_message (array ($this->uri_1), array ('_flash_info' => '新增成功！'));
  }
  public function edit () {
    $posts = Session::getData ('posts', true);

    return $this->load_view (array (
        'posts' => $posts,
        'sources' => isset ($posts['sources']) ? $posts['sources'] : array_map (function ($source) { return array ('title' => $source->title, 'href' => $source->href); }, $this->obj->sources),
        'obj' => $this->obj,
      ));
  }
  public function update () {
    $obj = $this->obj;

    if (!$this->has_post ())
      return redirect_message (array ($this->uri_1, $obj->id, 'edit'), array ('_flash_danger' => '非 POST 方法，錯誤的頁面請求。'));

    $posts = OAInput::post ();
    $posts['content'] = OAInput::post ('content', false);
    $cover = OAInput::file ('cover');

    if ($msg = $this->_validation_update ($posts, $cover, $obj))
      return redirect_message (array ($this->uri_1, $obj->id, 'edit'), array ('_flash_danger' => $msg, 'posts' => $posts));

    if ($columns = array_intersect_key ($posts, $obj->table ()->columns))
      foreach ($columns as $column => $value)
        $obj->$column = $value;

    if (!Article::transaction (function () use ($obj, $posts, $cover) { if (!$obj->save () || ($cover && !$obj->cover->put ($cover))) return false; return true; }))
      return redirect_message (array ($this->uri_1, $obj->id, 'edit'), array ('_flash_danger' => '更新失敗！', 'posts' => $posts));

    if ($obj->sources)
      foreach ($obj->sources as $source)
        ArticleSource::transaction (function () use ($source) { return $source->destroy (); });

    if ($posts['sources'])
      foreach ($posts['sources'] as $i => $source)
        ArticleSource::transaction (function () use ($i, $source, $obj) { return verifyCreateOrm (ArticleSource::create (array_intersect_key (array_merge ($source, array ('sort' => $i, 'article_id' => $obj->id)), ArticleSource::table ()->columns))); });

    return redirect_message (array ($this->uri_1), array ('_flash_info' => '更新成功！'));
  }
  public function sort ($id, $sort) {
    $obj = $this->obj;

    if (!in_array ($sort, array ('up', 'down')))
      return redirect_message (array ($this->uri_1), array ('_flash_danger' => '排序失敗！'));

    $conditions = array ();
    $total = Article::count (array ('conditions' => $conditions));

    switch ($sort) {
      case 'up': $sort = $obj->sort; $obj->sort = $obj->sort + 1 >= $total ? 0 : $obj->sort + 1; break;
      case 'down': $sort = $obj->sort; $obj->sort = $obj->sort - 1 < 0 ? $total - 1 : $obj->sort - 1; break;
    }

    $change = array ();
    array_push ($change, array ('id' => $obj->id, 'old' => $sort, 'new' => $obj->sort));
    OaModel::addConditions ($conditions, 'sort = ?', $obj->sort);

    if (!Article::transaction (function () use ($conditions, $obj, $sort, &$change) { if (($next = Article::find ('one', array ('conditions' => $conditions))) && array_push ($change, array ('id' => $next->id, 'old' => $next->sort, 'new' => $sort))) { $next->sort = $sort; if (!$next->save ()) return false; } return $obj->save (); }))
      return redirect_message (array ($this->uri_1), array ('_flash_danger' => '排序失敗！'));

    return redirect_message (array ($this->uri_1), array ('_flash_info' => '排序成功！'));
  }
  public function destroy () {
    $obj = $this->obj;

    if (!Article::transaction (function () use ($obj) { return $obj->destroy (); }))
      return redirect_message (array ($this->uri_1), array ('_flash_danger' => '刪除失敗！'));

    return redirect_message (array ($this->uri_1), array ('_flash_info' => '刪除成功！'));
  }

  private function _validation_create (&$posts, &$cover) {
    if (!isset ($posts['user_id'])) return '沒有選擇 文章作者！';
    if (!isset ($posts['tag'])) return '沒有填寫 分類！';
    if (!isset ($posts['title'])) return '沒有填寫 文章標題！';
    if (!isset ($posts['content'])) return '沒有填寫 文章內容！';
    if (!isset ($cover)) return '沒有選擇 文章封面！';
    
    if (!(is_numeric ($posts['user_id'] = trim ($posts['user_id'])) && User::find ('one', array ('select' => 'id', 'conditions' => array ('id = ?', $posts['user_id']))))) return '文章作者 不存在！';
    if (!(is_string ($posts['tag']) && ($posts['tag'] = trim ($posts['tag'])) && in_array ($posts['tag'], Article::$tags))) return '文章分類 格式錯誤！';
    if (!(is_string ($posts['title']) && ($posts['title'] = trim ($posts['title'])))) return '文章標題 格式錯誤！';
    if (!(is_string ($posts['content']) && ($posts['content'] = trim ($posts['content'])))) return '文章內容 格式錯誤！';
    if (!is_upload_image_format ($cover, 20 * 1024 * 1024, array ('gif', 'jpeg', 'jpg', 'png'))) return '文章封面 格式錯誤！';
    
    $posts['sources'] = isset ($posts['sources']) && is_array ($posts['sources']) && $posts['sources'] ? array_values (array_filter ($posts['sources'], function ($source) { return isset ($source['href']) && is_string ($source['href']) && ($source['href'] = trim ($source['href'])); })) : array ();
    
    $posts['cover'] = '';
    
    return '';
  }
  private function _validation_update (&$posts, &$cover, $obj) {
    if (!isset ($posts['user_id'])) return '沒有選擇 文章作者！';
    if (!isset ($posts['tag'])) return '沒有填寫 分類！';
    if (!isset ($posts['title'])) return '沒有填寫 文章標題！';
    if (!isset ($posts['content'])) return '沒有填寫 文章內容！';
    if (!((string)$obj->cover || isset ($cover))) return '沒有選擇 文章封面！';

    if (!(is_numeric ($posts['user_id'] = trim ($posts['user_id'])) && User::find ('one', array ('select' => 'id', 'conditions' => array ('id = ?', $posts['user_id']))))) return '文章作者 不存在！';
    if (!(is_string ($posts['tag']) && ($posts['tag'] = trim ($posts['tag'])) && in_array ($posts['tag'], Article::$tags))) return '文章分類 格式錯誤！';
    if (!(is_string ($posts['title']) && ($posts['title'] = trim ($posts['title'])))) return '文章標題 格式錯誤！';
    if (!(is_string ($posts['content']) && ($posts['content'] = trim ($posts['content'])))) return '文章內容 格式錯誤！';
    if ($cover && !is_upload_image_format ($cover, 20 * 1024 * 1024, array ('gif', 'jpeg', 'jpg', 'png'))) return '文章封面 格式錯誤！';
    
    $posts['sources'] = isset ($posts['sources']) && is_array ($posts['sources']) && $posts['sources'] ? array_values (array_filter ($posts['sources'], function ($source) { return isset ($source['href']) && is_string ($source['href']) && ($source['href'] = trim ($source['href'])); })) : array ();

    return '';
  }
}
