<?php echo TbHtml::breadcrumbs(array(
	"素材包設定"=>array('index','material_id'=>$topModel->id),
	"搜尋"
));?>


<?php

$gridColumns = array(
	array('name'=>'id', 'header'=>'流水號', 'htmlOptions'=>array('style'=>'width: 60px'),'filter'=>false),
        array('name'=>'type', 
            'header'=>'題目類型',
            'value'=>'CustomParams::$paramsMaterialQuestionType[$data->type]',
            'filter'=>CHtml::dropDownList('FgMaterialQuestion[type]',
                    "type",
                    CustomParams::$paramsMaterialQuestionType,
                    array('options' => array($model->type=>array('selected'=>true)))
                    )
            ),
	array('name'=>'name', 'header'=>'問題'),
//        array('name'=>'item1', 'header'=>'選項1','filter'=>false),
//        array('name'=>'item2', 'header'=>'選項2','filter'=>false),
//        array('name'=>'item3', 'header'=>'選項3','filter'=>false),
//        array('name'=>'item4', 'header'=>'選項4','filter'=>false),
//        array('name'=>'item5', 'header'=>'選項5','filter'=>false),
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
	'id'=>'fg-city-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>$gridColumns,
	
)); ?>
