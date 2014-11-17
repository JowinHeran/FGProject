<?php
//改寫父類別連線方式
class RewriteAR extends CActiveRecord{
	//改寫父類別連線方式
	function __construct($scenario='insert')
    {
    	// $this->_model=$model;
    	// var_dump($model);
    	// exit;
    	// 修改連線資訊
        $dbname = Yii::app()->dbfgmanage->connectionString;
        Yii::app()->db->setActive(false);
        Yii::app()->db->connectionString = trim($dbname);
        Yii::app()->db->setActive(true);
        // 新增及修改
        if($scenario===null) // internally used by populateRecord() and model()
			return;
        $this->setScenario($scenario);
		$this->setIsNewRecord(true);
		
    } 
    function fetchNameArr(){
    	$arr = array();
    	$model = $this::model()->findAll();
    	foreach ($model as $key => $value) {
    		$arr[$value->id] = $value->name;
    	}
    	return $arr;
    }
    // 暫時沒使用(CDBcommand問題)
    function fetchAssoNameArr($asso="",$field="",$fvalue=""){
    	$arr = array();
    	$model = $this::model()->with($asso)->findAll('$field=:$field',array(":$field"=>$fvalue));

    	foreach ($model as $key => $value) {
    		$arr[$key+1] = $value->name;
    	}
    	return $arr;
    }
}