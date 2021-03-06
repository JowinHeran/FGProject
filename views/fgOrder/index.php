<?php echo TbHtml::breadcrumbs(array(
    '素材推播設定'=>'#',
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
           'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'流水號',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
//        'odr_no',
        array(
            'htmlOptions'=>array('width'=>'100px'),
            'header'=>'篇名',
            'type'=>'raw',
            'name'=>'material_name',
            'value'=>'$data->getMaterial("material")',
        ),
        array(
            'htmlOptions'=>array('width'=>'100px'),
            'header'=>'品牌',
            'type'=>'raw',
            'name'=>'brand_name',
            'value'=>'$data->getMaterial("brand")',
        ),
        array(
            'htmlOptions'=>array('width'=>"100px"),
            'header'=>'通路',
            'type'=>'raw',
            'name'=>'place_name',
            'value'=>'$data->getPlace()',
        ),
        array(
            'htmlOptions'=>array('width'=>'100px'),
            'header'=>'素材預覽(橫)',
            'type'=>'raw',
            'name'=>'mimage',
            'value'=>'$data->getMaterial("mimage")',
        ),
        array(
            'htmlOptions'=>array('width'=>'100px'),
            'header'=>'進階互動(Yes/No)',
            'type'=>'raw',
            'name'=>'question',
            'value'=>'$data->getMaterial("question")',
        ),
        'name',
        's_date',
        'e_date',
        array(
            'htmlOptions'=>array('width'=>'100px'),
            'header'=>'執行狀態',
            'name'=>'status',
            'value'=>'$data->getStatus()',
        ),
         array(
            'htmlOptions'=>array('width'=>'100px'),
            'header'=>'活動成效',
            'type'=>'raw',
            'name'=>'question',
            'value'=>'$data->getMaterial("remark")',
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