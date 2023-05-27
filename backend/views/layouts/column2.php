<?php

use kartik\tabs\TabsX;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\helpers\Html;

$this->beginContent('@app/views/layouts/main.php'); ?>
<div class="row">
    <div class="col-md-9">
        <?= $content; ?>
    </div>

    <!-- /.col-sm-3 -->
    <div class="col-sm-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title"><?= FontAwesome::icon('bars') . ' Panel de Acciones' ?></h4>
            </div>
            <div class="panel-body">
                <?=
                TabsX::widget([
                    'options' => ['class' => 'nav flex-column nav-pills nav-stacked'],
                    'items' => isset($this->params['sub_menus']) ? $this->params['sub_menus'] : [],
                ]);
                ?>
            </div>
        </div>
    </div>
    <!-- /.col-sm-3 -->

</div>
<?php $this->endContent(); ?>