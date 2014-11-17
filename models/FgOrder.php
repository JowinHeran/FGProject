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
	
	
        
        
}