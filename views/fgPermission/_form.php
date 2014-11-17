<?php
/* @var $this FgPermissionController */
/* @var $model FgPermission */
/* @var $form TbActiveForm */
($model->isNewRecord)?($model->ins=0):('');
($model->isNewRecord)?($model->upd=0):('');
($model->isNewRecord)?($model->del=0):('');
($model->isNewRecord)?($model->sel=0):('');
($model->isNewRecord)?($model->print=0):('');
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'fg-permission-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note"><br>欄位前有 <span class="required">*</span> 為必填欄位<br></p>

    <?php echo $form->errorSummary($model); ?>

            <?php //echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

            <?php echo $form->dropDownListControlGroup($model,'level_id',$selectItem['level'],array('empty'=>'請選擇等級')); ?>

            <?php echo $form->dropDownListControlGroup($model,'function_id',$selectItem['function'],array('empty'=>'請選擇功能')); ?>
            <?php //echo $form->radioButton($model,'ins');?>
            <?php echo $form->labelEx($model,'ins');?>
            <?php echo $form->inlineRadioButtonList($model,'ins',array(0=>TbHtml::icon(TbHtml::ICON_REMOVE),1=>TbHtml::icon(TbHtml::ICON_OK))); ?>

            <?php echo $form->labelEx($model,'upd');?>
            <?php echo $form->inlineRadioButtonList($model,'upd',array(0=>TbHtml::icon(TbHtml::ICON_REMOVE),1=>TbHtml::icon(TbHtml::ICON_OK))); ?>

            <?php echo $form->labelEx($model,'del');?>
            <?php echo $form->inlineRadioButtonList($model,'del',array(0=>TbHtml::icon(TbHtml::ICON_REMOVE),1=>TbHtml::icon(TbHtml::ICON_OK))); ?>

            <?php echo $form->labelEx($model,'sel');?>
            <?php echo $form->inlineRadioButtonList($model,'sel',array(0=>TbHtml::icon(TbHtml::ICON_REMOVE),1=>TbHtml::icon(TbHtml::ICON_OK))); ?>

            <?php echo $form->labelEx($model,'print');?>
            <?php echo $form->inlineRadioButtonList($model,'print',array(0=>TbHtml::icon(TbHtml::ICON_REMOVE),1=>TbHtml::icon(TbHtml::ICON_OK))); ?>
            

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? '新增' : '更新',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->