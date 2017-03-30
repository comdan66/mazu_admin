<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Youtube extends OaModel {

  static $table_name = 'youtubes';

  static $has_one = array (
  );

  static $has_many = array (
  );

  static $belongs_to = array (
    array ('user', 'class_name' => 'User')
  );

  private $youtube_image_urls = null;
  private $youtube_info = null;

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }

  public static function search_youtube ($options = array ()) {
    $CI  =& get_instance ();
    $CI->load->library ('Google/Google');

    $client = new Google_Client ();
    $client->setDeveloperKey (Cfg::setting ('google', ENVIRONMENT, 'server_key'));
    $youtube = new Google_Service_YouTube ($client);

    try {
      return array_map (function ($item) {
        return Youtube::google_SearchResultSnippet_format ($item);
      }, $youtube->search->listSearch ('id, snippet', array_merge (array (
        'type' => 'video'
      ), $options))->items);
    } catch (Exception $e) {
      return array ();
    }
  }
  public static function google_SearchResultSnippet_format ($item) {
    $sizes = array ('getDefault', 'getHigh', 'getMaxres', 'getMedium', 'getStandard');
    $id = is_a ($item, 'Google_Service_YouTube_SearchResult') ? $item->id->videoId : (is_a ($item, 'Google_Service_YouTube_Video') ? $item->id : '');

    return $id && isset ($item->snippet) ? array (
          'id' => $id,
          'content' => isset ($item->snippet->content) ? $item->snippet->content : '',
          'title' => isset ($item->snippet->title) ? $item->snippet->title : '',
          'tags' => isset ($item->snippet->tags) ? $item->snippet->tags : array (),
          'publishedAt' => isset ($item->snippet->publishedAt) ? $item->snippet->publishedAt : '',
          'thumbnails' => isset ($item->snippet->thumbnails) ? array_filter (array_map (function ($size) use ($item) {
              if (!method_exists ($item->snippet->thumbnails, $size))
                return null;
      
              $thumbnail = call_user_func_array (array ($item->snippet->thumbnails, $size), array ());
      
              if (!isset ($thumbnail->url))
                return null;

              return array_merge (array ('url' => $thumbnail->url), isset ($thumbnail->width) && isset ($thumbnail->height) ? array (
                    'width' => $thumbnail->width,
                    'height' => $thumbnail->height
                  ) : array ());
            }, $sizes)) : array (),
        ) : array ();
  }

  public function bigger_youtube_image_urls () {
    if ($this->youtube_image_url !== null)
      return $this->youtube_image_url;

    if (!($youtube_image_urls = $this->youtube_image_urls ()))
      return $this->youtube_image_url = '';
    else
      $this->youtube_image_url = $youtube_image_urls[0]['url'];

    if (!($youtube_image_urls = array_filter ($youtube_image_urls, function ($image) { return isset ($image['width']) && isset ($image['height']); })))
      return $this->youtube_image_url;

    usort ($youtube_image_urls, function ($a, $b) {
      return $a['width'] * $a['height'] < $b['width'] * $b['height'];
    });

    $image_url = array_shift ($youtube_image_urls);

    return $this->youtube_image_url = $image_url['url'];
  }
  public function youtube_image_urls () {
    if ($this->youtube_image_urls !== null)
      return $this->youtube_image_urls;

    $youtube_info = $this->youtube_info ();
    return $this->youtube_image_urls = isset ($youtube_info['thumbnails']) && ($thumbnails = $youtube_info['thumbnails']) ? $youtube_info['thumbnails'] : array ();
  }

  public function youtube_info () {
    if ($this->youtube_info !== null) return $this->youtube_info;

    $this->CI->load->library ('Google/Google');
    $client = new Google_Client ();
    $client->setDeveloperKey (Cfg::setting ('google', ENVIRONMENT, 'server_key'));
    $youtube = new Google_Service_YouTube ($client);

    try {
      $searchResponse = $youtube->videos->listVideos ('id, snippet',
            array ('id' => $this->vid
          ));

      if (!isset ($searchResponse->items[0]))
        return $this->youtube_info = array ();
      
      return $this->youtube_info = Youtube::google_SearchResultSnippet_format ($searchResponse->items[0]);
    } catch (Exception $e) {
      return $this->youtube_info = array ();
    }
  }

  public function mini_title ($length = 25) {
    return $length ? mb_strimwidth (remove_ckedit_tag ($this->title), 0, $length, '…','UTF-8') : remove_ckedit_tag ($this->title);
  }
  public function mini_content ($length = 100) {
    return $length ? mb_strimwidth (remove_ckedit_tag ($this->content), 0, $length, '…','UTF-8') : remove_ckedit_tag ($this->content);
  }
  public function destroy () {
    return $this->delete ();
  }
  public function cover () {
    return 'https://img.youtube.com/vi/' . $this->vid . '/0.jpg';
  }

}