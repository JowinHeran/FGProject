<?php echo TbHtml::breadcrumbs(array(
    '標籤設定'=>array('index'),
    '新增'
)); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>