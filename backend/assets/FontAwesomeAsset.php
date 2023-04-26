<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Class FontAwesomeAsset
 *
 * @author Miguel Prieto <mikyvato@gmail.com>
 * @package app\assets
 */
class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@bower/font-awesome';

    public $css = [
        'css/all.css',
        'css/fontawesome.min.css',
    ];

    public $publishOptions = [
        'only' => [
            'css/*',
        ]
    ];
}
