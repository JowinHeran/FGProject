<?php 
    $common = new CommonFunction();
    $modelArr = array('FgCity'=>array('key'=>'id','isparent'=>true),'FgArea'=>array('key'=>'id','isparent'=>false,'with'=>'city','field'=>'city_id'));
    $arr = $common->relateForm($model,$modelArr);
    $cityArr = $arr['FgCity'];
    $areaArr = $arr['FgArea'];
    //with('city')->findAll('city_id=:city_id',array(":city_id"=>$model->id));
    // $testArr = FgArea::model()->fetchAssoNameArr('city','city_id',24);
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'fg-branch-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note"><br>欄位前有 <span class="required">*</span> 為必填欄位<br></p>

    <?php echo $form->errorSummary($model); ?>


            <?php echo $form->textFieldControlGroup($model,'name',array('span'=>5,'maxlength'=>45)); ?>

            <?php echo $form->dropDownListControlGroup($model,'place_id',$selectItem['place'],array('empty'=>"請選擇通路")); ?>
            
            <?php echo $form->dropDownListControlGroup($model,'city_id',$cityArr,array("empty"=>"請選擇縣市"),array('span'=>5)); ?>
            <?php echo $form->dropDownListControlGroup($model,'area_id',$areaArr,array("empty"=>"請選擇分店位置"),array('span'=>5)); ?>
            <?php //echo $form->dropDownListControlGroup($model,'area_id',array('span'=>5));?>
            <?php //echo $form->dropDownList($model,'city_id',CHtml::listData($areaArr,'id','name'), array('empty'=>array(0=>'Select location'),'options' => array('2'=>array('selected'=>true)))); ?>
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
        $("#FgBranch_city_id").change(function(){
            var value = $(this).find("option:selected").val();
            var url = <?="'".Yii::app()->createUrl('/FG_Manage_2/fgBranch/dropDownListChange')."'"?>;
            $.ajax({
              type: "GET",
              data: "&city_id="+value,
              url: url,
              success: function(result){
               $("#FgBranch_area_id").html('<option>請選擇分店位置</option>');
                $("#FgBranch_area_id").append(result);
              }
            });
        });
    });
</script>