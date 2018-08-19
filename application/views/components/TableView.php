<template id="TableComponent">
  <div class="ui-table">
    <table class="table" :class="type_ + ' ' + (hover?'table-hover':'')">
      <thead>
        <slot></slot>
      </thead>
      <tbody>
        <tr v-for="row in dataSource">
          <td v-for="(field, key) in row" v-if="key != dataValue" v-html="field"></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  Vue.component('ui-table', {
    template: '#TableComponent',

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

      value: {
        type: String,
        default: '',
      },

      type: {
        type: String,
        default: '',
      },

      hover: {
        type: Boolean,
        default: false,
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
      <id="_type_">
      ************************/
      type_: function () {
        if (this.type)
          return 'table-' + this.type;
        else
          return '';
      },
      
    },

  });
</script>
