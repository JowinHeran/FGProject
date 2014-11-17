<?php echo TbHtml::breadcrumbs(array(
    '使用者設定'=>array('index'),
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
		'gender',
		'tel',
		'mobile',
		'email',
	),
)); ?>