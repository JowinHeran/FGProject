<?php

/**
 * This is the model class for table "fg_tag_2".
 *
 * The followings are the available columns in table 'fg_tag_2':
 * @property integer $id
 * @property string $name
 * @property string $remark
 */
class FgTag extends CActiveRecord
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
	 * @return Tag the static model class
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
		return 'FG_Tag_2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>45),
			array('remark,sub_category', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name,sub_category, remark', 'safe', 'on'=>'search'),
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
			'id' => '流水號',
			'name' => '標籤名稱',
			'sub_category' => '子分類名稱',
			'remark' => '備註',
		);
	}
	// 1114補上找尋子分類功能
	public function find_sub_tag(){
		$subModel = FgSubTag::model()->findAll('tag_id=:tag_id',array(':tag_id'=>$this->id));
		$subArr = CHtml::listdata($subModel,'id','name');
		$urlStr = "/FG_Manage_2/FgSubTag";
		if(!$subModel){
			$url = Yii::app()->createUrl($urlStr.'/create/',array('tag_id'=>$this->id));
			return CHtml::link("建立子分類",$url);
		}else{
			$url = Yii::app()->createUrl($urlStr.'/index/',array('tag_id'=>$this->id));
			return end($subArr)."<br>".CHtml::link("檢視子分類",$url);
		}
		// var_dump($subModel);

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
		$criteria->compare('remark',$this->remark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}