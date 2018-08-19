<?php if (count($dataSource) > 0): foreach ($dataSource as $row): ?>

  <article>
    <h4>
      <a href="<?= $row['permalink'] ?>"><?= $row['title'] ?></a>
    </h4>
    <sup>
      <?= $row['postedDate'] ?> |
      <a href="<?= $row['categoryPermalink'] ?>"><?= $row['category'] ?></a>
    </sup>
    <br>

    <p>
      <?php if ($row['featuredImage']): ?>
        <img src="<?= $row['_featuredImage'] ?>"
        align="left"
        style="height: 110px; margin: 8px"
        alt="<?= $row['title'] ?>">
      <?php endif; ?>

      <?= $row['excerpt'] ?>
      <a href="<?= $row['permalink'] ?>">[...]</a>
    </p>

  </article>
  <hr>

<?php endforeach; else: ?>
  <h4><?= lang('DATA_NOT_FOUND') ?></h4>
<?php endif; ?>
<?= $this->pagination->create_links() ?>
