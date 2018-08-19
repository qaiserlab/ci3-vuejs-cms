<?php if ($page == 'HomeView'): ?>
  <header id="header-home" class="container-fluid header-home">
    <div class="overlay"></div>
    <div class="container">

      <a href="<?= base_url() ?>" class="logo">
        <h1>QaiserLab</h1>
        <h2>Web Experiment</h2>
      </a>
<?php else: ?>
  <header id="header" class="container-fluid">
    <div class="container">
<?php endif; ?>

    <nav class="navbar navbar-default" role="navigation">

      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
          <span class="sr-only">Menu</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <div id="main-menu" class="collapse navbar-collapse">

        <?php bs_nav($rsMenu, 1) ?>

        <form id="search-form" @submit.prevent="searchData" class="navbar-form navbar-right" role="search">
          <div>
            <div class="form-group">
              <ui-textbox v-model="keyword"
              placeholder="Search..."></ui-textbox>
              <i class="fa fa-search input-icon"></i>
            </div>
          </div>
        </form>
        <script>
          var searchForm = new Vue({
            el: '#search-form',
            data: {
              keyword: '',
            },

            methods: {

              searchData() {
                if (!this.keyword) return;
                window.location = base_url('search?keyword=' + this.keyword);
              },
            },

          });
        </script>

        <!-- <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
        <li><a href="#">Sub Menu</a></li>
        </ul>
        </li>
        </ul> -->

      </div><!-- /.navbar-collapse -->

    </nav>
  </div>

</header>
