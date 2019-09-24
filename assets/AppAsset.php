<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/normalize.min.css',
        'css/bootstrap-grid.min.css',
        'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;display=swap',
        'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'https://cdn.jsdelivr.net/npm/suggestions-jquery@19.8.0/dist/css/suggestions.min.css',
        'css/style.min.css',
    ];
    public $js = [
        //'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
        'https://cdn.jsdelivr.net/npm/suggestions-jquery@19.8.0/dist/js/jquery.suggestions.min.js',
        'js/common.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',

    ];
}
