<?php

class FgUserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column2';
	public $main_menu = 'fguser';

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
				'actions'=>array('index','view',''),
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
		$model = $this->loadModel($id);
		if($model->level_id==3){
			$criteria = new CDbCriteria();
			$criteria->condition = "brand_id=:brand_id";
			$criteria->params = array(":brand_id"=>$model->brand_id);
			$dataProvider=new CActiveDataProvider('FgUser',array('criteria'=>$criteria));
			$this->render('view_contact',array(
			'model'=>$dataProvider,
			));
		}else{
			$this->render('view',array(
			'model'=>$model,
			));
		}
	}
	public function actionViewContact($id){
		$criteria = new CDbCriteria();
		$criteria->condition = "brand_id=:brand_id";
		$criteria->params = array(":brand_id"=>$id);
		
		$dataProvider=new CActiveDataProvider('FgUser',array('criteria'=>$criteria));
		$this->render('view_contact',array(
			// 'model'=>$this->loadModel($id),
			'model'=>$dataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new FgUser;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$common = new CommonFunction();
		if (isset($_POST['FgUser'])) {
			$model->attributes=$_POST['FgUser'];
			$usermodel = FgUser::model()->find('account=:account',array(':account'=>$_POST['FgUser']['account']));
			if($usermodel){
			    $url = Yii::app()->createUrl("FG_Manage_2/fgUser/create");
				$common->alertMsg($url,'該帳號已存在!');
				exit;
			}
			if ($model->save()) {
				$common->record($model->id.'-'.$model->account.'-'.$model->level->name);
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'selectItem'=>$this->selectItem(),
		));
	}
	//1111補上聯絡人表單
	public function actionCreateContact()
	{
		$model=new FgUser;
		$model->setScenario('requiredContact');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$common = new CommonFunction();
		$url = Yii::app()->createUrl("FG_Manage_2/fgUser/CreateContact",array('brand_id'=>$_GET['brand_id']));
		if (isset($_POST['FgUser'])) {
			$model->attributes=$_POST['FgUser'];
			$usermodel = FgUser::model()->find('account=:account',array(':account'=>$_POST['FgUser']['account']));
			
			if($usermodel){
			   
				$common->alertMsg($url,'該帳號已存在!');
				exit;
			}
			if(!$model->name){
				$common->alertMsg($url,'請填寫聯絡人姓名!');
				exit;
			}
			if(!$model->position){
				$common->alertMsg($url,'請填寫聯絡人職位!');
				exit;
			}
			if(!$model->mobile){
				$common->alertMsg($url,'請填寫聯絡人電話!');
				exit;
			}
			if(!$model->email){
				$common->alertMsg($url,'請填寫聯絡人電子郵件!');
				exit;
			}
			if ($model->save()) {
				$common->record($model->id.'-聯絡人:'.$model->name.'-'.$model->brand->name."-聯絡方式:".$model->mobile."-email:".$model->email);
				$this->redirect(array('/FG_Manage_2/fgBrand/view/','id'=>$model->brand_id));
				// $this->redirect(array('view','id'=>$model->id));
				// $this->renderPartial('_view_contact',array('id'=>$model->id));
			}
			
		}

		$this->render('createcontact',array(
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
		$url = Yii::app()->createUrl("FG_Manage_2/fgUser/create");
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['FgUser'])) {
			$model->attributes=$_POST['FgUser'];
			$UserModel = FgUser::model()->find('account=:account',array(':account'=>$_POST['FgUser']['account']));
			if($UserModel){
				$common = new CommonFunction();
				$common->alertMsg($url,'該帳號已存在!');
			}
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'selectItem'=>$this->selectItem(),
		));
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
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('FgUser');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FgUser('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['FgUser'])) {
			$model->attributes=$_GET['FgUser'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FgUser the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FgUser::model()->findByPk($id);
		$common = new CommonFunction();
		$common->record($model->id.'-'.$model->account.'-'.$model->level->name);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}
	public function selectItem(){
		$levelModel = FgLevel::model()->findAll();
		$selectItem['level'] = CHtml::listData($levelModel,'id','name');
		$placeModel = FgPlace::model()->findAll();
		$selectItem['place'] = CHtml::listData($placeModel,'id','name');
		$branchModel = FgBranch::model()->findAll();
		$selectItem['branch'] = CHtml::listData($branchModel,'id','name');
		$brandModel = FgBrand::model()->findAll();
		$selectItem['brand'] = CHtml::listData($brandModel,'id','name');
		return $selectItem;
	}
	/**
	 * Performs the AJAX validation.
	 * @param FgUser $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='fg-user-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}