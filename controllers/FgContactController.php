<?php

class FgContactController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column2';
	public $main_menu = 'FgContact';

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
		$criteria = new CDbCriteria();
		$criteria->condition = "id=:id";
		$criteria->params = array(":id"=>$id);
		$dataProvider=new CActiveDataProvider('FgContact',array('criteria'=>$criteria));
		$this->render('view_contact',array(
			'model'=>$dataProvider,
		));
	}
	public function actionViewContact($id){
		$criteria = new CDbCriteria();
		$criteria->condition = "brand_id=:brand_id";
		$criteria->params = array(":brand_id"=>$id);
		
		$dataProvider=new CActiveDataProvider('FgContact',array('criteria'=>$criteria));
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
		$model=new FgContact;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$common = new CommonFunction();
		if (isset($_POST['FgContact'])) {
			$model->attributes=$_POST['FgContact'];
			// $usermodel = FgContact::model()->find('account=:account',array(':account'=>$_POST['FgContact']['account']));
			// if($usermodel){
			//     $url = Yii::app()->createUrl("FG_Manage_2/FgContact/create");
			// 	$common->alertMsg($url,'該帳號已存在!');
			// 	exit;
			// }
			if ($model->save()) {
				$common->record($model->id.'-廣告主:'.$model->advertiser->name.'-聯絡人:'.$model->first_name.$model->second_name.'-職位:'.$model->position);
				$this->redirect(array('index','advertiser_id'=>$model->advertiser_id));
				// $this->redirect(array('view','id'=>$model->id));
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
		$model=new FgContact;
		$model->setScenario('requiredContact');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$common = new CommonFunction();
		$url = Yii::app()->createUrl("FG_Manage_2/FgContact/CreateContact",array('advertiser_id'=>$_GET['advertiser_id'],'brand_id'=>$_GET['brand_id']));
		if (isset($_POST['FgContact'])) {
			$model->attributes=$_POST['FgContact'];
			// $usermodel = FgContact::model()->find('account=:account',array(':account'=>$_POST['FgContact']['account']));
			
			// if($usermodel){
			   
			// 	$common->alertMsg($url,'該帳號已存在!');
			// 	exit;
			// }
			// if(!$model->name){
			// 	$common->alertMsg($url,'請填寫聯絡人姓名!');
			// 	exit;
			// }
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
				$common->record($model->id.'-廣告主:'.$model->advertiser->name.'-聯絡人:'.$model->first_name.$model->second_name.'-職位:'.$model->position);
				$this->redirect(array('/FG_Manage_2/fgContact/view/','id'=>$model->id));
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
		$url = Yii::app()->createUrl("FG_Manage_2/FgContact/create");
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['FgContact'])) {
			$model->attributes=$_POST['FgContact'];
			// $UserModel = FgContact::model()->find('account=:account',array(':account'=>$_POST['FgContact']['account']));
			// if($UserModel){
			// 	$common = new CommonFunction();
			// 	$common->alertMsg($url,'該帳號已存在!');
			// }
			if ($model->save()) {
				$this->redirect(array('index','advertiser_id'=>$model->advertiser_id));
				// $this->redirect(array('view','id'=>$model->id));
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
		$criteria = new CDbCriteria();
		$getAdId = trim($_GET['advertiser_id']);
		$getBrandId = trim($_GET['brand_id']);

		if(isset($getAdId) && $getAdId){
			$criteria->condition="advertiser_id=:advertiser_id";
			$criteria->params=array(":advertiser_id"=>$getAdId);
		}
		if(isset($getBrandId) && $getBrandId){
			$criteria->condition="brand_id=:brand_id";
			$criteria->params=array(':brand_id'=>$getBrandId);
		}
		$dataProvider=new CActiveDataProvider('FgContact',array('criteria'=>$criteria));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FgContact('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['FgContact'])) {
			$model->attributes=$_GET['FgContact'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FgContact the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FgContact::model()->findByPk($id);
		$common = new CommonFunction();
		$common->record($model->id.'-廣告主:'.$model->advertiser->name.'-聯絡人:'.$model->first_name.$model->second_name.'-職位:'.$model->position);
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
		$advertiserModel = FgAdvertiser::model()->findAll();
		$selectItem['advertiser'] = CHtml::listData($advertiserModel,'id','name');
		return $selectItem;
	}
	/**
	 * Performs the AJAX validation.
	 * @param FgContact $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='fg-user-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}