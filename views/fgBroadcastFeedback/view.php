<?php echo TbHtml::breadcrumbs(array(
    '活動互動紀錄'=>array('index','material_id'=>$material_id),
    '互動裝況'=>"",
    '檢視'
)); ?>


<table>
    <tr>
        <th>標題/說明</th>
        <th>類型</th>
        <th>基本次數</th>
        <th>選項1</th>
        <th>次數</th>
        <th>選項2</th>
        <th>次數</th>
        <th>選項3</th>
        <th>次數</th>
        <th>選項4</th>
        <th>次數</th>
        <th>選項5</th>
        <th>次數</th>
    </tr>
    <?php foreach($questionLists as $key=>$val){?>
    <tr>
        <td><?= $val->name?></td>
        <td><?= CustomParams::$paramsMaterialQuestionType[$val->type]?></td>
        <td></td>
        <td><?= $val->item1?></td>
        <td><?= $item1_qty[$key]?></td>
        <td><?= $val->item2?></td>
        <td><?= $item2_qty[$key]?></td>
        <td><?= $val->item3?></td>
        <td><?= $item3_qty[$key]?></td>
        <td><?= $val->item4?></td>
        <td><?= $item4_qty[$key]?></td>
        <td><?= $val->item5?></td>
        <td><?= $item5_qty[$key]?></td>
    </tr>
    <?php } ?>
    
</table>
