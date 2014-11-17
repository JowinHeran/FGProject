<?php echo TbHtml::breadcrumbs(array(
    "素材設定"=>array("index"),
   '修改('.$model->id.')'=>array('update','id'=>$model->id),
    "檢視"
));?>

<?php
    $aa = '<video width="320" height="240" controls>
                <source src="'.$model->getMoviePath().'" type="video/mp4">
                <source src="'.$model->getMoviePath().'" type="video/ogg">
                你您瀏覽器不支援影片撥放
            </video>';
?>
<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
                            'id',
                            array('name'=>'brand_id','value'=>$model->oBrand->name),
                            'name',
                            array('name'=>'device_type_id','value'=>$model->oDeviceType->name),
                            // (!$model->getImagePath())?("image"):(array('label'=>"圖片(水平)",'type'=>'image','value'=>$model->getImagePath(),)),
                            // (!$model->getImage_vPath())?("image_v"):(array('label'=>"圖片(垂直)",'type'=>'image','value'=>$model->getImage_vPath())),
                            (!$model->getImagePath())?("image"):(array('label'=>"素材(橫)",'type'=>'image','value'=>$model->getImagePath(),)),
                            (!$model->getImage_vPath())?("image_v"):(array('label'=>"素材(直)",'type'=>'image','value'=>$model->getImage_vPath())),
                            (!$model->getMoviePath())?("movie"):
                            (array('label'=>"影片",
                                        'type'=>'raw',
                                        'value'=> $aa
                                    )
                            ),
                            'url',
                            'remark'
	),
)); ?>
<style>
    img{
        max-width:600px;
    }    
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('#deleteMaterial').click(function(){
            var isDelete = confirm("確定刪除此素材?");
            var url = <?="'".Yii::app()->createUrl('/FG_Manage_2/fGMaterial/delete',array("id"=>$model->id))."'"?>;
            if(isDelete){
                $.ajax({
                  type: "POST",
                  url: url,
                  success: function(){
                    alert('刪除成功!');
                    setTimeout(function(){history.go(-2);},1000);
                  }
                });
            }
        });
    });
</script>