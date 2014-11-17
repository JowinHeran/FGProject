<?php echo TbHtml::breadcrumbs(array(
    '聯絡人'=>array('index','advertiser_id'=>$_GET['advertiser_id'],'brand_id'=>$_GET['brand_id']),
    '新增'
)); ?>

<?php $this->renderPartial('_contact_form', array('model'=>$model,'selectItem'=>$selectItem)); ?>