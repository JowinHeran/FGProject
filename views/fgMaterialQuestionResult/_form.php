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
    <?php echo $form->hiddenField($model,'material_id',array('value'=>$topModel->id)); ?>
    
    <?php
 
        foreach($questionLists->data as $key=>$val){
            echo "Q".(++$key).". ".$val->name."<br>";
            if($val->type == 2){
                if($answerArray[$val->id] == 1)
                    echo "<input type='radio' name='item".$val->id."' value='1' checked> YES &nbsp;&nbsp;&nbsp;&nbsp;";
                else 
                    echo "<input type='radio' name='item".$val->id."' value='1'> YES &nbsp;&nbsp;&nbsp;&nbsp;";
                if($answerArray[$val->id] == '0')
                    echo "<input type='radio' name='item".$val->id."' value='0' checked> NO &nbsp;&nbsp;&nbsp;&nbsp;";
                else
                    echo "<input type='radio' name='item".$val->id."' value='0'> NO &nbsp;&nbsp;&nbsp;&nbsp;";  
                
            }else if($val->type == 3){
                
                if($val->item1 != ''){
                    if($answerArray[$val->id] == 1)
                        echo "<input type='radio' name='item".$val->id."' value='1' checked> ".$val->item1."&nbsp;&nbsp;&nbsp;&nbsp;";
                    else
                        echo "<input type='radio' name='item".$val->id."' value='1'> ".$val->item1."&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                    
                
                if($val->item2 != ''){
                    if($answerArray[$val->id] == 2)
                        echo "<input type='radio' name='item".$val->id."' value='2' checked> ".$val->item2."&nbsp;&nbsp;&nbsp;&nbsp;";
                    else
                        echo "<input type='radio' name='item".$val->id."' value='2'> ".$val->item2."&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                    
                
                if($val->item3 != ''){
                    if($answerArray[$val->id] == 3)
                        echo "<input type='radio' name='item".$val->id."' value='3' checked> ".$val->item3."&nbsp;&nbsp;&nbsp;&nbsp;";
                    else
                        echo "<input type='radio' name='item".$val->id."' value='3'> ".$val->item3."&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                    
                
                if($val->item4 != ''){
                    if($answerArray[$val->id] == 4)
                        echo "<input type='radio' name='item".$val->id."' value='4' checked> ".$val->item4."&nbsp;&nbsp;&nbsp;&nbsp;";
                    else
                        echo "<input type='radio' name='item".$val->id."' value='4'> ".$val->item4."&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                    
                
                if($val->item5 != ''){
                    if($answerArray[$val->id] == 5)
                        echo "<input type='radio' name='item".$val->id."' value='5' checked> ".$val->item5;
                    else
                        echo "<input type='radio' name='item".$val->id."' value='5'> ".$val->item5;
                }
                    
            }
            
            echo "<br>";
        }
    ?>
    

    <?php echo $form->textFieldControlGroup($model,'remark',array('span'=>5,'row'=>5)); ?>
    
    <label class="control-label" for="FgMaterialQuestion_link_type">連結類型</label>
    <?php echo $form->dropDownList($model,'link_type',CustomParams::$paramsMaterialType,array('options' => array($model->link_type=>array('selected'=>true))))?>
    <?php echo $form->textFieldControlGroup($model,'link_file'); ?>
    <?php echo $form->textFieldControlGroup($model,'link_url',array('span'=>5)); ?>
    
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

        $("#FgMaterialQuestionResult_link_type").on("change",function(){
            
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
        $("#FgMaterialQuestionResult_link_type").trigger("change");
    });
</script>