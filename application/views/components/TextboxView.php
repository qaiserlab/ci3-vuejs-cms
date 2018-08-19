<template id="TextboxComponent">
  <div class="ui-textbox">

    <label v-if="this.$slots.default">
      <slot></slot>
    </label>

    <input :type="type"
    :value="value"
    @input="handleInput"
    @keyup="handleKeyup"
    @keydown.enter="handleEnter"
    :placeholder="placeholder"
    class="form-control"
    :style="icon?'padding-right: 32px':''"
    :disabled="disabled">

    <span class="icon">
      <i v-if="!loading" class="fa" :class="icon_"></i>
      <i v-if="loading" class="fa fa-spin fa-refresh"></i>
    </span>
  </div>
</template>

<script>
  Vue.component('ui-textbox', {
    template: '#TextboxComponent',

    /************************
    <id="_props">
    ************************/
    props: {
      type: {
        type: String,
        default: 'text',
      },

      value: {
        type: String,
        default: '',
      },

      placeholder: {
        type: String,
        default: '',
      },

      icon: {
        type: String,
        default: '',
      },

      disabled: {
        type: Boolean,
        default: false,
      },

      loading: {
        type: Boolean,
        default: false,
      },

    },

    /************************
    <id="_computed">
    ************************/
    computed: {

      /************************
      <id="_icon_">
      ************************/
      icon_() {
        if (this.icon)
          return 'fa-' + this.icon;
        else
          return '';
      },

    },

    /************************
    <id="_methods">
    ************************/
    methods: {

      /************************
      <id="_handleInput">
      ************************/
      handleInput: function (event) {
        this.$emit('input', event.target.value);
      },

      /************************
      <id="_handleEnter">
      ************************/
      handleEnter: function (event) {
        this.$emit('enter');
      },

      /************************
      <id="_handleKeyup">
      ************************/
      handleKeyup: function (event) {
        this.$emit('keyup');
      },
      
    },

  });
</script>
