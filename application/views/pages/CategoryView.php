<div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title"><?= $rowCategory['category'] ?></h3>
        </div>
        <div class="panel-body">

          <?php $this->load->view('widgets/PostRollView', ['dataSource' => $rsPost]) ?>

        </div>
      </div>
    </div>
    <div class="col-md-3">

      <?php $this->load->view('widgets/CategoryView', ['dataSource' => $rsCategory]) ?>
      <?php $this->load->view('widgets/TagView', ['dataSource' => $rsTag]) ?>

    </div>
  </div>
</div>
