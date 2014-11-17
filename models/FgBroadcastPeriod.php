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
class FgBroadcastPeriod extends RewriteAR
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
		return 'FG_Broadcast_Period_2';
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
			array('id, material_id, device_id,status,order_id, material_package_id, material_package_item_id, order_item_id', 'numerical', 'integerOnly'=>true),
			//array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, material_id, device_id,status,order_id, material_package_id, material_package_item_id, order_item_id,period_date', 'safe', 'on'=>'search'),
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
                $criteria->compare('period_date',$this->period_date);

		// $criteria->compare('direction.name',$this->direction->name);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function createPeroid($type,$order_id,$material_package_id = "",$material_package_item_id = ""){
            
           $tableName = $this->tableName();
           $sql = "DELETE FROM `$tableName` WHERE order_id = '".$order_id."' ";
           Yii::app()->dbfgmanage->createCommand($sql)->execute();
            
            $oOrder = FgOrder::model()->findByPK($order_id);
            $sdate = date("Y-m-d",strtotime($oOrder->s_date));
            $edate = date("Y-m-d",strtotime($oOrder->e_date));
            $time_type_arr = explode(",", $oOrder->time_type);
            
            $condition = new CDbCriteria();
            $condition->condition = "order_id = '".$oOrder->id."'";
            $oOrderItem = FgOrderItem::model()->findAll($condition);
           
            if($sdate <= $edate){
                
                for($i=strtotime($sdate);$i<=strtotime($edate);$i+=24*60*60){
                    if($oOrder->time_type == ""){
                        foreach($oOrderItem as $key=>$val){
                            $this->unsetAttributes();
                            $this->order_id = $oOrder->id;
                            $this->order_item_id = $val->id;
                            $this->device_id = $val->device_id;
                            $this->material_id = $val->material_id;
                            $this->period_date = date("Y-m-d",$i);
                            $this->isNewRecord = true;
                            $this->save();
                        }
                        
                    }else{
                        if(in_array(date('w',$i), $time_type_arr)){
                            foreach($oOrderItem as $key=>$val){
                                $this->unsetAttributes();
                                $this->order_id = $oOrder->id;
                                $this->order_item_id = $val->id;
                                $this->device_id = $val->device_id;
                                $this->material_id = $val->material_id;
                                $this->period_date = date("Y-m-d",$i);
                                $this->isNewRecord = true;
                                $this->save();
                            }
                        }
                    }
                }
                
            }    
        }
        
        public function backEndSearch($p){
            
            $tableDevice = FgDevice::model()->tableName();
            $tableBranch = FgBranch::model()->tableName();
            $tableName = $this->tableName();
            $sql = "SELECT  count(*) as countAd, A.device_id as device_id, A.period_date as period_date, B.name as macAlias, B.mac as mac, C.name as branchName "
                    . " FROM `$tableName` A, `$tableDevice` B, `$tableBranch` C  "
                    . " WHERE A.device_id = B.id AND B.branch_id = C.id ";
            
            if($p['period_date'] != "")
                $sql .= " AND period_date = '".$p['period_date']."' ";
            
            if($p['branch_id'] != "")
                $sql .= " AND B.branch_id = '".$p['branch_id']."' ";
            
            if($p['name'] != "")
                $sql .= " AND B.name LIKE '%".$p['name']."%' ";
            
            if($p['mac'] != "")
                $sql .= " AND B.mac = '".$p['mac']."' ";
            
            $sql .= " GROUP BY A.period_date, B.mac ORDER BY A.period_date DESC";
            
            return Yii::app()->dbfgmanage->createCommand($sql)->queryAll();
            
        }
        
        
}