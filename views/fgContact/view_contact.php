<?php echo TbHtml::breadcrumbs(array(
    '聯絡人資料管理'=>array('index'),
    '修改('.$_GET['id'].')'=>array('update','id'=>$_GET['id']),
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
        array(
            'header'=>'姓名',
            'value'=>'$data->first_name.$data->second_name',
        ),
		'birthday',
		array(
            'header'=>'性別',
            'value'=>'(!$data->gender)?("男"):("女")',
        ),
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