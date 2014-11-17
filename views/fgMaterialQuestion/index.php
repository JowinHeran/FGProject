<?php echo TbHtml::breadcrumbs(array(
    "來源素材:".$topModel->name=>array('/FG_Manage_2/fGMaterial/index'),
    '互動設定'=>'#',
    '列表'
)); ?>

<?php 
    $common = new CommonFunction();
    $btnArr = $common->display($this->id);
?>

<a href="<?= Yii::app()->createUrl("FG_Manage_2/FgMaterialQuestionResult/index",array("material_id"=>$topModel->id)) ?>" id="mutualLink">
    互動結果設定
</a>

<?php
$this->widget('zii.widgets.grid.CGridView',array(
	'dataProvider' => $dataProvider,
	'columns'=>array(
		array(
           'htmlOptions'=>array('width'=>"20px",'style'=>'text-align: center'),
            'name'=>'流水號',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        array(
        	'htmlOptions'=>array('width'=>"40px",'style'=>'text-align: center'),
        	'name'=>'互動類型',
        	'value'=>'CustomParams::$paramsMaterialQuestionType[$data->type]',
        ),
        array(
        	'htmlOptions'=>array('width'=>"40px",'style'=>'text-align: center'),
        	'name'=>'題目',
        	'value'=>'$data->name',
        ),
//        array(
//        	'htmlOptions'=>array('width'=>"40px",'style'=>'text-align: center'),
//        	'name'=>'選項1',
//        	'value'=>'$data->item1',
//        ),
//        array(
//        	'htmlOptions'=>array('width'=>"40px",'style'=>'text-align: center'),
//        	'name'=>'選項2',
//        	'value'=>'$data->item2',
//        ),
//        array(
//        	'htmlOptions'=>array('width'=>"40px",'style'=>'text-align: center'),
//        	'name'=>'選項3',
//        	'value'=>'$data->item3',
//        ),
//        array(
//        	'htmlOptions'=>array('width'=>"40px",'style'=>'text-align: center'),
//        	'name'=>'選項4',
//        	'value'=>'$data->item4',
//        ),
//        array(
//        	'htmlOptions'=>array('width'=>"40px",'style'=>'text-align: center'),
//        	'name'=>'選項5',
//        	'value'=>'$data->item5',
//        ),
        
        $btnArr,
	),
));
?>
<?php 
// $this->widget('bootstrap.widgets.TbListView',array(
// 	'dataProvider'=>$dataProvider,
// 	'itemView'=>'_view',
// )); ?>

<script>
$(function(){
        if('<?= $addBtnCancel?>' == true)
            $(".breadcrumb").next(".btn-primary").hide();
        
        $("#mutualLink").hide();
        
        if(<?= $optionCount ?> > 1){
            $("#mutualLink").show();
        }
        
})    
</script>