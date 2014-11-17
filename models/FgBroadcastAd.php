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
class FgBroadcastAd extends RewriteAR
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
		return 'FG_Broadcast_Ad_2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('id', 'required'),
			array('id, broadcast_period_id, device_id,material_id,aspect', 'numerical', 'integerOnly'=>true),
			array('create_date, create_datetime', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, broadcast_period_id, device_id,material_id,aspect,create_date, create_datetime', 'safe', 'on'=>'search'),
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
                    'oMaterial' => array(self::BELONGS_TO, 'FGMaterial', 'material_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '流水號',
			
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
        
        public function varifyBroadcastAspect($date,$device_id,$material_id){
            
            $model = $this->tableName();
            
            //$sql = "SELECT aspect FROM `$model` WHERE create_date = '$date' AND device_id = '$device_id' AND material_id = $material_id ORDER BY ID DESC LIMIT 0,1 ";
            $sql = "SELECT aspect FROM `$model` WHERE create_date <= '$date' AND device_id = '$device_id' AND material_id = $material_id ORDER BY ID DESC LIMIT 0,1 ";
            $result = Yii::app()->dbfgmanage->createCommand($sql)->queryRow();
            return $result['aspect'];
            
        }
        
        public function warnMacForToday(){
            
            $tableDevice = FgDevice::model()->tableName();
            $tableBroadcastAd = $this->tableName();
            
            $sql = "SELECT * FROM `$tableDevice` WHERE id NOT IN (SELECT distinct device_id FROM `$tableBroadcastAd` WHERE create_time LIKE '".date("Y-m-d")."%')";
            
            return Yii::app()->dbfgmanage->createCommand($sql)->queryAll();
        }
}