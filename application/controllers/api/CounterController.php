<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CounterController extends MY_Controller {
  private $model = 'CounterModel';

  public function __construct() {
    parent::__construct();

    $this->load->Model($this->model, 'Model');
  }

  public function readOneData($id = 1) {
    $this->authen(AT_FREE);
    $request = $this->input->post();

    // Query

    $result = $this->Model->findOne($id);

    // Output
    $this->success('DATA_READ', $result);
  }

}
