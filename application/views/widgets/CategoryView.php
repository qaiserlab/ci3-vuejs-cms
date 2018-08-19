<div class="panel">
  <div class="panel-heading">
    <h3 class="panel-title"><?= lang('CATEGORY') ?></h3>
  </div>
  <div class="panel-body">
    <nav class="navmenu navmenu-default" role="navigation">

      <ul class="nav navmenu-nav">
        <?php foreach ($dataSource as $row): ?>
          <li><a href="<?= $row['permalink'] ?>"><?= $row['category'] ?></a></li>
        <?php endforeach; ?>
      </ul>

    </nav>
  </div>
</div>
