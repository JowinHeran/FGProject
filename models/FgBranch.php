<?php

/**
 * This is the model class for table "fg_branch".
 *
 * The followings are the available columns in table 'fg_branch':
 * @property integer $id
 * @property string $name
 * @property integer $place_id
 * @property integer $city_id
 * @property integer $area_id
 *
 * The followings are the available model relations:
 * @property FgPlace $place
 * @property FgArea $area
 * @property FgDevice[] $fgDevices
 */
class FgBranch extends CActiveRecord
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
	 * @return FgBranch the static model class
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
		return 'FG_Branch_2';
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
			array('id, place_id, city_id, area_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, place_id, city_id, area_id', 'safe', 'on'=>'search'),
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
			'place' => array(self::BELONGS_TO, 'FgPlace', 'place_id'),
			'area' => array(self::BELONGS_TO, 'FgArea', 'area_id'),
			'fgDevices' => array(self::HAS_MANY, 'FgDevice', 'branch_id'),
			//城市
			'city'=>array(self::BELONGS_TO,'FgCity','city_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '流水號',
			'name' => '分店名稱',
			'place_id' => '通路名稱',
			'city_id' => '縣市名稱',
			'area_id' => '分店位置',
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
		$criteria->compare('place_id',$this->place_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('area_id',$this->area_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}