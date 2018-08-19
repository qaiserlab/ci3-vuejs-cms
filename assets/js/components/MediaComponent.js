Vue.component('ui-media', {
  
  /************************
  function template()
  ************************/
  template: `
  <section id="MediaComponent" v-cloak>

    <div class="ui-media form-group">

      <label v-if="this.$slots.default">
        <slot></slot>
      </label>

      <figure>
        <a data-lightbox="preview"
        :href="imageUrl"
        :data-title="imageUrl">
          <img v-if="value" :src="imageUrl">
        </a>
        <button type="button" class="btn btn-primary" @click="browse = true">
          <i class="fa fa-photo"></i> <?= lang('MEDIA') ?>
        </button>
        <small>{{ placeholder }}</small>
      </figure>

      <transition
      enter-active-class="animated fadeIn"
      leave-active-class="animated fadeOut">
      <div v-if="browse" class="modal modal-default in" style="display: block">
        <form role="form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button @click="browse = false" type="button" class="close" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title"><?= lang('MEDIA') ?></h4>
                </div>
                <div class="upload-bar">
                  <input type="file"
                  @change="handleInput"
                  :disabled="disabled || loading">

                  <div>
                    <input v-model="form.keyword" type="text">
                    <i class="fa fa-search"></i>
                  </div>
                </div>

                <div class="modal-body">

                  <div class="row">
                    <div class="thumbnail col-md-2"
                    v-for="(image, i) in rs_">
                      <a href="javascript:"
                      @click="selectImage(image)"
                      :data-title="base_url('writable/archives/' + image)">
                        <figure class="modal-figure">
                          <img :src="base_url('writable/archives/' + image)" alt="">
                          <span>{{ image }}</span>
                        </figure>
                      </a>
                      <ui-button icon="close"
                      @click="deleteData(image, i)"
                      type="button"
                      bs-type="danger"></ui-button>
                    </div>
                  </div>

                  <div v-if="rs_.length < rsFiltered.length" class="row">
                    <div class="col-md-12" style="text-align: center;padding-top: 8px">
                      <ui-button @click="readMore" type="button">
                        <?= lang('READ_MORE') ?>...
                      </ui-button>
                    </div>
                  </div>

                </div>

                <div class="modal-footer">
                  <ui-button @click="browse = false"
                  type="button"
                  icon="remove"><?= lang('CLOSE') ?></ui-button>
                </div>

              </div>
            </div>
          </form>
        </div>
      </transition>

    </div>

  </section>
  `,

  /************************
  function props()
  ************************/
  props: {

    value: {
      type: String,
      default: '',
    },

    icon: {
      type: String,
      default: 'image',
    },

    placeholder: {
      type: String,
      default: '',
    },

    disabled: {
      type: Boolean,
      default: false,
    },

    browse: {
      type: Boolean,
      default: false,
    },

  },

  data: function () {
    return {
      baseUrl: base_url('writable/archives'),
      loading: false,
      page: 0,
      rs: [],

      form: {
        keyword: '',
      },
    };
  },

  /************************
  function computed()
  ************************/
  computed: {

    rsFiltered: function () {
      return this.rs.filter(image => {
        return image.match(new RegExp(this.form.keyword, 'gi'));
      });
    },

    rs_: function () {
      var limit = 10;
      var start = this.page * limit;
      limit = start + limit;
      var rs = [];

      for (var i = 0; i < limit; i++) {
        if (this.rsFiltered[i])
          rs.push(this.rsFiltered[i]);
      }

      return rs;
    },

    icon_: function () {
      if (this.icon)
        return 'fa-' + this.icon;
      else
        return '';
    },

    imageUrl: function () {
      return this.baseUrl + '/' + this.value;
    },
  },

  mounted: function () {
    this.refreshDataSource();
  },

  /************************
  function methods()
  ************************/
  methods: {

    refreshDataSource: function () {
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

    readMore: function () {
      this.page++;
    },

    selectImage: function (image) {

      // value = image;
      this.$emit('input', image);
      this.browse = false;
    },

    handleInput: function (event) {
      this.loading = true;

      var file = event.target.files[0];
      var formData = new FormData();

      formData.append('apiKey', API_KEY);
      formData.append('fileActive', file);

      $.ajax({
        method: 'POST',
        cache: false,
        contentType: false,
        processData: false,

        url: base_url('api/SystemController/uploadAndStore'),
        data: formData,

        success: function (result) {
          this.refreshDataSource();
        }.bind(this),
      });

    },

    deleteData: function (image, index) {

      if (confirm('<?= lang('DELETE_SELECTED_DATA') ?>')) {

        var url = 'MediaController/deleteData';
        var data = {
          image: image,
        };

        $api.post(url, data, function (result) {
          this.refreshDataSource();
        }.bind(this));
      }

    },

  },

});
