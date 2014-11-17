<?php echo TbHtml::breadcrumbs(array(
    '活動互動紀錄'=>'#',
    '列表'
)); ?>

<?php 
    $common = new CommonFunction();
    $btnArr = $common->display($this->id);
?>

<table>
    <tr>
        <th>裝置</th>
        <th>播放次數</th>
        <th>互動次數</th>
        <th>互動狀況</th>
    </tr>
    <?php foreach($dataLists as $key=>$val){
        $oDevice = FgDevice::model()->findByPK($val['device_id']);
        $oMaterial = FGMaterial::model()->findByPK($val['material_id']);

    ?>
    <tr>
        <td><?= $oDevice->name?></td>
        <td><?= $val['ct']?></td>
        <td><?= $val['mutual_qty']?></td>
        <td><a href="<?= Yii::app()->createUrl('FG_Manage_2/FgBroadcastFeedback/view',array('device_id'=>$oDevice->id,'material_id'=>$oMaterial->id));?>">互動裝況</a></td>
    </tr>
    <?php }?>
</table>