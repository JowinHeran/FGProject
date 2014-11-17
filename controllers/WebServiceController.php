<?php
header("Content-Type:text/html; charset=utf-8");
class WebServiceController extends Controller
{
        /**
         * This is the action to handle external exceptions.
         */
        public function actionError()
        {
            if($error=Yii::app()->errorHandler->error)
            {
                if(Yii::app()->request->isAjaxRequest)
                        echo $error['message'];
                else
                        $this->render('error', $error);
            }
        }

        public function actionPullAD($mac,$date){
            
            $result = array();
            
            $condition = new CDbCriteria;
            $condition2 = clone $condition;
            $condition->condition = "mac = '".$mac."'";
            
            $oDevice = new FgDevice;
            $count = $oDevice->count($condition);
            
                $result['mac'] = $mac;
            if($count > 0){
                $deviceLists= $oDevice->findAll($condition);
                $device_id = $deviceLists[0]->id;
                $market_type = $deviceLists[0]->market_type_id;
                $runMaterial = true;
            }else{
                //無裝置資料
                $oDevice->mac = $mac;
                if($mac != "")
                    $oDevice->save();
            }
           
            
            $convertSecond = strtotime($date);
            $pure_date = date('Y-m-d',$convertSecond);
            
            
            $result['update_time'] = FgMaterialPackage::model()->getUpdateDate($device_id);
            //0=>FG 1=>廣告機 2=>直式
            $mode = --$market_type;
            $result['mode'] = $mode;
            
            //素材獲取
            $oBroadcast = new FgBroadcastPeriod();
            $condition2->addCondition("period_date = '".$pure_date."'");
            $condition2->addCondition("device_id = '".$device_id."'");
            $ad_count = $oBroadcast->count($condition2);
            $results = $oBroadcast->findAll($condition2);
            $result['ad_count'] = $ad_count;
            
            $prev_date = date('Y-m-d',(strtotime($pure_date) - 24*60*60));
            
            //分組
            $aa = array();
            $bb = array();
            $cc = array();
            if($ad_count <= 8){
                if($mode == 0){
                    $result['ad_count'] = $ad_count*2;
                    $aa = $results;
                    $bb = $results;
                }else{
                    $aa = $results;
                }
            }else{
                if($mode == 0){
                    foreach($results as $key=>$val){
                        //比對昨天為Ａ(0)組還是Ｂ(1)組
                        $aspect = FgBroadcastAd::model()->varifyBroadcastAspect($prev_date,$val->device_id,$val->material_id);

                        if(isset($aspect) ){
                            if($aspect == 0){
                                $bb[] = $val;
                            }else if($aspect == 1){
                                $aa[] = $val;
                            }
                        }else{
                            $cc[] = $val;
                        }
                    }
                }else{
                    $aa = $results;
                }
                
            }
            foreach($cc as $key=>$val){
                $aa_count = count($aa);
                $bb_count = count($bb);
               $max = max($aa_count,$bb_count);
           
               if($max == $aa_count && $bb_count < 8 ){
                   $bb[] = $val;
               }else if($aa_count < 8){
                   $aa[] = $val;
               }
               
            }
            
            $oRecord = new FgBroadcastAd;
            $result['ad_content'] = array();
            $all_content = array();
            //echo "A組:<br>";
            
            foreach($aa as $key=>$val){
                $oRecord->unsetAttributes();
                $oRecord->broadcast_period_id = $val->id;
                $oRecord->device_id = $val->device_id;
                $oRecord->material_id = $val->material_id;
                $oRecord->aspect = 0;
                $oRecord->create_date = $pure_date;
                $oRecord->create_datetime = date("Y-m-d H:i:s");
                $oRecord->isNewRecord = true;
                $oRecord->save();
                //echo $val->oMaterial->name;
                //echo "<br>";
                $all_content[] = $this->createAD($val,"A");
            }
            
            //echo "============================<br>";
            //echo "B組:<br>";
            foreach($bb as $key=>$val){
                $oRecord->unsetAttributes();
                $oRecord->broadcast_period_id = $val->id;
                $oRecord->device_id = $val->device_id;
                $oRecord->material_id = $val->material_id;
                $oRecord->aspect = 1;
                $oRecord->create_date = $pure_date;
                $oRecord->create_datetime = date("Y-m-d H:i:s");
                $oRecord->isNewRecord = true;
                $oRecord->save();
                //echo $val->oMaterial->name;
                //echo "<br>";
                $all_content[] = $this->createAD($val,"B");
            }
            $result['ad_content'] = $all_content;
            echo json_encode($result);
        }
        
        function createAD($val,$AB){
            
                $ROOT =  dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
                
                if($val->oMaterial->movie == ""){
                    $content['ad_main'] = "http://".$_SERVER['HTTP_HOST'].$val->oMaterial->getImagePath();
                    $content['md5_ad_main'] = md5_file($ROOT.$val->oMaterial->getImagePath());
                }else{
                    $content['ad_main'] = "http://".$_SERVER['HTTP_HOST'].$val->oMaterial->getMoviePath();
                    $content['md5_ad_main'] = md5_file($ROOT.$val->oMaterial->getMoviePath());
                }

                $content['show_time'] = 7500;//單位毫秒
                $content['action'] = count($val->oMaterial->oQuestion) > 0 ? 1:0; //1=>有互動 0=>沒互動
                $content['action_type'] = 3;//0=>圖,1=>web,2=>影片,3=>answer
                $content['ad_left'] = "http://".$_SERVER['HTTP_HOST'].$val->oMaterial->getImagePath();;
                $content['md5_ad_left'] = md5_file($ROOT.$val->oMaterial->getImagePath());;
                $content['ad_action'] = "";
                $content['md5_ad_action'] = "";
                $content['question_sum'] = count($val->oMaterial->oQuestion);
                $content['type'] = $AB;
                
                $all_question = array();
                foreach($val->oMaterial->oQuestion as $k=>$v){
                    $question['type'] = $v->type - 1;
                    $question['question'] = $v->name;
                    $ans_num = 5;
                    if($v->item1 == ""){
                        $ans_num--;
                    } 
                    if($v->item2 == ""){
                        $ans_num--;
                    } 
                    if($v->item3 == ""){
                        $ans_num--;
                    } 
                    if($v->item4 == ""){
                        $ans_num--;
                    }
                    if($v->item5 == ""){
                        $ans_num--;
                    }
                    $question['ans_sum'] = $ans_num;
                    $question['a1'] = $v->item1;
                    $question['a2'] = $v->item2;
                    $question['a3'] = $v->item3;
                    $question['a4'] = $v->item4;
                    $question['a5'] = $v->item5;
                    $all_question[] = $question;
                }
                $content['question'] = $all_question;
                
                //$all_content[] = $content;
            return $content;
        }
        
        function actionOldVersionPullAD($mac){
            $runMaterial = false;
            $condition = new CDbCriteria;
            $condition2 = clone $condition;
            $condition->condition = "mac = '".$mac."'";
            
            $oDevice = new FgDevice;
            $count = $oDevice->count($condition);
            
            $result['mac']= $mac;
            
                    
            if($count > 0){
                $deviceLists= $oDevice->findAll($condition);
                $device_id = $deviceLists[0]->id;
                $runMaterial = true;
            }else{
                $oDevice->mac = $mac;
                if($mac != "")
                    $oDevice->save();
                $result['code'] = 0;
                $result['msg'] = "無裝置資料";
            }
            
            if($runMaterial){
                    $oOrderItem = new FgOrderItem;
                    $now  = date("Y-m-d");
                    $condition2->addCondition("s_date <='".$now."'");
                    $condition2->addCondition("e_date >='".$now."'");
                    $condition2->addCondition("device_id = ".$device_id);
         
                    $ad_count = (Int) $oOrderItem->count($condition2);
                    $orderItemLists = $oOrderItem->findAll($condition2);
                    
                    $result['code'] = 1;
                    $result['msg'] = "成功";
                    $result['update_time'] = "1911-01-01 00:00:00";
                    $result['sch_sum'] = 3;
                    $result['ad_count'] = $ad_count;
                    $result['ad_content'] = array();
                    
                    foreach($orderItemLists as $key=>$val){
                        $ids[] = $val->oMaterial->id;
                        $movie_path = $val->oMaterial->movie;
                        $movie_real_path = FGMaterial::$base_movie_path.$movie_path;
                        
                        $ad_content[$key]['name'] = $val->oMaterial->name;
                        $ad_content[$key]['ad'] = $movie_path != "" ? "http://www.jowinwin.com".$movie_real_path:"";
                        if($movie_path != "")
                            $ad[] = "http://www.jowinwin.com".$movie_real_path;
                        $ad_content[$key]['open_time'] = '00:00:00';
                        
                        $real_path = "/home/jowinwin/public_html".$movie_real_path;
                        $md5 = file_exists($real_path)&&($movie_path !="") ? md5_file($real_path) : "";
                        $ad_content[$key]['md5'] = $md5; 
                    }
                    
                    $result['ad_content'] = $ad_content;
                    
                    $result['sch_content'] = array();
                    
                    for($i=0;$i<3;$i++){
                        
                        if($i == 0){
                            $name = "09:00-12:00";
                        }else if($i == 1){
                            $name = "12:00-15:00";
                        }else{
                            $name = "15:00-18:00";
                        }
                        
                        $sch_content[$i]['name'] = $name;
                        $sch_content[$i]['file_count'] = $ad_count;
                        $ad_content_to_string =(count($ad) > 0) ? implode(",",$ad):"";
                        $sch_content[$i]['file'] = $ad_content_to_string;
                        
                    }
                    
                    $result['sch_content'] =  $sch_content;  
            }
            
            $json_result = json_encode($result);
            
            $oMaterialPull = new FgMaterialPull;
            $oMaterialPull->mac =  $mac;
            $oMaterialPull->content = $json_result;
            $content_ids = count($ids) >0 ?  implode(",",$ids):"";
            $oMaterialPull->content_ids = $content_ids;
            $oMaterialPull->save();
            echo $json_result;
        }
        
        function actionNewJson(){
            
            $result = array();
            
            $result['mac'] = "MAC碼";
            $result['update'] = "更新時間";
            $result['mode'] = "0=>FG 1=>廣告機 2=>直式";
            $result['ad_count'] = "廣告數目";
            
            $result['ad_content'] = array();
            
            $content = array();
            for($i=0;$i<5;$i++){
                $content[$i]['ad_main'] = "圖片，影片，GIF";
                $content[$i]['md5_ad_main'] = "md5";
                $content[$i]['show_time'] = "顯示時間 mode=>1使用(圖片,GIF)";
                $content[$i]['action'] = "0=>有互動 1=>沒互動";
                $content[$i]['action_type'] = "0=>圖,1=>web,2=>影片,3=>answer";
                $content[$i]['ad_left'] = "";
                $content[$i]['md5_ad_left'] = "";
                $content[$i]['ad_action'] = "圖片,影片,GIF";
                $content[$i]['md5_ad_action'] = "";
                $content[$i]['question_sum'] = "";
                $content[$i]['question_content'] = array();
                
                $question = array();
                
                for($j=0;$j<3;$j++){
                    $question[$j]['type'] = "0=>是非 1=>選擇";
                    $question[$j]['question'] = "";
                    $question[$j]['ans_sum'] = "選項數目";
                    $question[$j]['a1'] = "";
                    $question[$j]['a2'] = "";
                    $question[$j]['a3'] = "";
                    $question[$j]['a4'] = "";
                    $question[$j]['a5'] = "";
                }
                $content[$i]['question_content'] = $question;
            }
            $result['ad_content'] = $content;
            echo json_encode($result);
        }
}
