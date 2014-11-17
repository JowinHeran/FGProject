<?php
/* @var $this FgAdsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Fg Ads',
);

$this->menu=array(
	array('label'=>'Create FgAds','url'=>array('create')),
	array('label'=>'Manage FgAds','url'=>array('admin')),
);
?>

<h1>Fg Ads</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>