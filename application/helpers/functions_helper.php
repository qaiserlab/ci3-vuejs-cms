<?php

function load_components($key) {
  $CI = &get_instance();

  $components = $CI->config->item('components');

  $dashboardTools = $components[$key]['Tools'];
  foreach ($dashboardTools as $view => $loadIt) {
    if ($loadIt)
    $CI->load->view('tools/'.$view.'View');
  }

  $dashboardComponents = $components[$key]['Components'];
  foreach ($dashboardComponents as $view => $loadIt) {
    if ($loadIt)
    $CI->load->view('components/'.$view.'View');
  }
}

function get_menu($dataSource, $key) {
  $menu = '';

  foreach ($dataSource as $row) {
    if ($row['id'] == $key)
      $menu = $row;
  }

  return $menu;
}

function bs_nav($dataSource, $key, $style = 'nav navbar-nav') {
  $rowMenu = get_menu($dataSource, $key);

  ?>
  <ul class="<?= $style ?>">
    <?php
    $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    foreach($rowMenu['menu'] as $menuId => $menu):

      if (isset($menu['permalink']) && !isset($menu['child'])) {

        if (substr($menu['permalink'], 0, 2) == './')
          $permalink = base_url(substr($menu['permalink'], 2));
        else
          $permalink = $menu['permalink'];

        if ($permalink == $currentUrl)
          $liStyle = 'active';
        else
          $liStyle = '';

        $aStyle = '';
        $dataToggle = '';
        $caret = '';
      }
      else {
        $permalink = 'javascript:';
        $liStyle = 'dropdown';
        $aStyle = 'dropdown-toggle';
        $dataToggle = 'data-toggle="dropdown"';
        $caret = '<b class="caret"></b>';
      }
      ?>

      <li class="<?= $liStyle ?>">
        <a href="<?= $permalink ?>" class="<?= $aStyle ?>" <?= $dataToggle ?>>
          <?= $menu['title'] ?>
          <?= $caret ?>
        </a>

        <?php if (isset($menu['child'])): ?>
          <ul class="dropdown-menu">
            <?php foreach($menu['child'] as $subMenuId => $subMenu): ?>
              <li>
                <a href="<?= base_url($subMenu['permalink']) ?>"><?= $subMenu['title'] ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </li>

    <?php endforeach; ?>
  </ul>
  <?php
}
