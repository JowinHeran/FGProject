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
class FgMaterialQuestion extends RewriteAR
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FgCity the static model class
	 */
    
        public static $base_upload_photo_dir ="/../images/materialQuestion/bg_image/";
        public static $base_upload_voice_dir ="/../images/materialQuestion/bg_voice/";
                   
	public static $base_image_path = "/fashionguide/images/materialQuestion/bg_image/";
        public static $base_voice_path = "/fashionguide/images/materialQuestion/bg_voice/";
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'FG_Material_Question_2';
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
			array('id,type,material_id,item1_type, item2_type, item3_type, item4_type, item5_type, link_type, link_file', 'numerical', 'integerOnly'=>true),
			array('name, item1, item2, item3, item4, item5, item1_file, item1_link, item2_file, item2_link, item3_file, item3_link, item4_file, item4_link, item5_file, item5_link,background_image, background_voice, link_link', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, item1, item2, item3, item4, item5, material_id,type', 'safe', 'on'=>'search'),
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
                        'type'=>'類型',
			// 'name' => '問題',
                        'name' =>'問題/說明',
			'item1' => '選項1',
                        'item1_type'=>'選項1類型',
                        'item1_file' => '素材代碼1ID',
                        'item1_link' => '素材連結1',
			'item2' => '選項2',
                        'item2_type'=>'選項2類型',
                        'item2_file' => '素材代碼2ID',
                        'item2_link' => '素材連結2',
                        'item3' => '選項3',
                        'item3_type'=>'選項3類型',
                        'item3_file' => '素材代碼3ID',
                        'item3_link' => '素材連結3',
                        'item4' => '選項4',
                        'item4_type'=>'選項4類型',
                        'item4_file' => '素材代碼4ID',
                        'item4_link' => '素材連結4',
                        'item5' => '選項5',
                        'item5_type'=>'選項5類型',
                        'item5_file' => '素材代碼5ID',
                        'item5_link' => '素材連結5',
                        'background_image'=>'底圖',
                        'background_voice'=>'背景音',
                        'link_type'=>'連結類型',
                        'link_file'=>'連結素材ID',
                        'link_link'=>'連結',
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
                $criteria->compare('material_id',$this->material_id);
                if(!empty($this->type))
                    $criteria->compare('type',$this->type);
		$criteria->compare('name',$this->name,true);
		// $criteria->compare('direction.name',$this->direction->name);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getLists($p){
            
            $criteria=new CDbCriteria();
            
            if(!empty($p['material_id']))
                $criteria->compare('material_id',$p['material_id']);
            
            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            ));
        }
        
        public function getFile($type){
                switch($type){
                    case 1:
                        return FgMaterialQuestion::$base_upload_photo_dir.$this->background_image;
                        break;
                    case 2:
                        return FgMaterialQuestion::$base_upload_voice_dir.$this->background_voice;
                        break;
                    default:
                        //return FGMaterial::$base_upload_photo_dir.$this->image;
                        break;
                }
		
	}
	public function getFilePath($type){
                    switch($type){
                        case 1:
                            if($this->background_image == "") return false;
                            return FgMaterialQuestion::$base_image_path.$this->background_image;
                            break;
                        case 2:
                            if($this->background_voice == "") return false;
                            return FgMaterialQuestion::$base_voice_path.$this->background_voice;
                            break;
                    }
			

	}
}