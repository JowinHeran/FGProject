<?php $controllerName  = strtolower($this->id);?>
<?php 
	if($_SESSION['crudArr'][$controllerName]['ins']=="1"){
	  echo TbHtml::linkButton('新增', 
                    array(
                        'icon'=>'plus',
                        'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                        'url'=>Yii::app()->createUrl('/FG_Manage_2/'.$this->id.'/create')
                    )); 
	}
?>&nbsp;
<?php
	if($_SESSION['crudArr'][$controllerName]['sel']=="1"){
	 echo TbHtml::linkButton('搜尋', 
                    array(
                        'icon'=>'search',
                        'color' => TbHtml::BUTTON_COLOR_INFO,
                        'url'=>Yii::app()->createUrl('/FG_Manage_2/'.$this->id.'/admin')
                   )); 
	}
?>
<?php 
	$btnArr = array('htmlOptions'=>array('width'=>"40px",'style'=>'text-align: center'),
			            'class'=>'CButtonColumn','deleteConfirmation'=>'確定刪除此項目嗎?',);
	// var_dump($btnArr);
	if($_SESSION['crudArr'][$controllerName]['sel']!="1"){
		$btnArr['viewButtonOptions']=array('style'=>'display:none');
	}
	if($_SESSION['crudArr'][$controllerName]['upd']!="1"){
		$btnArr['updateButtonOptions']=array( 'style'=>'display:none',);
	}
	if($_SESSION['crudArr'][$controllerName]['del']!="1"){
		$btnArr['deleteButtonOptions']=array( 'style'=>'display:none',);
	}
?>