<div class="container">
  <div class="row">
    <div class="col-md-9">

      <div class="row">
        <div class="col-sm-4">
          <div class="panel panel-default">
            <article class="panel-body">
              <h4><?= $rowHome['csf']->title1 ?></h4>
              <p>
                <?= $rowHome['csf']->block1 ?>
              </p>
            </article>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="panel panel-default">
            <article class="panel-body">
              <h4><?= $rowHome['csf']->title2 ?></h4>
              <p>
                <?= $rowHome['csf']->block2 ?>
              </p>
            </article>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="panel panel-default">
            <article class="panel-body">
              <h4><?= $rowHome['csf']->title3 ?></h4>
              <p>
                <?= $rowHome['csf']->block3 ?>
              </p>
            </article>
          </div>
        </div>
      </div>

      <section id="FaceReview">

        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">Laboratorium</h3>
          </div>
          <div class="panel-body">

            <article>
              <h4>
                <a href="<?= $rowLatestPost['permalink'] ?>"><?= $rowLatestPost['title'] ?></a>
              </h4>
              <sup>
                <?= $rowLatestPost['postedDate'] ?> |
                <a href="<?= $rowLatestPost['categoryPermalink'] ?>"><?= $rowLatestPost['category'] ?></a>
              </sup>
              <br>

              <p>
                <?php if ($rowLatestPost['featuredImage']): ?>
                  <img src="<?= $rowLatestPost['_featuredImage'] ?>"
                  align="left"
                  style="height: 110px; margin: 8px"
                  alt="<?= $rowLatestPost['title'] ?>">
                <?php endif; ?>

                <?= $rowLatestPost['excerpt'] ?>
                <a href="<?= $rowLatestPost['permalink'] ?>">[...]</a>
              </p>

            </article>

          </div>
        </div>

        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">Jual DVD Linux</h3>
          </div>
          <div class="panel-body">

            <?php $this->load->view('widgets/ProductRollView', ['dataSource' => $rsNewProduct]) ?>

          </div>
        </div>

      </section>
      <script>

        var FaceReview = new Vue({
          el: '#FaceReview',

        });
      </script>

    </div>
    <div class="col-md-3">

      <iframe src='https://www.sribulancer.com/id/widgets/profile?digest=7d49172c1372184fcbcde4d0d23cd65f&id=57f075d8637275701f000000'
      frameborder='0'
      scrolling='no'
      height='310'
      style='overflow: hidden;'></iframe>
      <?php $this->load->view('widgets/CategoryView', ['dataSource' => $rsCategory]) ?>
      <?php $this->load->view('widgets/TagView', ['dataSource' => $rsTag]) ?>

    </div>
  </div>
</div>
