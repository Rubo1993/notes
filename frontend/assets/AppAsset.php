<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'css/site.css',
		'css/style.css',
		'css/animate.css',
		'css/animate.min.css',

//		'css/select2.min.css'

	];
	public $js = [
		'js/script.js',
		'js/custom.js',
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
//    public function init() {
//	   if (\Yii::$app->controller->action->id==='index' || 'sell'){
//	   	$this->js[]='js/script.js';
//		   $this->js[]='js/list.js';
//	   }
//	   if (\Yii::$app->controller->action->id==='need'){
//		   $this->js[]='js/script.js';
//	   }
//    }
}
