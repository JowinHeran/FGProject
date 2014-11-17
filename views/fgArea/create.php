<?php echo TbHtml::breadcrumbs(array(
	"地區設定"=>array("index"),
	"新增"
));?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>