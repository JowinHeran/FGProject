<?php echo TbHtml::breadcrumbs(array(
    '權限設定'=>array('index'),
    '搜尋'
)); ?>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div style="float: right;">
<?php 
    $actionName = Yii::app()->controller->action->id;
    $this->showRightLinkButton($actionName);
?>
</div>
<br/>
<?php $this->widget('bootstrap.components.GroupGridView',array(
	'id'=>'fg-device-grid',
	'dataProvider'=>$model->search(),
                    'pager'=>array(
                                'prevPageLabel' =>'上一頁',
                                'firstPageLabel' => '首頁', 
                                'nextPageLabel' => '下一頁',
                                'lastPageLabel' => '末頁',
                                'header' => '',
                     ),
	'filter'=>$model,
    'mergeColumns' => array('level_id'), 
    'columns'=>array(
        array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'header'=>'頭銜名稱',
            'name'=>'level_id',
            'value'=>'$data->level->name'
        ), 
       array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'header'=>'功能名稱',
            'name'=>'function_id',
            'value'=>'$data->function->name'
        ), 
       array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'header'=>'新增',
            'name'=>'ins',
             'type'=>'html',
            'value'=>'($data->ins==1)?(TbHtml::icon(TbHtml::ICON_OK)):(TbHtml::icon(TbHtml::ICON_REMOVE))'
        ), 
      array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'header'=>'修改',
            'name'=>'upd',
             'type'=>'html',
            'value'=>'($data->upd==1)?(TbHtml::icon(TbHtml::ICON_OK)):(TbHtml::icon(TbHtml::ICON_REMOVE))'
        ), 
      array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'header'=>'刪除',
            'name'=>'del',
             'type'=>'html',
            'value'=>'($data->del==1)?(TbHtml::icon(TbHtml::ICON_OK)):(TbHtml::icon(TbHtml::ICON_REMOVE))'
        ), 
      array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'header'=>'查詢',
            'name'=>'sel',
             'type'=>'html',
            'value'=>'($data->sel==1)?(TbHtml::icon(TbHtml::ICON_OK)):(TbHtml::icon(TbHtml::ICON_REMOVE))'
        ), 
      array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'header'=>'列印',
            'name'=>'print',
            'type'=>'html',
            'value'=>'($data->print==1)?(TbHtml::icon(TbHtml::ICON_OK)):(TbHtml::icon(TbHtml::ICON_REMOVE))'
        ), 
    ),
)); ?>