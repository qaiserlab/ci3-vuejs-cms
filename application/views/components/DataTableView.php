<style>
#DataTableComponent thead th:after {
  content: none;
}
</style>

<template id="DataTableComponent">
  <div class="ui-data-table">
    <div ref="table" style="display: none">
      <slot></slot>
    </div>
    <div ref="display"></div>
  </div>
</template>

<script>

  Vue.component('ui-data-table', {
    template: '#DataTableComponent',

    /************************
    <id="_props">
    ************************/
    props: {
      dataSource: {
        type: Array,
        default: function () { return []; },
      },
    },

    /************************
    <id="_watch">
    ************************/
    watch: {
      dataSource: function () {
        this.reloadDataTable();
      },
    },

    /************************
    <id="_methods">
    ************************/
    methods: {

      /************************
      <id="_reloadDataTable">
      ************************/
      reloadDataTable: function () {

        this.$nextTick(() => {

          var $table = $(this.$refs.table);
          var $display = $(this.$refs.display);

          $display.empty();
          $table.find('table').clone().appendTo($display);

          $display.find('table').dataTable({
            // columnDefs: [{
            //   "targets": 0,
            //   "orderable": false
            // }],
            aaSorting: [],
            lengthMenu: [[5, 10, 25, 50], [5, 10, 25, 50]],
          });

        });
      },

    },
  });

</script>
