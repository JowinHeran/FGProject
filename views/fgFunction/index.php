<?php
    $str_js = "
        var fixHelper = function(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        };
 
        $('#project-grid table.items tbody').sortable({
            forcePlaceholderSize: true,
            forceHelperSize: true,
            items: 'tr',
            update : function () {
                
                serial = $('#project-grid table.items tbody').sortable('serialize', {key: 'items[]', attribute: 'class'});
                $.ajax({
                    'url': '" . $this->createUrl('fgFunction/Sort') . "',
                    'type': 'post',
                    'data': serial,
                    'success': function(data){
                    },
                    'error': function(request, status, error){
                        alert('We are unable to set the sort order at this time.  Please try again in a few minutes.');
                    }
                });
            },
            helper: fixHelper
        }).disableSelection();
    ";
    // Yii::app()->clientScript->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js');
    // Yii::app()->clientScript->registerScript('sortable-project', $str_js);
?>
<?php echo TbHtml::breadcrumbs(array(
    '功能設定'=>'#',
    '列表'
)); ?>

<?php 
    $common = new CommonFunction();
    $btnArr = $common->display($this->id);
?>

<?php
 $this->widget('zii.widgets.grid.CGridView',array(
  'id'=>'project-grid',
  'rowCssClassExpression'=>'"items[]_{$data->id}"',
 'dataProvider'=>$dataProvider,
  'pager'=>array(
                'prevPageLabel' =>'上一頁',
                'firstPageLabel' => '首頁', 
                'nextPageLabel' => '下一頁',
                'lastPageLabel' => '末頁',
                'header' => '',
     ),
  'columns'=>array(
         array(
           'htmlOptions'=>array('width'=>"40px",'style'=>'text-align: center'),
            'name'=>'流水號',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'功能名稱',
            'value'=>'$data->name'
        ), 
        array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'父功能類別',
            'value'=>'($data->function_id!="")?(FgFunction::model()->findByPk($data->function_id)->name):(未設定)'
        ), 
         array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'URL位置',
            'value'=>'$data->url'
        ), 
       array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'排序',
            'value'=>'$data->seq'
        ), 
        $btnArr,
    ),
)); ?>
