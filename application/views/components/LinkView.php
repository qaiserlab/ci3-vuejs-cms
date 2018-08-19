<template id="LinkComponent">
  <a class="ui-link" :href="href" @click="handleClick">
    <i v-if="icon" :class="'fa fa-' + icon"></i>
    <slot></slot>
  </a>
</template>

<script>
  Vue.component('ui-link', {
    template: '#LinkComponent',

    /************************
    <id="_props">
    ************************/
    props: {

      href: {
        type: String,
        default: 'javascript:',
      },

      icon: {
        type: String,
        default: '',
      },

    },

    /************************
    <id="_methods">
    ************************/
    methods: {

      /************************
      <id="_handleClick">
      ************************/
      handleClick: function (event) {
        this.$emit('click');
      },
    },

  });
</script>
