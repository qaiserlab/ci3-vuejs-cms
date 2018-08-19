<?php
extract($data);

?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/images/favicon.png">

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <title>
    <?php if (isset($title)) echo $title; else echo $this->config->item('app_name'); ?>
    <?php if (isset($caption)) echo '| '.$caption ?>
  </title>

  <?php
  $this->load->view('admin/layouts/LibrariesView');
  $this->load->view('tools/ServerView');
  ?>

  <link rel="stylesheet" href="<?= base_url() ?>assets/styles/components.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/styles/admin.min.css">

</head>

<body id="lte" class="hold-transition skin-blue sidebar-mini">

  <?php load_components('Dashboard') ?>

  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="<?= base_url('admin') ?>" class="logo">
        <!-- Logo mini 50x50 pixels -->
        <span class="logo-mini">ADM</span>
        <!-- Logo regular -->
        <span class="logo-lg"><?= $this->config->item('app_name') ?><b>ADMIN</b></span>
      </a>
      <!-- End Logo -->

      <!-- Header -->
      <nav class="navbar navbar-static-top">

        <!-- Sidebar Toggle Button -->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <!-- End Sidebar Toggle Button -->

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <?php $this->load->view('admin/layouts/UserView') ?>

            <!-- Sidebar Toggle Button -->
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        </div>
      </nav>
      <!-- End Header -->
    </header>

    <!-- Sidebar -->
    <aside class="main-sidebar">
      <section class="sidebar">

        <?php if ($_SESSION['photo']): ?>
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?= $_SESSION['photo'] ?>" class="img-circle" alt="<?= $_SESSION['fullName'] ?>">
            </div>
            <div class="pull-left info">
              <p><?= $_SESSION['fullName'] ?></p>
              <a href="javascript:"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
        <?php endif; ?>

        <?php $this->load->view('admin/layouts/SidebarView') ?>
      </section>
    </aside>
    <!-- End Sidebar -->

    <?php $this->load->view('admin/pages/'.$page, $data); ?>

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> <?= $this->config->item('app_version') ?>
      </div>
      <strong>
        Copyright &copy; 2016 - <?= date('Y') ?>
        <a href="<?= $this->config->item('app_url') ?>" target="_blank">
          <?= $this->config->item('app_provider') ?>
        </a>.</strong>
        All rights reserved.
      </footer>

      <!-- Panel -->
      <aside class="control-sidebar control-sidebar-dark">
        <div class="tab-content">
          <?php $this->load->view('admin/layouts/PanelView') ?>
        </div>
      </aside>
      <!-- End Panel -->

      <div class="control-sidebar-bg"></div>
    </div>

  </body>
</html>
