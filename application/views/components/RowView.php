<template id="RowComponent">
  <div class="ui-row row" :class="hidden_ + (formGroup?'form-group':'')">
    <slot></slot>
  </div>
</template>

<script>
  Vue.component('ui-row', {
    template: '#RowComponent',

    /************************
    <id="_props">
    ************************/
    props: {

      formGroup: {
        type: Boolean,
        default: false,
      },

      hidden: {
        type: String,
        default: '',
      },

    },

    /************************
    <id="_computed">
    ************************/
    computed: {

      /************************
      <id="_hidden_">
      ************************/
      hidden_: function () {
        if (!this.hidden) return '';

        var xHidden = this.hidden.split(' ');
        var hidden_ = '';

        xHidden.forEach(function (hidden) {
          hidden_ += 'hidden-' + hidden + ' ';
        });

        return hidden_;
      },

    },

  });
</script>
