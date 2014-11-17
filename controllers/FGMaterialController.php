<?php

class FGMaterialController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column1';
	public $main_menu="fgmaterial";
	public $pageTitle="素材設定";

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			// array('allow', // allow authenticated user to perform 'create' and 'update' actions
			// 	'actions'=>array('create','update'),
			// 	'users'=>array('@'),
			// ),
			// array('allow', // allow admin user to perform 'admin' and 'delete' actions
			// 	'actions'=>array('admin','delete'),
			// 	'users'=>array('admin'),
			// ),
			// array('deny',  // deny all users
			// 	'users'=>array('*'),
			// ),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id,$device_type_id="")
	{
                                        
                                    switch($device_type_id){
                                        case 4:
                                            $model=FGMaterialTV::model()->findByPk($id);
                                            break;
                                        case 5:
                                            $model=FGMaterialPAD::model()->findByPk($id);
                                            break;
                                        default:
                                            $model=FGMaterial::model()->findByPk($id);
                                            break;
                                    }
                                    
       $common = new CommonFunction();
		$common->record($model->id.'-'.$model->name.'-'.$model->oDeviceType->name.'-'.$model->oBrand->name);                                 
		$this->render('view',array(
			'model'=>$model,
		));
	}
                    
                    /*
                     * Dropdown list value create
                     */
                    public function selectItem(){
                        
                        $modelDeviceType = FgDeviceType::model()->findAll();
                        $selectItem['device_type'] = CHtml::listData($modelDeviceType,'id','name');
                        
                        $modelBrand = FgBrand::model()->findAll();
                        $selectItem['brand'] = CHtml::listData($modelBrand,'id','name');
                        
                        return $selectItem;
                    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new FGMaterial;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

                                        if (isset($_POST['FGMaterial'])) {
                                                
                                                $model->attributes=$_POST['FGMaterial'];
                                                $uploadedFile = CUploadedFile::getInstance($model,'image');
                                                $uploadedFile2 = CUploadedFile::getInstance($model,'image_v');
                                                $uploadedFile3 = CUploadedFile::getInstance($model,'movie');
                                                
                                            
                                                if ($model->save()) {
                                                	$common = new CommonFunction();
                                                    $common->record($model->id.'-'.$model->name.'-'.$model->oDeviceType->name.'-'.$model->oBrand->name);
                                                    $this->handlePhoto($model,$uploadedFile,$old_photo,1);
                                                    $this->handlePhoto($model,$uploadedFile2,$old_photo,2);
                                                    $this->handlePhoto($model,$uploadedFile3,$old_photo,3);
                                                    $this->saveOtherTable($model);
                                                    $this->redirect(array('view','id'=>$model->id,'device_type_id'=>$device_type_id));
                                                }
                                        }

		$this->render('create',array(
			'model'=>$model,
                                                          'selectItem'=>$this->selectItem(),
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if (isset($_POST['FGMaterial'])) {
                                                        $old_image = $model->image;
                                                        $old_image_v = $model->image_v;
                                                        $old_movie = $model->movie;
                                                        
                                                        $model->attributes=$_POST['FGMaterial'];
                                                        $model->url=$_POST['FGMaterial']['url'];
                                                        
                                                        $uploadedFile = CUploadedFile::getInstance($model,'image');
                                                        $uploadedFile2 = CUploadedFile::getInstance($model,'image_v');
                                                        $uploadedFile3 = CUploadedFile::getInstance($model,'movie');
			// var_dump(is_null($uploadedFile));
			// exit;
                                                          
			if ($model->save()) {
                                                            if(!is_null($uploadedFile)){
                                                                $this->handlePhoto($model,$uploadedFile,$old_image,1);
                                                            }
                                                            if(!is_null($uploadedFile2)){
                                                                $this->handlePhoto($model,$uploadedFile2,$old_image_v,2);
                                                            }
                                                            if(!is_null($uploadedFile3)){
                                                                $this->handlePhoto($model,$uploadedFile3,$old_movie,3);
                                                            }
                                                            $this->saveOtherTable($model);
                                                            $this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
                                                          'selectItem'=>$this->selectItem(),
		));
                
	}
                    
                   protected function saveOtherTable($model){
                       
                       switch($model->device_type_id){
                                                    case 4:
                                                        $otherModel = new FGMaterialTV;
                                                        break;
                                                    case 5:
                                                        $otherModel = new FGMaterialPAD;
                                                        break;
                        }
                        
                        $cloneModel = clone $model;

                        if( !empty($model->relate_id)){
                            $otherModel = $otherModel->findByPk($model->relate_id);
                            $id = $otherModel->id;
                            $cloneModel->id = $id;
                        }
                        
                        $otherModel->attributes = $cloneModel->attributes;
                        $otherModel->image = $cloneModel->image;
                        $otherModel->image_v = $cloneModel->image_v;
                        $otherModel->movie = $cloneModel->movie;
                        $otherModel->relate_id = $model->id;
                        

                        $otherModel->save();
                        
                        $model->relate_id = $otherModel->id;
                        $model->save();
                        
                       
                   }
        
	protected function handlePhoto($model, $uploadedFile,$old_photo="",$type=""){

                                       switch($model->device_type_id){
                                           case 4:
                                               $base_upload_photo_dir = FGMaterialTV::$base_upload_photo_dir;
                                               $base_upload_photo_v_dir = FGMaterialTV::$base_upload_photo_v_dir;
                                               $base_upload_movie_dir = FGMaterialTV::$base_upload_movie_dir;
                                               break;
                                           case 5:
                                               $base_upload_photo_dir = FGMaterialPAD::$base_upload_photo_dir;
                                               $base_upload_photo_v_dir = FGMaterialPAD::$base_upload_photo_v_dir;
                                               $base_upload_movie_dir = FGMaterialPAD::$base_upload_movie_dir;
                                               break;
                                       }
                                        
                                        switch($type){
                                            case 1:
                                                $define_path = Yii::app()->basePath.$base_upload_photo_dir.'/';
                                                $db_column = "image";
                                                break;
                                            case 2:
                                                $define_path = Yii::app()->basePath.$base_upload_photo_v_dir.'/';
                                                $db_column = "image_v";
                                                break;
                                            case 3:
                                                $define_path = Yii::app()->basePath.$base_upload_movie_dir.'/';
                                                $db_column = "movie";
                                                break;
                                            default:
                                                $define_path = Yii::app()->basePath.$base_upload_photo_dir.'/';
                                                $db_column = "image";
                                                break;
                                            
                                        }
                                      
                                        $upload_path = $define_path;
                                        $new_filename = "material-".$model->id.'-'.uniqid(rand(), false);
        
                                        $this->uploadPhoto($model, $uploadedFile,$db_column, $upload_path, $old_photo,$new_filename);

                    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
                    public function actionDelete($id){
                            if (Yii::app()->request->isPostRequest) {
                                    // we only allow deletion via POST request
                                    $model = $this->loadModel($id);
                                    
                                    switch($model->device_type_id){
                                        case 4:
                                            $otherModel = FGMaterialTV::model()->findByPK($model->relate_id);
                                            $otherModel->delete();
                                            break;
                                        case 5:
                                            $otherModel = FGMaterialPAD::model()->findByPK($model->relate_id);
                                            $otherModel->delete();
                                            break;
                                    }
                                    
                                    $model->delete();

                                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                                    if (!isset($_GET['ajax'])) {
                                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                                    }
                            } else {
                                    throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
                            }
                    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
                                        
		$dataProvider=new CActiveDataProvider('FGMaterial',
			array(
                            'pagination'=>array(
			        'pageSize'=>20,
			        // 'pageVar'=>'custom-page-selector', //page selector
			    ),
                            'criteria'=>array(
                                    'order'=>"id desc",
                            ),
                        
		));
                                       
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FGMaterial('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['FGMaterial'])) {
			$model->attributes=$_GET['FGMaterial'];
		}
		if(isset($_GET['brand_id'])){
			$model->brand_id = $_GET['brand_id'];
		}
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FGMaterial the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FGMaterial::model()->findByPk($id);
		$common = new CommonFunction();
		$common->record($model->id.'-'.$model->name.'-'.$model->oDeviceType->name.'-'.$model->oBrand->name);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FGMaterial $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='fgmaterial-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}