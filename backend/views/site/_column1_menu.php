<?php

use kartik\nav\NavX;
use kartik\widgets\SideNav;
use yii\helpers\Url;
?>
<div class="panel panel-info border gap-1 p-2 d-flex flex-column justify-content-center">
    <!-- Default panel contents -->
    <div class="panel-heading w-100 d-flex justify-content-center align-items-center border-bottom">
        <p class="panel-title"><?= $actionsTitle ?></p>
    </div>
    <div class="panel-body w-100">
        <?= NavX::widget([
            'bsVersion' => '5.x',
            'encodeLabels' => false,
            'options' => ['class' => 'w-80 d-flex gap-1 flex-column justify-content-center nav nav-pills nav-stacked'],
            'items' => $items
        ]); ?>
    </div>
</div>