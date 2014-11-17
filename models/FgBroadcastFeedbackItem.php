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
class FgBroadcastFeedbackItem extends RewriteAR
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
		return 'FG_Broadcast_Feedback_Item_2';
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
			array('id, feedback_id, brand_id, device_id,material_id, question_id', 'numerical', 'integerOnly'=>true),
			//array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, feedback_id, brand_id, device_id,material_id, question_id, question_item, create_datetime, insert_datetime', 'safe', 'on'=>'search'),
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
                $criteria->compare('brand_id',$this->brand_id);
                $criteria->compare('device_id',$this->device_id);
                $criteria->compare('material_id',$this->material_id);

		// $criteria->compare('direction.name',$this->direction->name);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function mutualQty($device_id, $material_id, $s_date="", $e_date=""){
            
            $tableFeedbackItem = $this->tableName();
            
            $sql = "SELECT DISTINCT feedback_id FROM `$tableFeedbackItem` WHERE device_id = '".$device_id."' AND material_id = '".$material_id."' ";
            
            if($s_date != ""){
                $sql .= " AND create_datetime >= '".$s_date." 00:00:00"."' ";
            }
            
            if($e_date != ""){
                $sql .= " AND create_datetime <= '".$e_date." 23:59:59"."' ";
            }
            
            $sql2 = "SELECT COUNT(*) FROM ($sql) A";
            //echo $sql2."<br>";
            return Yii::app()->dbfgmanage->createCommand($sql2)->queryScalar();
            
        }
        
       
        
        
        
}