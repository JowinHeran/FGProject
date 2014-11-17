<?php
/* @var $this FgAdsController */
/* @var $model FgAds */
?>

<?php
$this->breadcrumbs=array(
	'Fg Ads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FgAds', 'url'=>array('index')),
	array('label'=>'Manage FgAds', 'url'=>array('admin')),
);
?>

<h1>Create FgAds</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>