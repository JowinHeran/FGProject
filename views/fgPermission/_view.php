<?php
/* @var $this FgPermissionController */
/* @var $data FgPermission */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('level_id')); ?>:</b>
	<?php echo CHtml::encode($data->level_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('function_id')); ?>:</b>
	<?php echo CHtml::encode($data->function_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ins')); ?>:</b>
	<?php echo CHtml::encode($data->ins); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('upd')); ?>:</b>
	<?php echo CHtml::encode($data->upd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('del')); ?>:</b>
	<?php echo CHtml::encode($data->del); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sel')); ?>:</b>
	<?php echo CHtml::encode($data->sel); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('print')); ?>:</b>
	<?php echo CHtml::encode($data->print); ?>
	<br />

	*/ ?>

</div>