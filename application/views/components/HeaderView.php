<template id="HeaderComponent">
  <div class="ui-header content-header">
    <h1>
      {{ title }}
      <small>{{ caption }}</small>
    </h1>
    <slot></slot>
  </div>
</template>

<script>
  Vue.component('ui-header', {
    template: '#HeaderComponent',

    /************************
    <id="_props">
    ************************/
    props: {

      title: {
        type: String,
        default: 'Title',
      },

      caption: {
        type: String,
        default: 'Caption',
      },

    },

  });
</script>
