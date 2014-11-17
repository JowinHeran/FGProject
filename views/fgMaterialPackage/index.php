<?php echo TbHtml::breadcrumbs(array(
    '素材包設定'=>'#',
    '列表'
)); ?>
<?php 
    $common = new CommonFunction();
    $btnArr = $common->display($this->id);
?>
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
        	'name'=>'名稱',
        	'value'=>'$data->name',
        ),
        $btnArr,
	),
));
?>
<?php 
// $this->widget('bootstrap.widgets.TbListView',array(
// 	'dataProvider'=>$dataProvider,
// 	'itemView'=>'_view',
// )); ?>