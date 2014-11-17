<?php

/**
 * This is the model class for table "fg_user".
 *
 * The followings are the available columns in table 'fg_user':
 * @property integer $id
 * @property string $name
 * @property string $account
 * @property string $password
 * @property integer $level_id
 * @property integer $place_id
 * @property integer $branch_id
 *
 * The followings are the available model relations:
 * @property FgCtrlBranch[] $fgCtrlBranches
 * @property FgLevel $level
 */
class FgContact extends CActiveRecord
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
	 * @return FgUser the static model class
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
		return 'FG_Contact_2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			//1113補上下方欄位
			array('first_name, second_name,advertiser_id,position,brand_id, mobile, email ','required','on'=>'requiredContact'),
			array('first_name, second_name,advertiser_id,position,brand_id, mobile,email,birthday,gender,tel,fax,remark','safe'),
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
			'brand'=>array(self::BELONGS_TO,'FgBrand','brand_id'),
			'advertiser'=>array(self::BELONGS_TO,'FgAdvertiser','advertiser_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '使用者編號',
		
			//1110補上下方欄位
			'brand_id' => '品牌編號',
			'birthday' => '生日',
			'gender' => '性別',
			'tel' => '連絡電話',
			'fax' => '傳真',
			'mobile' => '行動電話',
			'email' => '電子郵件',
			'position'=>'職位',
			//1113加上下方欄位
			'first_name'=>'姓',
			'second_name'=>'名',
			'advertiser_id'=>'廣告主名稱',
			'remark'=>'備註',
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
		
		$criteria->compare('place_id',$this->place_id);
		$criteria->compare('branch_id',$this->branch_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}