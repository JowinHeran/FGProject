<style>
    .font-red-color{
        color:#ff0000;
    }
</style>
<?php echo TbHtml::breadcrumbs(array(
        '互動設定'=>array('/FG_Manage_2/fgMaterialQuestion/index','material_id'=>$model->material_id),
	"互動結果設定"=>array('index','material_id'=>$model->material_id),
	"修改($model->id)"=>array('update','id'=>$model->id),
	"檢視"
));?>

<?php
    
    foreach($questionLists->data as $key=>$val){
            echo "Q".(++$key).". ".$val->name."<br>";
            
            if($val->type == 2){
                if($answerArray[$val->id] == 1)
                    echo " 1.<span class='font-red-color'>YES</span> &nbsp;&nbsp;&nbsp;&nbsp;";
                else
                    echo " 1.YES &nbsp;&nbsp;&nbsp;&nbsp;";
                
                if($answerArray[$val->id] == '0')
                    echo " 2.<span class='font-red-color'>NO</span> &nbsp;&nbsp;&nbsp;&nbsp;";
                else
                   echo " 2.NO &nbsp;&nbsp;&nbsp;&nbsp;";
                
            }else if($val->type == 3){
                if($val->item1 != ''){
                    if($answerArray[$val->id] == 1)
                        echo " 1.<span class='font-red-color'>".$val->item1."</span>&nbsp;&nbsp;&nbsp;&nbsp;";
                    else
                        echo " 1.".$val->item1."&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                    
                
                if($val->item2 != ''){
                    if($answerArray[$val->id] == 2)
                        echo " 2.<span class='font-red-color'>".$val->item2."</span>&nbsp;&nbsp;&nbsp;&nbsp;";
                    else
                        echo " 2.".$val->item2."&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                    
                
                if($val->item3 != ''){
                    if($answerArray[$val->id] == 3)
                        echo " 3.<span class='font-red-color'>".$val->item3."</span>&nbsp;&nbsp;&nbsp;&nbsp;";
                    else
                        echo " 3.".$val->item3."&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                    
                
                if($val->item4 != ''){
                    if($answerArray[$val->id] == 4)
                        echo " 4.<span class='font-red-color'>".$val->item4."</span>&nbsp;&nbsp;&nbsp;&nbsp;";
                    else
                        echo " 4.".$val->item4."&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                    
                
                if($val->item5 != ''){
                    if($answerArray[$val->id] == 5)
                        echo " 5.<span class='font-red-color'>".$val->item5."</span>";
                    else
                        echo " 5.".$val->item5;
                }
                    
            }
            
            echo "<br>";
        }
?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		//'id',
		//'answer',
                'remark',
                array(
                  'name'=>'link_type',
                  'value'=>CustomParams::$paramsMaterialType[$model->link_type],
                ),
                array(
                    'name'=>'link_file',
                    'visible'=>$model->link_type != 3,
                ),
                array(
                    'name'=>'link_url',
                    'visible'=>$model->link_type == 3,
                ),
	),
)); ?>