<?php echo TbHtml::breadcrumbs(array(
    '地區設定'=>'#',
    '列表'
)); ?>

<?php 
    $common = new CommonFunction();
    $btnArr = $common->display($this->id);
?>

<?php 

$this->widget('zii.widgets.grid.CGridView',array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
	           'htmlOptions'=>array('width'=>"20px",'style'=>'text-align: center'),
	            'name'=>'流水號',
	            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        array(
        	'htmlOptions'=>array('width'=>'20px','style'=>'text-align: center'),
        	'name'=>'縣市',
        	'value'=>'$data->city->name',
        ),
        array(
        	'htmlOptions'=>array('width'=>'20px','style'=>'text-align: center'),
        	'name'=>'地區',
        	'value'=>'$data->name',
        ),
        array(
        	'htmlOptions'=>array('width'=>'20px','style'=>'text-align: center'),
        	'name'=>'排序',
        	'value'=>'$data->seq',
        ),
        $btnArr,
	),
)); 
?>