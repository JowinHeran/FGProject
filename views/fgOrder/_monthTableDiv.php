<?php 
// 組成每一列裝置的標題
$postDeviceArr = array_map("intval",explode(',', $post['deviceIdArr']));
$periodArr = array();
foreach ($postDeviceArr as $key => $value) {
	$periodArr[$value]=array(
						    "device_id"=>$value,
					  		"count"=>$post['materialNum'],
						);
}

$results =  FgOrder::model()->ajaxGetStatistic();
foreach ($results  as $key => $value) {
	$periodArr[$value['device_id']][$key] = 
			array("device_id"=>$value['device_id'],
				  "project_device"=>$value['project_device'],
				  "count"=>$value['current_qty'],
				);
}
$deviceArr = $postDeviceArr;
// var_dump($postDeviceArr);

// 查詢裝置別名及Mac
$criteria = new CDbCriteria();
$criteria->addInCondition("id", $postDeviceArr);
$deviceNameResults = FgDevice::model()->findAll($criteria);
foreach ($deviceNameResults as $key => $value) {
	$name = (string)$value->name;
	$mac = (string)$value->mac;
	$id = (string)$value->id;
	$tempArr[$id] =array(
						"name"=>$name,
						"mac"=>$mac,
					); 
}

$deviceNameArr = $tempArr;

?>

<style>
#calendar-table table,#calendar-table th,#calendar-table td{
	border:1px solid black;
	padding: 4px;
}
.calendar-header td{
	background-color: #539DC7;
	color:white;
}
.calendar-day td:nth-child(odd){
	background-color: #F0F0F0;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	var s_date_obj = $("input[name='s_date']");
	var e_date_obj = $("input[name='e_date']");
	var check_obj = $("input[name='time_type[]']");
	var s_date_val = "";
	var e_date_val = "";
	s_date_obj.blur(function(){
		if(isNaN(Date.parse($(this).val()))){
			alert("請輸入正確日期!");
			return false;
		}else{
			s_date_val = $(this).val();
		}
	});
	e_date_obj.blur(function(){
		if(isNaN(Date.parse($(this).val()))){
			alert("請輸入正確日期!");
			return false;
		}else{
			s_date_obj.trigger('blur');
			e_date_val = $(this).val();
			if(s_date_val && e_date_val){
				// sendAjax();
				getAjax();
			}else{
				// console.log("s_date_val="+s_date_val);
				// console.log("e_date_val="+e_date_val);
			}
		}
	});
	check_obj.click(function(){
		getAjax();
	});
});

var periodArr = JSON.parse('<?=json_encode($periodArr); ?>');

//var deviceArr = new Array(<?=implode(",",$deviceArr);?>);
var deviceArr = [];
<?php foreach($deviceArr as $k=>$v){?>
	deviceArr.push(<?= $v ?>);
<?php }?>
var deviceNameArr = JSON.parse('<?=json_encode($deviceNameArr); ?>');
var deviceNum = <?=count($deviceArr)?>;
// these are labels for the days of the week
cal_days_labels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
// these are human-readable month name labels, in order
cal_months_labels = ['January', 'February', 'March', 'April',
                     'May', 'June', 'July', 'August', 'September',
                     'October', 'November', 'December'];
// these are the days of the week for each month, in order
cal_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
// this is the current date
cal_current_date = new Date(); 
// The Calendar constructor
function Calendar(month, year) {
  this.month = (isNaN(month) || month == null) ? cal_current_date.getMonth() : month;
  this.year  = (isNaN(year) || year == null) ? cal_current_date.getFullYear() : year;
  this.html = '';
}
/* 左邊補0 */
function padLeft(str, len) {
    str = '' + str;
    if (str.length >= len) {
        return str;
    } else {
        return padLeft("0" + str, len);
    }
}
// HTML generation
Calendar.prototype.generateHTML = function(){
	// 取得今日日期
		var today = new Date();
 	 	var year = today.getFullYear();
 	 	var month = today.getMonth()+1;
	// First day of the month
		var firstDay = new Date(this.year, this.month, 1);
		var startingDay = firstDay.getDay();
		// returns 4 (Thursday)

		// Number of days in the month
		var monthLength = cal_days_in_month[this.month];
		
		// Compensate for leap year
		if (this.month == 1) { // February only!
		  if ((this.year % 4 == 0 && this.year % 100 != 0) || this.year % 400 == 0){
		    monthLength = 29;
		  }
		}
		
		// Constructing the HTML(table header)
		var monthName = cal_months_labels[this.month];
		var html = '<table class="calendar-table" id="calendar-table">';
		html += '<tr><th colspan="7">';
		html +=  monthName + "&nbsp;" + this.year;
		html += '</th></tr>';
		html += '<tr class="calendar-header">';
		html += '<td class="calendar-header-day">裝置編號</td>';
		for(var i=0;i<monthLength;i++){
			 html += '<td class="calendar-header-day">';
		  html += (i+1);
		  html += '</td>';
		}
		
		
		html += '</tr><tr>';
		// table body
		var materialNum;
		// 循環有幾個裝置
		for (var i = 0; i < deviceNum; i++) {
			// 設定第一個td:裝置名稱
			console.log(deviceArr[i],i);
			html += '<td class="calendar-day-device">';
			html += deviceNameArr[deviceArr[i]]["name"];
			html += "<br>";
			html += deviceNameArr[deviceArr[i]]["mac"];
			// html += deviceArr[i];
			html += '</td>';
			// 循環有幾天開始
			 for(var j=0 ; j < monthLength ; j++ ){
			 	console.log("this.year=>"+this.year+"this.month=>"+this.month);
			 	var strIndex = this.year+"-"+(this.month+1)+"-"+padLeft(j+1,2);
			 	if(typeof(deviceArr[i])=="undefined" || typeof(periodArr[deviceArr[i]])=="undefined"){
			 		continue;
			 	}
			 	
			 	 // 如果當天小於整月天數，就顯示日期
		 	 	if(j <= monthLength && Object.keys(periodArr[deviceArr[i]]).indexOf(strIndex)!=-1){
			 	 	 html += '<td class="calendar-day" data-date="'+strIndex+'" data-device="'+deviceArr[i]+'">';
			 	 	if(typeof(periodArr[deviceArr[i]][strIndex])=="undefined"){
			 	 		console.log("不是undefined!");
			 	 	}else{
			 	 		html += periodArr[deviceArr[i]][strIndex]["count"];
			 	 	}
			 	 	 html += '</td>';
				 }else{
				 	html += '<td class="calendar-day" data-date="'+strIndex+'" data-device="'+deviceArr[i]+'"></td>';
				 }
				 

			 }
			 //循環有幾天結束
			
			 if(i > deviceNum){
			 	break;
			 }else{
			 	html += '</tr><tr>';
			 }
			console.log("i="+i+"j="+j+"deviceNum="+deviceNum);
			 
		};
		

		html += '</tr></table>';

		this.html = html;
}

Calendar.prototype.getHTML = function() {
  return this.html;
}

</script>
<div style="float:right;margin-bottom: -10px;margin-right: 45px;">
	<span><a id="left">前一月<?php echo TbHtml::icon(TbHtml::ICON_CHEVRON_LEFT);?></a></span>
	<span><a id="right">後一月<?php echo TbHtml::icon(TbHtml::ICON_CHEVRON_RIGHT);?></a></span>
</div>
<!-- 切換頁用的區塊 -->
<div id="pageDiv"></div>
<script type="text/javascript">
  var today = new Date();
  var year = today.getFullYear();
  var month = today.getMonth();
  var pageMonth = month;
  var pageYear  = year;
  var cal = new Calendar(month,year);
  cal.generateHTML();
  $("#pageDiv").after(cal.getHTML());
  // document.write(cal.getHTML());
  $('#left').click(function(){
  		$("#calendar-table").remove();
		if(pageMonth==0){
			pageMonth = 12;
			pageYear = pageYear - 1;
		}
		pageMonth = pageMonth - 1;
  		var cal = new Calendar(pageMonth,pageYear);
  		cal.generateHTML();

  		$("#pageDiv").html(cal.getHTML());
  		$("input[name='e_date']").trigger('blur');
  });
  $("#right").click(function(){
  	$("#calendar-table").remove();
  	console.log("pageMonth=>"+pageMonth+"pageYear=>"+pageYear);
	if(pageMonth==11){
		pageMonth = 0;
		pageYear = pageYear + 1;
	}else{
		pageMonth = pageMonth + 1;
	}
	
    var cal = new Calendar(pageMonth,pageYear);
    cal.generateHTML();
  	$("#pageDiv").html(cal.getHTML());
  	$("input[name='e_date']").trigger('blur');
  });
</script>
