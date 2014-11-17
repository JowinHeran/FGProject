<?php echo TbHtml::breadcrumbs(array(
    '品牌設定'=>array('index'),
    '搜尋'
)); ?>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView',array(
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
)); ?>