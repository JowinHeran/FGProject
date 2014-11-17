<?php echo TbHtml::breadcrumbs(array(
    '標籤設定'=>array('index'),
    '檢視('.$model->id.')'=>array('view','id'=>$model->id),
    '修改'
)); ?>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>