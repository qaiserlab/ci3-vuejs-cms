<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends MY_Model {

  protected $table = 'tb_product';
  protected $view = 'vi_product';

  public function map($data) {

    // Output

    $data['excerpt'] = $this->getExcerpt($data);
    $data['categoryPermalink'] = $this->getCategoryPermalink($data);
    $data['permalink'] = $this->getPermalink($data);
    $data['_featuredImage'] = $this->getFeaturedImage($data);
    $data['images'] = $this->getImages($data);
    $data['_images'] = $this->getImages_($data);
    $data['rsPostTag'] = $this->getRsPostTag($data);
    $data['_price'] = $this->getPrice($data);
    $data['_postedOn'] = $this->getPostedOn($data);
    $data['postedDate'] = $this->getPostedDate($data);
    $data['postedTime'] = $this->getPostedTime($data);
    $data['postedYear'] = $this->getPostedYear($data);
    $data['postedMonth'] = $this->getPostedMonth($data);
    $data['postedDay'] = $this->getPostedDay($data);

    return $data;
  }

  private function getExcerpt($data) {
    $length = 80;

    $stContent = strip_tags($data['content']);
    $xContent = explode(' ', $stContent);
    $cxContent = count($xContent);

    $xExcerpt = [];

    for ($i = 0; $i < $length; $i++) {
      if ($i < $cxContent)
      $xExcerpt[] = $xContent[$i];
    }

    $excerpt = implode(' ', $xExcerpt);

    return $excerpt;
  }

  private function getCategoryPermalink($data) {
    $categorySlug = $data['categorySlug'];
    $categoryPermalink = base_url('product/'.$categorySlug);

    return $categoryPermalink;
  }

  private function getPermalink($data) {

    $categoryPermalink = $this->getCategoryPermalink($data);
    $slug = $data['slug'];

    $permalink = $categoryPermalink.'/'.$slug;

    return $permalink;
  }

  private function getFeaturedImage($data) {
    return base_url('writable/archives/'.$data['featuredImage']);
  }

  private function getImages($data) {
    return explode(',', $data['images']);
  }

  private function getImages_($data) {
    $images = $data['images'];
    $_images = [];

    foreach ($images as $image) {
      if (!empty($image))
        $_images []= base_url('writable/archives/'.$image);
    }

    return $_images;
  }

  private function getPrice($data) {
    return number_format($data['price'], 2);
  }

  private function getPostedOn($data) {
    $postedOn = date_create($data['postedOn']);
    $_postedOn = date_format($postedOn, 'd/m/Y h:i:s');

    return $_postedOn;
  }

  private function getPostedDate($data) {
    $postedOn = date_create($data['postedOn']);
    $postedDate = date_format($postedOn, 'd/m/Y');

    return $postedDate;
  }

  private function getPostedTime($data) {
    $postedOn = date_create($data['postedOn']);
    $postedTime = date_format($postedOn, 'h:i:s');

    return $postedTime;
  }

  private function getPostedYear($data) {
    $postedOn = date_create($data['postedOn']);
    $postedYear = date_format($postedOn, 'Y');

    return $postedYear;
  }

  private function getPostedMonth($data) {
    $postedOn = date_create($data['postedOn']);
    $postedMonth = date_format($postedOn, 'm');

    return $postedMonth;
  }

  private function getPostedDay($data) {
    $postedOn = date_create($data['postedOn']);
    $postedDay = date_format($postedOn, 'd');

    return $postedDay;
  }

  private function getRsPostTag($data) {
    return $this->db->
      from('tb_post_tag')->
      or_like(['tag' => $data['title'], 'tag' => $data['content']])->
      get()->result_array();
  }

}
