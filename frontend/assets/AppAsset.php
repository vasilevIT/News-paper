<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
    ];
    public $js = [
//        "https://code.jquery.com/jquery-1.12.4.js",
        "https://code.jquery.com/ui/1.12.1/jquery-ui.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
