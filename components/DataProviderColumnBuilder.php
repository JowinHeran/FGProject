<?php
class DataProviderColumnBuilder{
	protected static $flowNo = 
		array(
           'htmlOptions'=>array('width'=>"20px",'style'=>'text-align: center'),
            'name'=>'流水號',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        );
    protected static $operation =
    	array(            // display a column with "view", "update" and "delete" buttons
            'htmlOptions'=>array('width'=>"40px",'style'=>'text-align: center'),
            'class'=>'CButtonColumn',
            'deleteConfirmation'=>'確定刪除此項目嗎?',
            'buttons'=>array(
                        'view'=>array(
                                                    'label'=>'詳細資料',
                                        ),
                        'update'=>array(
                                   'label'=>'更新',
                       ),
                        'delete'=>array(
                                                    'label'=>'刪除',
                                                    ),
                        ),
        );
        public static function showOperation(){
        	echo $this::$operation;
        }
	// public function build($dataProvider){
	// 	$array = array();
	// 	$array[] = $this::$flowNo;
	// 	$array[] = $this::dataLabel("test","test");
	// 	$array[] = $this::$operation;
	// 	$array[] = $this::showDataProvider($dataProvider);
	// 	return $array;
	// }
	// protected function dataLabel($name="",$value="",$width="20px"){
	// 	return array(
 //           'htmlOptions'=>array('width'=>"$width",'style'=>'text-align: center'),
 //            'name'=>"$name",
 //            'value'=>"$value",
 //        );
	// } 
	// protected function showDataProvider($dataProvider){
	// 	foreach ($dataProvider->getData() as $key => $value) {
	// 		var_dump($value);
	// 	}
		
	// }
}
