<?php

/**
 * This is the model class for table "FG_DB_log".
 *
 * The followings are the available columns in table 'FG_DB_log':
 * @property integer $id
 * @property string $name
 * @property string $updatedate
 */
class FgMaterialPull extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return FGDBLog the static model class
     */
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
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return 'FG_Material_Pull_2';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    //array('name, updatedate', 'safe'),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('id, mac, content, content_ids, create_time, create_ip', 'safe', 'on'=>'search'),
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
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'mac'=>'MAC',
                    'content'=>'內容',
                    'create_time'=>'新增日期',
                    'create_ip'=>'新增IP',
            );
    }
    public function getUpdateDate(){
            return date('Y-m-d H:i:s');
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
            $criteria->compare('mac',$this->mac);
            $criteria->compare('create_time',$this->create_time,true);
            $criteria->compare('create_ip',$this->create_ip,true);
            
            $criteria->order = "create_time desc ";

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }
    
     protected function beforeSave() {

            if (parent::beforeSave()) {
                
                $date =  date('Y-m-d H:i:s');
                $ip = Yii::app()->request->userHostAddress;
                if ($this->isNewRecord) {
                    $this->create_time = $date;
                    $this->create_ip = $ip;
                }

            }

            return true;

    }
}