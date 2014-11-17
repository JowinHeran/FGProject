<style>
    #sect2,#sect3,#templateArea{
        display:none;
    }
    div.ajaxloading {
        height: 64px; 
        width: 75px;
        background-color: #fff;
        background-image: url('/fashionguide/images/ajax-loader.gif');
        background-position:  center center;
        background-repeat: no-repeat;
        opacity: 1;
        position: absolute;
        top:50%;
        left:50%;
        margin-left:-35px;
        display:none;
    }
    div.ajaxloading * {
        opacity: .8;
    }
</style>
<div class="ajaxloading">
    <div>資料處理中</div>
</div>
<div class="form">

        <!--樣板區!-->
        <div id="templateArea">
            <table id="templateBranchSearch">
                <tr>
                    <td><input type="checkbox" value=""></td>
                    <td>縣市</td>
                    <td>區域</td>
                    <td>分店</td>
                    <td>裝置別名</td>
                    <td>MAC</td>
                </tr>
            </table>
            <table class="table table-bordered" id="templateBranchResult">
                    <tr>
                        <td>縣市</td>
                        <td>區域</td>
                        <td>分店</td>
                        <td>裝置別名</td>
                        <td>MAC</td>
                        <td><a href="#"  class="deviceDel" data-rel="">刪除</a></td>
                    </tr>
            </table>
            <table class="table table-bordered" id="templateMaterialSearch">
                    <tr>
                        <td><input type="checkbox" class="selectAll"></td>
                        <td>裝置類型</td>
                        <td>品牌</td>
                        <td>素材</td>
                        <td>圖片</td>
                        <td>詳細內容</td>
                    </tr>
            </table>
            <table class="table table-bordered" id="templateMaterialResult">
                    <tr>
                        <td>裝置類型</td>
                        <td>品牌</td>
                        <td>素材</td>
                        <td>圖片</td>
                        <td>詳細內容</td>
                        <td><a href="#"  class="materialDel" data-rel="">刪除</a></td>
                    </tr>
            </table>
        </div>
        
        <!--START 場景1-->
        <div id="sect1">
            <div>
                <h1>選擇推播之裝置</h1>
            </div>
            <div>
                <div id="branchSearch" class="alert alert-info" role="alert">
                    縣市:
                    <select style="width:100px" name="city_id">
                        <option value="">請選擇</option>
                        <?php 
                        $cityLists = FgCity::model()->findAll();
                        foreach($cityLists as $key=>$val){?>
                        <option value="<?= $val->id?>"><?= $val->name?></option>
                        <?php }?>
                    </select>
                    區域:
                    <select style="width:100px" name="area_id">
                        <option value="">請選擇</option>
                        <?php 
                        $areaLists = FgArea::model()->findAll();
                        foreach($areaLists as $key=>$val){?>
                        <option value="<?= $val->id?>"><?= $val->name?></option>
                        <?php }?>
                    </select>
                    分店:
                    <select style="width:100px" name="branch_id">
                        <option value="">請選擇</option>
                        <?php 
                        $branchLists = FgBranch::model()->findAll();
                        foreach($branchLists as $key=>$val){?>
                        <option value="<?= $val->id?>"><?= $val->name?></option>
                        <?php }?>
                    </select>
                    裝置類型:
                    <select style="width:100px" name="device_type_id">
                        <option value="">請選擇</option>
                        <?php 
                        $deviceTypeLists = FgDeviceType::model()->findAll();
                        foreach($deviceTypeLists as $key=>$val){?>
                        <option value="<?= $val->id?>"><?= $val->name?></option>
                        <?php }?>
                    </select>
                    <br>
                    裝置別名:<input type="text" style="width:100px" name="name">
                    MAC:<input type="text" style="width:100px" name="mac">
                    <button type="button" class="btn btn-default" id="btnBranchSearch">搜尋</button>
                    <div>
                        <h3>搜尋結果:</h3>
                        <table class="table table-bordered" id="branchSearchData">
                            <tr>
                                <th><input type="checkbox" class="selectAll"></th>
                                <th>縣市</th>
                                <th>區域</th>
                                <th>分店</th>
                                <th>裝置別名</th>
                                <th>MAC</th>
                            </tr>
                        </table>
                        <div style="text-align:center;">
                            <!--<button type="button" class="btn btn-default" id="btnbranchSearchAddAll">全部加入</button>-->
                            <button type="button" class="btn btn-default" id="btnbranchSearchAddPartial">加入</button>
                        </div>
                    </div>
               </div>
            </div>
            <div>
                <table class="table table-bordered" id="branchResult">
                    <tr>
                        <th>縣市</th>
                        <th>區域</th>
                        <th>分店</th>
                        <th>裝置別名</th>
                        <th>MAC</th>
                        <th>操作</th>
                    </tr>
                    <?php foreach($oPackage as $key=>$val){?>
                    <tr>
                        <td><?= $val->oDevice->branch->area->city->name?></td>
                        <td><?= $val->oDevice->branch->area->name?></td>
                        <td><?= $val->oDevice->branch->name?></td>
                        <td><?= $val->oDevice->name?></td>
                        <td><?= $val->oDevice->mac?></td>
                        <td><a href="#"  class="deviceDel" data-rel="<?= $val->device_id?>">刪除</a></td>
                    </tr>
                    <?php } ?>
                </table>
                <div>
                    <button type="button" class="btn btn-default">取消</button>
                    <button type="button" class="btn btn-default" id="gotoSect2">下一步</button>
                </div>
            </div>
        </div>
        <!--END 場景1-->
        
        <!--START場景2-->
        <div id="sect2">
            <div>
                <h1>選擇推播之素材</h1>
            </div>
            <div>
                <div>
                    <div id="materialSearch" class="alert alert-info" role="alert">
                        裝置:
                        <select style="width:100px" name="device_type_id">
                            <option value="">請選擇</option>
                            <?php 
                            $deviceTypeLists = FgDeviceType::model()->findAll();
                            foreach($deviceTypeLists as $key=>$val){?>
                            <option value="<?= $val->id?>"><?= $val->name?></option>
                            <?php }?>
                        </select>
                        素材:<input type="text" style="width:100px" name="name">
                        <button type="button" class="btn btn-default" id="btnMaterialSearch">搜尋</button>
                        <div>
                            <h3>搜尋結果:</h3>
                            <table class="table table-bordered" id="materialSearchData">
                                <tr>
                                    <th><input type="checkbox" class="selectAll"></th>
                                    <th>裝置類型</th>
                                    <th>品牌</th>
                                    <th>素材</th>
                                    <th>圖片</th>
                                    <th>詳細內容</th>
                                </tr>
                            </table>
                            <div style="text-align:center;">
                                <!--<button type="button" class="btn btn-default" id="btnbranchSearchAddAll">全部加入</button>-->
                                <button type="button" class="btn btn-default" id="btnMaterialSearchAddPartial">加入</button>
                            </div>
                        </div>
                   </div>
                </div>
                <div>
                    <table class="table table-bordered" id="materialResult">
                    <tr>
                        <th>裝置類型</th>
                        <th>品牌</th>
                        <th>素材</th>
                        <th>圖片</th>
                        <th>詳細內容</th>
                        <th>操作</th>
                    </tr>
                    <?php foreach($oPackageItem as $key=>$val){?>
                    <tr>
                        <td><?= $val->oMaterial->oDeviceType->name?></td>
                        <td><?= $val->oMaterial->oBrand->name?></td>
                        <td><?= $val->oMaterial->name?></td>
                        <td>
                            <?php if($val->oMaterial->image != "") 
                                echo "<img src='".FGMaterial::$base_image_path.$val->oMaterial->image."' width=150 height=150>";
                            ?>
                        </td>
                        <td><a href="<?= Yii::app()->createUrl("FG_Manage_2/fGMaterial/view",array('id'=>$val->material_id))?>" target="_blank">詳細內容</a></td>
                        <td><a href="#"  class="materialDel" data-rel="<?= $val->material_id?>">刪除</a></td>
                    </tr>
                    <?php }?>
                    </table>
                    <div>
                        <button type="button" class="btn btn-default" id="gobackSect1">上一步</button>
                        <button type="button" class="btn btn-default" id="gotoSect3">下一步</button>
                    </div>
                </div>
            </div>
        </div>
        <!--END 場景2-->
        
        <!--START場景3-->
        <div id="sect3">
            <div>
                <h1>推播設定</h1>
            </div>
            <div>
                <div>
                    <form id="submitForm">
                        <input type="hidden" name="id" value="<?= $model->id?>">
                        <?php foreach($oPackage as $key=>$val){?>
                        <input type="hidden" name="devices[]" value="<?= $val->device_id?>">
                        <?php }?>
                         <?php foreach($oPackageItem as $key=>$val){?>
                        <input type="hidden" name="materials[]" value="<?= $val->material_id?>">
                        <?php }?>
                        活動名稱:<input type="text" name="name" value="<?= $model->name?>"><br>
                        起始時間:<input type="text" style="width:150px" name="s_date" value="<?= $model->s_date?>"><br>
                        結束時間:<input type="text" style="width:150px" name="e_date" value="<?= $model->e_date?>"><br>
                        指定星期:<br>
                        <input type="checkbox" value="1" name="time_type[]" <?php if($model->parserTimeType(1)){?>checked<?php }?>>星期一&nbsp;&nbsp;
                        <input type="checkbox" value="2" name="time_type[]" <?php if($model->parserTimeType(2)){?>checked<?php }?>>星期二&nbsp;&nbsp;
                        <input type="checkbox" value="3" name="time_type[]" <?php if($model->parserTimeType(3)){?>checked<?php }?>>星期三&nbsp;&nbsp;
                        <input type="checkbox" value="4" name="time_type[]" <?php if($model->parserTimeType(4)){?>checked<?php }?>>星期四&nbsp;&nbsp;
                        <input type="checkbox" value="5" name="time_type[]" <?php if($model->parserTimeType(5)){?>checked<?php }?>>星期五&nbsp;&nbsp;
                        <input type="checkbox" value="6" name="time_type[]" <?php if($model->parserTimeType(6)){?>checked<?php }?>>星期六&nbsp;&nbsp;
                        <input type="checkbox" value="0" name="time_type[]" <?php if($model->parserTimeType('0')){?>checked<?php }?>>星期日<br>
                        狀態:
                        <select>
                            <option value="1" <?php if($model->status == 1) echo "selected";?>>上架</option>
                            <option value="0" <?php if($model->status == '0') echo "selected";?>>下架</option>
                        </select>
                        <br>
                        分類:
                        <?php foreach($model->getTag() as $key=>$value):?>

                        <input type="checkbox" value="<?=$key?>" name="sub_tag[]" <?=($model->checkTag($key)==1)?("checked"):("");?>><?=$value['name']?>&nbsp;&nbsp;
                            
                        <?php endforeach;?>
                    </form>
                </div>
                <div>
                    <button type="button" class="btn btn-default" id="gobackSect2">上一步</button>
                    <button type="button" class="btn btn-default" id="submitMyData">送出</button>
                </div>
            </div>
        </div>
        <!--END 場景3-->
        
    
    
    
</div><!-- form -->
<script type="text/javascript">
    $(document).ready(function(){
        
        $("#gotoSect2").on("click",function(){
            if($("#branchResult").find("tr td").length > 0){
                $("#sect1").hide();
                $("#sect2").show();
            }else{
                alert("尚未選擇裝置");
            }
        })
        
        $("#gotoSect3").on("click",function(){
            if($("#materialResult").find("tr td").length > 0){
                $("#sect2").hide();
                $("#sect3").show();
            }else{
                alert("尚未選擇素材");
            }
        })
        
        $("#gobackSect1").on("click",function(){
            $("#sect2").hide();
            $("#sect1").show();
        })
        
        $("#gobackSect2").on("click",function(){
            $("#sect3").hide();
            $("#sect2").show();
        })
        
        $("#submitMyData").on("click",function(){
            $.ajax({
                url:"<?php echo Yii::app()->createUrl("FG_Manage_2/FgOrder/ajaxSave")?>",
                type:"post",
                beforeSend:function(){
                    $(".ajaxloading").show();
                },
                data:$("#submitForm").serialize(),
                success:function(e){
                    $(".ajaxloading").hide();
                    location.href="<?php echo Yii::app()->createUrl("FG_Manage_2/FgOrder/view");?>/id/"+e;
                }
                
            })
        })
        
        $(".selectAll").on("click",function(){
            
            if( $(this).is(":checked")){
                $(this).parents("table").find("tr td:nth-child(1) input[type=checkbox]").prop("checked",true);
            }else{
                $(this).parents("table").find("tr td:nth-child(1) input[type=checkbox]").prop("checked",false);
            }
            
        })
        
        $("#btnBranchSearch").on("click",function(){
            
            //START ajax
            $.ajax({
                url:'<?php echo Yii::app()->createUrl("FG_Manage_2/FgOrder/ajaxBranch")?>',
                type:"get",
                data:$("#branchSearch").find("input,select").serialize(),
                dataType:"json",
                success:function(e){
                    $("#branchSearchData").find("tr td:nth-child(1)").parent().remove("tr");
                    
                    $.map(e,function(val,key){
                        $("#templateBranchSearch tr").clone().appendTo($("#branchSearchData"));
                        var target = $("#branchSearchData").find("tr:last");
                        target.find("td:nth-child(1) input[type=checkbox]").val(val.deviceID);
                        target.find("td:nth-child(2)").text(val.cityName);
                        target.find("td:nth-child(3)").text(val.areaName);
                        target.find("td:nth-child(4)").text(val.branchName);
                        target.find("td:nth-child(5)").text(val.deviceName);
                        target.find("td:nth-child(6)").text(val.mac);
                    })
                    
                }
            })
            //END ajax
        })
        
        $("#btnbranchSearchAddPartial").on("click",function(){
            
            if( $("#branchSearchData").find("tr td:nth-child(1) input[type=checkbox]:checked").length == 0){
                
                alert("您尚未選擇");
                
            }else{
                //將搜尋結果且已checked之項目加入
                $.each($("#branchSearchData").find("tr td:nth-child(1) input[type=checkbox]:checked"),function(key,val){
                    
                    if($("input[name=devices\\[\\]][value='"+$(this).val()+"']").length == 0){
                    //加入已選擇之分店
                    $("#submitForm").append("<input type='hidden' name='devices[]' value='"+$(this).val()+"'>");
                    
                    $("#templateBranchResult tr").clone().appendTo($("#branchResult"));
                    
                    var target = $("#branchResult").find("tr:last");
                        //縣市
                        var city = $(this).parent().next().text()
                        target.find("td:nth-child(1)").text(city);
                        //區域
                        var area = $(this).parent().next().next().text()
                        target.find("td:nth-child(2)").text(area);
                        //分店
                        var branch = $(this).parent().next().next().next().text()
                        target.find("td:nth-child(3)").text(branch);
                        //裝置別名
                        var device = $(this).parent().next().next().next().next().text()
                        target.find("td:nth-child(4)").text(device);
                        //MAC
                        var mac = $(this).parent().next().next().next().next().next().text()
                        target.find("td:nth-child(5)").text(mac);
                        //deviceID
                        target.find("td:nth-child(6) a").attr("data-rel",$(this).val());
                    }
                        
                })
                //加入後，清除已checked
                $("#branchSearchData").find("tr td:nth-child(1) input[type=checkbox]:checked").prop("checked",false);
                
            }
        
        })
        
        $("body").delegate(".deviceDel","click",function(e){
            e.preventDefault();
            var target = $(this).parents("tr");
            $("input[name=devices\\[\\]][value='"+$(this).attr("data-rel")+"']").remove("input");
            target.remove("tr");
        })
        
        //==============================================素材事件=============================================================
        
        $("#btnMaterialSearch").on("click",function(){
            
            //START ajax
            $.ajax({
                url:'<?php echo Yii::app()->createUrl("FG_Manage_2/FgOrder/ajaxMaterial")?>',
                type:"get",
                data:$("#materialSearch").find("input,select").serialize(),
                dataType:"json",
                success:function(e){
                    $("#materialSearchData").find("tr td:nth-child(1)").parent().remove("tr");
                    
                    $.map(e,function(val,key){
                        $("#templateMaterialSearch tr").clone().appendTo($("#materialSearchData"));
                        var target = $("#materialSearchData").find("tr:last");
                        target.find("td:nth-child(1) input[type=checkbox]").val(val.materialID);
                        target.find("td:nth-child(2)").text(val.deviceName);
                        var brandName;
                        brandName = (val.brandName == null) ?"":val.brandName;
                        target.find("td:nth-child(3)").text(brandName);
                        target.find("td:nth-child(4)").text(val.materialName);
                        if(val.image != null){
                            var path = '<?= FGMaterial::$base_image_path?>';
                            target.find("td:nth-child(5)").html("<img src='"+path+val.image+"' width=150 height=150>");
                        }else{
                            target.find("td:nth-child(5)").text('');
                        }
                        var base_url = '<?=Yii::app()->createUrl('FG_Manage_2/fGMaterial/view')?>'+'/id/'+val.materialID;
                        target.find("td:nth-child(6)").html("<a href='"+base_url+"' target='_blank'>詳細資料</a>");
                       
                    })
                    
                }
            })
            //END ajax
        })
        
        $("#btnMaterialSearchAddPartial").on("click",function(){
            
            if( $("#materialSearchData").find("tr td:nth-child(1) input[type=checkbox]:checked").length == 0){
                
                alert("您尚未選擇");
                
            }else{
                //將搜尋結果且已checked之項目加入
                $.each($("#materialSearchData").find("tr td:nth-child(1) input[type=checkbox]:checked"),function(key,val){
                    
                    
                    //加入已選擇之分店
                    $("#submitForm").append("<input type='hidden' name='materials[]' value='"+$(this).val()+"'>");
                    
                    $("#templateMaterialResult tr").clone().appendTo($("#materialResult"));
                    
                    var target = $("#materialResult").find("tr:last");
                        //裝置類型
                        var deviceType = $(this).parent().next().text()
                        target.find("td:nth-child(1)").text(deviceType);
                        //品牌
                        var brand = $(this).parent().next().next().text()
                        target.find("td:nth-child(2)").text(brand);
                        //素材
                        var material = $(this).parent().next().next().next().text()
                        target.find("td:nth-child(3)").text(material);
                        //圖片
                        var image = $(this).parent().next().next().next().next().find("img").clone()
                        if(image != null)
                            target.find("td:nth-child(4)").html(image);
                        else 
                            target.find("td:nth-child(4)").text("");
                        //詳細資料
                        var detail = $(this).parent().next().next().next().next().next().find("a").clone();
                        target.find("td:nth-child(5)").html(detail);
                        //deviceID
                        target.find("td:nth-child(6) a").attr("data-rel",$(this).val());
                    
                        
                })
                //加入後，清除已checked
                $("#materialSearchData").find("tr td:nth-child(1) input[type=checkbox]:checked").prop("checked",false);
                
            }
        
        })
        
        $("body").delegate(".materialDel","click",function(e){
            e.preventDefault();
            var target = $(this).parents("tr");
            $("input[name=materials\\[\\]][value='"+$(this).attr("data-rel")+"']").remove("input");
            target.remove("tr");
        })
        
    });
</script>