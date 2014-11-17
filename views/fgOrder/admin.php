<?php echo TbHtml::breadcrumbs(array(
	"縣市設定"=>array('index'),
	"搜尋"
));?>


<?php

$gridColumns = array(
	array('name'=>'id', 'header'=>'流水號', 'htmlOptions'=>array('style'=>'width: 60px')),
	array('name'=>'name', 'header'=>'縣市'),
	array('name'=>'direction.name', 'header'=>'區域','filter'=>CHtml::activeTextField($model,'direction')),
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
	'id'=>'fg-city-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>$gridColumns,
	
)); ?>
