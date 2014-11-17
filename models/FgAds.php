<?php

/**
 * This is the model class for table "fg_ads".
 *
 * The followings are the available columns in table 'fg_ads':
 * @property integer $id
 * @property string $name
 * @property string $photo
 * @property string $movie
 * @property string $url
 * @property integer $device_type_id
 * @property integer $brand_id
 *
 * The followings are the available model relations:
 * @property FgDeviceType $deviceType
 * @property FgBrand $brand
 * @property FgOrderItem[] $fgOrderItems
 */
class FgAds extends CActiveRecord
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
	 * @return FgAds the static model class
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
		return 'FG_Ads_2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, device_type_id, brand_id', 'numerical', 'integerOnly'=>true),
			array('name, photo, movie', 'length', 'max'=>255),
			array('url', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, photo, movie, url, device_type_id, brand_id', 'safe', 'on'=>'search'),
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
			'deviceType' => array(self::BELONGS_TO, 'FgDeviceType', 'device_type_id'),
			'brand' => array(self::BELONGS_TO, 'FgBrand', 'brand_id'),
			'fgOrderItems' => array(self::HAS_MANY, 'FgOrderItem', 'ads_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'photo' => 'Photo',
			'movie' => 'Movie',
			'url' => 'Url',
			'device_type_id' => 'Device Type',
			'brand_id' => 'Brand',
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
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('movie',$this->movie,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('device_type_id',$this->device_type_id);
		$criteria->compare('brand_id',$this->brand_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}