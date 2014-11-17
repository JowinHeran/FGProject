<?php 
    $common = new CommonFunction();
    $menuArr= $common->menu();
    $subMenuArr = $common->subMenu();
    $this->widget('zii.widgets.CMenu',array('items'=>$menuArr));
   
?>
