<?php echo TbHtml::breadcrumbs(array(
    '使用者設定'=>array('index'),
    '新增'
)); ?>

<?php $this->renderPartial('_contact_form', array('model'=>$model,'selectItem'=>$selectItem)); ?>