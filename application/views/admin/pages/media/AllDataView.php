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
    <ui-widget title="<?= lang('IMAGES') ?>" :loading="loading">

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

        <div class="row">
          <div class="thumbnail col-md-2"
          v-for="(image, i) in rs_">
            <a data-lightbox="thumbnail"
            :data-title="base_url('writable/archives/' + image)"
            :href="base_url('writable/archives/' + image)">
              <figure style="height: 100px">
                <img :src="base_url('writable/archives/' + image)" alt="">
              </figure>
            </a>
            <ui-button icon="close"
            @click="deleteData(image, i)"
            type="button"
            bs-type="danger"></ui-button>
          </div>
        </div>

        <div v-if="rs_.length < rs.length" class="row">
          <div class="col-md-12" style="text-align: center;padding-top: 16px">
            <ui-button @click="readMore" type="button">
              <?= lang('READ_MORE') ?>...
            </ui-button>
          </div>
        </div>

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
      page: 0,
      rs: [],
    },

    /************************
    <id="_computed">
    ************************/
    computed: {

      /************************
      <id="_rs_">
      ************************/
      rs_: function () {
        var limit = 10;
        var start = this.page * limit;
        limit = start + limit;
        var rs = [];

        for (var i = 0; i < limit; i++) {
          if (this.rs[i])
            rs.push(this.rs[i]);
        }

        return rs;
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

        var url = 'MediaController/readAllData';
        var data = {
          remap: true,
          orderBy: 'id',
        };

        $api.post(url, data, function (result) {

          this.rs = result.data;
          this.loading = false;

        }.bind(this));
      },

      /************************
      <id="_readMore">
      ************************/
      readMore: function () {
        this.page++;
      },

      /************************
      <id="_addNewData">
      ************************/
      addNewData: function () {
        window.location = admin_url('media/add-new-data');
      },

      /************************
      <id="_editData">
      ************************/
      editData: function (id) {
        window.location = admin_url('media/edit-data/' + id);
      },

      /************************
      <id="_deleteData">
      ************************/
      deleteData: function (image, index) {

        $confirm.show('<?= lang('DELETE_SELECTED_DATA') ?>', function () {

          var url = 'MediaController/deleteData';
          var data = {
            image: image,
          };

          $api.post(url, data, function (result) {
            this.refreshData();
          }.bind(this));

        }.bind(this));

      },
    },

  });
</script>
