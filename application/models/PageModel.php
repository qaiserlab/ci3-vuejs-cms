<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageModel extends MY_Model {

  protected $table = 'tb_page';
  protected $view = 'vi_page';

  public function map($data) {

    $data['excerpt'] = $this->getExcerpt($data);
    $data['permalink'] = $this->getPermalink($data);
    $data['csf'] = $this->getCsf($data);
    $data['_featuredImage'] = $this->getFeaturedImage($data);
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

  private function getPermalink($data) {

    $slug = $data['slug'];
    $permalink = base_url($slug);

    return $permalink;
  }

  private function getCsf($data) {
    $csf = json_decode($data['csf']);
    return $csf;
  }

  private function getFeaturedImage($data) {
    return base_url('writable/archives/'.$data['featuredImage']);
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

}
