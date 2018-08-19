<div class="container">
  <div class="row">

    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-body">

          <h3><?= $rowPage['title'] ?></h3>
          <sup>
            <?= $rowPage['postedDate'] ?>
          </sup>
          <br>

          <article>
            <?php if (!empty($rowPage['featuredImage'])): ?>
              <img src="<?= $rowPage['_featuredImage'] ?>"
              align="right"
              style="height: 160px; margin: 8px"
              alt="<?= $rowPage['title'] ?>">
            <?php endif; ?>

            <?= $rowPage['content'] ?>
          </article>

        </div>
      </div>
    </div>

    <div class="col-md-3">

      <?php $this->load->view('widgets/CategoryView', ['dataSource' => $rsCategory]) ?>
      <?php $this->load->view('widgets/TagView', ['dataSource' => $rsTag]) ?>

    </div>

  </div>
</div>
