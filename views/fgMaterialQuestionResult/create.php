<?php echo TbHtml::breadcrumbs(array(
        '互動設定'=>array('/FG_Manage_2/fgMaterialQuestion/index','material_id'=>$topModel->id),
	"互動結果設定"=>array("index",'material_id'=>$topModel->id),
	"新增"
));?>


<?php $this->renderPartial('_form', array('model'=>$model,'topModel'=>$topModel,'questionLists'=>$questionLists)); ?>