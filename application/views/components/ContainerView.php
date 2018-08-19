<template id="ContainerComponent">
  <div class="ui-container" :class="hidden_ + (fluid?'container-fluid':'container')">
    <slot></slot>
  </div>
</template>

<script>
  Vue.component('ui-container', {
    template: '#ContainerComponent',

    /************************
    <id="_props">
    ************************/
    props: {

      fluid: {
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
