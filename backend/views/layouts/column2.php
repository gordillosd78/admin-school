<?php

use yii\bootstrap\Tabs;

$this->beginContent('@app/views/layouts/main.php'); ?>
<div class="row">
    <div class="col-md-9">
        <?= $content; ?>
    </div>

    <!-- /.col-sm-3 -->
    <div class="col-sm-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bars"></i> Panel de Acciones</h3>
            </div>
            <div class="panel-body">
                <?=
                // Tabs::widget([
                //     'options' => ['class' => 'nav-pills nav-stacked'],
                //     'items' => isset($this->params['sub_menus']) ? $this->params['sub_menus'] : [],
                // ]);
                "aqui venia un tabs";
                ?>
            </div>
        </div>
    </div>
    <!-- /.col-sm-3 -->

</div>
<?php $this->endContent(); ?>