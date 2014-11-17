<?php echo TbHtml::breadcrumbs(array(
	"互動設定"=>array('index','material_id'=>$model->material_id),
	"修改($model->id)"=>array('update','id'=>$model->id),
	"檢視"
));?>


<?php 
    
    $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
                array(
                    'name'=>'type',
                    'value'=>CustomParams::$paramsMaterialQuestionType[$model->type]
                ),
		'name',
                array(
                    'name'=>"background_image",
                    'type'=>'raw',
                    'value'=>"<img src='".$model->getFilePath(1)."' width=150>",
                ),
                 array(
                     'name'=>'background_voice',
                     'type'=>'raw',
                     'value'=>"<audio src='".$model->getFilePath(2)."' controls='controls'>
                                Your browser does not support the audio tag.
                              </audio>",
                 ),

                array(
                    'name'=>'link_type',
                    'value'=>CustomParams::$paramsMaterialType[$model->link_type],
                    'visible'=>$model->type == 1,
                ),
                array(
                    'name'=>'link_file',
                    'visible'=>$model->type == 1 && $model->link_type != 3,
                ),
                array( 
                    'name'=>'link_link',
                    'visible'=>$model->type == 1 && $model->link_type == 3,
                ),
        
                array(
                   'name'=>'item1',
                   'visible'=>$model->type != 1,
                ),
                 array(
                    'name'=>'item1_type',
                    'value'=>CustomParams::$paramsMaterialType[$model->item1_type],
                     'visible'=>$model->type != 1 && $model->item1_type != 0,
                ),
                 array(
                    'name'=>'item1_file',
                     'visible'=>$model->type != 1 && $model->item1_type != 3 && $model->item1_type != 0,
                ),
                array(
                    'name'=>'item1_link',
                    'visible'=>$model->type != 1 && $model->item1_type == 3 && $model->item1_type != 0,
                ),
        
                array(
                    'name'=>'item2',
                    'visible'=>$model->type != 1,
                ),
                array(
                    'name'=>'item2_type',
                    'value'=>CustomParams::$paramsMaterialType[$model->item2_type],
                    'visible'=>$model->type != 1 && $model->item2_type != 0,
                ),
                array(
                    'name'=>'item2_file',
                    'visible'=>$model->type != 1 && $model->item2_type != 3 && $model->item2_type != 0,
                ),
                array(
                    'name'=>'item2_link',
                    'visible'=>$model->type != 1 && $model->item2_type == 3 && $model->item2_type != 0,
                ),
        
                array(
                    'name'=>'item3',
                    'visible'=>$model->type != 1,
                ),
                array(
                    'name'=>'item3_type',
                    'value'=>CustomParams::$paramsMaterialType[$model->item3_type],
                    'visible'=>$model->type != 1 && $model->item3_type != 0,
                ),
                array(
                    'name'=>'item3_file',
                    'visible'=>$model->type != 1 && $model->item3_type != 3 && $model->item3_type != 0,
                ),
                array(
                    'name'=>'item3_link',
                    'visible'=>$model->type != 1 && $model->item3_type == 3 && $model->item3_type != 0,
                ),
        
                array(
                    'name'=>'item4',
                    'visible'=>$model->type != 1,
                ),
                array(
                    'name'=>'item4_type',
                    'value'=>CustomParams::$paramsMaterialType[$model->item4_type],
                    'visible'=>$model->type != 1 && $model->item4_type != 0,
                ),
                array(
                    'name'=>'item4_file',
                    'visible'=>$model->type != 1 && $model->item4_type != 3 && $model->item4_type != 0,
                ),
                array(
                    'name'=>'item4_link',
                    'visible'=>$model->type != 1 && $model->item4_type == 3 && $model->item4_type != 0,
                ),
        
                array(
                    'name'=>'item5',
                    'visible'=>$model->type != 1,
                ),
                array(
                    'name'=>'item5_type',
                    'value'=>CustomParams::$paramsMaterialType[$model->item5_type],
                    'visible'=>$model->type != 1 && $model->item5_type != 0,
                ),
                array(
                    'name'=>'item5_file',
                    'visible'=>$model->type != 1 && $model->item5_type != 3 && $model->item5_type != 0,
                ),
                array(
                    'name'=>'item5_link',
                    'visible'=>$model->type != 1 && $model->item5_type == 3 && $model->item5_type != 0,
                ),
	),
    )); 
    
    ?>