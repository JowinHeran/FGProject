<?php echo TbHtml::breadcrumbs(array(
    '通路類型設定'=>array('index'),
    '新增'
)); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>