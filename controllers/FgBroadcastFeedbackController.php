<?php

class FgBroadcastFeedbackController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column2';
	public $main_menu = 'fgbroadcastfeedback';

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
	public function actionView($device_id,$material_id)
	{
                
                $criteria = new CDbCriteria;
                $criteria2 = clone $criteria;
                $criteria->addCondition("device_id = ".$device_id);
                $criteria->addCondition("material_id = ".$material_id);
                
                $oFeedback = new FgBroadcastFeedbackItem();
                $lists = $oFeedback->findAll($criteria);
                
                $criteria2->addCondition("material_id = ".$material_id);
                $oQuestion = new FgMaterialQuestion();
                $questionLists = $oQuestion->findAll($criteria2);
                
                foreach($lists as $k=>$v){
                    foreach($questionLists as $key=>$val){
                        if($v->question_id == $val->id){
                            $item1_qty[$key] += 1; 
                            if($v->question_item == $val->item1){
                                $item1_qty[$key] += 1; 
                            }else if($v->question_item == $val->item2){
                                
                            }else if($v->question_item == $val->item3){
                                
                            }else if($v->question_item == $val->item4){
                                
                            }else if($v->question_item == $val->item5){
                                
                            }
                            
                            break;
                        }
                    }
                }
                
            
		$this->render('view',array(
			//'model'=>$this->loadModel($id),
                        'questionLists'=>$questionLists,
                        'item1_qty'=>$item1_qty,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new FgBroadcastFeedback;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['FgBroadcastFeedback'])) {
			$model->attributes=$_POST['FgBroadcastFeedback'];
			if ($model->save()) {
				$typeObj = FgBroadcastFeedbackType::model()->findByPk($model->place_type_id);
				$common = new CommonFunction();
				$common->record($model->id.'-'.$model->name.'-'.$typeObj->name);
				$this->redirect(array('FgBroadcastFeedback/view','id'=>$model->id));
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

		if (isset($_POST['FgBroadcastFeedback'])) {
			$model->attributes=$_POST['FgBroadcastFeedback'];
			if ($model->save()) {
				$this->redirect(array('FgBroadcastFeedback/view','id'=>$model->id));
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
	public function actionIndex($material_id)
	{
            $p['material_id'] = $material_id;
            $dataLists = FgBroadcastFeedback::model()->filterData($p);
            if($dataLists == ""){
                $dataLists = array();
            }
      
            $this->render('index',array(
                'dataLists'=>$dataLists,
            ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FgBroadcastFeedback('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['FgBroadcastFeedback'])) {
			$model->attributes=$_GET['FgBroadcastFeedback'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FgBroadcastFeedback the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FgBroadcastFeedback::model()->findByPk($id);
		//$typeObj = FgPlaceType::model()->findByPk($model->place_type_id);
		$common = new CommonFunction();
		//$common->record($model->id.'-'.$model->name.'-'.$typeObj->name);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FgBroadcastFeedback $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='fg-place-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}