<script>
  // Server Variables

  var BASE_URL = '<?= base_url() ?>';
  var API_URL = '<?= base_url('api') ?>';
  var ADMIN_URL = '<?= base_url('admin') ?>';

  // Language

  var LANG = '<?= $_SESSION['lang'] ?>';

  // Authorize

  var API_KEY = '<?= $this->config->item('api_key') ?>';

  <?php if (isset($_SESSION['authKey'])): ?>
  var AUTH_KEY = '<?= $_SESSION['authKey'] ?>';
  <?php else: ?>
  var AUTH_KEY = '';
  <?php endif; ?>

  var API_RESULT = {
    state: '',
    success: false,
    failed: false,
    invalid: false,
    denied: false,

    message: '',
    data: '',
    extra: '',
  };

  function base_url(url) {
    if (!url)
    url = '';

    return BASE_URL + url;
  }

  function api_url(url) {
    if (!url)
    url = '';

    return API_URL + '/' + url;
  }

  function admin_url(url) {
    if (!url)
    url = '';

    return ADMIN_URL + '/' + url;
  }

  var $api = new Vue({

    methods: {

      result: function () {
        return API_RESULT;
      },

      post: function (url, data, callback) {

        url = api_url(url);

        if ($.isFunction(data)) {
          callback = data;
          data = {};
        }

        data.lang = LANG;

        data.apiKey = API_KEY;
        data.authKey = AUTH_KEY;

        $.ajax({
          method: 'POST',
          cache: false,
          url: url,
          data: data,
          success: callback,
        });

      },

      get: function (url, data, callback) {

        url = api_url(url);

        if ($.isFunction(data)) {
          callback = data;
          data = {};
        }

        data.apiKey = API_KEY;
        data.authKey = AUTH_KEY;

        $.ajax({
          method: 'GET',
          cache: false,
          url: url,
          data: data,
          success: callback,
        });

      },
    },
  });

</script>
