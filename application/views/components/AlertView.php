<template id="AlertComponent">
  <div class="ui-alert">
    <transition enter-active-class="animated shake"
    leave-active-class="animated fadeOut">
      <div v-if="dataSource.state == 'invalid'" class="ui-alert alert" :class="'alert-' + type">
        <button type="button" @click="handleClose" class="close">
          <i class="fa fa-close"></i>
        </button>
        <h4>
          <i v-if="icon" :class="'fa fa-' + icon"></i>
          {{ dataSource.message }}
        </h4>
        <p v-if="dataSource">
          <ul>
            <li v-for="row in dataSource.data">{{ row }}</li>
          </ul>
        </p>
      </div>
    </transition>
  </div>
</template>

<script>
  Vue.component('ui-alert', {
    template: '#AlertComponent',

    /************************
    <id="_props">
    ************************/
    props: {

      type: {
        type: String,
        default: 'danger',
      },

      icon: {
        type: String,
        default: '',
      },

      dataSource: {
        type: Array,
        default: () => [],
      },

      dataField: {
        type: String,
        default: 'id',
      },

    },

    /************************
    <id="_methods">
    ************************/
    methods: {

      /************************
      <id="_handleClose">
      ************************/
      handleClose: function (event) {
        this.dataSource.state = 'success';
        this.$emit('close');
      },
    },

  });
</script>
