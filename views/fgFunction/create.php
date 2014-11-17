<?php echo TbHtml::breadcrumbs(array(
    '功能設定'=>array('index'),
    '新增'
)); ?>

<?php $this->renderPartial('_form', array('model'=>$model,'selectItem'=>$selectItem)); ?>