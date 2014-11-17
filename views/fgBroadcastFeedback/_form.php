<?php
$modelArr = array('FgPlace'=>array('key'=>'name'),'FgPlaceType'=>array('key'=>'id'));
$common = new CommonFunction();
$arr = $common->associateForm($modelArr);
$placeArr = $arr['FgPlace'];
$typeArr = $arr['FgPlaceType'];
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'fg-place-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <div class="note"><br/>欄位有<span class="required">*</span>為必填欄位<br/></div>

    <?php echo $form->errorSummary($model); ?>
	<?php echo (!$model->isNewRecord)?( $form->dropDownListControlGroup($model,'name',$placeArr,array('empty'=>"請選擇通路名稱","disabled"=>"disalbed"))):( $form->textFieldControlGroup($model,'name',array('span'=>5))); ?>
    <?php echo $form->dropDownListControlGroup($model,'place_type_id',$typeArr,array('empty'=>"請選擇通路類型")); ?>
            

            <?php //echo $form->textFieldControlGroup($model,'place_type_id',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? '新增' : '更新',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->