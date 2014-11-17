<?php

class FgIndexController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';
	public $main_menu="fgindex";
	public $pageTitle="首頁";
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
		$model=new FgMaterialPull;
		$model->updatedate = $model->getUpdateDate();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['FgMaterialPull'])) {
			$model->attributes=$_POST['FgMaterialPull'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
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

		if (isset($_POST['FgMaterialPull'])) {
			$model->attributes=$_POST['FgMaterialPull'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
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
                $dataLists = array();
                $errLists = array();
                $dataLists = FgBroadcastPeriod::model()->backEndSearch($_GET);
                $errLists = FgBroadcastAd::model()->warnMacForToday();
                
		$this->render('index',array(
                        'dataLists'=>$dataLists,
                        'errLists'=>$errLists,
                        'p'=>$_GET,
		));
	}
        
        public function actionMaterialPull(){

            $this->renderPartial('material_pull');

        }

        public function actionFeedback(){
            
            
            
            $dataLists = FgBroadcastFeedback::model()->filterData($_GET);
            if($dataLists == ""){
                $dataLists = array();
            }
      
            $this->render('material_feedback',array(
                'dataLists'=>$dataLists,
                'p'=>$_GET,
            ));

        }

        public function actionShowMaterial($period_date,$device_id){

            $criteria = new CDbCriteria;
            $criteria->addCondition("period_date = '".$period_date."' ");
            $criteria->addCondition("device_id = '".$device_id."' ");
            $lists = FgBroadcastPeriod::model()->findAll($criteria);

            $this->render("material_list",array("lists"=>$lists));

        }
        
        public function actionShowMutual($device_id,$material_id,$s_date="",$e_date=""){
            
            $criteria = new CDbCriteria;
            if($s_date != "")
                $criteria->addCondition("create_datetime >= '".$s_date."' ");
            if($e_date != "")
                $criteria->addCondition("create_datetime <= '".$e_date."' ");
            $criteria->addCondition("device_id = '".$device_id."' ");
            $criteria->addCondition("material_id = '".$material_id."' ");
            $lists = FgBroadcastFeedbackItem::model()->findAll($criteria);

            $this->render("mutual_list",array("lists"=>$lists));
            
        }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FgMaterialPull('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['FgMaterialPull'])) {
			$model->attributes=$_GET['FgMaterialPull'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FgMaterialPull the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FgMaterialPull::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FgMaterialPull $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='fgdblog-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}