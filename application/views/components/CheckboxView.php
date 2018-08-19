<template id="CheckboxComponent">
  <div class="ui-checkbox">

    <label v-if="this.$slots.default">
      <slot></slot>
    </label>

    <label class="checkbox-inline" v-for="row in dataSource">
      <input :name="name_"
      type="checkbox"
      @input="handleInput"
      :value="row[dataValue]"
      :checked="isChecked(row[dataValue])"
      :disabled="disabled || loading">
      {{ row[dataField] }}
    </label>
  </div>
</template>

<script>
  Vue.component('ui-checkbox', {
    template: '#CheckboxComponent',

    /************************
    <id="_props">
    ************************/
    props: {

      dataSource: {
        type: Array,
        default: function () { return []; },
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
        type: Array,
        default: function () { return []; },
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
        name_: 'checkbox-' + Math.random(),
      };
    },

    /************************
    <id="_methods">
    ************************/
    methods: {

      /************************
      <id="_isChecked">
      ************************/
      isChecked: function (value) {
        var checked = false;

        this.value.forEach(function (value_) {
          if (value == value_)
            checked = true;
        });

        return checked;
      },

      /************************
      <id="_handleInput">
      ************************/
      handleInput: function (event) {

        if (!this.isChecked(event.target.value)) {
          var value = this.value;
          value.push(event.target.value);
        }
        else {
          var value_ = this.value;
          var value = [];

          value_.forEach(function (value__) {
            if (value__ != event.target.value)
              value.push(value__);
          });
        }

        this.$emit('input', value);
      },
    },

  });
</script>
