<div id="PageActive" class="content-wrapper">

  <!-- Headbar -->
  <ui-header title="<?= $title ?>" caption="<?= $caption ?>">
    <ol class="breadcrumb">
      <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i></a></li>
      <li><a href="<?= base_url('admin/users/all-data') ?>"><?= $title ?></a></li>
      <li class="active"><?= $caption ?></li>
    </ol>
  </ui-header>
  <!-- End Headbar -->

  <!-- Content -->
  <form @submit.prevent="saveData" role="form" autocomplete="off">
    <div class="content">
      <div class="row">

        <!-- Left Column -->
        <div class="col-md-9">

          <!-- Widget -->
          <ui-widget title="<?= lang('EDITOR') ?>" :loading="loading">
            <div class="box-body">
              <ui-alert :data-source="result"></ui-alert>

              <ui-textbox v-model="form.firstName"><?= lang('FIRST_NAME') ?></ui-textbox>
              <ui-textbox v-model="form.lastName"><?= lang('LAST_NAME') ?></ui-textbox>
              <ui-textbox v-model="form.username"><?= lang('USERNAME') ?></ui-textbox>
              <ui-textbox v-model="form.email"><?= lang('EMAIL') ?></ui-textbox>
              <ui-textbox v-model="form.password" type="password" autocomplete="off">
                <?= lang('PASSWORD') ?>
              </ui-textbox>
              <ui-textbox v-model="form.retypePassword" type="password" autocomplete="off">
                <?= lang('RETYPE_PASSWORD') ?>
              </ui-textbox>

              <ui-datepicker v-model="form.dateOfBirth"><?= lang('DATE_OF_BIRTH') ?></ui-datepicker>

            </div>
          </ui-widget>
          <!-- End Widget -->

        </div>
        <!-- End Left Column -->

        <!-- Right Column -->
        <div class="col-md-3">

          <ui-widget title="<?= lang('ACTION') ?>">

            <div class="box-body">

              <ui-image v-model="form.photo" placeholder="Size 3x4"><?= lang('PHOTO') ?></ui-image>
              <ui-select v-model="form.activationId" :data-source="rsActivation" data-field="activation">
                <?= lang('ACTIVATION') ?>
              </ui-select>

            </div>

            <div class="box-footer">
              <ui-button :loading="loading" icon="save">
                <?= lang('SAVE') ?>
              </ui-button>
            </div>

          </ui-widget>

        </div>
        <!-- End Right Column -->
      </div>

    </div>
  </form>
  <!-- End Content -->

</div>

<script>
  var vm = new Vue({
    el: '#PageActive',

    /************************
    <id="_data">
    ************************/
    data: {
      loading: false,
      result: $api.result(),

      rsActivation: [],

      form: {
        firstName: '',
        lastName: '',
        username: '',
        email: '',
        password: '',
        retypePassword: '',
        photo: '',
        activationId: 1,
        dateOfBirth: '1985-1-1',
      },
    },

    /************************
    <id="_created">
    ************************/
    created: function () {
      this.refreshData();
    },

    /************************
    <id="_methods">
    ************************/
    methods: {

      /************************
      <id="_refreshData">
      ************************/
      refreshData: function () {
        this.loading = true;

        var url = 'ActivationController/readAllData';
        var data = {
          orderBy: 'id',
        };

        $api.post(url, data, function (result) {

          this.rsActivation = result.data;
          this.loading = false;

        }.bind(this));

      },

      /************************
      <id="_saveData">
      ************************/
      saveData: function () {
        this.loading = true;

        var url = 'UserController/createData';
        var data = this.form;

        $api.post(url, data, function (result) {

          if (result.state == 'success') {
            $splash.show(result.message, function () {
              window.location = admin_url('users/edit-data/' + result.data.id);
            });
          }
          else {
            this.result = result;
            this.loading = false;
          }

        }.bind(this));
      },
    },
  });
</script>
