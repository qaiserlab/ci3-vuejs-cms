<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SiteController extends MY_Controller {
  private $layout = 'MainView';

  public function __construct() {
    parent::__construct();

    $this->load->library([
      'pagination',
    ]);

    $this->load->model([
      'VisitorModel',
      'MenuModel',

      'PostCategoryModel',
      'PostTagModel',
      'PostModel',

      'ProductCategoryModel',
      'ProductModel',

      'PageModel',
    ]);
  }

  private function render($page, $data = []) {
    $this->VisitorModel->hit();

    if (isset($data['rowPage']))
      $title = $data['rowPage']['title'];
    elseif (isset($data['rowPost']))
      $title = $data['rowPost']['title'];
    elseif (isset($data['rowCategory']))
      $title = $data['rowCategory']['category'];
    elseif (isset($data['rowTag']))
      $title = $data['rowTag']['tag'];
    else
      $title = $this->config->item('app_name');

    $rsMenu = $this->MenuModel->findAll([
      'remap' => true,
    ]);

    $rsCategory = $this->PostCategoryModel->findAll(['remap' => true]);
    $rsTag = $this->PostTagModel->findAll(['remap' => true]);

    // Output

    $data['title'] = $title;
    $data['page'] = $page;

    $data['rsMenu'] = $rsMenu;
    $data['rsCategory'] = $rsCategory;
    $data['rsTag'] = $rsTag;

    $this->load->view('layouts/'.$this->layout, $data);
  }

  private function initPaging($baseUrl, $totalRows, $perPage) {
    $config['base_url'] = $baseUrl;
    $config['total_rows'] = $totalRows;
    $config['per_page'] = $perPage;

    $config['full_tag_open'] = "<ul class='pagination'>";
    $config['full_tag_close'] ="</ul>";
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
    $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
    $config['next_tag_open'] = "<li>";
    $config['next_tagl_close'] = "</li>";
    $config['prev_tag_open'] = "<li>";
    $config['prev_tagl_close'] = "</li>";
    $config['first_tag_open'] = "<li>";
    $config['first_tagl_close'] = "</li>";
    $config['last_tag_open'] = "<li>";
    $config['last_tagl_close'] = "</li>";

    $this->pagination->initialize($config);
  }

  public function index() {

    // Extract

    $rowHome = $this->PageModel->findOne([
      'where' => [
        'id' => 1,
      ],
    ]);

    $rsLatestPost = $this->PostModel->findAll([
      'remap' => true,
      'orderBy' => 'postedOn desc',
      'limit' => 1,
    ]);

    if (count($rsLatestPost) >= 1)
      $rowLatestPost = $rsLatestPost[0];
    else
      $rowLatestPost = null;

    $rsNewProduct = $this->ProductModel->findAll([
      'remap' => true,
      'orderBy' => 'postedOn desc',
      'limit' => 4,
    ]);

    // Output

    $this->render('HomeView', [
      'rowHome' => $rowHome,
      'rowLatestPost' => $rowLatestPost,
      'rsNewProduct' => $rsNewProduct,
    ]);
  }

  public function renderCategory($slug, $start = 0) {

    // Extract

    $rowCategory = $this->PostCategoryModel->findOne([
      'where' => [
        'slug' => $slug,
      ],
    ]);

    if (!$rowCategory)
      show_404();

    $baseUrl = base_url('category/'.$slug);
    $offset = 5;

    $count = $this->PostModel->count([
      'where' => [
        'publicationId' => 2,
        'categorySlug' => $slug,
      ],
    ]);

    $this->initPaging($baseUrl, $count, $offset);
    $rsPost = $this->PostModel->findAll([
      'remap' => true,
      'where' => [
        'publicationId' => 2,
        'categorySlug' => $slug,
      ],
      'orderBy' => 'postedOn desc',
      'limit' => [$offset, $start],
    ]);

    // Output

    $this->render('CategoryView', [
      'rowCategory' => $rowCategory,
      'rsPost' => $rsPost,
    ]);
  }

  public function renderSearch($start = 0) {

    $keyword = $this->input->get('keyword');

    // Extract

    $baseUrl = base_url('search');
    $offset = 5;

    $count = $this->PostModel->count([
      'where' => [
        'publicationId' => 2,
      ],
      'orWhere' => [
        'title like' => '%'.$keyword.'%',
        'content like' => '%'.$keyword.'%',
      ],
    ]);

    $this->initPaging($baseUrl, $count, $offset);
    $rsPost = $this->PostModel->findAll([
      'remap' => true,
      'where' => [
        'publicationId' => 2,
      ],
      'orWhere' => [
        'title like' => '%'.$keyword.'%',
        'content like' => '%'.$keyword.'%',
      ],
      'orderBy' => 'postedOn desc',
      'limit' => [$offset, $start],
    ]);

    // Output

    $this->render('SearchView', [
      // 'rowTag' => $rowTag,
      'rsPost' => $rsPost,
    ]);
  }

  public function renderTag($slug, $start = 0) {
    // Extract

    $rowTag = $this->PostTagModel->findOne([
      'where' => [
        'slug' => $slug,
      ],
    ]);

    if (!$rowTag)
      show_404();

    $baseUrl = base_url('tag/'.$slug);
    $offset = 5;

    $count = $this->PostModel->count([
      'where' => [
        'publicationId' => 2,
      ],
      'orWhere' => [
        'title like' => '%'.$rowTag['tag'].'%',
        'content like' => '%'.$rowTag['tag'].'%',
      ],
    ]);

    $this->initPaging($baseUrl, $count, $offset);
    $rsPost = $this->PostModel->findAll([
      'remap' => true,
      'where' => [
        'publicationId' => 2,
      ],
      'orWhere' => [
        'title like' => '%'.$rowTag['tag'].'%',
        'content like' => '%'.$rowTag['tag'].'%',
      ],
      'orderBy' => 'postedOn desc',
      'limit' => [$offset, $start],
    ]);

    // Output

    $this->render('TagView', [
      'rowTag' => $rowTag,
      'rsPost' => $rsPost,
    ]);
  }

  public function renderSingle($postedYear, $postedMonth, $slug) {
    $rowPost = $this->PostModel->findOne([
      'remap' => true,
      'where' => [
        'year(postedOn)' => $postedYear,
        'month(postedOn)' => $postedMonth,
        'slug' => $slug,
      ],
    ]);

    if (!$rowPost)
      show_404();

    // Output

    $this->render('SingleView', [
      'rowPost' => $rowPost,
    ]);
  }

  public function renderProductCategory($slug, $start = 0) {

    // Extract

    $rowCategory = $this->ProductCategoryModel->findOne([
      'where' => [
        'slug' => $slug,
      ],
    ]);

    if (!$rowCategory)
      show_404();

    $baseUrl = base_url('product/'.$slug);
    $offset = 5;

    $count = $this->ProductModel->count([
      'where' => [
        'publicationId' => 2,
        'categorySlug' => $slug,
      ],
    ]);

    $this->initPaging($baseUrl, $count, $offset);
    $rsProduct = $this->ProductModel->findAll([
      'remap' => true,
      'where' => [
        'publicationId' => 2,
        'categorySlug' => $slug,
      ],
      'orderBy' => 'postedOn desc',
      'limit' => [$offset, $start],
    ]);

    // Output

    $this->render('ProductCategoryView', [
      'rowCategory' => $rowCategory,
      'rsProduct' => $rsProduct,
    ]);
  }

  public function renderProductSingle($category, $slug) {
    $rowProduct = $this->ProductModel->findOne([
      'remap' => true,
      'where' => [
        // 'categorySlug' => $categorySlug,
        'slug' => $slug,
      ],
    ]);

    if (!$rowProduct)
      show_404();

    // Output

    $this->render('ProductSingleView', [
      'rowProduct' => $rowProduct,
    ]);
  }

  public function renderPage($slug) {
    $rowPage = $this->PageModel->findOne([
      'remap' => true,
      'where' => [
        'slug' => $slug,
      ],
    ]);

    if (!$rowPage)
      show_404();

    // Output

    $this->render('PageView', [
      'rowPage' => $rowPage,
    ]);
  }

}
