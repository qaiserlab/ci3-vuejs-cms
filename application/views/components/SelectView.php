<template id="SelectComponent">
  <div class="ui-select">

    <label v-if="this.$slots.default">
      <slot></slot>
    </label>

    <select value=""
    :value="value"
    @input="handleInput"
    class="form-control"
    :disabled="disabled || loading">
      <option v-if="placeholder" value="" disabled>{{ placeholder }}</option>
      <option v-for="row in dataSource"
      :value="row[dataValue]"
      :selected="row[dataValue] == value">{{ row[dataField] }}</option>
    </select>
  </div>
</template>

<script>
  Vue.component('ui-select', {
    template: '#SelectComponent',

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

      placeholder: {
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
