<?php echo TbHtml::breadcrumbs(array(
	"地區設定"=>array("index"),
	"搜尋"
));?>


<?php

$gridColumns = array(
	array('name'=>'id', 'header'=>'流水號', 'htmlOptions'=>array('style'=>'width: 60px')),
	// array('name'=>'city.name', 'header'=>'縣市','filter'=>CHtml::activeTextField($model,'city')),
    array('name'=>'city_id','value'=>'$data->city->name', 'header'=>'縣市','filter'=>CHtml::listData(FgCity::model()->findAll(), 'id', 'name')),
    // array('name'=>'city_id','value'=>'$data->city->name', 'header'=>'縣市','filter'=>CHtml::activeInputField('text',FgCity::model()->findAll(),'','')),
	array('name'=>'name', 'header'=>'地區'),
	array('name'=>'seq', 'header'=>'排序'),
	array(            // display a column with "view", "update" and "delete" buttons
            'htmlOptions'=>array('width'=>"40px",'style'=>'text-align: center'),
            'class'=>'CButtonColumn',
            'deleteConfirmation'=>'確定刪除此項目嗎?',
            'buttons'=>array(
                        'view'=>array(
                                                    'label'=>'詳細資料',
                                        ),
                        'update'=>array(
                                   'label'=>'更新',
                       ),
                        'delete'=>array(
                                                    'label'=>'刪除',
                                                    ),
                        ),
        ),
	
);
?>
<?php $this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'fg-area-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>$gridColumns,
)); ?>