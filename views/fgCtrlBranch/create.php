<?php
/* @var $this FgCtrlBranchController */
/* @var $model FgCtrlBranch */
?>

<?php
$this->breadcrumbs=array(
	'Fg Ctrl Branches'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FgCtrlBranch', 'url'=>array('index')),
	array('label'=>'Manage FgCtrlBranch', 'url'=>array('admin')),
);
?>

<h1>Create FgCtrlBranch</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>