<?php

/**
 * This is the model class for table "fg_brand".
 *
 * The followings are the available columns in table 'fg_brand':
 * @property integer $id
 * @property string $name
 * @property integer $seq
 *
 * The followings are the available model relations:
 * @property FgAds[] $fgAds
 * @property FgDevice[] $fgDevices
 */
class FgBrand extends CActiveRecord
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
	 * @return FgBrand the static model class
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
		return 'FG_Brand_2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('id', 'required'),
			array('id, seq', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			//1110補上下方欄位
			array('company, manager','length','max'=>45),
			array('email, address','length','max'=>100),
			array('phone','safe'),
			array('exe_status, email_status, phone_status','numerical','integerOnly'=>true),
			//改存放於fguser資料表中，除了company及address名稱以外
			array('user_id','safe'),
			//1111補上下方欄位
			array('product','safe'),
			array('vat_number','safe'),
			array('contract','safe'),
			array('contract_status','safe'),
			array('contact_arr','safe'),
			// 1113補上下方欄位
			array('advertiser_id','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, seq', 'safe', 'on'=>'search'),
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
			'fgAds' => array(self::HAS_MANY, 'FgAds', 'brand_id'),
			'fgDevices' => array(self::MANY_MANY, 'FgDevice', 'fg_com_device_brand(brand_id, device_id)'),
			'material' => array(self::HAS_MANY,'FGMaterial','brand_id'),
			'user' => array(self::BELONGS_TO,'FgUser','user_id'),
			'advertiser' => array(self::BELONGS_TO,'FgAdvertiser','advertiser_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '流水號',
			'name' => '品牌名稱',
			'advertiser_id'=>'廣告主編號',
			'seq' => '排序',
			//1110補上下方欄位
			'company' => '公司名稱',
			'exe_status' => '執行狀態',
			'manager' => '聯絡窗口',
			'address' => '公司地址',
			'phone' => '連絡電話',
			'phone_status' => '電話驗證狀態',
			'email' =>'電子郵件',
			'email_status' => '電子郵件驗證狀態',
			//1111補上product欄位
			'product' =>'產品名稱',
			'vat_number' => '統一編號',
			'contract'=>'合約名稱',
			'contract_status'=>'合約狀態',
			'contact_arr' =>'聯絡人',
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
		$criteria->compare('seq',$this->seq);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function isEmpty($field,$msg){
		return (!$this->$field)?($msg):($this->$field);
	}
	// 1112取得名稱
	public function getContactName(){
		$getAdId = trim($_GET['advertiser_id']);
		$nameArr = array();
		if(isset($getAdId) && $getAdId){
			$contactModel = FgContact::model()->findAll('advertiser_id=:advertiser_id',array(':advertiser_id'=>$this->advertiser_id));
			$url = Yii::app()->createURL('/FG_Manage_2/fgContact/index/',array("advertiser_id"=>$getAdId));
		}else{
			$contactModel = FgContact::model()->findAll();
			$url = Yii::app()->createURL('/FG_Manage_2/fgContact/index/',array("advertiser_id"=>$this->advertiser_id));
		}
		foreach ($contactModel as $key => $value) {
			$nameArr[]=array("first_name"=>$value->first_name,"second_name"=>$value->second_name);
		}

		return (implode('',end($nameArr)))."<br>".CHtml::link('檢視全部',$url);
	}
	// 11/11補上下方代碼 index.php CGridView會用到
	public function getMaterial($type=""){
		$path = "/fashionguide/images/material/";
		$arr = CHtml::listData($this->material,'id',$type);
		$endvalue= end($arr);
		$key = key($arr);
		switch ($type) {
			case 'image':
				if($endvalue==""){
					return CHtml::image($path."no_image.png");
				}else{
					return CHtml::image($path.$endvalue)."<br>".CHtml::link("檢視全部",array("fGMaterial/admin/brand_id/".$this->id));
				}
			break;
			case 'name':
				if($endvalue==""){
					return "未建立素材";
				}else{
					// 檢視素材
					// return $endvalue."<br>".CHtml::link("檢視全部",array("fGMaterial/view/id/".$key));
					return $endvalue."<br>".CHtml::link("檢視全部",array("fGMaterial/admin/brand_id/".$this->id));
				}
			break;
			default:
			# code...
			break;
		}
	}
	public function getIcon(){
		return (!$this->exe_status)?(TbHtml::icon(TbHtml::ICON_REMOVE)):(TbHtml::icon(TbHtml::ICON_OK));
	}
	public function returnIconData($type=""){
		if($type==""){
			return array(0=>TbHtml::icon(TbHtml::ICON_REMOVE),1=>TbHtml::icon(TbHtml::ICON_OK));
		}else{
			return $type;
		}
		
	}
	public function isEmptyName($model,$msg,$path){
		return (!$this->$model->name)?($msg):($this->$model->name."<br>".CHtml::link("檢視全部",array($path)));
	}
}