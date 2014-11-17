<?php echo TbHtml::breadcrumbs(array(
	"互動設定"=>array("index",'material_id'=>$model->material_id),
	"檢視($model->id)"=>array("view","id"=>$model->id),
	"修改"
));?>


<?php $this->renderPartial('_form', array('model'=>$model,'topModel'=>$topModel)); ?>