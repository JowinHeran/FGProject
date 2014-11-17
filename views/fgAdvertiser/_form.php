<?php
//設定預設值
($model->isNewRecord || !($model->exe_status))?($model->exe_status = 0):('');
// ($model->isNewRecord || !($model->contract_status))?($model->contract_status = 0):('');
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'fg-brand-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); 

?>

    <p class="note"><br>欄位前有 <span class="required">*</span> 為必填欄位<br></p>

    <?php echo $form->errorSummary($model); ?>

            <?php //echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

            <?php //echo $form->textFieldControlGroup($model,'company',array('span'=>5,'maxlength'=>45));?>

            <?php echo $form->textFieldControlGroup($model,'name',array('span'=>5,'maxlength'=>45)); ?>

            <?php //echo $form->dropDownListControlGroup($model,'brand_id',$selectItem['brand'],array('empty'=>'請選擇品牌'));?>
            
            <?php echo $form->labelEx($model,'exe_status');?>
            <?php echo $form->inlineRadioButtonList($model,'exe_status',array(0=>"Yes",1=>"No"));?>

            <?php echo $form->textFieldControlGroup($model,'product_name',array('span'=>5,'maxlength'=>45)); ?>

            <?php echo $form->textFieldControlGroup($model,'vat_number',array('span'=>5,'maxlength'=>45)); ?>

            <?php echo $form->textFieldControlGroup($model,'contract_name',array('span'=>5,'maxlength'=>45)); ?>

            <?php //echo $form->labelEx($model,'contract_status');?>
            <?php echo $form->dropDownListControlGroup($model,'contract_status',$model->returnIconData(array(0=>"執行中",1=>"暫停",2=>"中止",3=>"結束")),array('emtpy'=>'請選擇合約狀態'));?>

            <?php //echo $form->labelEx($model,'exe_status'); ?>
            <?php //echo $form->inlineRadioButtonList($model,'exe_status',$model->returnIconData()); ?>

            <?php //echo $form->textFieldControlGroup($model,'address',array('span'=>5,'maxlength'=>100));?>

            <?php //echo $form->textFieldControlGroup($model,'phone',array('span'=>5)); ?>

            <?php //echo $form->textFieldControlGroup($model,'email',array('span'=>5,'maxlength'=>100));?>

            <?php //echo $form->dropDownListControlGroup($model,'user_id',$selectItem['user'],array('empty'=>"請選擇廣告主")); ?>

            
            <?php 
                // if(!$model->isNewRecord){
                //     echo $form->labelEx($model,'contact_arr');
                //     $userModel = FgUser::model()->findAll('brand_id=:brand_id',array(':brand_id'=>$_GET['id']));
                //     $userArr = CHtml::listData($userModel,'id','name');
                   
                //     foreach ($userArr as $key => $value) {
                //         echo CHtml::link($value,'../../../fgUser/view/id/'.$key)."<br>";
                //     }
                    
                // }

            ?>
             <?php// echo (!$model->isNewRecord)?(CHtml:: ajaxButton('新增聯絡人',
                                         //  '../../../fgUser/createContact',
                                         //  $ajaxOptions=array (
                                         //    'type'=>'POST',
                                         //    'dataType'=>'html',
                                         //    'success'=>'function(html){ jQuery("#contact").html(html); }'
                                         //    ), 
                                         //    $htmlOptions=array ()
                                         // )):('');?>
           
            <div id="contact"></div>
            <?php //echo $form->textFieldControlGroup($model,'seq',array('span'=>5)); ?>
       
        <div class="form-actions">
        
         <?php 
        //  echo TbHtml::submitButton('下一步',array(
        //     // 'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
        //     // 'size'=>TbHtml::BUTTON_SIZE_LARGE,
        // )); ?>
        <?php 
         echo TbHtml::submitButton($model->isNewRecord ? '新增' : '更新',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->