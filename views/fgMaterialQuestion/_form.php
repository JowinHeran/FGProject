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
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note"><br>欄位有<span class="required">*</span>為必填欄位<br></p>
    
    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model,'material_id',array('value'=>$topModel->id)); ?>

    <?php echo $form->dropDownList($model,'type',CustomParams::$paramsMaterialQuestionType,array('options' => array($model->type=>array('selected'=>true))))?>
    
    <div class="row">
        <?php if(!$model->isNewRecord && $model->getFile(1)!="/../images/materialQuestion/bg_image/"){echo "<img src='".$model->getFilePath(1)."' width=150/>";}?>
        <?php // if($model->getFile(1)=="/../images/materialQuestion/bg_image/"){echo "<span style='color:red'>*尚未上傳背景!</span>";}?>
        <?php echo $form->fileFieldControlGroup($model,'background_image'); ?>
        <?php echo $form->error($model,'background_image'); ?>
    </div>
    
    <div class="row">
        <?php if(!$model->isNewRecord && $model->getFile(2)!="/../images/materialQuestion/bg_voice/"){
            echo "<audio src='".$model->getFilePath(2)."' controls='controls'>
                  Your browser does not support the audio tag.
                  </audio>";
        }?>
        <?php // if($model->getFile(2)=="/../images/materialQuestion/bg_voice/"){echo "<span style='color:red'>*尚未上傳背景音!</span>";}?>
        <?php echo $form->fileFieldControlGroup($model,'background_voice'); ?>
        <?php echo $form->error($model,'background_voice'); ?>
    </div>
    
    <?php echo $form->textFieldControlGroup($model,'name'); ?>
    
    <div id="option-type-1" <?php if($model->type == "" || $model->type != 1){?>style="display:none;"<?php } ?>>
        
        <label class="control-label" for="FgMaterialQuestion_link_file">連結類型</label>
        <?php echo $form->dropDownList($model,'link_type',CustomParams::$paramsMaterialType,array('options' => array($model->type=>array('selected'=>true))))?>
        <?php echo $form->textFieldControlGroup($model,'link_file'); ?>
        <?php echo $form->textFieldControlGroup($model,'link_link'); ?>
    </div>
    
    
    
    <div id="option-type-2" <?php if($model->type == "" || $model->type == 1){?>style="display:none;"<?php } ?>>
        <?php echo $form->textFieldControlGroup($model,'item1'); ?>
        <label class="control-label" for="FgMaterialQuestion_item1_file">項目1連結類型</label>
        <?php echo $form->dropDownList($model,'item1_type',CustomParams::$paramsMaterialType,array('options' => array($model->type=>array('selected'=>true))))?>
        <?php echo $form->textFieldControlGroup($model,'item1_file'); ?>
        <?php echo $form->textFieldControlGroup($model,'item1_link'); ?>

        <?php echo $form->textFieldControlGroup($model,'item2'); ?>
        <label class="control-label" for="FgMaterialQuestion_item2_file">項目2連結類型</label>
        <?php echo $form->dropDownList($model,'item2_type',CustomParams::$paramsMaterialType,array('options' => array($model->type=>array('selected'=>true))))?>
        <?php echo $form->textFieldControlGroup($model,'item2_file'); ?>
        <?php echo $form->textFieldControlGroup($model,'item2_link'); ?>

        <?php echo $form->textFieldControlGroup($model,'item3'); ?>
        <label class="control-label" for="FgMaterialQuestion_item3_file">項目3連結類型</label>
        <?php echo $form->dropDownList($model,'item3_type',CustomParams::$paramsMaterialType,array('options' => array($model->type=>array('selected'=>true))))?>
        <?php echo $form->textFieldControlGroup($model,'item3_file'); ?>
        <?php echo $form->textFieldControlGroup($model,'item3_link'); ?>

        <?php echo $form->textFieldControlGroup($model,'item4'); ?>
        <label class="control-label" for="FgMaterialQuestion_item4_file">項目4連結類型</label>
        <?php echo $form->dropDownList($model,'item4_type',CustomParams::$paramsMaterialType,array('options' => array($model->type=>array('selected'=>true))))?>
        <?php echo $form->textFieldControlGroup($model,'item4_file'); ?>
        <?php echo $form->textFieldControlGroup($model,'item4_link'); ?>

        <?php echo $form->textFieldControlGroup($model,'item5'); ?>
        <label class="control-label" for="FgMaterialQuestion_item5_file">項目5連結類型</label>
        <?php echo $form->dropDownList($model,'item5_type',CustomParams::$paramsMaterialType,array('options' => array($model->type=>array('selected'=>true))))?>
        <?php echo $form->textFieldControlGroup($model,'item5_file'); ?>
        <?php echo $form->textFieldControlGroup($model,'item5_link'); ?>
    </div>
    
        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? '新增' : '更新',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
        ));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    $(document).ready(function(){
        
        $("#FgMaterialQuestion_type").on("change",function(){
            if($(this).val() == 0){
                $("#option-type-1").hide();
                $("#option-type-2").hide();
                return;
            }
            if($(this).val() == 1){
                $("#option-type-1").show();
                $("#option-type-2").hide();
            }else{
                $("#option-type-1").hide();
                $("#option-type-2").show();
            }
        })
        
        $("select[id^=FgMaterialQuestion_item],#FgMaterialQuestion_link_type").on("change",function(){
            
            if($(this).val() == 0){
                $(this).next().hide();
                $(this).next().next().hide();
                return;
            }
            if( $(this).val() == 3){
                $(this).next().hide();
                $(this).next().next().show();
            }else{
                $(this).next().show();
                $(this).next().next().hide();
            }
            
        })
        
        $("select[id^=FgMaterialQuestion_item],#FgMaterialQuestion_link_type").trigger("change");
        
    });
</script>