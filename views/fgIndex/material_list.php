<table class="table table-striped">
    <tr>
        <th>序號</th>
        <th>素材名稱</th>
        <th>圖片</th>
        <th>詳細資料</th>
    </tr>    
    <?php foreach($lists as $key=>$val){?>
    <tr>
        <td><?= ++$key?></td>
        <td><?= $val->oMaterial->name?></td>
        <td>
            <?php if($val->oMaterial->image){?>
            <img src="<?= $val->oMaterial->getImagePath()?>" width="150">
            <?php } ?>
        </td>
        <td><a href="<?= Yii::app()->createUrl("FG_Manage_2/fGMaterial/view",array('id'=>$val->oMaterial->id))?>">詳細資料</a></td>
     </tr>
    <?php } ?>
</table>