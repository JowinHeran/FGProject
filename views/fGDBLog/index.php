<?php echo TbHtml::breadcrumbs(array(
    '程式修改紀錄'=>'#',
    '列表'
)); ?>

<?php 
    $common = new CommonFunction();
    $btnArr = $common->display($this->id);
?>

<div style="float:right">
<?php
   $user_id = $_GET['user_id'];
   
   $model = FgUser::model()->findAll();
   $modelArr = CHtml::listData($model,'id','name');
   echo TbHtml::dropDownList('user','',$modelArr,array('id'=>'user_click','empty'=>'請選擇使用者','options'=>array($user_id=>array("selected"=>true))));
?>
</div>
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
            'name'=>'操作名稱',
            'value'=>'$data->name'
        ), 
            array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'更新日期',
            'value'=>'$data->updatedate'
        ), 
        $btnArr,
	),
	// 'itemView'=>'_view',
)); ?>
<?php 
// $this->widget('bootstrap.widgets.TbListView',array(
// 	'dataProvider'=>$dataProvider,
// 	'itemView'=>'_view',
// )); ?>
<script type="text/javascript">
$('#user_click').change(function(){
  var url = "<?=$this->createUrl('/FG_Manage_2/FGDBLog/index/user_id/')?>";
  var option = $(this).val();
  location.href = url + '/' + option;
});
</script>