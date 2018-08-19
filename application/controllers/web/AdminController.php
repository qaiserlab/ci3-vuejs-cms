<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends MY_Controller {

  public function __construct() {
    parent::__construct();

    // Authorize

    if (!isset($_SESSION['authKey']))
      $this->forceOut();

    if (!isset($_SESSION['authType']))
      $this->forceOut();
    else {

      if ($_SESSION['authType'] != 'user')
      $this->forceOut();
    }

    // Menu

    $this->config->load('menu');
  }

  private function forceOut() {
    if ($this->uri->segment(2) != 'login') {
      header('location:'.base_url('admin/login'));
      exit;
    }
  }

  private function render($page, $data = []) {
    $this->load->view('admin/layouts/MainView', [
      'page' => $page,
      'data' => $data,
    ]);
  }

  public function renderDashboard() {
    $this->render('dashboard/DashboardView');
  }

  public function renderLogin() {
    $this->load->view('admin/pages/login/LoginView');
  }

  public function renderPage($directory, $view, $params = '') {

    // Directory

    $explodedDirectory = explode('-', $directory);
    $arrayDirectory = [];

    foreach ($explodedDirectory as $iDirectory) {
      $arrayDirectory []= ucfirst($iDirectory);
    }

    $directory = implode('', $arrayDirectory);
    $directory = lcfirst($directory);

    $title = implode('_', $arrayDirectory);
    $title = lang(strtoupper($title));

    // View

    $explodedView = explode('-', $view);
    $arrayView = [];

    foreach ($explodedView as $iView) {
      $arrayView []= ucfirst($iView);
    }

    $view = implode('', $arrayView).'View';

    $caption = implode('_', $arrayView);
    $caption = lang(strtoupper($caption));

    // Params

    if (!empty($params))
      $params = explode('-', $params);

    if (file_exists('application/views/admin/pages/'.$directory.'/'.$view.'.php')) {

      $page = $directory.'/'.$view;
      $data = [
        '_SEGMENT' => $params,

        'title' => $title,
        'caption' => $caption,
      ];

      $this->render($page, $data);
    }
    else
      show_404();

  }

}
