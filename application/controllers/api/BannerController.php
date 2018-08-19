<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BannerController extends MY_Controller {
  private $model = 'BannerModel';

  public function __construct() {
    parent::__construct();

    $this->load->Model($this->model, 'Model');
  }

  public function readAllData() {
    $this->authen(AT_FREE);
    $request = $this->input->post();

    // Query

    $result = $this->Model->findAll($request);

    // Output
    $this->success('DATA_READ', $result);
  }

  public function readOneData($id = '') {
    $this->authen(AT_FREE);
    $request = $this->input->post();

    // Query

    $result = $this->Model->findOne($id);

    // Output
    $this->success('DATA_READ', $result);
  }

  private function validate($data, $scenario = '') {

    $errors = [];

    if (empty($data['title']))
      $errors[] = lang('TITLE_REQUIRED');

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

    $publicationId = $request['publicationId'];
    $title = $request['title'];
    $content = urldecode($request['content']);

    $image = $request['image'];
    // if (!empty($image)) $this->store($image);

    $postedOn = date('Y-m-d h:i:s');

    // Map

    $data = [
      'publicationId' => $publicationId,
      'title' => $title,
      'content' => $content,
      'image' => $image,
      'postedOn' => $postedOn,
    ];

    // Query

    $this->Model->insert($data);
    $result = $this->Model->findOne($this->db->insert_id());

    // Output

    $this->success('DATA_CREATED', $result);

  }

  public function updateData() {
    $this->authen(AT_USER);

    $request = $this->input->post();
    $id = $this->input->post('id');

    // Validation

    $errors = $this->validate($request);

    if ($errors)
      $this->invalid($errors);

    // Prepare

    $publicationId = $request['publicationId'];
    $title = $request['title'];
    $content = urldecode($request['content']);
    $image = $request['image'];

    // if (!empty($image)) {
    //   if (!file_exists('writable/archives/'.$image))
    //     $this->store($image);
    // }

    // Map

    $data = [
      'publicationId' => $publicationId,
      'title' => $title,
      'content' => $content,
      'image' => $image,
    ];

    // Query

    $this->Model->set($data)
      ->where('id', $id)
      ->update();
    $result = $this->Model->findOne($id);

    // Output

    $this->success('DATA_UPDATED', $result);
  }

  public function deleteData() {
    $id = $this->input->post('id');

    // Query

    $row = $this->Model->findOne([
      'where' => [
        'id' => $id,
      ]
    ]);

    // if (!empty($row['image'])) {
    //   $file = 'writable/archives/'.$row['image'];
    //
    //   if (file_exists($file))
    //     unlink($file);
    // }

    $this->Model->where([
      'id' => $id,
    ])->delete();

    // Output

    $this->success('DATA_DELETED');
  }

}
