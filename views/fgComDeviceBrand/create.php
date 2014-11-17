<?php
/* @var $this FgComDeviceBrandController */
/* @var $model FgComDeviceBrand */
?>

<?php
$this->breadcrumbs=array(
	'Fg Com Device Brands'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FgComDeviceBrand', 'url'=>array('index')),
	array('label'=>'Manage FgComDeviceBrand', 'url'=>array('admin')),
);
?>

<h1>Create FgComDeviceBrand</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>