<div class="row">
  <?php if (count($dataSource) > 0): foreach ($dataSource as $row): ?>

    <div class="col-md-3">
      <figure class="product-box">
        <a href="<?= $row['permalink'] ?>">

          <?php if ($row['featuredImage']): ?>
            <img src="<?= $row['_featuredImage'] ?>"
            style="height: 110px; margin: 8px"
            alt="<?= $row['title'] ?>">
          <?php endif; ?>

          <h4><?= $row['title'] ?></h4>
        </a>

        <b>
          <?= $row['_price'] ?>
        </b>

        <span>
          <a href="<?= $row['categoryPermalink'] ?>"><?= $row['category'] ?></a>
        </span>
      </figure>
    </div>

  <?php endforeach; else: ?>
    <h4><?= lang('DATA_NOT_FOUND') ?></h4>
  <?php endif; ?>
</div>

<?= $this->pagination->create_links() ?>
