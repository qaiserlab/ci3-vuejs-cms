<template id="ColComponent">
  <div class="ui-col" :class="size_ + hidden_">
    <slot></slot>
  </div>
</template>

<script>
  Vue.component('ui-col', {
    template: '#ColComponent',

    /************************
    <id="_props">
    ************************/
    props: {

      size: {
        type: String,
        default: '',
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
      <id="_size_">
      ************************/
      size_: function () {
        if (!this.size) return '';

        var xSize = this.size.split(' ');
        var size_ = '';

        xSize.forEach(function (size) {
          size_ += 'col-' + size + ' ';
        });

        return size_;
      },

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
