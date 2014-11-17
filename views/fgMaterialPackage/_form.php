<?php 

$modelArr = array('FgCity'=>array('key'=>'name'),'FgDirection'=>array('key'=>'id'));
$common = new CommonFunction();
$arr = $common->associateForm($modelArr);
$cityArr = $arr['FgCity'];
$directionArr = $arr['FgDirection'];

?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'fg-city-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note"><br>欄位有<span class="required">*</span>為必填欄位<br></p>
    
    <?php echo $form->errorSummary($model); ?>

 <?php echo $form->textFieldControlGroup($model,'name'); ?>


        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? '新增' : '更新',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    $(document).ready(function(){
        var optionSelected = <?=$model->id?>;
        $("select#FgCity_name option").eq(optionSelected).attr('selected','selected');
        
    });
</script>