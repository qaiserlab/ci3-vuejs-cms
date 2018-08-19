<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MediaController extends MY_Controller {
  private $basePath = 'writable/archives';

  public function __construct() {
    parent::__construct();
  }

  function scanDir($dir) {
      $ignored = array('.', '..', '.svn', '.htaccess', 'index.html');

      $files = array();
      foreach (scandir($dir) as $file) {
          if (in_array($file, $ignored)) continue;
          $files[$file] = filemtime($dir . '/' . $file);
      }

      arsort($files);
      $files = array_keys($files);

      return ($files) ? $files : false;
  }

  public function readAllData() {
    $this->authen(AT_FREE);
    $request = $this->input->post();

    // Query

    $result = $this->scanDir($this->basePath);

    // Output
    $this->success('DATA_READ', $result);
  }

  // public function readOneData($id = '') {
  //   $this->authen(AT_FREE);
  //   $request = $this->input->post();
  //
  //   // Query
  //
  //   $result = $this->Model->findOne($id);
  //
  //   // Output
  //   $this->success('DATA_READ', $result);
  // }

  private function validate($data, $scenario = '') {

    $errors = [];

    if (empty($data['image']))
      $errors[] = lang('IMAGE_REQUIRED');

    if (count($errors) > 0)
      return $errors;
  }

  public function createData() {
    $this->authen(AT_USER);
    $request = $this->input->post();

    // Validation

    $errors = $this->validate($request);

    if ($errors)
      $this->invalid($errors);

    // Prepare

    $image = $request['image'];
    if (!empty($image)) $this->store($image);

    // Output

    $this->success('DATA_CREATED', base_url('writable/archives/'.$image));

  }
  //
  // public function updateData() {
  //   $this->authen(AT_USER);
  //
  //   $request = $this->input->post();
  //   $id = $this->input->post('id');
  //
  //   // Validation
  //
  //   $errors = $this->validate($request);
  //
  //   if ($errors)
  //     $this->invalid($errors);
  //
  //   // Prepare
  //
  //   $publicationId = $request['publicationId'];
  //   $title = $request['title'];
  //   $content = urldecode($request['content']);
  //   $image = $request['image'];
  //
  //   if (!empty($image)) {
  //     if (!file_exists('writable/archives/'.$image))
  //       $this->store($image);
  //   }
  //
  //   // Map
  //
  //   $data = [
  //     'publicationId' => $publicationId,
  //     'title' => $title,
  //     'content' => $content,
  //     'image' => $image,
  //   ];
  //
  //   // Query
  //
  //   $this->Model->set($data)
  //     ->where('id', $id)
  //     ->update();
  //   $result = $this->Model->findOne($id);
  //
  //   // Output
  //
  //   $this->success('DATA_UPDATED', $result);
  // }

  public function deleteData() {
    $image = $this->input->post('image');

    // Query

    if (!empty($image)) {
      $file = 'writable/archives/'.$image;

      if (file_exists($file))
        unlink($file);
    }

    // Output

    $this->success('DATA_DELETED');
  }

}
