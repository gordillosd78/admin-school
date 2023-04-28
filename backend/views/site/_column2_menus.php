<?php

use rmrevin\yii\fontawesome\FontAwesome;
use yii\helpers\Url;

$request = Yii::$app->request;
$get = $request->getUrl();

foreach ($items as $key => $value) {
    if ($value['visible']) {
        $active = false;

        if (isset($value['id']) && $value['id'] > 0)
            $url = Url::to([str_replace('{{context}}', $this->context->id, $value['url']), 'id' => $value['id']]);
        else
            $url = Url::to([str_replace('{{context}}', $this->context->id, $value['url'])]);

        if ($get === $url) {
            $active = true;
        }

        $this->params['sub_menus'][] = [
            'encode' => false,
            'label' => FontAwesome::icon($value['icon']) . $value['name'],
            'url' => $url,
            'active' => $active,
        ];
    }
}
