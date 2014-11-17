<?php

class FgMaterialQuestionResultController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column2';
	public $main_menu = 'fgmaterialquestionresult';

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
                
                
                $model = $this->loadModel($id);
                $p['material_id'] = $model->material_id;
                $questionLists = FgMaterialQuestion::model()->getLists($p);
                
                $answerArray = $this->parserAnswer($model->answer);
		$this->render('view',array(
			'model'=>$model,
                        'questionLists'=>$questionLists,
                        'answerArray'=>$answerArray,
		));
	}
        
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($material_id)
	{
		$model=new FgMaterialQuestionResult;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $topModel = FGMaterial::model()->findByPK($material_id);
                
                $p['material_id'] = $material_id;
                $questionLists = FgMaterialQuestion::model()->getLists($p);
                
		if (isset($_POST['FgMaterialQuestionResult'])) {
			$model->attributes=$_POST['FgMaterialQuestionResult'];
                        $model->answer = $this->composeAnswer($questionLists,$_POST['FgMaterialQuestionResult']);
			if ($model->save()) {
				//$common = new CommonFunction();
				//$common->record($model->id.'-'.$model->name.'-'.$directionObj->name);
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
                        'topModel'=>$topModel,
                        'questionLists'=>$questionLists,
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
                $p['material_id'] = $model->material_id;
                $questionLists = FgMaterialQuestion::model()->getLists($p);
                $answerArray =$this->parserAnswer($model->answer);
		if (isset($_POST['FgMaterialQuestionResult'])) {
			$model->attributes=$_POST['FgMaterialQuestionResult'];
                        $model->answer = $this->composeAnswer($questionLists,$_POST['FgMaterialQuestionResult']);
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
                        'questionLists'=>$questionLists,
                        'answerArray'=>$answerArray,
		));
	}
        
        /*
         * 答案返回正列
         */
        protected function parserAnswer($answer){
            
            $slice = explode(";", $answer);
            
            $result = array();
            
            foreach($slice as $key=>$val){
                
                $slice2 = explode("=>",$val);
                $result[$slice2[0]] = $slice2[1];
                
            }
            
            return $result;
        }

        /*
         * 答案組成字串
         */
        protected function composeAnswer($oLists,$vars){
            
            $result = array();
            foreach($oLists->data as $key=>$val){
                
                $ans = $_POST['item'.$val->id];
                
                if(!isset($ans)){
                    $ans = 'n/a';
                }
                
                $result[$key] = $val->id."=>".$ans;
                
            }
            
            return implode(";", $result);
            
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

		$dataProvider=new CActiveDataProvider('FgMaterialQuestionResult',array(
                        'criteria'=>array(
                            'condition'=>'material_id = '.$material_id,
                        ),
			'pagination'=>array(
				'pageSize'=> 5,
			),
		));
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
                        'topModel'=>$topModel,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FgMaterialQuestionResult('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['FgMaterialQuestionResult'])) {
			$model->attributes=$_GET['FgMaterialQuestionResult'];
		}
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FgMaterialQuestionResult the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FgMaterialQuestionResult::model()->findByPk($id);
		//$common = new CommonFunction();
		//$common->record($model->id.'-'.$model->name.'-'.$directionObj->name);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FgMaterialQuestionResult $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='fg-city-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}