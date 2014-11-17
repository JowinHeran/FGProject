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
class FgOrderItem extends RewriteAR
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
		return 'FG_Order_Item_2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('name', 'required'),
			array('id, status, order_id, material_package_id, material_package_item_id, material_id, device_id', 'numerical', 'integerOnly'=>true),
			array('time_type, s_date, e_date', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, status, order_id, material_package_id, material_package_item_id, material_id, device_id,time_type, s_date, e_date', 'safe', 'on'=>'search'),
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
                        'name' => '活動名稱',
                        'odr_no' => '訂單編號',
                        's_date' =>'開始時間',
                        'e_date' =>'結束時間',
                        'time_type' =>'時間分類',
                        'status' => '狀態',
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
        
                public function clearOrderID($order_id){
                        $tableName = $this->tableName();
                        $sql = "DELETE FROM `$tableName` WHERE order_id = '".$order_id."' ";

                        Yii::app()->dbfgmanage->createCommand($sql)->execute();

                    }
        
        
}