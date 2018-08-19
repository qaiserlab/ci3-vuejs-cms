<div id="PageActive" class="content-wrapper">

  <!-- Headbar -->
  <ui-header title="<?= $title ?>" caption="<?= $caption ?>">
    <ol class="breadcrumb">
      <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i></a></li>
      <li class="active"><?= $title ?></li>
    </ol>
  </ui-header>
  <!-- End Headbar -->

  <!-- Content -->
  <div class="content">

    <!-- Table Area -->
    <ui-widget title="<?= lang('TABLE') ?>" :loading="loading">

      <!-- Toolbar -->
      <div class="box-header">

        <ul class="list-inline pull-right">
          <li>
            <ui-link @click="refreshData" icon="refresh"><?= lang('REFRESH') ?></ui-link>
          </li>
          <li>
            <ui-link @click="addNewData" icon="plus"><?= lang('ADD_NEW_DATA') ?></ui-link>
          </li>
        </ul>

      </div>
      <!-- End Toolbar -->

      <div class="box-body">

        <ui-data-table :data-source="rs">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th><?= lang('TAG') ?></th>
                <th style="text-align: right"><?= lang('ACTION') ?></th>
              </tr>
            </thead>
            <tbody>

              <tr v-for="row in rs">
                <td>{{ row.tag }}</td>
                <td>
                  <ul class="list-inline pull-right">
                    <li>
                      <ui-link
                      :href="'javascript:vm.editDataAction(' + row.id + ')'"
                      icon="edit"><?= lang('EDIT') ?></ui-link>
                    </li>
                    <li>
                      <ui-link
                      :href="'javascript:vm.deleteData(' + row.id + ')'"
                      icon="remove"><?= lang('DELETE') ?></ui-link>
                    </li>
                  </ul>
                </td>
              </tr>

            </tbody>
          </table>
        </ui-data-table>

      </div>

    </ui-widget>
    <!-- End Table Area -->

  </div>
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
      rs: [],
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

        var url = 'PostTagController/readAllData';
        var data = {
          orderBy: 'id',
        };

        $api.post(url, data, result => {

          this.rs = result.data;
          this.loading = false;

        });
      },

      /************************
      <id="_addNewData">
      ************************/
      addNewData: function () {
        window.location = admin_url('tags/add-new-data');
      },

      /************************
      <id="_editDataAction">
      ************************/
      editDataAction: function (id) {
        window.location = admin_url('tags/edit-data/' + id);
      },

      /************************
      <id="_deleteData">
      ************************/
      deleteData: function (id) {

        $confirm.show('<?= lang('DELETE_SELECTED_DATA') ?>', () => {

          var url = 'PostTagController/deleteData';
          var data = {
            id: id,
          };

          $api.post(url, data, function (result) {
            this.refreshData();
          }.bind(this));

        });

      },
    },

  });
</script>
