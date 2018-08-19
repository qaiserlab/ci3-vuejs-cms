<template id="PanelComponent">
  <div class="ui-panel panel" :class="'panel-' + type">
    <div class="panel-heading">
      <h3 class="panel-title">
        <i v-if="icon" :class="'fa fa-' + icon"></i>
        {{ title }}
      </h3>
    </div>
    <div class="panel-body">
      <slot></slot>
    </div>
  </div>
</template>

<script>
  Vue.component('ui-panel', {
    template: '#PanelComponent',

    /************************
    <id="_props">
    ************************/
    props: {

      type: {
        type: String,
        default: 'default',
      },

      icon: {
        type: String,
        default: '',
      },

      title: {
        type: String,
        default: 'Panel',
      },

    },

  });
</script>
