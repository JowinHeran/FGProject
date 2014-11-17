<?php
/* @var $this FGMaterialController */
/* @var $model FGMaterial */
/* @var $form TbActiveForm */
?>
<style>
    img{
        max-width:600px;
    }    
</style>
<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'fgmaterial-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note"><br>欄位有<span class="required">*</span>為必填欄位<br></p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListControlGroup($model,'brand_id',$selectItem['brand'],array('empty'=>"請選擇品牌")); ?>
    
    <?php echo  ($model->isNewRecord) ? $form->dropDownListControlGroup($model,'device_type_id',$selectItem['device_type'],array('empty'=>"請選擇裝置類型")):$form->dropDownListControlGroup($model,'device_type_id',$selectItem['device_type'],array('empty'=>"請選擇裝置類型",'disabled'=>'disabled')); ?>

    <?php echo $form->textFieldControlGroup($model,'name',array('span'=>5)); ?>


    <div class="row">
        <?php if(!$model->isNewRecord && $model->getImage(1)!="/../images/material/"){echo "<img src='".$model->getImagePath()."' />";}?>
        <?php if($model->getImage(1)=="/../images/material/"){echo "<span style='color:red'>*尚未上傳素材(橫)!</span>";}?>
        <?php echo $form->fileFieldControlGroup($model,'image'); ?>
        <?php echo $form->error($model,'image'); ?>
    </div>
    
    <div class="row">
        <?php if(!$model->isNewRecord && $model->getImage(2)!="/../images/material-v/"){echo "<img src='".$model->getImage_vPath()."' />";}?>
        <?php if($model->getImage(2)=="/../images/material-v/"){echo "<span style='color:red'>*尚未上傳素材(直)!</span>";}?>
        <?php echo $form->fileFieldControlGroup($model,'image_v'); ?>
        <?php echo $form->error($model,'image_v'); ?>
    </div>
    <div class="row">
        <?php 
        if(!$model->isNewRecord && $model->getImage(3)!="/../images/material-movie/"){?>
            <video width="320" height="240" controls>
                <source src="<?=$model->getMoviePath()?>" type="video/mp4">
                <source src="<?=$model->getMoviePath()?>" type="video/ogg">
                你您瀏覽器不支援影片撥放
            </video>
        <?php } ?>
        <?php if($model->getImage(3)=="/../images/material-movie/"){echo "<span style='color:red'>*尚未上傳素材影片!</span>";}?>
        <?php echo $form->fileFieldControlGroup($model,'movie'); ?>
        <?php echo $form->error($model,'movie'); ?>
    </div>

    <?php echo $form->textFieldControlGroup($model,'url',array('span'=>5)); ?>
    
    <label class="control-label" for="FGMaterial_remark">成效目標說明</label>
    <?php echo $form->textArea($model,'remark',array('span'=>5,'row'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? '新增' : '更新',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->