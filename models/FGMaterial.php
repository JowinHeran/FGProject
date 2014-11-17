<?php

/**
 * This is the model class for table "FG_Material".
 *
 * The followings are the available columns in table 'FG_Material':
 * @property integer $id
 * @property string $name
 * @property string $type
 */
class FGMaterial extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FGMaterial the static model class
	 */
	public static $base_upload_photo_dir ="/../images/material/";
                   public static $base_upload_photo_v_dir ="/../images/material-v/";
                   public static $base_upload_movie_dir ="/../images/material-movie/";
                   
	public static $base_image_path = "/fashionguide/images/material/";
                   public static $base_image_v_path = "/fashionguide/images/material-v/";
                   public static $base_movie_path = "/fashionguide/images/material-movie/";
                   
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
		return 'FG_Material_2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,device_type_id', 'required'),
                        array('device_type_id, brand_id, relate_id', 'numerical', 'integerOnly'=>true),
                        array('remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, image, movie, url,remark', 'safe', 'on'=>'search'),
			
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
                                        'oDeviceType'=>array(self::BELONGS_TO,'FgDeviceType','device_type_id'),
                                        'oBrand'=>array(self::BELONGS_TO,'FgBrand','brand_id'),
                                        'oQuestion'=>array(self::HAS_MANY,'FgMaterialQuestion','material_id'),
		);

	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '流水號',
			// 'name' => '素材名稱',
			'name'=>'篇名',
			'type' => '素材類型',
			'image'=>'素材(橫)',
                        'image_v'=>'素材(直)',
                        // 'image'=>'圖片(水平)',
                        // 'image_v'=>'圖片(垂直)',
                        'movie'=>'影片',
                        'device_type_id'=>'裝置類型',
                        'brand_id'=>'品牌',
                        'remark'=>'成效目標說明',
		);
	}
	public function getImage($type){
                                      switch($type){
                                          case 1:
                                              return FGMaterial::$base_upload_photo_dir.$this->image;
                                              break;
                                          case 2:
                                              return FGMaterial::$base_upload_photo_v_dir.$this->image_v;
                                              break;
                                           case 3:
                                               return FGMaterial::$base_upload_movie_dir.$this->movie;
                                              break;
                                          default:
                                              return FGMaterial::$base_upload_photo_dir.$this->image;
                                              break;
                                      }
		
	}
	public function getImagePath(){
		if($this->image==""){
			return false;
		}else{
			return FGMaterial::$base_image_path.$this->image;
		}
	}
                    public function getImage_vPath(){
		if($this->image_v==""){
			return false;
		}else{
			return FGMaterial::$base_image_v_path.$this->image_v;
		}
	}
                    public function getMoviePath(){
		if($this->movie==""){
			return false;
		}else{
			return FGMaterial::$base_movie_path.$this->movie;
		}
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
		$criteria->compare('type',$this->type,true);
                                       $criteria->compare('brand_id',$this->brand_id,true);
                                       $criteria->compare('device_type_id',$this->device_type_id,true);
                $criteria->order = "id desc";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function composeSearch($p){
            
            $tableDeviceType = FgDeviceType::model()->tableName();
            $tableBrand = FgBrand::model()->tableName();
            $tableMaterial = $this->tableName();
            
            $sql = "
                    SELECT A.name as materialName, B.name as deviceName, C.name as brandName,
                           A.image as image, A.id as materialID
                    FROM `$tableMaterial` A LEFT JOIN `$tableDeviceType` B 
                         ON A.device_type_id = B.id
                         LEFT JOIN `$tableBrand` C
                         ON A.brand_id = C.id
                    WHERE 1=1 ";
            
            if($p["device_type_id"] != ""){
                $sql .= " AND A.device_type_id = '".$p["device_type_id"]."' ";
            }
            if($p["name"] != ""){
                $sql .= " AND A.name LIKE '%".$p["name"]."%' ";
            }
            //echo $sql;
            return Yii::app()->dbfgmanage->createCommand($sql)->queryAll();
            
        }
}