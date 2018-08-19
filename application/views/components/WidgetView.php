<template id="WidgetComponent">
  <div class="ui-widget box" :class="'box-' + type">

    <div class="box-header with-border">
      <h3 class="box-title">
        <i v-if="icon" :class="'fa fa-' + icon"></i>
        {{ title }}
      </h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
          <i class="fa fa-minus"></i>
        </button>
      </div>
    </div>

    <div class="box-body">
      <slot></slot>
    </div>

    <div v-if="loading" class="overlay">
      <i class="fa fa-refresh fa-spin"></i>
    </div>

  </div>
</template>

<script>
  Vue.component('ui-widget', {
    template: '#WidgetComponent',

    /************************
    <id="_props">
    ************************/
    props: {

      type: {
        type: String,
        default: 'primary',
      },

      icon: {
        type: String,
        default: '',
      },

      title: {
        type: String,
        default: 'Widget',
      },

      loading: {
        type: Boolean,
        default: false,
      },

    },

  });
</script>
