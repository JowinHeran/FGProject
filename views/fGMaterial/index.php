<?php echo TbHtml::breadcrumbs(array(
    '素材管理'=>'#',
    '列表'
)); ?>


<?php 
    $common = new CommonFunction();
    $btnArr = $common->display($this->id);
?>
<?php $this->widget('zii.widgets.grid.CGridView',array(
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
            'name'=>'ID',
            'value'=>'$data->id'
        ), 
         array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'品牌',
            'value'=>'$data->oBrand->name'
        ), 
       
         array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'篇名',
            'value'=>'$data->name'
        ), 
        array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'裝置類型',
            'value'=>'$data->oDeviceType->name'
        ), 
       
       array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            // 'name'=>'圖片(水平)',
            'name'=>'素材(橫)',
            'type'=>'image',
            'value'=>'$data->getImagePath()'
        ), 
        array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            // 'name'=>'圖片(垂直)',
            'name'=>'素材(直)',
            'type'=>'image',
            'value'=>'$data->getImage_vPath()'
        ), 
//         array(
//            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
//            'name'=>'影片',
//            'type'=>'image',
//            'value'=>'$data->getMoviePath()'
//        ), 
//         array(
//            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
//            'name'=>'網址',
//            'value'=>'$data->url'
//        ), 
        array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            // 'name'=>'互動',
            'name'=>'進階互動',
            'type'=>'raw',
            // 'value'=>'CHtml::link(互動,Yii::app()->createUrl("FG_Manage_2/FgMaterialQuestion/index",array("material_id"=>$data->id)))'
            'value'=>'CHtml::link(進階互動,Yii::app()->createUrl("FG_Manage_2/FgMaterialQuestion/index",array("material_id"=>$data->id)))'
        ), 
        array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            // 'name'=>'互動分析',
            'name'=>'活動互動紀錄',
            'type'=>'raw',
            // 'value'=>'CHtml::link(互動分析,Yii::app()->createUrl("FG_Manage_2/FgMaterialQuestionResult/index",array("material_id"=>$data->id)))'
            'value'=>'CHtml::link(活動互動紀錄,Yii::app()->createUrl("FG_Manage_2/FgBroadcastFeedback/index",array("material_id"=>$data->id)))'
        ),
        $btnArr,
    ),
)); ?>
<?php 
// $this->widget('bootstrap.widgets.TbListView',array(
// 	'dataProvider'=>$dataProvider,
// 	'itemView'=>'_view',
// )); ?>