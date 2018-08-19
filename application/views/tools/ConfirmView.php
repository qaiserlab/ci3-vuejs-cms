<div id="confirm-template">

  <transition
  enter-active-class="animated fadeIn"
  leave-active-class="animated fadeOut">
  <div v-if="message" class="modal modal-primary in" style="display: block">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button @click="closeAction" type="button" class="close" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">{{ title }}</h4>
          </div>
          <div class="modal-body">
            <p>
              <i class="fa fa-question"></i>
              {{ message }}
            </p>
          </div>
          <div class="modal-footer">
            <button @click="okAction" type="button" class="btn btn-outline pull-left">OK</button>
            <button @click="closeAction" type="button" class="btn btn-outline">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </transition>

</div>

<script>

var $confirm = new Vue({
  el: '#confirm-template',
  data: {
    callback: '',

    title: 'Confirm',
    message: '',
  },

  methods: {
    show: function (message, callback) {
      this.message = message;
      this.callback = callback;
    },

    okAction: function () {

      if ($.isFunction(this.callback)) {
        this.callback();
        this.closeAction();
      }
    },

    closeAction: function () {
      this.message = '';
    },

  },
});
</script>
