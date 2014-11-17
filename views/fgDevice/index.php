<?php echo TbHtml::breadcrumbs(array(
    '裝置設定'=>'#',
    '列表'
)); ?>

<?php 
    $common = new CommonFunction();
    $btnArr = $common->display($this->id);
?>

<br/><br/>
<a href="<?= Yii::app()->createUrl('/FG_Manage_2/FgDevice/index',array('unSet'=>1))?>">未認領裝置(<?= $unSetCount?>)</a>
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
            'name'=>'分店',
            'value'=>'$data->branch->name'
        ), 
        array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'裝置名稱',
            'value'=>'$data->name'
        ), 
         array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'機台序號',
             'type'=>'raw',
            'value'=> function($data){
                if(empty($data->branch_id)){
                    return "<span style='color:red'>".$data->mac."</span>";
                }else{
                    return $data->mac;
                }
            }
        ), 
      array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'裝置類型',
            'value'=> '$data->deviceType->name'
        ), 
        array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'機種',
            'value'=> '$data->marketType->name'
        ), 
      array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'新增時間',
            'value'=>'$data->create_time'
        ), 
       $btnArr,
    ),
)); ?>
