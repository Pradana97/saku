<?php
namespace app\assets;
use yii\web\AssetBundle;
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css'
    ];
    public $js = [    
        'https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js',
        'https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
