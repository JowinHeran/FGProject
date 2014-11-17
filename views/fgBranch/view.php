<?php echo TbHtml::breadcrumbs(array(
    '分店設定'=>array('index'),
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
		array('name'=>'place_id','value'=>$model->place->name),
		array('name'=>'city_id','value'=>$model->city->name),
		array('name'=>'area_id','value'=>$model->area->name),
	),
)); ?>