<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\helpers\Url;

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
        'bootstrap3-editable/css/bootstrap-editable.css',
        'css/site.css',
    ];

    public $js = [
        'bootstrap3-editable/js/bootstrap-editable.min.js',
        'js/jquery.simple.websocket.min.js',
        'js/site.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
    
    /**
     * @param \yii\web\View $view
     */
    public static function register($view)
    {
        parent::register($view);
        
        $view->registerJsVar('gameSocket', Url::to('@gameSocket/'));
    }
}
