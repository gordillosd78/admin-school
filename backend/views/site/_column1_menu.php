<?php

use kartik\nav\NavX;
?>
<div class="d-flex w-40 flex-column">
    <!-- Default panel contents -->
    <div class="panel-heading w-100">
        <p class="panel-title"><?= $actionsTitle ?></p>
    </div>
    <div class="panel-body w-100">
        <?= NavX::widget([
            'bsVersion' => '5.x',
            'encodeLabels' => false,
            'options' => ['class' => 'nav nav-pills nav-stacked'],
            'items' => $items
        ]); ?>
    </div>
</div>