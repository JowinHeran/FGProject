<?php

/**
 * This is the model class for table "fg_device".
 *
 * The followings are the available columns in table 'fg_device':
 * @property integer $id
 * @property string $name
 * @property string $mac
 * @property integer $device_type_id
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property FgBrand[] $fgBrands
 * @property FgBranch $branch
 * @property FgDeviceType $deviceType
 * @property FgOrder[] $fgOrders
 */
class FgDevice extends CActiveRecord
{
	//改寫父類別連線方式
	function __construct($scenario='insert')
    {
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
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FgDevice the static model class
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
		return 'FG_Device_2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('id', 'required'),
			array('id, device_type_id, branch_id, market_type_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('mac', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, mac, device_type_id, branch_id, market_type_id, create_time,update_time,create_ip,update_ip', 'safe', 'on'=>'search'),
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
			'fgBrands' => array(self::MANY_MANY, 'FgBrand', 'fg_com_device_brand(device_id, brand_id)'),
			'branch' => array(self::BELONGS_TO, 'FgBranch', 'branch_id'),
			'deviceType' => array(self::BELONGS_TO, 'FgDeviceType', 'device_type_id'),
                        'marketType' => array(self::BELONGS_TO, 'FgMarketType', 'market_type_id'),
			'fgOrders' => array(self::HAS_MANY, 'FgOrder', 'branch_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '流水號',
                        'branch_id' => '分店',
			'name' => '裝置名稱',
			'mac' => '機台序號',
			'device_type_id' => '裝置類型',
                        'market_type_id' => '機種',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('mac',$this->mac,true);
		$criteria->compare('device_type_id',$this->device_type_id);
		$criteria->compare('branch_id',$this->branch_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function composeSearch($p){
            
            $tableCity = FgCity::model()->tableName();
            $tableArea = FgArea::model()->tableName();
            $tableBranch = FgBranch::model()->tableName();
            $tableDevice = $this->tableName();
            
            $sql = "
                    SELECT A.name as cityName, B.name as areaName, 
                           C.name as branchName, D.name as deviceName, 
                           D.mac as mac, D.id as deviceID
                    FROM `$tableCity` as A,`$tableArea` as B,`$tableBranch` as C,`$tableDevice` as D
                    WHERE 
                            D.branch_id = C.id
                        AND C.city_id = A.id
                        AND C.area_id = B.id
                   ";
            if($p["mac"] != ""){
                $sql .= " AND D.mac = '".$p["mac"]."' ";
            }
            if($p["name"] != ""){
                $sql .= " AND D.name LIKE '%".$p["name"]."%' ";
            }
            
            if($p["city_id"] != ""){
                $sql .= " AND A.id = '".$p["city_id"]."' ";
            }
            
            if($p["area_id"] != ""){
                $sql .= " AND B.id = '".$p["area_id"]."' ";
            }
            
            if($p["branch_id"] != ""){
                $sql .= " AND C.id = '".$p["branch_id"]."' ";
            }
            
            if($p["device_type_id"] != ""){
                $sql .= " AND D.device_type_id = '".$p["device_type_id"]."' ";
            }
            //echo $sql;
            return Yii::app()->dbfgmanage->createCommand($sql)->queryAll();
            
        }
        
        protected function beforeSave() {

            if (parent::beforeSave()) {
                
                $date =  date('Y-m-d H:i:s');
                $ip = Yii::app()->request->userHostAddress;
                if ($this->isNewRecord) {
                    $this->create_time = $date;
                    $this->create_ip = $ip;
                }else{
                    $this->update_time = $date;
                    $this->update_ip = $ip;
                }

            }

            return true;

    }
}