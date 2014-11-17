<?php echo TbHtml::breadcrumbs(array(
	"素材推播設定"=>array('index'),
	"修改($model->id)"=>array('update','id'=>$model->id),
	"檢視"
));?>
<div style="float:right">
子標籤:<br>
<?php 
	$tagArr = explode(',', $model->sub_tag);
	foreach ($tagArr as $value) {
		$subModel = FgSubTag::model()->findByPk($value+1);
		echo $subModel->name."<br>";
	}
?>
</div>
<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		array('name'=>'篇名','value'=>$model->getMaterial("material")),
		array('name'=>'品牌','value'=>$model->getMaterial("brand")),
		'name',
        's_date',
        'e_date',
        array('name'=>'status','value'=>$model->getStatus()),
	),
)); ?>