<?php
/* @var $this FgAdsController */
/* @var $model FgAds */
?>

<?php
$this->breadcrumbs=array(
	'Fg Ads'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FgAds', 'url'=>array('index')),
	array('label'=>'Create FgAds', 'url'=>array('create')),
	array('label'=>'View FgAds', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FgAds', 'url'=>array('admin')),
);
?>

    <h1>Update FgAds <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>