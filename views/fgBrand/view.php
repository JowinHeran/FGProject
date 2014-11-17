<?php echo TbHtml::breadcrumbs(array(
    '品牌設定'=>array('index'),
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
        array('name'=>'company','header'=>'公司名稱','value'=>(!$model->company)?('未設置'):($model->company)),
		array('name'=>'name','header'=>'品牌名稱','value'=>$model->isEmpty('name','未設置品牌名稱')),
        // array('name'=>'address','header'=>'公司地址','value'=>(!$model->address)?('未設置'):($model->address)),
        // array('name'=>'phone','header'=>'連絡電話','value'=>(!$model->phone)?('未設置'):($model->phone)),
        // array('name'=>'email','header'=>'電子郵件','value'=>(!$model->email)?('未設置'):($model->email)),
        // array('name'=>'manager','header'=>'聯絡窗口','value'=>(!$model->manager)?('未設置'):($model->manager)),
		array('name'=>'seq','header'=>'排序','value'=>(!$model->seq)?('未設置'):($model->seq)),
	),
)); ?>