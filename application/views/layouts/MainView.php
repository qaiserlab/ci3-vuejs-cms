<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/images/favicon.png">

  <title><?= $title ?></title>

  <?php
  $this->load->view('layouts/LibrariesView');
  $this->load->view('tools/ServerView');
  ?>

  <link rel="stylesheet" href="<?= base_url() ?>assets/styles/components.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/styles/site.min.css">

</head>
<body>

  <?php load_components('Site') ?>

  <div id="main">
    <?php $this->load->view('layouts/HeaderView') ?>
    <?php $this->load->view('pages/'.$page) ?>
    <?php $this->load->view('layouts/FooterView') ?>
  </div>

</body>
</html>
