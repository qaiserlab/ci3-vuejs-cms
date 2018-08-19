<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  public function __construct() {
    parent::__construct();
    session_start();

    // Language

    $lang = $this->input->post('lang');
    if (empty($lang))
      $lang = $this->input->get('lang');

    if (!empty($lang)) {
      $_SESSION['lang'] = $lang;
      $this->config->item('language', $_SESSION['lang']);
    }
    else {
      if(!isset($_SESSION['lang'])) {
        $lang = $this->config->item('language');
        $_SESSION['lang'] = $lang;
      }
      else
        $lang = $_SESSION['lang'];
    }

    $this->lang->load('strings', $lang);
  }

  protected function authen($authLevel) {
    $postApiKey = $this->input->post('apiKey');
    if (empty($postApiKey)) $postApiKey = $this->input->get('apiKey');

    $postAuthKey = $this->input->post('authKey');
    if (empty($postAuthKey)) $postAuthKey = $this->input->get('authKey');

    $apiKey = $this->config->item('api_key');

    if (empty($postApiKey))
      $this->denied();

    if ($postApiKey != $apiKey)
      $this->denied();

    if ($authLevel == AT_MEMBER) {
      if (empty($postAuthKey))
        $this->denied();

      if ($postAuthKey != $_SESSION['authKey'])
        $this->denied();
    }
    elseif ($authLevel == AT_USER) {
      if (empty($postAuthKey))
        $this->denied();

      $this->load->model('UserLogModel');
      $row = $this->UserLogModel->findOne([
        'where' => [
          'authKey' => $postAuthKey,
        ],
      ]);

      if ($row['authType'] != AT_USER)
        $this->denied();

      if ($postAuthKey != $row['authKey'])
        $this->denied();
    }

  }

  protected function result($state, $message, $data = array(), $extra = array()) {
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');

    $message = (empty(lang($message))?$message:lang($message));

    $result = array(
      'state' => $state,
      'message' =>$message,
      'data' => $data,
      'extra' => $extra,
    );

    echo json_encode($result);
    exit;
  }

  protected function success($message, $data = array(), $extra = array()) {
    $this->result('success', $message, $data, $extra);
  }

  protected function failed($message, $data = array(), $extra = array()) {
    $this->result('failed', $message, $data, $extra);
  }

  protected function invalid($data = array(), $extra = array()) {
    $this->result('invalid', 'PLEASE_CORRECT', $data, $extra);
  }

  protected function denied() {
    $this->result('denied', 'ACCESS_DENIED');
  }

  public function store($fileName) {

    $source = 'writable/tmp/'.$fileName;
    $target = 'writable/archives/'.$fileName;

    if (rename($source, $target))
      return true;
    else
      return false;
  }

  public function encrypt($password = '', $salt = '') {
    if (empty($password))
      $password = uniqid();

    $encryptedText = strtoupper(sha1($password.$salt));
    return $encryptedText;
  }

}
