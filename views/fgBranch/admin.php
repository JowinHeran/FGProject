<?php echo TbHtml::breadcrumbs(array(
    '分店設定'=>array('index'),
    '搜尋'
)); ?>





<?php

$gridColumns = array(
	array('name'=>'id', 'header'=>'流水號', 'htmlOptions'=>array('style'=>'width: 60px')),
	array('name'=>'name', 'header'=>'分店名稱'),
	array('name'=>'place_id', 'header'=>'通路名稱' ,'value'=>'$data->place->name'),
	// array('name'=>'city_id', 'header'=>'縣市名稱'  ,'value'=>'$data->city->name'),
	array('name'=>'area_id', 'header'=>'地區名稱'  ,'value'=>'$data->area->name'),
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
	'id'=>'fg-branch-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>$gridColumns,
)); ?>