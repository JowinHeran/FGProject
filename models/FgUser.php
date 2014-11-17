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
class FgUser extends CActiveRecord
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
		return 'FG_User_2';
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
			array('id, level_id, place_id, branch_id', 'numerical', 'integerOnly'=>true),
			array('name, account, password, nickname', 'length', 'max'=>45),
			//1110補上下方欄位
			array('brand_id, gender','numerical','integerOnly'=>true),
			array('birthday','safe'),
			array('tel, fax, mobile','length','max'=>45),
			array('email','length','max'=>100),
			array('position','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, account, password, level_id, place_id, branch_id', 'safe', 'on'=>'search'),
			//1111補上自定義驗證方法
			array('name, position, mobile, email, level_id, brand_id','required','on'=>'requiredContact'),
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
			'fgCtrlBranches' => array(self::HAS_MANY, 'FgCtrlBranch', 'user_id'),
			'level' => array(self::BELONGS_TO, 'FgLevel', 'level_id'),
			'place' => array(self::BELONGS_TO, 'FgPlace', 'place_id'),
			'branch' => array(self::BELONGS_TO, 'FgBranch', 'branch_id'),
			'brand'=>array(self::BELONGS_TO,'FgBrand','brand_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '使用者編號',
			'name' => '使用者姓名',
			'account' => '使用者帳戶',
			'nickname' => '使用者暱稱',
			'password' => '使用者密碼',
			'level_id' => '使用者等級',
			'place_id' => '通路編號',
			'branch_id' => '分店編號',
			//1110補上下方欄位
			'brand_id' => '品牌編號',
			'birthday' => '生日',
			'gender' => '性別',
			'tel' => '連絡電話',
			'fax' => '傳真',
			'mobile' => '行動電話',
			'email' => '電子郵件',
			'position'=>'職位',
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
		$criteria->compare('account',$this->account,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('level_id',$this->level_id);
		$criteria->compare('place_id',$this->place_id);
		$criteria->compare('branch_id',$this->branch_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}