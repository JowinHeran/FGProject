<?php
/* @var $this FgComDeviceBrandController */
/* @var $model FgComDeviceBrand */
?>

<?php
$this->breadcrumbs=array(
	'Fg Com Device Brands'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FgComDeviceBrand', 'url'=>array('index')),
	array('label'=>'Create FgComDeviceBrand', 'url'=>array('create')),
	array('label'=>'Update FgComDeviceBrand', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FgComDeviceBrand', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FgComDeviceBrand', 'url'=>array('admin')),
);
?>

<h1>View FgComDeviceBrand #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'device_id',
		'brand_id',
	),
)); ?>