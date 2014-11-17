<?php
/* @var $this FgComDeviceBrandController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Fg Com Device Brands',
);

$this->menu=array(
	array('label'=>'Create FgComDeviceBrand','url'=>array('create')),
	array('label'=>'Manage FgComDeviceBrand','url'=>array('admin')),
);
?>

<h1>Fg Com Device Brands</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>