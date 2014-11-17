<?php
$this->breadcrumbs=array(
	$this->module->id,
);
// $this->renderPartial('menu');
?>

<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
			             array('label'=>'會員設定', 'url'=>array('/FG_Manage_2/FGMember/index'),'active' => $this->main_menu == 'default' ? true : false),
			             array('label'=>'素材設定', 'url'=>array('/FG_Manage_2/fGMaterial/index'),'active' => $this->main_menu == 'fgmaterial' ? true : false),
			             array('label'=>'操作紀錄', 'url'=>array('/FG_Manage_2/FGDBLog/index'),'active' => $this->main_menu == 'fglog' ? true : false),
			),
		)); ?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
This is the view content for action "<?php echo $this->action->id; ?>".
The action belongs to the controller "<?php echo get_class($this); ?>"
in the "<?php echo $this->module->id; ?>" module.
</p>
<p>
You may customize this page by editing <tt><?php echo __FILE__; ?></tt>
</p>