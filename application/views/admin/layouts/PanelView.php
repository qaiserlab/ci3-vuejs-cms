<ul class="control-sidebar-menu">

  <?php
  $menu = $this->config->item('menu');

  foreach($menu['panel'] as $menuId => $adminMenu):
    if (isset($adminMenu['permalink']))
      $permalink = base_url('admin/'.$adminMenu['permalink']);
    else
      $permalink = 'javascript:';
  ?>
    <li>
      <a href="<?= $permalink ?>">
        <?php if (isset($adminMenu['icon'])): ?>
          <i class="menu-icon fa fa-<?= $adminMenu['icon'] ?> bg-blue"></i>
        <?php endif; ?>

        <div class="menu-info">
          <h4 class="control-sidebar-subheading"><?= lang($adminMenu['title']) ?></h4>

          <?php if (isset($adminMenu['caption'])): ?>
            <p><?= lang($adminMenu['caption']) ?></p>
          <?php endif; ?>

        </div>
      </a>
    </li>
  <?php endforeach; ?>
  
</ul>
