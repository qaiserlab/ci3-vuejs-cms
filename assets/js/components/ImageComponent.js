Vue.component('ui-image', {

  /************************
  function template()
  ************************/
  template: `
  <section id="ImageComponent" v-cloak>
    <div class="ui-image">
      <label v-if="this.$slots.default">
        <slot></slot>
      </label>

      <img v-if="value" :src="imageUrl">
      <input type="file"
      @change="handleInput"
      class="form-control"
      :disabled="disabled || loading">
      <small class="pull-right" style="color: darkblue">
        {{ placeholder }}
      </small>

      <span class="icon">
        <i v-if="!loading" class="fa" :class="icon_"></i>
        <i v-if="loading" class="fa fa-spin fa-refresh"></i>
      </span>
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

  },

  data: function () {
    return {
      loading: false,
      baseUrl: base_url('writable/archives'),
    };
  },

  /************************
  function computed()
  ************************/
  computed: {

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

  // mounted: function () {
  //   if (this.value)
  //     this.url = base_url('writable/archives/' + this.value);
  // },

  /************************
  function methods()
  ************************/
  methods: {

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

        url: base_url('api/SystemController/upload'),
        data: formData,

        success: function (result) {
          this.loading = false;

          this.baseUrl = base_url('writable/tmp');
          this.$emit('input', result.data.file);

        }.bind(this),
      });

    },

  },

});
