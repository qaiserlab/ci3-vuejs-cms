<template id="ImageComponent">
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
</template>

<script>
  Vue.component('ui-image', {
    template: '#ImageComponent',

    /************************
    <id="_props">
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

    /************************
    <id="_data">
    ************************/
    data: function () {
      return {
        loading: false,
        baseUrl: base_url('writable/archives'),
      };
    },

    /************************
    <id="_computed">
    ************************/
    computed: {

      /************************
      <id="_icon_">
      ************************/
      icon_: function () {
        if (this.icon)
          return 'fa-' + this.icon;
        else
          return '';
      },

      /************************
      <id="_imageUrl">
      ************************/
      imageUrl: function () {
        return this.baseUrl + '/' + this.value;
      },
    },

    /************************
    <id="_mounted">
    ************************/
    // mounted: function () {
    //   if (this.value)
    //     this.url = base_url('writable/archives/' + this.value);
    // },

    /************************
    <id="_methods">
    ************************/
    methods: {

      /************************
      <id="_handleInput">
      ************************/
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
</script>
