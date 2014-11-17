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
class FgBroadcastFeedback extends RewriteAR
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
		return 'FG_Broadcast_Feedback_2';
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
			array('id, brand_id, device_id,material_id,qty, mutual_qty', 'numerical', 'integerOnly'=>true),
			//array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, brand_id, device_id,material_id,qty, mutual_qty, create_datetime, insert_datetime', 'safe', 'on'=>'search'),
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
        
        public function filterData($p){
            
            $tableDevice = FgDevice::model()->tableName();
            $tableFeedback = $this->tableName();
            $sql = "SELECT A.device_id,A.material_id,A.brand_id,count(A.device_id) as ct "
                  ."FROM `$tableFeedback` A LEFT JOIN `$tableDevice` B ON A.device_id = B.id "
                  ."WHERE 1=1 ";
            
            if($p['material_id']){
                $sql .= "AND A.material_id = '".$p['material_id']."' ";
            }
            
            if($p['branch_id']){
                $sql .= "AND B.branch_id = '".$p['branch_id']."' ";
            }
            
            if($p['name']){
                $sql .= "AND B.name = '".$p['name']."' ";
            }
            
            if($p['mac']){
                $sql .= "AND B.mac = '".$p['mac']."' ";
            }

            if($p['s_date']){
                $sql .= " AND A.create_datetime >= '".$p['s_date']." 00:00:00"."' ";
            }
            
            if($p['e_date']){
                $sql .= " AND A.create_datetime <= '".$p['e_date']." 23:59:59"."' ";
            }
            
            $sql .= "GROUP BY A.device_id,A.material_id";

            $lists = Yii::app()->dbfgmanage->createCommand($sql)->queryAll();
            
            foreach($lists as $key=>$val){
                $lists[$key]['mutual_qty'] = FgBroadcastFeedbackItem::model()->mutualQty($val['device_id'],$val['material_id'],$p['s_date'],$p['e_date']);
            }
            
            
            return $lists;
        }
        
       
        
        
        
}