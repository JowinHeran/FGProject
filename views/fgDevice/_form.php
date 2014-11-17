<?php
/* @var $this FgDeviceController */
/* @var $model FgDevice */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'fg-device-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note"><br>欄位前有 <span class="required">*</span> 為必填欄位<br></p>

    <?php echo $form->errorSummary($model); ?>


            <?php echo $form->textFieldControlGroup($model,'name',array('span'=>5,'maxlength'=>100)); ?>

            <?php echo $form->textFieldControlGroup($model,'mac',array('span'=>5,'maxlength'=>255)); ?>

           <label class="control-label" for="FgDevice_device_type_id">裝置類型</label>
            <?php echo $form->dropDownList($model,'device_type_id', CHtml::listData(FgDeviceType::model()->findAll(),'id','name')); ?>
            <br>
            <label class="control-label" for="FgDevice_branch_id">分店</label>
            <?php echo $form->dropDownList($model,'branch_id', CHtml::listData(FgBranch::model()->findAll(),'id','name')); ?>
            
             <label class="control-label" for="FgDevice_branch_id">機種</label>
            <?php echo $form->dropDownList($model,'market_type_id', CHtml::listData(FgMarketType::model()->findAll(),'id','name')); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? '新增' : '更新',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->