<?php
/* @var $this FgUserController */
/* @var $model FgUser */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'fg-user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note"><br>欄位前有 <span class="required">*</span> 為必填欄位<br></p>

    <?php echo $form->errorSummary($model); ?>

            <?php //echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'name',array('span'=>5,'maxlength'=>45)); ?>

            <?php echo $form->textFieldControlGroup($model,'nickname',array('span'=>5,'maxlength'=>45)); ?>

            <?php echo ($model->isNewRecord)?( $form->textFieldControlGroup($model,'account',array('span'=>5,'maxlength'=>45))):( $form->textFieldControlGroup($model,'account',array('span'=>5,'maxlength'=>45,'disabled'=>'disabled'))); ?>

            <?php echo $form->passwordFieldControlGroup($model,'password',array('span'=>5,'maxlength'=>45)); ?>

            <?php echo $form->dropDownListControlGroup($model,'level_id',$selectItem['level'],array('span'=>5,'empty'=>'請選擇等級')); ?>

            <?php echo $form->textFieldControlGroup($model,'position',array('span'=>5));?>

            <?php echo $form->dropDownListControlGroup($model,'place_id',$selectItem['place'],array('span'=>5,'empty'=>'請選擇通路')); ?>

            <?php echo $form->dropDownListControlGroup($model,'branch_id',$selectItem['branch'],array('span'=>5,'empty'=>'請選擇分店')); ?>
            
            <?php echo $form->dropDownListControlGroup($model,'brand_id',$selectItem['brand'],array('span'=>5,'empty'=>'請選擇品牌')); ?>

            <?php echo $form->textFieldControlGroup($model,'birthday',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'tel',array('span'=>5));?>

            <?php echo $form->textFieldControlGroup($model,'fax',array('span'=>5));?>

            <?php echo $form->textFieldControlGroup($model,'mobile',array('span'=>5));?>

            <?php echo $form->textFieldControlGroup($model,'email',array('span'=>5));?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? '新增' : '更新',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    var positionObj =$("#FgUser_position").parent().parent();
    positionObj.css({"display":"none"});
    var isLevel = <?=($model->level_id=="")?(0):($model->level_id)?>;
    if(isLevel){
         positionObj.css({"display":"block"});
    }
    $('#FgUser_level_id').change(function(){
        if($(this).val()==3){
            positionObj.css({"display":"block"});
        }else{
             positionObj.css({"display":"none"});
        }
    });
</script>