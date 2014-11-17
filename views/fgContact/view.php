<?php echo TbHtml::breadcrumbs(array(
    '聯絡人設定'=>array('index'),
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
		'name',
		'nickname',
		'account',
		'password',
		array('name'=>'level_id','value'=>$model->level->name),
		array('name'=>'place_id','value'=>$model->place->name),
		array('name'=>'branch_id','value'=>$model->branch->name),
		array('name'=>'brand_id','value'=>$model->brand->name),
		'birthday',
		array(
			'header'=>'性別',
			'value'=>'(!$data->gender)?("男"):("女")',
		),
		'tel',
		'mobile',
		'email',
	),
)); ?>