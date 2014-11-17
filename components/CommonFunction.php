<?php 
class CommonFunction{
	// public static $arr="123";
	// 生成menu.php，為了解決第一次登入SESSION設定問題
	function menu(){
		$menuArr = array();
	    $crudArr = array();
	   
	    $menuModel = FgUser::model()->findByPk(Yii::app()->user->id);
	    $permissionModel = FgPermission::model()->findAll("level_id=:l_id and sel!=0",array(":l_id"=>$menuModel->level_id));
	   
	    $flag = 0;
	    foreach ($permissionModel as $key => $value) {

	        $functionModel = FgFunction::model()->findByPk($value->function_id);
 			
	        $tempArr= array('label'=>$functionModel->name,'url'=>array('/FG_Manage_2/'.$functionModel->url.'/index'),'active' => Yii::app()->controller->main_menu == strtolower($functionModel->url) ? true : false);
	        // $tempArr=array('rel'=>$functionModel->seq);
	        if($functionModel->id == $functionModel->function_id || $functionModel->function_id==""){   	
	        	if(!is_null($functionModel->function_id)){
	        		$menuArr[$functionModel->seq]=$tempArr;
	        	}
	        }
	        $crudArr[strtolower($functionModel->url)]=array('function_id'=>$value->function_id,
	                         'sel'=>$value->sel,
	                         'ins'=>$value->ins,
	                         'upd'=>$value->upd,
	                         'del'=>$value->del,
	                         'print'=>$value->print,
	                         );
	    }
	    ksort($menuArr);
	    $menuArr[]=array('label'=>'登出('.Yii::app()->user->name.')', 'url'=>array('/FG_Manage_2/Site/logout'), 'visible'=>!Yii::app()->user->isGuest );
	    $menuArr[]=array('label'=>'登入', 'url'=>array('/FG_Manage_2/Site/login'), 'visible'=>Yii::app()->user->isGuest );
	    $_SESSION['crudArr'] = $crudArr;
	   
	    return $menuArr;
	  
	}
	// 依照父功能產生子選單
	function subMenu(){
		
		$getMaterialId = trim($_GET['material_id']);
		$getadvertiserId = trim($_GET['advertiser_id']);
		$menuArr = array("items"=>array());
		$controllerName = Yii::app()->controller->id;
		$lowerCase = strtolower($controllerName);
		$model = FgFunction::model()->find('url=:url',array(':url'=>$controllerName));
		$model = FgFunction::model()->findAll('function_id=:function_id',array(':function_id'=>$model->function_id));
		foreach ($model as $key => $value) {
			if($value->status!=1){
				switch ($lowerCase) {
					case 'fgmaterialquestion':
						$menuArr["items"][$value->seq]=array('label'=>$value->name,'url'=>array('/FG_Manage_2/'.$value->url.'/index/advertiser_id/'.$getMaterialId));		
						break;
					case 'fgbrand':
						$menuArr["items"][$value->seq]=array('label'=>$value->name,'url'=>array('/FG_Manage_2/'.$value->url.'/index/advertiser_id/'.$getadvertiserId));		
						break;
					break;
					default:
						$menuArr["items"][$value->seq]=array('label'=>$value->name,'url'=>array('/FG_Manage_2/'.$value->url.'/index'));		
						break;
				}
				
			}		
		}
		ksort($menuArr['items']);
		return $menuArr;
	}
	function alertMsg($url,$msg){
		header('Content-Type: text/html; charset=utf-8');
		
		if(Yii::app()->controller->id=="fgUser" && Yii::app()->controller->action->id=="createContact"){
			echo "<script type='text/javascript'>alert('".$msg."');</script>";
		}else{
			echo "<script type='text/javascript'>alert('".$msg."');location.href='".$url."';</script>";	
		}
	}
	// 用來生成index.php的操作按鈕
	function display($controllerName){
		//為了解決第一次沒有設定session問題，造成按鈕沒有出現的問題
		$url = Yii::app()->createUrl("FG_Manage_2/Site/login");
		$this->menu();
		if(empty($_SESSION['crudArr'])){
			$this->alertMsg($url,'請登入進行操作');
		}
		$getMaterialId = trim($_GET['material_id']);
		$getadvertiserId = trim($_GET['advertiser_id']);
		$lowerCase = strtolower($controllerName);
		
		switch ($lowerCase) {
			case 'fgmaterialquestion':
				$createUrl = Yii::app()->createUrl('/FG_Manage_2/'.$controllerName.'/create',array('material_id'=>$getMaterialId));
				$adminUrl = Yii::app()->createUrl('/FG_Manage_2/'.$controllerName.'/admin',array('material_id'=>$getMaterialId));
				break;
			case 'fgbrand':
				$createUrl = Yii::app()->createUrl('/FG_Manage_2/'.$controllerName.'/create',array('advertiser_id'=>$getadvertiserId));
				$adminUrl = Yii::app()->createUrl('/FG_Manage_2/'.$controllerName.'/admin',array('advertiser_id'=>$getadvertiserId));
				break;
			break;
			case 'fgcontact':
				$createUrl = Yii::app()->createUrl('/FG_Manage_2/'.$controllerName.'/create',array('advertiser_id'=>$getadvertiserId));
				$adminUrl = Yii::app()->createUrl('/FG_Manage_2/'.$controllerName.'/admin',array('advertiser_id'=>$getadvertiserId));
				break;
			default:
				$createUrl = Yii::app()->createUrl('/FG_Manage_2/'.$controllerName.'/create');
				$adminUrl = Yii::app()->createUrl('/FG_Manage_2/'.$controllerName.'/admin');
				break;
		}
		if($_SESSION['crudArr'][$lowerCase]['ins']=="1"){
		  echo TbHtml::linkButton('新增', 
	                    array(
	                        'icon'=>'plus',
	                        'color' => TbHtml::BUTTON_COLOR_PRIMARY,
	                        'url'=>$createUrl
	                    )); 
		  echo "&nbsp;&nbsp;";
		}
		if($_SESSION['crudArr'][$lowerCase]['sel']=="1"){
		 echo TbHtml::linkButton('搜尋', 
	                    array(
	                        'icon'=>'search',
	                        'color' => TbHtml::BUTTON_COLOR_INFO,
	                        'url'=>$adminUrl
	                   )); 
		}
		$btnArr = array('htmlOptions'=>array('width'=>"40px",'style'=>'text-align: center'),
			            'class'=>'CButtonColumn','deleteConfirmation'=>'確定刪除此項目嗎?',);
		
		if($_SESSION['crudArr'][$lowerCase]['sel']!="1"){
			$btnArr['viewButtonOptions']=array('style'=>'display:none');
		}
		if($_SESSION['crudArr'][$lowerCase]['upd']!="1"){
			$btnArr['updateButtonOptions']=array( 'style'=>'display:none',);
		}
		if($_SESSION['crudArr'][$lowerCase]['del']!="1"){
			$btnArr['deleteButtonOptions']=array( 'style'=>'display:none',);
		}

		return $btnArr;
	}
	// 紀錄客製化頁面的操作紀錄
	function record($msg=""){
		//加入操作者編號及暱稱
		$uid = Yii::app()->user->id;
		$userObj = FgUser::model()->find('id=:id',array(":id"=>$uid));
		$userNickname = (is_null($userObj->nickname))?($userObj->account):($userObj->nickname);
		$num = Yii::app()->db->createCommand()->select('id')->from('FG_DB_Log')->queryAll();
		$num = count($num) + 1;
		$action = Yii::app()->params->actionName[strtolower(Yii::app()->controller->action->id)];
		$controller =  Yii::app()->params->controllerName[strtolower(Yii::app()->controller->id)];
		$actionName = (is_null($action))?(Yii::app()->controller->action->id):($action);
		$controllerName = (is_null($controller))?(Yii::app()->controller->id):($controller);

		$logStr = "系統流水號:".$num.",";
		$logStr = $logStr."操作者編號:".$uid.",";
		$logStr = $logStr."操作者暱稱:".$userNickname.",";
		$logStr = $logStr."客製化程式位置:".Yii::app()->controller->module->id.",";
		$logStr = $logStr."Function名:".$controllerName.",";
		$logStr = $logStr."操作名:".$actionName.",";
		if($msg!=""){
			$logStr = $logStr."".$msg.",";
		}
		// echo $logStr;
		$log = Yii::app()->dbfgmanage->createCommand();
		$log->insert('FG_DB_Log_2',array('name'=>$logStr,'updatedate'=>date('Y-m-d H:i:s')));
		$formallog = Yii::app()->db->createCommand();
		$formallog->insert('FG_DB_Log',array('name'=>$logStr,'updatedate'=>date('Y-m-d H:i:s')));
	}
	// _form下拉式表單關聯生成
	function associateForm($modelArr){
		$arr=array();
		foreach ($modelArr as  $key=>$value) {
			$Model = $key::model()->findAll(); 
			foreach ($Model as $key2=>$value2) {

			   $arr[$key][$value2->$value['key']] = $value2->name;
			}
		}
		return $arr;
	}

	// 連動式下拉選單:用於fgBranch，例如:選擇台北縣，生成中正區、信義區、等等
	function relateForm($model,$modelArr){
		$arr = array();
		$tempArr = array();
		foreach ($modelArr as $key => $value) {
			
			// 呼叫RewriteAr的方法
			if($value['isparent']){
				$Model = $key::model()->fetchNameArr(); 
				$arr[$key]=$Model;
			}else if(!$model->isNewRecord && !$value['isparent']){
				$findStr = $value['field'];
				$conditionStr = $findStr."=:".$findStr;
				$commaStr = ":".$findStr;
				$withModel = $key::model()->with($value['with'])->findAll($conditionStr,array($commaStr=>$model->$findStr));
				
				foreach($withModel as $key2=>$value2){
	           	 	$tempArr[$value2->id] = $value2->name;
	        	}
	        	$arr[$key]=$tempArr;
			}else{
				$arr[$key]=$tempArr;
			}

		}
		// var_dump($arr);
		// exit;
	    return $arr;
	}

}

?>
