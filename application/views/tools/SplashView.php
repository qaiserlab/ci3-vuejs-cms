<style>
#splash-template {
  position: fixed;
  right: 36px;
  top: 36px;
  background: #00A65A;
  color: #fff;
  padding: 8px;
  padding-left: 20px;
  padding-right: 20px;
  display: none;
  z-index: 10000;
}
</style>

<div id="splash-template">
  {{ message }}
</div>

<script>

var $splash = new Vue({
  el: '#splash-template',
  data: {
    message: '',
  },

  methods: {

    show: function (message, callback) {
      this.message = message;

      $(this.$el).slideDown(() => {
        setTimeout(() => {

          $(this.$el).fadeOut('slow', function () {
            if ($.isFunction(callback))
            callback();
          });

        }, 1000);
      });
    },

  },
});

</script>
