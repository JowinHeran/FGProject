<?php echo TbHtml::breadcrumbs(array(
    '程式修改紀錄'=>array('index'),
    '搜尋'
)); ?>


<?php

$gridColumns = array(
	array('name'=>'id', 'header'=>'流水號', 'htmlOptions'=>array('style'=>'width: 60px'),'filter'=>false,),
                    array(
                        'name'=>'mac', 
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
                        'htmlOptions'=>array('width'=>"100px",'style'=>'text-align: left;'),
                        'name'=>'content', 
                        'value'=> function($data){
                            return substr($data->content, 0,100);
                        },
                         'filter'=>false,
                        ),
	array('name'=>'create_time',),
                   array('name'=>'create_ip',),
	array(            // display a column with "view", "update" and "delete" buttons
                            'htmlOptions'=>array('width'=>"40px",'style'=>'text-align: center'),
                            'class'=>'CButtonColumn',
                             'template'=>'{view}',
                            'buttons'=>array(
                                        'view'=>array(
                                                                    'label'=>'詳細資料',
                                                        ),
                                        ),
                            ),
	
);
?>

<?php $this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'fg-device-grid',
	'dataProvider'=>$model->search(),
                    'pager'=>array(
                                'prevPageLabel' =>'上一頁',
                                'firstPageLabel' => '首頁', 
                                'nextPageLabel' => '下一頁',
                                'lastPageLabel' => '末頁',
                                'header' => '',
                     ),
	'filter'=>$model,
                   'columns'=>$gridColumns,
)); ?>