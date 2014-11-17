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
class FgMaterialPackage extends RewriteAR
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
		return 'FG_Material_Package_2';
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
			array('id,city_id, area_id, place_id, branch_id, order_id ,device_id', 'numerical', 'integerOnly'=>true),
			array('name,time_type', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,city_id, area_id, place_id, branch_id, order_id ,device_id, name, s_date, e_date,create_datetime, update_datetime, create_ip, update_ip', 'safe', 'on'=>'search'),
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
                    'oDevice' => array(self::BELONGS_TO, 'FgDevice', 'device_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '流水號',
			'name' => '名稱',
			's_date' => '起始日期',
			'e_date' => '結束日期',
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
                                      $criteria->compare('order_id',$this->order_id);
		$criteria->compare('name',$this->name,true);
		// $criteria->compare('direction.name',$this->direction->name);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function clearOrderID($order_id){
            $tableName = $this->tableName();
            $sql = "DELETE FROM `$tableName` WHERE order_id = '".$order_id."' ";

            Yii::app()->dbfgmanage->createCommand($sql)->execute();

        }
        
        protected function beforeSave() {

            if (parent::beforeSave()) {
                $date =  date('Y-m-d H:i:s');
                $ip = Yii::app()->request->userHostAddress;
                if ($this->isNewRecord) {
                    $this->create_datetime = $date;
                    $this->create_ip = $ip;
                    
                    $this->update_datetime = $date;
                    $this->update_ip = $ip;
                }else{
                    $this->update_datetime = $date;
                    $this->update_ip = $ip;
                }

            }
            return true;

        }
        
        public function getUpdateDate($device_id){
            
            $tablePackage = $this->tableName();
            $sql = "SELECT update_datetime FROM `$tablePackage` WHERE device_id = '".$device_id."' ORDER BY update_datetime DESC LIMIT 0,1";
            
            return Yii::app()->dbfgmanage->createCommand($sql)->queryScalar();
            
        }
}