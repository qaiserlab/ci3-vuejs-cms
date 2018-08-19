<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductCategoryController extends MY_Controller {
  private $model = 'ProductCategoryModel';

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

    // Query

    $result = $this->Model->findOne($id);

    // Output

    $this->success('DATA_READ', $result);
  }

  private function validate($data, $scenario = '') {

    $errors = [];

    if (empty($data['category']))
      $errors[] = lang('CATEGORY_REQUIRED');

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

    $category = $request['category'];
    $slug = strtolower(url_title($category));

    // Map

    $data = [
      'category' => $category,
      'slug' => $slug,
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

    $category = $request['category'];
    $slug = strtolower(url_title($category));

    // Map

    $data = [
      'category' => $category,
      'slug' => $slug,
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

    $this->Model->where([
      'id' => $id,
    ])->delete();

    // Output

    $this->success('DATA_DELETED');
  }

}
