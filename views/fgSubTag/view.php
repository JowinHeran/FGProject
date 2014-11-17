<?php echo TbHtml::breadcrumbs(array(
    '標籤設定'=>array('index'),
    '修改('.$model->id.')'=>array('update','id'=>$model->id),
    '檢視'
)); ?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
        array('name'=>'tag_id','value'=>$model->tag->name),
		'name',
		'remark',
	),
)); ?>