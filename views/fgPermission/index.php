<?php echo TbHtml::breadcrumbs(array(
    '權限設定'=>'#',
    '列表'
)); ?>

<?php echo TbHtml::linkButton('新增', 
                                                        array(
                                                            'icon'=>'plus',
                                                            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                                                            'url'=>Yii::app()->createUrl('/FG_Manage_2/FgPermission/create')
                                                        )); 
?>&nbsp;
<?php echo TbHtml::linkButton('搜尋', 
                                                        array(
                                                            'icon'=>'search',
                                                            'color' => TbHtml::BUTTON_COLOR_INFO,
                                                            'url'=>Yii::app()->createUrl('/FG_Manage_2/FgPermission/admin')
                                                       )); ?>
<div style="float:right">
<?php
  $actionName = Yii::app()->controller->action->id;
    $this->showRightLinkButton($actionName);
?>
</div>
<?php
 $this->widget('bootstrap.components.GroupGridView',array(
 'dataProvider'=>$dataProvider,
  'pager'=>array(
                'prevPageLabel' =>'上一頁',
                'firstPageLabel' => '首頁', 
                'nextPageLabel' => '下一頁',
                'lastPageLabel' => '末頁',
                'header' => '',
     ),
  'mergeColumns' => array('頭銜名稱'), 
  // 'extraRowColumns' => array('頭銜名稱'),
  //  'extraRowExpression' => '"<b style=\"font-size: 3em; color: green\">".substr($data->level->name, 0, 1)."</b>"', 
 
   'columns'=>array(
        //  array(
        //    'htmlOptions'=>array('width'=>"40px",'style'=>'text-align: center'),
        //     'name'=>'流水號',
        //     'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        // ),
        array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'頭銜名稱',
            'value'=>'$data->level->name'
        ), 
       array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'功能名稱',
            'value'=>'$data->function->name'
        ), 
       array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'新增',
             'type'=>'html',
            'value'=>'($data->ins==1)?(TbHtml::icon(TbHtml::ICON_OK)):(TbHtml::icon(TbHtml::ICON_REMOVE))'
        ), 
      array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'修改',
             'type'=>'html',
            'value'=>'($data->upd==1)?(TbHtml::icon(TbHtml::ICON_OK)):(TbHtml::icon(TbHtml::ICON_REMOVE))'
        ), 
      array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'刪除',
             'type'=>'html',
            'value'=>'($data->del==1)?(TbHtml::icon(TbHtml::ICON_OK)):(TbHtml::icon(TbHtml::ICON_REMOVE))'
        ), 
      array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'查詢',
             'type'=>'html',
            'value'=>'($data->sel==1)?(TbHtml::icon(TbHtml::ICON_OK)):(TbHtml::icon(TbHtml::ICON_REMOVE))'
        ), 
      array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'列印',
            'type'=>'html',
            'value'=>'($data->print==1)?(TbHtml::icon(TbHtml::ICON_OK)):(TbHtml::icon(TbHtml::ICON_REMOVE))'
        ), 
        array(            // display a column with "view", "update" and "delete" buttons
                'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
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
    ),
)); ?>
