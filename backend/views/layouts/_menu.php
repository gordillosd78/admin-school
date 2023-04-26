<?php

use rmrevin\yii\fontawesome\FA;
use kartik\nav\NavX;
use rmrevin\yii\fontawesome\FAR;

?>
<div class="panel panel-default">
    <!-- Default panel contents -->

    <div class="panel-body">
        <?= NavX::widget([
            'bsVersion' => '3',
            'encodeLabels' => false,
            'options' => ['class' => 'nav nav-pills nav-stacked'],
            'items' => [
                ['label' => FA::icon('copyright') . ' Compras', 'url' => ['compra/index']],
                ['label' => FA::icon('copyright') . ' Auditorias', 'url' => ['auditoria/index']],
                ['label' => FA::icon('share') . ' Egresos', 'url' => ['egresos/index']],
                ['label' => FA::icon('exchange') . ' Movimientos', 'url' => ['movimiento/index']],
                ['label' => FA::icon('edit') . ' Presupuestos', 'url' => ['presupuestos/index']],
                ['label' => FA::icon('share-square-o') . ' Ventas', 'url' => ['ventas/index']],
            ],
        ]); ?>
    </div>
</div>