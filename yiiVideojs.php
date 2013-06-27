<?php

/*
* yiiVideojs - Yii extension videojs
* based on http://videojs.com
* @author Zhussupov Zhassulan <zhzhussupovkz@gmail.com>
* @version: 1.0
* MADE IN KAZAKHSTAN
*/

class yiiVideojs extends CWidget {

	//src mp4
	public $src;

	//width
	public $width = '640';

	//height
	public $height = '480';

	//path to swf player
	private $swfPath;

	//run widget
	public function run() {
		$this->allScripts();

		echo '<video id="example" class="video-js vjs-default-skin"
		controls preload="none" width = "'.$this->width.'" height = "'.$this->height.'" 
		poster="http://video-js.zencoder.com/oceans-clip.png"
		data-setup="{}">';
		echo '<source src="'.$this->src.'" type="video/mp4" />';
		echo '</video>';

		$script = 'videojs.options.flash.swf = "'.$this->swfPath.'"';
		Yii::app()->clientScript->registerScript('yiiScroll', $script, CClientScript::POS_HEAD);
	}

	//подключение плагинов
	protected function allScripts()
	{
		$assets=dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
		$baseUrl=Yii::app()->assetManager->publish($assets);
		if(is_dir($assets))
		{
			Yii::app()->clientScript->registerCoreScript('jquery');
			Yii::app()->clientScript->registerScriptFile($baseUrl.'/video.js', CClientScript::POS_HEAD);
			Yii::app()->clientScript->registerCssFile($baseUrl.'/video-js.css');
			$this->swfPath = $baseUrl.'/video-js.swf';
		}
		else
		{
			throw new Exception('Ошибка в расширении yiiScroll! Не удалось подключить папку assets');
		}
	}
}