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
        'css/ui.css',
        'css/star-rating.min.css',
        'css/menu.css',
        'css/magnific-popup.css',
        'css/slick.css',
        'css/slick-theme.css',
        'css/owl.carousel.min.css',
        'css/owl.theme.default.min.css',
        'css/hover.css',
        'css/nouislider.min.css',
        'css/util.css',
        'css/main.css',
        'css/amazonmenu.css',
        'css/responsive_multi_level_menu/component.css',
        'css/nice-select.css',
        'css/style.css',
    ];
    public $js = [
        'js/jquery-ui.js',
        'js/velocity.min.js',
        'js/menu.js',
        'js/jquery.magnific-popup.min.js',
        'js/spartan-multi-image-picker.js',
        'js/slick.min.js',
        'js/owl.carousel.min.js',
        'js/nouislider.min.js',
        'js/jquery.smartmenus.min.js',
        'js/amazonmenu.js',
        'js/jquery.dlmenu.js',
        'js/jquery.nice-select.js',
        'js/jquery.sticky.js',
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
