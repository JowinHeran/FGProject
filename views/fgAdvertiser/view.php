<?php echo TbHtml::breadcrumbs(array(
    '客戶資料管理'=>array('index'),
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
        array('name'=>'name','header'=>'廣告主名稱','value'=>$model->name),
		array('name'=>'brand_id','header'=>'品牌名稱','value'=>$model->fgbrand->name),
        array('name'=>'exe_status','header'=>'執行狀態','type'=>'raw','value'=>$model->getIcon()),
        array('name'=>'最新篇名','header'=>'最新篇名','type'=>'raw','value'=>$model->getMaterial("name")),
        array('name'=>'最新素材預覽(橫)','header'=>'最新素材預覽(橫)','type'=>'raw','value'=>$model->getMaterial("image")),
        array('name'=>'聯絡窗口','header'=>'聯絡窗口','type'=>'raw','value'=>$model->getContactName()),
        // array('name'=>'email','header'=>'電子郵件','value'=>(!$model->email)?('未設置'):($model->email)),
       
		
	),
)); ?>