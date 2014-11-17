<?php
/* @var $this FgCtrlBranchController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Fg Ctrl Branches',
);

$this->menu=array(
	array('label'=>'Create FgCtrlBranch','url'=>array('create')),
	array('label'=>'Manage FgCtrlBranch','url'=>array('admin')),
);
?>

<h1>Fg Ctrl Branches</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>