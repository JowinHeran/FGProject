<?php echo TbHtml::breadcrumbs(array(
    '標籤設定'=>array('index'),
    '搜尋'
)); ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'tag-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'remark',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>