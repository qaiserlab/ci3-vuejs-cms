<template id="TextareaComponent">
  <div class="ui-textarea">

    <label v-if="this.$slots.default">
      <slot></slot>
    </label>

    <textarea :value="value"
    class="form-control"
    @input="handleInput"
    @keyup="handleKeyup"
    :placeholder="placeholder"
    :rows="size"
    :disabled="disabled || loading"></textarea>

  </div>
</template>

<script>
  Vue.component('ui-textarea', {
    template: '#TextareaComponent',

    /************************
    <id="_props">
    ************************/
    props: {

      value: {
        type: String,
        default: '',
      },

      placeholder: {
        type: String,
        default: '',
      },

      size: {
        type: String,
        default: '8',
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
      <id="_handleKeyup">
      ************************/
      handleKeyup: function (event) {
        this.$emit('keyup');
      },
    },

  });
</script>
