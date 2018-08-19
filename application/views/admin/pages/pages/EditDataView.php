<div id="PageActive" class="content-wrapper">

  <!-- Headbar -->
  <ui-header title="<?= $title ?>" caption="<?= $caption ?>">
    <ol class="breadcrumb">
      <li><a href="<?= base_url('admin') ?>"><i class="fa fa-dashboard"></i></a></li>
      <li><a href="<?= base_url('admin/pages/all-data') ?>"><?= $title ?></a></li>
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

              <ui-textbox v-model="form.title"><?= lang('TITLE') ?></ui-textbox>

              <?php if ($_SEGMENT[0] > 1): ?>
                <ui-wysi v-model="form.content"><?= lang('CONTENT') ?></ui-wysi>
              <?php endif; ?>

              <?php if ($_SEGMENT[0] == 1): ?>
              <div id="csfHome">
                <br>

                <ui-row>
                  <ui-col size="md-4">
                    <ui-textbox v-model="form.csf.title1"></ui-textbox>
                  </ui-col>
                  <ui-col size="md-4">
                    <ui-textbox v-model="form.csf.title2"></ui-textbox>
                  </ui-col>
                  <ui-col size="md-4">
                    <ui-textbox v-model="form.csf.title3"></ui-textbox>
                  </ui-col>
                </ui-row>
                <br>

                <ui-row>
                  <ui-col size="md-4">
                    <ui-textarea v-model="form.csf.block1"></ui-textarea>
                  </ui-col>
                  <ui-col size="md-4">
                    <ui-textarea v-model="form.csf.block2"></ui-textarea>
                  </ui-col>
                  <ui-col size="md-4">
                    <ui-textarea v-model="form.csf.block3"></ui-textarea>
                  </ui-col>
                </ui-row>
              </div>
              <?php endif; ?>

            </div>
          </ui-widget>
          <!-- End Widget -->

        </div>
        <!-- End Left Column -->

        <!-- Right Column -->
        <div class="col-md-3">

          <ui-widget title="<?= lang('ACTION') ?>">

            <div class="box-body">
              <ui-media v-model="form.featuredImage" placeholder="Size 3x4"><?= lang('FEATURED_IMAGE') ?></ui-media>
              <ui-select v-model="form.publicationId" :data-source="rsActivation" data-field="publication">
                <?= lang('PUBLICATION') ?>
              </ui-select>
            </div>

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
        publicationId: '',
        postCategoryId: '',
        title: '',
        content: '',
        featuredImage: '',

        /************************
        <id="_csfHome">
        ************************/
        <?php if ($_SEGMENT[0] == 1): ?>
        csf: {
          title1: '',
          block1: '',
          title2: '',
          block2: '',
          title3: '',
          block3: '',
        },
        <?php endif; ?>
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

        var url = 'PublicationController/readAllData';
        var data = {
          orderBy: 'id',
        };

        $api.post(url, data, function (result) {
          this.rsActivation = result.data;

          var url = 'PageController/readOneData/<?= $_SEGMENT[0] ?>';
          var data = {
            remap: true,
          };

          $api.post(url, data, function (result) {

            var lastCsf = this.form.csf;
            this.form = result.data;

            if (!result.data.csf)
              this.form.csf = lastCsf;

            this.loading = false;
          }.bind(this));
        }.bind(this));

      },

      /************************
      <id="_addNewData">
      ************************/
      addNewData: function () {
        window.location = admin_url('pages/add-new-data');
      },

      /************************
      <id="_saveData">
      ************************/
      saveData: function () {

        this.loading = true;

        var url = 'PageController/updateData';
        var data = this.form;

        $api.post(url, data, function (result) {

          this.result = result;
          this.loading = false;

          if (result.state == 'success') {
            $splash.show(result.message, function () {
              this.form = result.data;
            }.bind(this));
          }

        }.bind(this));
      },
    },
  });
</script>
