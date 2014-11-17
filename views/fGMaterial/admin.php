<?php echo TbHtml::breadcrumbs(array(
	"素材設定"=>array('index'),
	"搜尋"
));?>

<?php

$gridColumns = array(
	array('name'=>'id', 'header'=>'流水號', 'htmlOptions'=>array('style'=>'width: 60px'),'filter'=>false,),
                    array('name'=>'device_type_id', 
                        'header'=>'裝置類型',
                        'value'=>'$data->oDeviceType->name',
                        'filter'=>CHtml::listData(FgDeviceType::model()->findAll(), 'id', 'name'),
                        ),
                    array('name'=>'brand_id', 
                        'header'=>'品牌',
                        'value'=>'$data->oBrand->name',
                         'filter'=>CHtml::listData(FgBrand::model()->findAll(), 'id', 'name'),
                        ),
	array('name'=>'name', 'header'=>'名稱'),
	array('name'=>'image',
                            'type'=>'image', 
                            'value'=>'$data->getImagePath()',
                            'header'=>'圖片(水平)',
                            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
                            'filter'=>false,
                ),
	array('name'=>'image_v',
                            'type'=>'image', 
                            'value'=>'$data->getImage_vPath()',
                            'header'=>'圖片(垂直)',
                            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
                            'filter'=>false,
                    ),
//                   array('name'=>'movie','type'=>'image', 'value'=>'$data->getMoviePath()','header'=>'影片','htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center')),
//                  array('name'=>'url', 'header'=>'網址'),
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
