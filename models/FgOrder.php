<?php

/**
 * This is the model class for table "fg_city".
 *
 * The followings are the available columns in table 'fg_city':
 * @property integer $id
 * @property string $name
 * @property integer $direction_id
 * @property integer $seq
 *
 * The followings are the available model relations:
 * @property FgArea[] $fgAreas
 * @property FgDirection $direction
 */
class FgOrder extends RewriteAR
{
	private static $tableOperation="FG_OrderOperation_2";
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FgCity the static model class
	 */
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'FG_Order_2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('id, status ', 'numerical', 'integerOnly'=>true),
			array('odr_no, name, time_type, s_date, e_date, remark', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,odr_no, name, time_type, s_date, e_date, status, remark', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			 'orderItem' => array(self::HAS_MANY, 'FgOrderItem', 'order_id'),
			 'mpackageItem' => array(self::HAS_MANY, 'FgMaterialPackageItem', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '流水號',
                        'name' => '活動名稱',
                        'odr_no' => '訂單編號',
                        's_date' =>'開始時間',
                        'e_date' =>'結束時間',
                        'time_type' =>'時間分類',
                        // 'status' => '狀態',
                        'status' => '執行狀態',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria();
		$criteria->compare('id',$this->id);
      
		// $criteria->compare('direction.name',$this->direction->name);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	//1112補上下方程式
	public function getMaterial($type){
		// $material_id = CHtml::listData($this->mpackageItem,'id','material_id');
		$return_arr = array();
		foreach ($this->mpackageItem as $key => $value) {
			$return_arr["material"][$value->oMaterial->id]=$value->oMaterial->name;
			$return_arr["mimage"][$value->oMaterial->id]= $value->oMaterial->image;
			$questionModel = FgMaterialQuestion::model()->findAll('material_id=:material_id',array(':material_id'=>$value->oMaterial->id));
			// echo count($questionModel);
			$questionTag = (count($questionModel)==0)?(TbHtml::icon(TbHtml::ICON_REMOVE)):(TbHtml::icon(TbHtml::ICON_OK));
			$return_arr['question'][$value->oMaterial->id] = $questionTag;
			$remarkTag = ($value->oMaterial->remark=="")?("未建立成效"):($value->oMaterial->remark);
			$return_arr['remark'][$value->oMaterial->id] = $remarkTag;
			$brandModel = FgBrand::model()->findByPk($value->oMaterial->brand_id);
			$return_arr["brand"][$brandModel->id]=$brandModel->name;
		}
		switch ($type) {
			case 'material':
				return implode('<br>', $return_arr["material"]);
				break;
			case 'brand':
				return $return_arr['brand'][$brandModel->id];
			break;
			case 'mimage':
				$imageTag = "";
				foreach ($return_arr["mimage"] as $key => $value) {

					  $imageTag = $imageTag.CHtml::image("/fashionguide/images/material/".$value);
				}
				return $imageTag;
			break;
			case 'question':				
				return implode('<br>', $return_arr['question']);
			break;
			case 'remark':
				return implode('<br>', $return_arr['remark']);
			break;
			default:
				# code...
				break;
		}
		
		// var_dump($return_arr);
		// return_arr $return_arr;
		

	}
	//1114補上下方程式
	public function getTag(){
		$subModel = FgSubTag::model()->findAll();
		$subArr = array();
		// $subArr = CHtml::listData($subModel,'id','name');
		foreach ($subModel as $key => $value) {
			$subArr[$key]=array('tag_id'=>$value->tag_id,'name'=>$value->name);
		}
		return $subArr;
	}
    
    //1117補上下方程式
    public function getPlace(){
    	// var_dump($this->orderItem);
    	$placeArr = array();
    	foreach ($this->orderItem as $key => $value) {
    		$deviceModel = FgDevice::model()->findByPk($value->device_id);
    		$branchModel = FgBranch::model()->findByPk($deviceModel->branch_id);
    		$placeModel = FgPlace::model()->findByPk($branchModel->place_id);
    		$placeArr[] = $placeModel->name;
    		// var_dump($placeModel->name);
    		// var_dump($value);
    	}
    	return $placeArr[0];
    }
	public function checkTag($tag){
		if(!is_null($this->sub_tag)){
			$arr = explode(",", $this->sub_tag);
			// 比較資料庫的值和當前選中的值
			return in_array($tag, $arr);
		}	
	}
    public function getStatus(){
    	$msg = "";
    	switch ($this->status) {
    		case 0:
    			(is_null($this->status)?($msg = "未設置"):($msg = "執行中"));
    			break;
    		case 1:
    			$msg = "暫停";
    			break;
    		case 2:
    			$msg = "中止";
    			break;
    		case 3:
    			$msg = "結束";
    			break;

    		default:
    			$msg = "未設置";
    			break;
    	}
    	return $msg;
    }    
                public function parserTimeType($week){

                    $arr = explode(",",$this->time_type);    
                    
                    return in_array($week, $arr);
                }
    

    // 1126加上FG_OrderOperation_2
    public function queryOrderOperation(){
    	$table = self::$tableOperation;
    	$sql = "SELECT * FROM `$table`";
    	Yii::app()->dbfgmanage->createCommand($sql)->queryAll();
    	
    }
    public function insertOrderOperation($post=""){
    	$table = self::$tableOperation;
    	if(isset($post) && $post){
    		$device = implode(',', $_post['device_arr']);
    		$member_id = Yii::app()->user->id;
    		$statistic_id = $post['statistic_id'];
    		$material_num = $post['material_num'];
    		$create_date = date("Y-m-d H:i:s");
    		$sql="INSERT INTO `$table`(`device`,`member_id`,`statistic_id`,`material_num`,`create_date`) 
    		 VALUES($device,$member_id,$statistic_id,$material_num,$create_date)";
    		 echo $sql;
    	}
    	
    }
	// 1124加上取得FG_Broadcast_Statistic_2資料
    // _monthTableDiv.php會用到
	public function ajaxGetStatistic($post=""){
		$tableStatistic = "FG_Broadcast_Statistic_2";
		$mergeArr = array();
		//ajax傳值
		if(isset($post) && $post){
			// post設定
			$s_date = $post['s_date'];
    		$e_date = $post['e_date'];
    		$materialNum = $post['materialNum'];
    		$deviceIdArr = explode(',',$post['deviceIdArr']);
    		$materialIdArr = explode(',', $post['materialIdArr']);
    		//由小到大排序
    		asort($deviceIdArr);
    		// 處理post裝置
    		
    		
    		// 回傳陣列periodArr
    		$periodArr = array();
			$sql = "select * from `$tableStatistic` ORDER BY  `period_date` ASC ";
			$results = Yii::app()->dbfgmanage->createCommand($sql)->queryAll();
			// 查詢裝置
			$deviceSql = "SELECT * FROM `FG_Broadcast_Statistic_2` group by device_id order by device_id ASC";
			$deviceResults = Yii::app()->dbfgmanage->createCommand($deviceSql)->queryAll();
			foreach ($deviceIdArr as $key => $value) {
				// 不足的日期補足
				$length = (strtotime($e_date)-strtotime($s_date))/(24*60*60);
				for($i=0;$i<=$length;$i++){
					$spaceDate = date("Y-m-d",strtotime($s_date)+24*60*60*$i);
					$spaceArr[$value][$spaceDate] = 
						array(
							"device_id" => $value,
							"resultMsg" => 2,
							"materialNum" => $materialNum,
						); 
				}
			}
			
			// 讀取資料庫的素材數量
			foreach ($results  as $key => $value) {
				//判斷開始和結束日期
				if($s_date<=$value['period_date']."23:59:59" && $e_date>=$value['period_date']){
					// 判斷廣告機還是專案機
					if($value['project_device']==0){
						$adNumber = 16;
						$currentQty = $materialNum+$value['current_qty'];
					}else{
						$adNumber = 0;
					}
					// 如果是null值，則不處理
					if(!is_array($spaceArr[$value['device_id']])){
						continue;
					}
					
					
					$periodArr[$value['device_id']][$value['period_date']] = 
							array(
								"device_id" => $value['device_id'],
								"materialNum" => $materialNum,
								"resultMsg" => ($adNumber<=$currentQty)?(0):(1),
								"count"=>$value['current_qty'],
							);
						
				}else{
					// 不在開始和結束範圍內的資料
					if($value['current_qty']){
						$periodArr[$value['device_id']][$value['period_date']] = 
							array(
								"device_id" => $value['device_id'],
								// "materialNum" => $materialNum,
								"resultMsg" => 3,
								"count"=>$value['current_qty'],
							);
					}else{
						$periodArr[$value['device_id']][$value['period_date']] = 
							array(
								"device_id" => $value['device_id'],
								"resultMsg" => 4,
							);
					}
					
				}
			}
			
			// 兩個二維陣列合併
			$periodArr = array_replace_recursive($spaceArr,$periodArr);
			
		
			echo json_encode($periodArr);

			return false;
			// exit;
			
			
		}else{
			// 在view處理陣列
			$sql = "select * from `$tableStatistic` ORDER BY  `period_date` ASC ";
			return Yii::app()->dbfgmanage->createCommand($sql)->queryAll();
		}
	}
        
        
}