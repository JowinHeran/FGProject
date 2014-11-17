<?php
/* @var $this FgPermissionController */
/* @var $model FgPermission */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'level_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'function_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'ins',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'upd',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'del',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'sel',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'print',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->