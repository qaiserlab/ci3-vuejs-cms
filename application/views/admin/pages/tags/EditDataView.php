<div id="PageActive" class="content-wrapper">

  <!-- Headbar -->
  <ui-header title="<?= $title ?>" caption="<?= $caption ?>">
    <ol class="breadcrumb">
      <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i></a></li>
      <li><a href="<?= base_url('admin/tags/all-data') ?>"><?= $title ?></a></li>
      <li class="active"><?= $caption ?></li>
    </ol>
  </ui-header>
  <!-- End Headbar -->

  <!-- Content -->
  <form @submit.prevent="saveData" role="form">
    <div class="content">
      <div class="row">

        <!-- Left Column -->
        <div class="col-md-9">

          <!-- Widget -->
          <ui-widget title="<?= lang('EDITOR') ?>" :loading="loading">
            <div class="box-body">

              <ui-alert :data-source="result"></ui-alert>

              <ui-textbox v-model="form.tag"><?= lang('TAGS') ?></ui-textbox>

            </div>
          </ui-widget>
          <!-- End Widget -->

        </div>
        <!-- End Left Column -->

        <!-- Right Column -->
        <div class="col-md-3">

          <ui-widget title="<?= lang('ACTION') ?>">

            <div class="box-footer">

              <ui-button :loading="loading" icon="save">
                <?= lang('SAVE') ?>
              </ui-button>

              <div class="pull-right">
                <ui-link @click="addNewData" icon="plus">
                  <?= lang('ADD_NEW_DATA') ?>
                </ui-link>
              </div>
            </div>

          </ui-widget>

        </div>
        <!-- End Right Column -->

      </div>
    </div>
    <!-- End Content -->
  </form>

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
        tag: '',
        activationId: '',
      },

    },

    /************************
    <id="_created">
    ************************/
    created: function () {
      $('#PostsMenu').addClass('active');
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

        $api.post(url, data, result => {
          this.rsActivation = result.data;

          var url = 'PostTagController/readOneData/<?= $_SEGMENT[0] ?>';

          $api.post(url, result => {
            this.form = result.data;
            this.loading = false;
          });
        });

      },

      /************************
      <id="_addNewData">
      ************************/
      addNewData: function () {
        window.location = admin_url('tags/add-new-data');
      },

      /************************
      <id="_saveData">
      ************************/
      saveData: function () {

        this.loading = true;

        var url = 'PostTagController/updateData';
        var data = this.form;

        $api.post(url, data, result => {

          this.result = result;
          this.loading = false;

          if (result.state == 'success') {
            $splash.show(result.message, function () {
              this.form = result.data;
            }.bind(this));
          }

        });
      },
    },
  });
</script>
