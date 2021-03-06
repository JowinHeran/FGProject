<?php

class FgAdvertiserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column2';
	public $main_menu = 'fgadvertiser';

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
	public function actionCreate()
	{
		$model=new FgAdvertiser;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['FgAdvertiser'])) {
			$model->attributes=$_POST['FgAdvertiser'];
			if ($model->save()) {
				$common = new CommonFunction();
				$common->record($model->id.'-'.$model->name);
				// $this->redirect(array('/FG_Manage_2/fgContact/Create','advertiser_id'=>$model->id,'brand_id'=>$model->brand_id));
				// $this->redirect(array('/FG_Manage_2/fgUser/CreateContact','brand_id'=>$model->id));
				$this->redirect(array('view','id'=>$model->id));
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

		if (isset($_POST['FgAdvertiser'])) {
			$model->attributes=$_POST['FgAdvertiser'];
			if ($model->save()) {
				// $this->redirect(array('/FG_Manage_2/fgContact/CreateContact','advertiser_id'=>$model->id,'brand_id'=>$model->brand_id));
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
		$dataProvider=new CActiveDataProvider('FgAdvertiser');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FgAdvertiser('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['FgAdvertiser'])) {
			$model->attributes=$_GET['FgAdvertiser'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FgAdvertiser the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FgAdvertiser::model()->findByPk($id);
		$common = new CommonFunction();
		$common->record($model->id.'-'.$model->name);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}
	public function selectItem(){
		$brandModel = FgBrand::model()->findAll();
		$selectItem['brand']=CHtml::listData($brandModel,'id','name');
		// $fglevel = FgLevel::model()->find('name=:name',array(':name'=>"廣告主"));
		// $userModel = FgUser::model()->findAll('level_id=:level_id',array(':level_id'=>$fglevel->id));
		// $selectItem['user'] = CHtml::listData($userModel,'id','name');
		return $selectItem;
	}
	/**
	 * Performs the AJAX validation.
	 * @param FgAdvertiser $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='fg-brand-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}