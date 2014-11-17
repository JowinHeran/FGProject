<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom_style.css" />
        
                     <!--Angularjs-->
                     <?php //  Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/angular.min.js');?>
                     <?php Yii::app()->bootstrap->register(); ?>      
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	<div id="header">
	<div id="logo"><img src="<?php //echo Yii::app()->request->baseUrl."/images/image/fashionguide.gif"?>" ><!--FashionGuide!--> 廣告開發測試版本</div>
                    </div><!-- header -->

	<div id="mainmenu">
                    <?php // echo $this->renderPartial('//layouts/menu.php');?>
            <?php $this->beginContent('/layouts/menu'); ?>
            
            <?php $this->endContent(); ?>
            
	</div><!-- mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
                                        'homeLink'=>CHtml::link('首頁',Yii::app()->homeUrl),
		  'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->
	<div id="submenu">
                    <?php // echo $this->renderPartial('//layouts/menu.php');?>
            <?php $this->beginContent('/layouts/submenu'); ?>
            
            <?php $this->endContent(); ?>
            
	</div><!-- mainmenu -->
	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> 禾聯碩股份有限公司.<br/>
		All Rights Reserved.<br/>
		<?php // echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->
<script>
    function deleteAjax(url,id,goto){
        if(confirm('確定刪除此項目嗎')){
            $.ajax({
                url:url,
                type:"post",
                data:{id:id},
                success:function(){
                    location.href= goto;
                }
            })
        }
    }
</script>
</body>
</html>