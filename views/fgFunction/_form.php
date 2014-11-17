<?php
/* @var $this FgFunctionController */
/* @var $model FgFunction */
/* @var $form TbActiveForm */
($model->isNewRecord||!$model->status)?($model->status=0):('');
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'fg-function-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note"><br>欄位前有 <span class="required">*</span> 為必填欄位<br></p>

    <?php echo $form->errorSummary($model); ?>
    
           
            <?php echo $form->dropDownListControlGroup($model,'function_id',$selectItem['function_name'],array('empty'=>"請選擇功能名稱")); ?>
           
            <?php echo $form->textFieldControlGroup($model,'name',array('span'=>5,'maxlength'=>100)); ?>
            
            <?php echo $form->textFieldControlGroup($model,'url',array('span'=>5,'maxlength'=>100)); ?>
            
            <?php echo $form->labelEx($model,'status');?>
            <?php echo $form->inlineRadioButtonList($model,'status',array(0=>'顯示',1=>'不顯示')); ?>

            <?php echo $form->textFieldControlGroup($model,'seq',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? '新增' : '更新',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->