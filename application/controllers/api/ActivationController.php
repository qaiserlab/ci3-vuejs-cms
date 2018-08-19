<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ActivationController extends MY_Controller {
  private $model = 'ActivationModel';

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

}
