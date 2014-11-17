<?php echo TbHtml::breadcrumbs(array(
    '聯絡人'=>array('index'),
    '修改('.$model->id.')'=>array('update','id'=>$model->id),
    '檢視'
)); ?>

<?php 
$this->widget('zii.widgets.grid.CGridView',array(
    'htmlOptions' => array(
        // 'class' => 'table table-striped table-condensed table-hover',
    ),
    'dataProvider'=>$model,
    'pager'=>array(
                'prevPageLabel' =>'上一頁',
                'firstPageLabel' => '首頁', 
                'nextPageLabel' => '下一頁',
                'lastPageLabel' => '末頁',
                'header' => '',
     ),
    'columns'=>array(
		'position',
		'name',
		'birthday',
		'gender',
		'tel',
		'fax',
		'mobile',
		'email',
		array(            // display a column with "view", "update" and "delete" buttons
                'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
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
		// array('name'=>'level_id','value'=>$model->level->name),
		// array('name'=>'place_id','value'=>$model->place->name),
		// array('name'=>'branch_id','value'=>$model->branch->name),
		// array('name'=>'brand_id','value'=>$model->brand->name),
		// 'birthday',
		// 'gender',
		
		// 'mobile',
		
	),
)); ?>