<template id="RadioComponent">
  <div class="ui-radio">

    <label v-if="this.$slots.default">
      <slot></slot>
    </label>

    <label class="radio-inline" v-for="row in dataSource">
      <input :name="name_"
      type="radio"
      @input="handleInput"
      :value="row[dataValue]"
      :checked="row[dataValue] == value"
      :disabled="disabled || loading">
      {{ row[dataField] }}
    </label>
  </div>
</template>

<script>
  Vue.component('ui-radio', {
    template: '#RadioComponent',

    /************************
    <id="_props">
    ************************/
    props: {

      dataSource: {
        type: Array,
        default: () => [],
      },

      dataValue: {
        type: String,
        default: 'id',
      },

      dataField: {
        type: String,
        default: 'id',
      },

      value: {
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
    <id="_data">
    ************************/
    data: function () {
      return {
        name_: 'radio-' + Math.random(),
      };
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
    },

  });
</script>
