<li id="user" class="dropdown user user-menu">
  <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
    <?php if ($_SESSION['photo']): ?>
      <img src="<?= $_SESSION['photo'] ?>"
      class="user-image"
      alt="">
    <?php endif; ?>

    <span class="hidden-xs"><?= $_SESSION['fullName'] ?></span>
  </a>

  <ul class="dropdown-menu">

    <li class="user-header">
      <?php if ($_SESSION['photo']): ?>
        <img src="<?= $_SESSION['photo'] ?>"
        class="img-circle"
        alt="<?= $_SESSION['fullName'] ?>">
      <?php endif; ?>

      <p>
        <?= $_SESSION['fullName'] ?>
        <small><?= lang('MEMBER_SINCE') ?> <?= $_SESSION['registeredDate'] ?></small>
      </p>
    </li>

    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a @click="goToMyAccount"
        href="javascript:"
        class="btn btn-default btn-flat"><?= lang('MY_ACCOUNT') ?></a>
      </div>
      <div class="pull-right">
        <a @click="logoutAction"
        href="javascript:"
        class="btn btn-default btn-flat"><?= lang('LOGOUT') ?></a>
      </div>
    </li>

  </ul>
</li>

<script>
  var user = new Vue({
    el: '#user',

    /************************
    <id="_data">
    ************************/
    data: {
      result: $api.result(),
      loading: false,
    },

    /************************
    <id="_methods">
    ************************/
    methods: {

      /************************
      <id="_goToMyAccount">
      ************************/
      goToMyAccount: function () {
        window.location = admin_url('my-account/user-profile');
      },

      /************************
      <id="_logoutAction">
      ************************/
      logoutAction: function () {

        $confirm.show('<?= lang('LOGOUT_SESSION') ?>', function () {

          var url = 'AccountController/logout';

          this.loading = true;

          $api.post(url, function (result) {

            this.result = result;
            this.loading = false;

            if (result.state == 'success')
              window.location = admin_url('login');

          }.bind(this));
        }.bind(this));

      },
    },

  });
</script>
