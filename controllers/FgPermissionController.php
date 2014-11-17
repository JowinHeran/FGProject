<?php

class FgPermissionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column2';
	public $main_menu = 'fgpermission';

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
		$model=new FgPermission;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['FgPermission'])) {
			$model->attributes=$_POST['FgPermission'];
			if ($model->save()) {
				$common = new CommonFunction();
				$common->record($model->id.'-'.$model->level->name);
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

		if (isset($_POST['FgPermission'])) {
			$model->attributes=$_POST['FgPermission'];
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
		$criteria=new CDbCriteria;
		$criteria->order = 'level_id asc';
		if(isset($_GET['level_id'])){
			$criteria->condition = 'level_id=:level_id';
			$criteria->params = array(':level_id'=>$_GET['level_id']);
		}
		$dataProvider=new CActiveDataProvider('FgPermission',array(
			'criteria'=>$criteria,
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
		$model=new FgPermission('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['FgPermission'])) {
			$model->attributes=$_GET['FgPermission'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function showRightLinkButton($actionName){
		$model = FgPermission::model()->findAll(array('group'=>'level_id'));
	   foreach ($model as $key => $value) {
	        echo TbHtml::linkButton($value->level->name,array(
	                        'icon'=>'user',
	                        'color'=>TbHtml::BUTTON_COLOR_INFO,
	                        'url'=>Yii::app()->createUrl('/FG_Manage_2/FgPermission/'.$actionName.'/',array('level_id'=>$value->level->id)),
	                        'style'=>$_GET['level_id']==$value->level->id ? 'background:#2f96b4' : false,
	                ));
	        echo "&nbsp;&nbsp;";
	       // var_dump($value->level->name);
	   }
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FgPermission the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FgPermission::model()->findByPk($id);
		$common = new CommonFunction();
		$common->record($model->id.'-'.$model->level->name);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}
	public function selectItem(){
		$levelModel = FgLevel::model()->findAll();
		$selectItem['level'] = CHtml::listData($levelModel,'id','name');
		$functionModel = FgFunction::model()->findAll();
		$selectItem['function'] = CHtml::listData($functionModel,'id','name');
		return $selectItem;
	}
	/**
	 * Performs the AJAX validation.
	 * @param FgPermission $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='fg-permission-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}