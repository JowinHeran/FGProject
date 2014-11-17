<?php echo TbHtml::breadcrumbs(array(
    '分店設定'=>'#',
    '列表'
)); ?>

<?php 
    $common = new CommonFunction();
    $btnArr = $common->display($this->id);
?>
<?php $this->widget('zii.widgets.grid.CGridView',array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
           'htmlOptions'=>array('width'=>"20px",'style'=>'text-align: center'),
            'name'=>'流水號',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        array(
        	'htmlOptions'=>array('width'=>"20px",'style'=>'text-align: center'),
        	'name'=>'分店名稱',
        	'value'=>'$data->name',
        ),
        array(
        	'htmlOptions'=>array('width'=>"20px",'style'=>'text-align: center'),
        	'name'=>'通路名稱',
        	'value'=>'$data->place->name',
        ),
        // array(
        // 	'htmlOptions'=>array('width'=>"20px",'style'=>'text-align: center'),
        // 	'name'=>'縣市名稱',
        // 	'value'=>'$data->area->name',
        // ),
        array(
        	'htmlOptions'=>array('width'=>"20px",'style'=>'text-align: center'),
        	'name'=>'分店位置',
        	'value'=>'$data->area->name',
        ),
         $btnArr,
	),
)); ?>