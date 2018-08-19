<div id="PageActive" class="content-wrapper">

  <!-- Headbar -->
  <ui-header title="Admin" caption="Dashboard"></ui-header>
  <!-- End Headbar -->

  <!-- Content -->
  <div class="content">

    <div id="counter" class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{ counter.block1 }}</h3>

            <p><?= lang('USER_REGISTRATIONS') ?></p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{ counter.block2 }}</h3>

            <p><?= lang('TOTAL_POSTS') ?></p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="<?= base_url('admin/posts/all-data') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{ counter.block3 }}</h3>

            <p><?= lang('UNIQUE_VISITORS') ?></p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{ counter.block4 }}</h3>

            <p><?= lang('PAGE_HITS') ?></p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>

  </div>
  <!-- End Content -->

</div>

<script>

  var vm = new Vue({
    el: '#PageActive',

    /************************
    <id="_data">
    ************************/
    data: {
      loading: false,

      result: API_RESULT,

      form: {
        apiKey: API_KEY,
        authKey: AUTH_KEY,
      },

      counter: {
        block1: 0,
        block2: 0,
        block3: 0,
        block4: 0,
      },

    },

    /************************
    <id="_created">
    ************************/
    created: function () {
      this.refreshData();
    },

    /************************
    <id="_methods">
    ************************/
    methods: {

      /************************
      <id="_refreshData">
      ************************/
      refreshData: function () {
        var url = 'CounterController/readOneData';

        $api.post(url, result => {
          this.counter.block1 = result.data.userRegistrations;
          this.counter.block2 = result.data.totalPosts;
          this.counter.block3 = result.data.uniqueVisitors;
          this.counter.block4 = result.data.pageHits;
        });
      },

    },
  });

</script>
