<?php echo TbHtml::breadcrumbs(array(
	"地區設定"=>array('index'),
	"檢視($model->id)"=>array('view','id'=>$model->id),
	"更新"
));?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>