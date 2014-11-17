<?php echo TbHtml::breadcrumbs(array(
    '程式修改紀錄'=>array('index'),
    '新增'
)); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>