<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/images/favicon.png">
  <title><?= $this->config->item('app_name') ?> | <?= lang('LOGIN') ?></title>

  <?php
  $this->load->view('admin/layouts/LibrariesView');
  $this->load->view('tools/ServerView');
  ?>

  <link rel="stylesheet" href="<?= base_url() ?>assets/styles/components.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/styles/admin.min.css">

</head>

<body class="hold-transition login-page">

  <?php load_components('Login') ?>

  <div class="login-box">
    <!-- <div class="login-logo">
      <a href="<?= base_url() ?>"><?= $this->config->item('app_name') ?><b>ADMIN</b></a>
    </div> -->

    <!-- <div class="login-box-body"> -->
      <!-- <p class="login-box-msg">
        Copyright &copy; 2016 - <?= date('Y') ?>
        <a href="<?= $this->config->item('app_url') ?>" target="_blank">
          <?= $this->config->item('app_provider') ?>
        </a>
      </p> -->

      <ui-widget title="<?= lang('LOGIN') ?>">
        <form @submit.prevent="login">

          <ui-alert :data-source="result"></ui-alert>

          <div class="form-group has-feedback">
            <ui-textbox placeholder="<?= lang('USERNAME_EMAIL') ?>" v-model="form.email" icon="envelope"></ui-textbox>
          </div>
          <div class="form-group has-feedback">
            <ui-textbox placeholder="<?= lang('PASSWORD') ?>" v-model="form.password" type="password" icon="lock"></ui-textbox>
          </div>
          <hr>
          <div class="pull-right">
            <ui-button type="submit" icon="lock" :loading="loading">
              <?= lang('LOGIN') ?>
            </ui-button>
          </div>
        </form>
      </ui-widget>

    <!-- </div> -->

  </div>

  <script>
    var vm = new Vue({
      el: '.login-box',

      /************************
      <id="_data">
      ************************/
      data: {
        result: $api.result(),
        loading: false,

        form: {
          email: '',
          password: '',
        },
      },

      /************************
      <id="_methods">
      ************************/
      methods: {

        /************************
        <id="_login">
        ************************/
        login: function () {

          this.loading = true;

          $api.post('AccountController/login', this.form, result => {

            this.result = result;
            this.loading = false;

            if (result.state == 'success')
              window.location = admin_url();

          });
        },

      },
    });
  </script>

</body>

</html>
