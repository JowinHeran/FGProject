<?php echo TbHtml::breadcrumbs(array(
    '使用者設定'=>array('index'),
    '檢視('.$model->id.')'=>array('view','id'=>$model->id),
    '修改'
)); ?>

<?php $this->renderPartial('_form', array('model'=>$model,'selectItem'=>$selectItem)); ?>