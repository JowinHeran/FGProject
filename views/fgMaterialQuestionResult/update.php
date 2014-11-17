<?php echo TbHtml::breadcrumbs(array(
        '互動設定'=>array('/FG_Manage_2/fgMaterialQuestion/index','material_id'=>$model->material_id),
	"互動結果設定"=>array("index",'material_id'=>$model->material_id),
	"檢視($model->id)"=>array("view","id"=>$model->id),
	"修改"
));?>


<?php $this->renderPartial('_form', array('model'=>$model,'topModel'=>$topModel,'questionLists'=>$questionLists,'answerArray'=>$answerArray)); ?>