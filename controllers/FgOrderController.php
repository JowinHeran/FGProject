<?php

class FgOrderController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column2';
	public $main_menu = 'fgorder';

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
		$model=new FgOrder;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['FgOrder'])) {
			$model->attributes=$_POST['FgOrder'];
			if ($model->save()) {
				$directionObj = FgDirection::model()->findByPk($model->direction_id);
				$common = new CommonFunction();
				$common->record($model->id.'-'.$model->name.'-'.$directionObj->name);
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
                                                          'oPackage'=>array(),
                                                          'oPackageItem'=>array(),
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
                $condition = new CDbCriteria();
                $condition->condition = "order_id = '".$model->id."'";
                $oPackage = FgMaterialPackage::model()->findAll($condition);
                $oPackageItem = FgMaterialPackageItem::model()->findAll($condition);

		if (isset($_POST['FgOrder'])) {
			$model->attributes=$_POST['FgOrder'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
                                                        'oPackage'=>$oPackage,
                                                        'oPackageItem'=>$oPackageItem,
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

		$dataProvider=new CActiveDataProvider('FgOrder',array(
			'pagination'=>array(
				'pageSize'=> 5,
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
		$model=new FgOrder('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['FgOrder'])) {
			$model->attributes=$_GET['FgOrder'];
		}
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FgOrder the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FgOrder::model()->findByPk($id);
		//$directionObj = FgDirection::model()->findByPk($model->direction_id);
		//$common = new CommonFunction();
		//$common->record($model->id.'-'.$model->name.'-'.$directionObj->name);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FgOrder $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='fg-city-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionAjaxBranch(){
           
           $data = FgDevice::model()->composeSearch($_GET);
           
           echo json_encode($data);
        }
        
        public function actionAjaxMaterial(){
            
            $data = FGMaterial::model()->composeSearch($_GET);
           
            echo json_encode($data);
            
        }
        
        public function actionAjaxSave(){
            
            $model = new FgOrder;
            
            if( !empty($_POST['id'])){
                $model = $model->findByPK($_POST['id']);
            }
            
            $model->name = $_POST['name'];
            $model->s_date = $_POST['s_date'];
            $model->e_date = $_POST['e_date'];
            if($_POST['time_type'] != "")
                $model->time_type = implode(",",$_POST['time_type']);
            if($_POST['sub_tag']!=""){
            	$model->sub_tag = implode(",",$_POST['sub_tag']);
            }
            $model->status = $_POST['status'];
            $model->save();
            
            $oPackage = new FgMaterialPackage;
            $oPackage->clearOrderID($model->id);
            foreach($_POST['devices'] as $key=>$val){
                $oPackage->unsetAttributes(); 
                $oPackage->order_id = $model->id;
                $oPackage->device_id = $val;
                $oPackage->isNewRecord = true;
                $oPackage->save(); 
            }
            
            $oPackageItem = new FgMaterialPackageItem;
            $oPackageItem->clearOrderID($model->id);
            foreach($_POST['materials'] as $key=>$val){
                $oPackageItem->unsetAttributes(); 
                $oPackageItem->order_id = $model->id;
                $oPackageItem->material_id = $val;
                $oPackageItem->isNewRecord = true;
                $oPackageItem->save(); 
            }
            
            $condition = new CDbCriteria;
            $condition->addCondition("order_id = '".$model->id."' ");
            $oPackage = FgMaterialPackage::model()->findAll($condition);
            $oPackageItem = FgMaterialPackageItem::model()->findAll($condition);
            
            $oOrderItem = new FgOrderItem;
            $oOrderItem->clearOrderID($model->id);
            foreach($oPackage as $key=>$val){
                foreach($oPackageItem as $key2=>$val2){
                    $oOrderItem->unsetAttributes(); 
                    $oOrderItem->order_id = $model->id;
                    $oOrderItem->material_package_id = $val->id;
                    $oOrderItem->device_id = $val->device_id;
                    $oOrderItem->material_package_item_id = $val2->id;
                    $oOrderItem->material_id = $val2->material_id;
                    $oOrderItem->s_date = $model->s_date;
                    $oOrderItem->e_date = $model->e_date;
                    $oOrderItem->isNewRecord = true;
                    $oOrderItem->save();  
                }
            }
            
            $aa = new FgBroadcastPeriod;
            $aa->createPeroid(0,$model->id);
            
            echo $model->id;
        }
        public function actionAjaxGetPeriod(){
        	$periodModel = FgBroadcastPeriod::model()->findAll();
        	return $periodModel;
        }
        // 1127加上接收裝置陣列和素材數量
        public function actionGetAjaxCalendar(){
        	if(!empty($_POST)){
        		$post = $_POST;
        		// 本來想要在呼叫sendAjax方法時，一起處理
        		// $results = FgOrder::model()->ajaxGetStatistic($post);
        		$this->renderPartial('_monthTableDiv',array('post'=>$post,'results'=>$results));

        	}
        }
        // 1124加上取得FG_Broadcast_Statistic_2資料
        public function actionAjaxGetStatistic(){
        	if(isset($_POST)){
        		$post = $_POST;
        		$results = FgOrder::model()->ajaxGetStatistic($post);
        	}
        	
        }
        
        
}