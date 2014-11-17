<?php
/* @var $this FgUserController */
/* @var $model FgUser */
/* @var $form TbActiveForm */

$levelModel = FgLevel::model()->find('name=:name',array(":name"=>"聯絡人"));
$selectItem['level'] = array($levelModel->id=>$levelModel->name);
$brand_id = intval($_GET['brand_id']);
$selectItem['brand'] = array($brand_id=>$selectItem['brand'][$brand_id]);
$advertiser_id = intval($_GET['advertiser_id']);
$selectItem['advertiser'] = array($advertiser_id=>$selectItem['advertiser'][$advertiser_id]);

// $model->level_id = $levelModel->id;
$model->brand_id = $brand_id;
$model->advertiser_id = $advertiser_id;
($model->isNewRecord)?($model->gender=0):("");
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'fg-user-form',
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

            <?php echo $form->textFieldControlGroup($model,'first_name',array('span'=>5,'maxlength'=>45)); ?>

            <?php echo $form->textFieldControlGroup($model,'second_name',array('span'=>5,'maxlength'=>45)); ?>

            <?php echo $form->textFieldControlGroup($model,'position',array('span'=>5,'maxlength'=>45)); ?>

            <?php echo $form->textFieldControlGroup($model,'mobile',array('span'=>5));?>

            <?php echo $form->textFieldControlGroup($model,'email',array('span'=>5));?>


            <?php //echo $form->textFieldControlGroup($model,'nickname',array('span'=>5,'maxlength'=>45)); ?>

            <?php// echo ($model->isNewRecord)?( $form->textFieldControlGroup($model,'account',array('span'=>5,'maxlength'=>45))):( $form->textFieldControlGroup($model,'account',array('span'=>5,'maxlength'=>45,'disabled'=>'disabled'))); ?>

            <?php// echo $form->passwordFieldControlGroup($model,'password',array('span'=>5,'maxlength'=>45)); ?>

            <?php //echo $form->dropDownListControlGroup($model,'level_id',$selectItem['level'],array('span'=>5,'empty'=>'請選擇等級')); ?>

            <?php //echo $form->dropDownListControlGroup($model,'place_id',$selectItem['place'],array('span'=>5,'empty'=>'請選擇通路')); ?>

            <?php //echo $form->dropDownListControlGroup($model,'branch_id',$selectItem['branch'],array('span'=>5,'empty'=>'請選擇分店')); ?>
           
             <?php echo $form->dropDownListControlGroup($model,'advertiser_id',$selectItem['advertiser'],array('span'=>5,'empty'=>'請選擇廣告主')); ?>

            <?php echo $form->dropDownListControlGroup($model,'brand_id',$selectItem['brand'],array('span'=>5,'empty'=>'請選擇品牌')); ?>

            <?php echo $form->textFieldControlGroup($model,'birthday',array('span'=>5)); ?>

            <?php echo $form->inlineRadioButtonListControlGroup($model,'gender',array(0=>"男",1=>"女"));?>

            <?php echo $form->textFieldControlGroup($model,'tel',array('span'=>5));?>

            <?php echo $form->textFieldControlGroup($model,'fax',array('span'=>5));?>

             <?php echo $form->textAreaControlGroup($model,'remark',array('span'=>5));?>

           <div class="form-actions">
        <?php echo TbHtml::linkButton('上一步',array('submit'=>$this->createUrl('FgBrand/update',array('id'=>$model->brand_id))));?>
        &nbsp;
        <?php 
                // echo TbHtml::ajaxButton('新增聯絡人',
                //                           'fgUser/createContact',
                //                           $ajaxOptions=array (
                //                             'type'=>'POST',
                //                             'dataType'=>'html',
                //                             'success'=>'function(html){ jQuery("#contact").html(html); }'
                //                             ), 
                //                             $htmlOptions=array ()
                //                          );?>
        <?php 
        echo TbHtml::submitButton($model->isNewRecord ? '新增聯絡人' : '更新',array(
            // 'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
            // 'size'=>TbHtml::BUTTON_SIZE_LARGE,
        )); ?>
        &nbsp;
        <?php echo TbHtml::linkButton('完成',array('submit'=>$this->createUrl('FgBrand/index')));?>
    </div>

        

    <?php $this->endWidget(); ?>

</div><!-- form -->