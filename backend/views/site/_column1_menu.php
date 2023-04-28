<?php

use kartik\nav\NavX;
?>
<div class="panel panel-info">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <p class="panel-title"><?= $actionsTitle ?></p>
    </div>
    <div class="panel-body">
        <?= NavX::widget([
            'bsVersion' => '3',
            'encodeLabels' => false,
            'options' => ['class' => 'nav nav-pills nav-stacked'],
            'items' => $items
        ]); ?>
    </div>
</div>