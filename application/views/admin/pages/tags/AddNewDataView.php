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

      form: {
        tag: '',
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
      },

      /************************
      <id="_saveData">
      ************************/
      saveData: function () {
        this.loading = true;

        var url = 'PostTagController/createData';
        var data = this.form;

        $api.post(url, data, result => {

          if (result.state == 'success') {
            $splash.show(result.message, function () {
              window.location = admin_url('tags/edit-data/' + result.data.id);
            });
          }
          else {
            this.result = result;
            this.loading = false;
          }

        });
      },
    },
  });
</script>
