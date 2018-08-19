<ul class="sidebar-menu">
  <li class="header">Menu</li>

  <?php
  $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $menu = $this->config->item('menu');

  foreach($menu['sidebar'] as $menuId => $adminMenu):

    if (isset($adminMenu['permalink']) && !isset($adminMenu['child'])) {
      $permalink = base_url('admin/'.$adminMenu['permalink']);

      if ($permalink == $currentUrl)
        $cssClass = 'active';
      else
        $cssClass = '';

    }
    else {
      $permalink = 'javascript:';
      $cssClass = 'treeview';

      foreach($adminMenu['child'] as $childMenu) {
        if (isset($childMenu['permalink'])) {
          $permalink = base_url('admin/'.$childMenu['permalink']);

          if ($permalink == $currentUrl)
            $cssClass.=' active';
        }
      }
    }
    ?>
      <li id="<?= $menuId ?>Menu" class="<?= $cssClass ?>">
        <a href="<?= $permalink ?>">
          <?php if (isset($adminMenu['icon'])): ?>
            <i class="fa fa-<?= $adminMenu['icon'] ?>"></i>
          <?php endif; ?>

          <span><?= lang($adminMenu['title']) ?></span>

          <?php if (isset($adminMenu['child'])): ?>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          <?php endif; ?>
        </a>

        <?php if (isset($adminMenu['child'])): ?>
          <ul class="treeview-menu">

            <?php
            foreach($adminMenu['child'] as $menuId => $childMenu):
            if (isset($childMenu['permalink']))
              $permalink = base_url('admin/'.$childMenu['permalink']);
            else
              $permalink = 'javascript:';

            $cssClass = '';
            if (isset($childMenu['permalink'])) {
              if ($permalink == $currentUrl)
                $cssClass = 'active';
            }

            ?>
            <li id="<?= $menuId ?>Menu" class="<?= $cssClass ?>">
              <a href="<?= $permalink ?>"><?= lang($childMenu['title']) ?></a>
            </li>
          <?php endforeach; ?>

        </ul>
      <?php endif; ?>
    </li>
  <?php endforeach; ?>

</ul>
