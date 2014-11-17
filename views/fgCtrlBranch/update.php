<?php
/* @var $this FgCtrlBranchController */
/* @var $model FgCtrlBranch */
?>

<?php
$this->breadcrumbs=array(
	'Fg Ctrl Branches'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FgCtrlBranch', 'url'=>array('index')),
	array('label'=>'Create FgCtrlBranch', 'url'=>array('create')),
	array('label'=>'View FgCtrlBranch', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FgCtrlBranch', 'url'=>array('admin')),
);
?>

    <h1>Update FgCtrlBranch <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>