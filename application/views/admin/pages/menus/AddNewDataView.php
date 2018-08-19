<div id="PageActive" class="content-wrapper">

  <!-- Headbar -->
  <ui-header title="<?= $title ?>" caption="<?= $caption ?>">
    <ol class="breadcrumb">
      <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i></a></li>
      <li><a href="<?= base_url('admin/menus/all-data') ?>"><?= $title ?></a></li>
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

              <ui-textbox v-model="form.title"><?= lang('TITLE') ?></ui-textbox>
              <ui-menu v-model="form.menu"><?= lang('MENU') ?></ui-menu>

            </div>
          </ui-widget>
          <!-- End Widget -->

        </div>
        <!-- End Left Column -->

        <!-- Right Column -->
        <div class="col-md-3">

          <ui-widget title="<?= lang('ACTION') ?>">

            <ui-button :loading="loading" icon="save">
              <?= lang('SAVE') ?>
            </ui-button>

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

      rsPublication: [],

      form: {
        title: '',
        menu: {},
      },
    },

    /************************
    <id="_methods">
    ************************/
    methods: {

      /************************
      <id="_saveData">
      ************************/
      saveData: function () {
        this.loading = true;

        var url = 'MenuController/createData';
        var data = this.form;

        $api.post(url, data, function (result) {

          if (result.state == 'success') {
            $splash.show(result.message, function () {
              window.location = admin_url('menus/edit-data/' + result.data.id);
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
