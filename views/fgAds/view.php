<?php
/* @var $this FgAdsController */
/* @var $model FgAds */
?>

<?php
$this->breadcrumbs=array(
	'Fg Ads'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List FgAds', 'url'=>array('index')),
	array('label'=>'Create FgAds', 'url'=>array('create')),
	array('label'=>'Update FgAds', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FgAds', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FgAds', 'url'=>array('admin')),
);
?>

<h1>View FgAds #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'name',
		'photo',
		'movie',
		'url',
		'device_type_id',
		'brand_id',
	),
)); ?>