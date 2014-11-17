<?php echo TbHtml::breadcrumbs(array(
    '程式修改紀錄'=>array('index'),
  
    '檢視'
)); ?>
<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'mac',
                                      'content',
		'create_time',
                                       'create_ip',
	),
)); ?>