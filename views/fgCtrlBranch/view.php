<?php
/* @var $this FgCtrlBranchController */
/* @var $model FgCtrlBranch */
?>

<?php
$this->breadcrumbs=array(
	'Fg Ctrl Branches'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FgCtrlBranch', 'url'=>array('index')),
	array('label'=>'Create FgCtrlBranch', 'url'=>array('create')),
	array('label'=>'Update FgCtrlBranch', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FgCtrlBranch', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FgCtrlBranch', 'url'=>array('admin')),
);
?>

<h1>View FgCtrlBranch #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'user_id',
		'branch_id',
	),
)); ?>