<?php

/**
 * This is the model class for table "fg_permission".
 *
 * The followings are the available columns in table 'fg_permission':
 * @property integer $id
 * @property integer $level_id
 * @property integer $function_id
 * @property integer $ins
 * @property integer $upd
 * @property integer $del
 * @property integer $sel
 * @property integer $print
 *
 * The followings are the available model relations:
 * @property FgLevel $level
 * @property FgFunction $function
 */
class FgPermission extends CActiveRecord
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
	 * @return FgPermission the static model class
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
		return 'FG_Permission_2';
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
			array('id, level_id, function_id, ins, upd, del, sel, print', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, level_id, function_id, ins, upd, del, sel, print', 'safe', 'on'=>'search'),
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
			'level' => array(self::BELONGS_TO, 'FgLevel', 'level_id'),
			'function' => array(self::BELONGS_TO, 'FgFunction', 'function_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '流水號',
			'level_id' => '頭銜名稱',
			'function_id' => '功能名稱',
			'ins' => '新增',
			'upd' => '修改',
			'del' => '刪除',
			'sel' => '查詢',
			'print' => '列印',
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
		$criteria->compare('level_id',$this->level_id);
		$criteria->compare('function_id',$this->function_id);
		$criteria->compare('ins',$this->ins);
		$criteria->compare('upd',$this->upd);
		$criteria->compare('del',$this->del);
		$criteria->compare('sel',$this->sel);
		$criteria->compare('print',$this->print);
		$criteria->order = 'level_id asc';
		if(isset($_GET['level_id'])){
			$criteria->condition = 'level_id=:level_id';
			$criteria->params = array(':level_id'=>$_GET['level_id']);
		}
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}