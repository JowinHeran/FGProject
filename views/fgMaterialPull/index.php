<?php echo TbHtml::breadcrumbs(array(
    '程式修改紀錄'=>'#',
    '列表'
)); ?>

<?php echo TbHtml::linkButton('搜尋', 
                                                        array(
                                                            'icon'=>'search',
                                                            'color' => TbHtml::BUTTON_COLOR_INFO,
                                                            'url'=>Yii::app()->createUrl('/FG_Manage_2/FgMaterialPull/admin')
                                                       )); ?>

<?php 
$this->widget('zii.widgets.grid.CGridView',array(
	'dataProvider'=>$dataProvider,
    'pager'=>array(
                'prevPageLabel' =>'上一頁',
                'firstPageLabel' => '首頁', 
                'nextPageLabel' => '下一頁',
                'lastPageLabel' => '末頁',
                'header' => '',
     ),
          'columns'=>array(
		array(
           'htmlOptions'=>array('width'=>"40px",'style'=>'text-align: center'),
            'name'=>'流水號',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
          array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'MAC',
            'type'=>'raw',
            'value'=>function($data){
                if($data->content_ids == ""){
                    return "<span style='color:red'>".$data->mac."</span>";
                }else{
                    return $data->mac;
                }
            }
        ), 
        array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'內容',
            'value'=>'$data->content_ids'
        ), 
            array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'新增日期',
            'value'=>'$data->create_time'
        ), 
        array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'新增IP',
            'value'=>'$data->create_ip'
        ), 
        array(            // display a column with "view", "update" and "delete" buttons
                'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
                'class'=>'CButtonColumn',
                'template'=>'{view}',
                'buttons'=>array(
                                                    'view'=>array(
                                                                                'label'=>'詳細資料',
                                                                    ),
                                                    ),
            ),
       
	),
	// 'itemView'=>'_view',
)); ?>
<?php 
// $this->widget('bootstrap.widgets.TbListView',array(
// 	'dataProvider'=>$dataProvider,
// 	'itemView'=>'_view',
// )); ?>