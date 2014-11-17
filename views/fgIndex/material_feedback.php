<style>
    #content-search{
      background-color: #F7F7F9;
     line-height: 80px;
    }
    
</style>
<div class="btn-group btn-group-justified">
  <div class="btn-group">
    <button type="button" class="btn btn-default"><a href="<?= Yii::app()->createUrl("FG_Manage_2/FgIndex/index")?>">電視端要資料狀況</a></button>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-default"><a href="<?= Yii::app()->createUrl("FG_Manage_2/FgIndex/feedback")?>">電視端撥放互動紀錄</a></button>
  </div>
</div>
<hr>
<div id="main-content">
    <div id="content-search">
        <form action="" method="GET">
        日期(起):<input type="text" name="s_date" style="width:80px;"  value="<?=$p['s_date']?>">
        日期(迄):<input type="text" name="e_date" style="width:80px;"  value="<?=$p['e_date']?>">
       <br>
       品牌:
       <select name="brand_id" style="width:100px">
           <option value="">請選擇</option>
           <?php $brandLists = FgBrand::model()->findAll()?>
           <?php foreach($brandLists as $key=>$val){
               if($val->id == $p['brand_id']){
                    echo "<option value='".$val->id."' selected>".$val->name."</option>";
               }else{
                    echo "<option value='".$val->id."'>".$val->name."</option>";
               }
           } ?>
       </select>
       &nbsp;&nbsp;
       分店:
       <select name="branch_id" style="width:100px">
           <option value="">請選擇</option>
           <?php $branchLists = FgBranch::model()->findAll()?>
           <?php foreach($branchLists as $key=>$val){
               if($val->id == $p['branch_id']){
                    echo "<option value='".$val->id."' selected>".$val->name."</option>";
               }else{
                    echo "<option value='".$val->id."'>".$val->name."</option>";
               }
           } ?>
       </select>
       &nbsp;&nbsp;
       MAC別名:<input type="text" name="name" style="width:100px;" value="<?=$p['name']?>">
       &nbsp;&nbsp;
       MAC:<input type="text" name="mac" style="width:100px;" value="<?=$p['mac']?>">
       &nbsp;&nbsp;
        <button type="subbmit" class="btn btn-default">搜尋</button>
        </form>
    </div>
    <div id="content-here">
        <table class="table table-striped">
            <tr>
                <!--<th>日期</th>-->
                <th>店家</th>
                <th>MAC</th>
                <th>MAC別名</th>
                <th>素材</th>
                <th>播放次數</th>
                <th>互動次數</th>
                <th>互動狀況</th>
            </tr>
            <?php foreach($dataLists as $key=>$val){?>
            <?php 
                    $oDevice = FgDevice::model()->findByPK($val['device_id']);
                    $oMaterial = FGMaterial::model()->findByPK($val['material_id']);
            ?>
            <tr>
                <!--<td><?= $val['create_datetime']?></td>-->
                <td><?= $oDevice->branch->name?></td>
                <td><?= $oDevice->mac?></td>
                <td><?= $oDevice->name?></td>
                <td><?= $oMaterial->name?></td>
                <td><?= $val['ct']?></td>
                <td><?= $val['mutual_qty']?></td>
                <td><a href="<?= Yii::app()->createUrl("FG_Manage_2/FgIndex/showMutual",array("device_id"=>$val['device_id'],"material_id"=>$val['material_id'],"s_date"=>$p['s_date'],"e_date"=>$p['e_date']))?>" target="_blank">詳細內容</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    
</div>