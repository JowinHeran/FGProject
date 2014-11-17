<?php echo TbHtml::breadcrumbs(array(
	"素材推播設定"=>array("index"),
	"新增"
));?>


<?php $this->renderPartial('_form', array('model'=>$model,'oPackage'=>$oPackage,'oPackageItem'=>$oPackageItem)); ?>