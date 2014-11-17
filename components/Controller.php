<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    //檢查是否登入
    protected function beforeAction($event){
        $common = new CommonFunction;
        $url = Yii::app()->createUrl("FG_Manage_2/Site/login");
        if(empty($_SESSION['crudArr']) ){
            if(Yii::app()->controller->action->id!="index" && Yii::app()->controller->id!="site" && Yii::app()->controller->id!="webService"){
                $common->alertMsg($url,'請登入進行操作');
            }
        }
        return true;
    }
        
                    public function uploadPhoto($model, $myfile, $db_column_name="photo",$photo_path,$old_filename,$new_filename) {
                        
                        if (is_object($myfile) && get_class($myfile)==='CUploadedFile') {
                                $ext = $myfile->getExtensionName();
                                if(!is_dir($photo_path)){
                                    mkdir($photo_path);
                                }
                                if (!empty($old_filename)) {
                                    @unlink($photo_path.$old_filename);
                                }
                                
                                $model->$db_column_name = $new_filename.'.'.$ext;
                            
                                $model->save();
                                switch (get_class($model)) {
                                    case 'Board':
                                        $myfile->saveAs($photo_path.$model->image); 
                                        break;
                                    case 'FGMaterial':
                                    case 'FgMaterialQuestion':
                                         $myfile->saveAs($photo_path.$model->$db_column_name); 
                                        break;
                                    default:
                                        $myfile->saveAs($photo_path.$model->photo); 
                                        break;
                                }
                               

                                return true;
                        }else{
                                $model->$db_column_name = $old_filename;
                                $model->save();
                                return false;
                        }

                    }
                    
                    //網址非channel 而是user時需做查詢動作
                   protected function get_channel_id($user,$video_count=''){
                       
                        $api_key = Yii::app()->params->youtubeApiKey;
                        $main_api = "https://www.googleapis.com/youtube/v3/channels?part=id&forUsername=".$user."&key=".$api_key;
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_URL, $main_api);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $content = curl_exec($ch);
                        curl_close($ch);
                       $getArray = json_decode($content);
                 
                       return $this->get_video_list_api($getArray->items[0]->id,$video_count);
                   }
                   
                     protected function get_video_list_api($channel_id,$video_count=12){
                                
		$pagesize = empty($video_count) ? 12:$video_count;
		$api_key = Yii::app()->params->youtubeApiKey;
		$main_video_api = "https://www.googleapis.com/youtube/v3/activities?part=snippet&channelId=".$channel_id."&maxResults=".$pagesize."&fields=items%2Fsnippet&key=".$api_key;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL, $main_video_api);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($ch);
		curl_close($ch);
		$getArray = json_decode($content);

		return $getArray->items;	
	}
}