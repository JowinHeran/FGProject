<?php echo TbHtml::breadcrumbs(array(
    '客戶資料管理'=>'#',
    '列表'
)); ?>

<?php 
    $common = new CommonFunction();
    $btnArr = $common->display($this->id);
?>

<?php
 $this->widget('zii.widgets.grid.CGridView',array(
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
           'htmlOptions'=>array('width'=>"120px",'style'=>'text-align: center'),
            'name'=>'公司',
            'value'=>'$data->name'
        ),
        array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'品牌',
            'type'=>'raw',
            'value'=>'$data->getBrand()'
        ), 
        array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'執行狀態',
            'type'=>'raw',
            'value'=>'$data->getIcon()',
        ), 
       array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'最新篇名',
            'type'=>'raw',
            'value'=>'$data->getMaterial("name")',
       ), 
        array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'最新素材預覽(橫)',
            'type'=>'raw',
            'value'=>'$data->getMaterial("image")',
       ), 
       array(
            'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
            'name'=>'聯絡窗口',
            'type'=>'raw',
            'value'=>'$data->getContactName()',
            // 'value'=>'$data->isEmptyName("user","聯絡窗口未設置","fgUser/viewcontact/id/".$data->id)',
       ), 
       // array(
       //      'htmlOptions'=>array('width'=>"80px",'style'=>'text-align: center'),
       //      'name'=>'排序',
       //      'value'=>'$data->seq'
       //  ), 
        $btnArr,
    ),
)); ?>
