<?php echo TbHtml::breadcrumbs(array(
    '裝置設定'=>array('index'),
    '新增'
)); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>