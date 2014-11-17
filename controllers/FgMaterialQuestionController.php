<?php

class FgMaterialQuestionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column2';
	public $main_menu = 'fgmaterialquestion';

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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($material_id)
	{
		$model=new FgMaterialQuestion;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $topModel = FGMaterial::model()->findByPK($material_id);
     
		if (isset($_POST['FgMaterialQuestion'])) {
			$model->attributes=$_POST['FgMaterialQuestion'];
                        $uploadedFile = CUploadedFile::getInstance($model,'background_image');
                        $uploadedFile2 = CUploadedFile::getInstance($model,'background_voice');
                        if($model->type == 1){
                            $model->item1_type = "";
                            $model->item2_type = "";
                            $model->item3_type = "";
                            $model->item4_type = "";
                            $model->item5_type = "";
                        }else{
                            $model->link_type = "";
                        }
			if ($model->save()) {
				$common = new CommonFunction();
				$common->record($model->id.'-'.$model->name.'-'.$directionObj->name);
                                $this->handlePhoto($model,$uploadedFile,$old_photo,1);
                                $this->handlePhoto($model,$uploadedFile2,$old_photo,2);
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
                        'topModel'=>$topModel,
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
                $old_image = $model->background_image;
                $old_voice = $model->background_voice;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['FgMaterialQuestion'])) {
			$model->attributes=$_POST['FgMaterialQuestion'];
                        $uploadedFile = CUploadedFile::getInstance($model,'background_image');
                        $uploadedFile2 = CUploadedFile::getInstance($model,'background_voice');
                        $model->background_image = $old_image;
                        $model->background_voice = $old_voice;
                         if($model->type == 1){
                            $model->item1_type = "";
                            $model->item2_type = "";
                            $model->item3_type = "";
                            $model->item4_type = "";
                            $model->item5_type = "";
                        }else{
                            $model->link_type = "";
                        }
			if ($model->save()) {
                                if(!is_null($uploadedFile)){
                                    $this->handlePhoto($model,$uploadedFile,$old_image,1);
                                }
                                if(!is_null($uploadedFile2)){
                                    $this->handlePhoto($model,$uploadedFile2,$old_voice,2);
                                }
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        protected function handlePhoto($model, $uploadedFile,$old_photo="",$type=""){
                                        switch($type){
                                            case 1:
                                                $define_path = Yii::app()->basePath.FgMaterialQuestion::$base_upload_photo_dir.'/';
                                                $db_column = "background_image";
                                                break;
                                            case 2:
                                                $define_path = Yii::app()->basePath.FgMaterialQuestion::$base_upload_voice_dir.'/';
                                                $db_column = "background_voice";
                                                break;
                                            default:
//                                                $define_path = Yii::app()->basePath.$base_upload_photo_dir.'/';
//                                                $db_column = "image";
                                                break;
                                            
                                        }
                                      
                                        $upload_path = $define_path;
                                        $new_filename = "materialQuestion-".$model->id.'-'.uniqid(rand(), false);
        
                                        $this->uploadPhoto($model, $uploadedFile,$db_column, $upload_path, $old_photo,$new_filename);

        }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

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
	public function actionIndex($material_id)
	{
            
            $topModel = FGMaterial::model()->findByPK($material_id);

		$dataProvider=new CActiveDataProvider('FgMaterialQuestion',array(
                        'criteria'=>array(
                            'condition'=>'material_id = '.$material_id,
                        ),
			'pagination'=>array(
				'pageSize'=> 5,
			),
		));
                
                $optionRegular = array();
                $optionArray = array();
                foreach($dataProvider->data as $key=>$val){
                    if($val->type == 1 || $val->type == 4 || $val->type == 5){
                        $optionRegular[] = $val;
                    }else if($val->type == 2 || $val->type == 3){
                        $optionArray[] = $val;
                    }
                }
               
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
                        'topModel'=>$topModel,
                        'optionCount'=>count($optionArray),
                        'regularCount'=>count($optionRegular),
                        'addBtnCancel'=>(count($optionRegular) >=1 || count($optionArray) >= 3),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($material_id)
	{
                $topModel = FGMaterial::model()->findByPK($material_id);
		$model=new FgMaterialQuestion('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['FgMaterialQuestion'])) {
			$model->attributes=$_GET['FgMaterialQuestion'];
                        
		}
                $model->material_id = $material_id;
                
		$this->render('admin',array(
			'model'=>$model,
                        'topModel'=>$topModel,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FgMaterialQuestion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FgMaterialQuestion::model()->findByPk($id);
		$common = new CommonFunction();
		$common->record($model->id.'-'.$model->name.'-'.$directionObj->name);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FgMaterialQuestion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='fg-city-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}