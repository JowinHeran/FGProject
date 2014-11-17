<table class="table table-striped">
    <tr>
        <th>時間</th>
        <th>問題</th>
        <th>選擇</th>
    </tr>    
    <?php foreach($lists as $key=>$val){
          $oQuestion = FgMaterialQuestion::model()->findByPK($val['question_id']);
    ?>
    <tr>
        <td><?= $val['create_datetime']?></td>
        <td><?= $oQuestion->name?></td>
        <td><?= $val['question_item']?></td>
    </tr>
    <?php } ?>
</table>