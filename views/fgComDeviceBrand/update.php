<?php
/* @var $this FgComDeviceBrandController */
/* @var $model FgComDeviceBrand */
?>

<?php
$this->breadcrumbs=array(
	'Fg Com Device Brands'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FgComDeviceBrand', 'url'=>array('index')),
	array('label'=>'Create FgComDeviceBrand', 'url'=>array('create')),
	array('label'=>'View FgComDeviceBrand', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FgComDeviceBrand', 'url'=>array('admin')),
);
?>

    <h1>Update FgComDeviceBrand <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>