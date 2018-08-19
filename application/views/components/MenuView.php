<template id="MenuComponent">

  <div class="ui-menu form-group">

    <label v-if="this.$slots.default">
      <slot></slot>
    </label>

    <select @dblclick="showEditForm" ref="select" class="form-control" size="16">

      <option v-for="row in tree">
        {{ row.title }}
      </option>

    </select>

    <br>
    <button type="button" class="btn btn-primary" @click="moveUpData"><i class="fa fa-arrow-up"></i></button>
    <button type="button" class="btn btn-primary" @click="moveDownData"><i class="fa fa-arrow-down"></i></button>

    <div style="float: right">
      <button type="button" class="btn btn-primary" @click="showAddForm"><i class="fa fa-plus"></i></button>
      <button type="button" class="btn btn-primary" @click="showEditForm"><i class="fa fa-edit"></i></button>
      <button type="button" class="btn btn-danger" @click="deleteData"><i class="fa fa-remove"></i></button>
    </div>

    <transition
    enter-active-class="animated fadeIn"
    leave-active-class="animated fadeOut">
    <div v-if="showForm" class="modal modal-default in" style="display: block">
      <form role="form">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button @click="closeForm" type="button" class="close" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><?= lang('ADD_NEW') ?></h4>
              </div>
              <div class="modal-body">
                <ui-select v-model="form.pKey" :data-source="parent" :disabled="editForm" field="title"><?= lang('PARENT') ?></ui-select>
                <ui-textbox v-model="form.cKey" :disabled="editForm"><?= lang('KEY') ?></ui-textbox>
                <ui-textbox v-model="form.title"><?= lang('TITLE') ?></ui-textbox>
                <ui-textbox v-model="form.icon"><?= lang('ICON') ?></ui-textbox>
                <ui-textbox v-model="form.url"><?= lang('URL') ?></ui-textbox>
              </div>
              <div class="modal-footer">
                <span style="float: left">
                  <ui-button @click="addData" v-if="addForm" type="button" icon="plus"><?= lang('ADD') ?></ui-button>
                  <ui-button @click="editData" v-if="editForm" type="button" icon="edit"><?= lang('CHANGE') ?></ui-button>
                </span>

                <ui-button @click="closeForm" type="button" icon="remove"><?= lang('CLOSE') ?></ui-button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </transition>

  </div>

</template>

<script>

  Vue.component('ui-menu', {
    template: '#MenuComponent',

    /************************
    <id="_props">
    ************************/
    props: {

      value: {
        type: Object,
        default: {},
      },

    },

    /************************
    <id="_data">
    ************************/
    data: function () {
      return {

        form: {
          pKey: '',
          cKey: '',
          title: '',
          icon: '',
          url: '',
        },

        showForm: false,
        addForm: false,
        editForm: false,
      };
    },

    /************************
    <id="_computed">
    ************************/
    computed: {

      /************************
      <id="_parent">
      ************************/
      parent: function () {
        var parent = [];

        parent.push({
          id: 'ROOT',
          title: '<?= lang('ROOT') ?>*',
        });

        $.each(this.value, function (i, row) {
          parent.push({
            id: i,
            title: row.title,
          });
        });

        return parent;
      },

      /************************
      <id="_tree">
      ************************/
      tree: function () {
        var tree = [];

        $.each(this.value, function (i, row) {
          tree.push({
            title: row.title,
          });

          if (row.child) {
            $.each (row.child,  function (i, _row) {
              tree.push({
                title: '...... ' + _row.title,
              });
            });
          }
        });

        return tree;
      },

    },

    /************************
    <id="_methods">
    ************************/
    methods: {

      /************************
      <id="_getMenuKey">
      ************************/
      getMenuKey: function (selectedIndex) {

        var kIndex = 0;
        var index = -1;

        var parentKey = '';
        var childKey = '';

        $.each(this.value, function (i, row) {
          index++;

          if (index == selectedIndex) {
            kIndex = index;
            parentKey = i;
          }

          if (row.child) {
            $.each(row.child, function (_i, _row) {
              index++;

              if (index == selectedIndex) {
                kIndex = index;
                parentKey = i;
                childKey = _i;
              }
            });
          }

        });

        return {
          index: kIndex,
          pKey: parentKey,
          cKey: childKey,
        };
      },

      /************************
      <id="_getSelectedMenuKey">
      ************************/
      getSelectedMenuKey: function () {
        var selectedIndex = $(this.$refs.select).prop('selectedIndex');
        return this.getMenuKey(selectedIndex);
      },

      /************************
      <id="_moveDownData">
      ************************/
      moveDownData: function () {
        var selectedMenuKey = this.getSelectedMenuKey();

        var lastValue = this.$refs.select.value;
        var value = {};

        var insertMode = false;

        if (!selectedMenuKey.cKey) {
          $.each(this.value, function (i, row) {

            if (insertMode) {
              value[i] = row;
              value[selectedMenuKey.pKey] =
              this.value[selectedMenuKey.pKey];
              insertMode = false;
            }
            else {

              if (i != selectedMenuKey.pKey)
              value[i] = row;
              else
              insertMode = true;
            }

          }.bind(this));

          if (insertMode)
          value[selectedMenuKey.pKey] =
          this.value[selectedMenuKey.pKey];
        }
        else {
          $.each(this.value, function (pKey, pRow) {

            value[pKey] = pRow;

            if  (pKey == selectedMenuKey.pKey && pRow.child) {

              var child = pRow.child;
              pRow.child = {};

              $.each(child, function (cKey, cRow) {

                if (insertMode) {
                  value[pKey].child[cKey] = cRow;
                  value[pKey].child[lastRowKey] = lastRow;
                  insertMode = false;
                }
                else {

                  if (cKey != selectedMenuKey.cKey)
                  value[pKey].child[cKey] = cRow;
                  else
                  insertMode = true;

                }

                lastRow = cRow;
                lastRowKey = cKey;
              });
            }


          }.bind(this));

          if (insertMode)
          value[selectedMenuKey.pKey].child[selectedMenuKey.cKey] = lastRow;

        }

        this.$emit('input', value);
        this.$nextTick(function () {
          this.$refs.select.value = lastValue;
        }.bind(this));
      },

      /************************
      <id="_moveUpData">
      ************************/
      moveUpData: function () {
        var selectedMenuKey = this.getSelectedMenuKey();

        var value = {};
        var lastValue = this.$refs.select.value;

        var lastRow = {};
        var lastRowKey = '';

        if (!selectedMenuKey.cKey) {

          $.each(this.value, function (i, row) {

            if (i != selectedMenuKey.pKey)
            value[i] = row;
            else {
              delete value[lastRowKey];
              value[i] = row;

              if (lastRowKey)
              value[lastRowKey] = lastRow;
            }

            lastRow = row;
            lastRowKey = i;

          }.bind(this));
        }
        else {

          $.each(this.value, function (pKey, pRow) {

            value[pKey] = pRow;

            if  (pKey == selectedMenuKey.pKey && pRow.child) {

              var child = pRow.child;
              pRow.child = {};

              $.each(child, function (cKey, cRow) {
                if (cKey != selectedMenuKey.cKey)
                value[pKey].child[cKey] = cRow;
                else {
                  delete value[pKey].child[lastRowKey];
                  value[pKey].child[cKey] = cRow;

                  if (lastRowKey)
                  value[pKey].child[lastRowKey] = lastRow;
                }

                lastRow = cRow;
                lastRowKey = cKey;
              });
            }

          }.bind(this));

        }

        this.$emit('input', value);
        this.$nextTick(function () {
          this.$refs.select.value = lastValue;
        }.bind(this));
      },

      /************************
      <id="_clearForm">
      ************************/
      clearForm: function () {
        this.form.pKey = 'ROOT';
        this.form.cKey = '';
        this.form.title = '';
        this.form.icon = '';
        this.form.url = '';
      },

      /************************
      <id="_closeForm">
      ************************/
      closeForm: function () {
        this.showForm = false;
        this.addForm = false;
        this.editForm = false;
      },

      /************************
      <id="_showAddForm">
      ************************/
      showAddForm: function () {
        this.clearForm();
        this.showForm = true;
        this.addForm = true;
      },

      /************************
      <id="_showEditForm">
      ************************/
      showEditForm: function () {
        this.clearForm();

        var selectedMenuKey = this.getSelectedMenuKey();

        if (!selectedMenuKey.cKey) {
          var pKey = 'ROOT';
          var cKey = selectedMenuKey.pKey;
          var selectedItem = this.value[selectedMenuKey.pKey];
        }
        else {
          var pKey = selectedMenuKey.pKey;
          var cKey = selectedMenuKey.cKey;
          var selectedItem = this.value[selectedMenuKey.pKey].child[selectedMenuKey.cKey];
        }

        this.form.pKey = pKey;
        this.form.cKey = cKey;
        this.form.title = selectedItem.title;
        this.form.icon = selectedItem.icon;
        this.form.url = selectedItem.permalink;

        this.showForm = true;
        this.editForm = true;
      },

      /************************
      <id="_addData">
      ************************/
      addData: function () {

        var value = {};

        $.each(this.value, function (i, row) {
          value[i] = row;
        });

        if (this.form.pKey == 'ROOT')
        value[this.form.cKey] = {
          title: this.form.title,
          icon: this.form.icon,
          permalink: this.form.url,
        };
        else {

          if (!value[this.form.pKey].child)
          value[this.form.pKey].child = {};

          value[this.form.pKey].child[this.form.cKey] = {
            title: this.form.title,
            icon: this.form.icon,
            permalink: this.form.url,
          };
        }

        this.clearForm();
        this.$emit('input', value);
      },

      /************************
      <id="_editData">
      ************************/
      editData: function () {
        var selectedMenuKey = this.getSelectedMenuKey();
        if (!selectedMenuKey.cKey) {
          this.value[selectedMenuKey.pKey].title = this.form.title;
          this.value[selectedMenuKey.pKey].icon = this.form.icon;
          this.value[selectedMenuKey.pKey].permalink = this.form.url;
        }
        else {
          this.value[selectedMenuKey.pKey].child[selectedMenuKey.cKey].title = this.form.title;
          this.value[selectedMenuKey.pKey].child[selectedMenuKey.cKey].icon = this.form.icon;
          this.value[selectedMenuKey.pKey].child[selectedMenuKey.cKey].permalink = this.form.url;
        }

        this.closeForm();
      },

      /************************
      <id="_deleteData">
      ************************/
      deleteData: function () {

        var value = {};

        var selectedIndex = $(this.$refs.select).prop('selectedIndex');
        var index = -1;

        $.each(this.value, function (i, row) {
          index++;

          if (index != selectedIndex)
          value[i] = row;

          if (row.child) {
            $.each(row.child, function (_i, _row) {
              index++;

              if (index == selectedIndex)
              delete value[i].child[_i];
            });
          }

        });

        this.$emit('input', value);
      },
    },

  });

</script>
