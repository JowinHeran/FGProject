<?php echo TbHtml::breadcrumbs(array(
    '素材管理'=>array("index"),
    '新增素材'
)); ?>




<?php $this->renderPartial('_form', array('model'=>$model,'selectItem'=>$selectItem)); ?>