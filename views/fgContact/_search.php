<?php
/* @var $this FgUserController */
/* @var $model FgUser */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'name',array('span'=>5,'maxlength'=>45)); ?>

                     <?php echo $form->textFieldControlGroup($model,'nickname',array('span'=>5,'maxlength'=>45)); ?>

                    <?php echo $form->textFieldControlGroup($model,'account',array('span'=>5,'maxlength'=>45)); ?>

                            <?php echo $form->textFieldControlGroup($model,'level_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'place_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'branch_id',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->