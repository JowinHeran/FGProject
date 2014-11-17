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
<?php echo date("Y/m/d")?> 異常機台:
<table>
    <tr>
        <th>分店</th>
        <th>MAC</th>
        <th>MAC別名</th>
        <th>狀況</th>
    </tr>
    <?php foreach($errLists as $key=>$val){?>
    <tr style="color:red">
        <td><?= FgBranch::model()->findByPK($val['branch_id'])->name?></td>
        <td><?= $val['mac']?></td>
        <td><?= $val['name']?></td>
        <td>未向後台獲取資料</td>
    </tr>
    <?php }?>
</table>
<hr>
<div id="main-content">
    <div id="content-search">
        <form action="" method="GET">
            日期:<input type="text" name="period_date" style="width:80px;"  value="<?=$p['period_date']?>">
       &nbsp;&nbsp;
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
                <th>日期</th>
                <!--<th>品牌</th>-->
                <th>店家</th>
                <th>MAC</th>
                <th>MAC別名</th>
                <th>素材推播數目</th>
                <th>素材內容</th>
            </tr>
            <?php foreach($dataLists as $key=>$val){?>
            <tr>
                <td><?= $val['period_date']?></td>
                <!--<td><?= $val['brandName']?></td>-->
                <td><?= $val['branchName']?></td>
                <td><?= $val['mac']?></td>
                <td><?= $val['macAlias']?></td>
                <td><?= $val['countAd']?></td>
                <td><a href="<?= Yii::app()->createUrl("FG_Manage_2/FgIndex/showMaterial",array('period_date'=>$val['period_date'],'device_id'=>$val['device_id']))?>" target="_blank">詳細內容</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    
</div>