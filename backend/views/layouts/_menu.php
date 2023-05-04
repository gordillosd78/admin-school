<?php

use yii\bootstrap5\Nav;
use rmrevin\yii\fontawesome\FontAwesome;

?>
<div class="panel panel-default">
    <!-- Default panel contents -->

    <div class="panel-body">
        <?= Nav::widget([
            'encodeLabels' => false,
            'options' => ['class' => 'nav nav-pills nav-stacked'],
            'items' => [
                ['label' => FontAwesome::icon('copyright') . ' Compras', 'url' => ['compra/index']],
                ['label' => FontAwesome::icon('copyright') . ' Auditorias', 'url' => ['auditoria/index']],
                ['label' => FontAwesome::icon('share') . ' Egresos', 'url' => ['egresos/index']],
                ['label' => FontAwesome::icon('exchange') . ' Movimientos', 'url' => ['movimiento/index']],
                ['label' => FontAwesome::icon('edit') . ' Presupuestos', 'url' => ['presupuestos/index']],
                ['label' => FontAwesome::icon('share-square-o') . ' Ventas', 'url' => ['ventas/index']],
            ],
        ]); ?>
    </div>
</div>