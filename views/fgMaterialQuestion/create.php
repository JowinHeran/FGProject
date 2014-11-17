<?php echo TbHtml::breadcrumbs(array(
	"互動設定"=>array("index",'material_id'=>$topModel->id),
	"新增"
));?>


<?php $this->renderPartial('_form', array('model'=>$model,'topModel'=>$topModel)); ?>