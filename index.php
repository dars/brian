<?php
session_start();
if(!$_GET['id']){
	echo "不正確的頁面邀求.";
	exit();
}
require_once('config.php');
$res = $db->get_row('SELECT * FROM property WHERE id='.$_GET['id']);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="description" content="<?php echo $res->description?>" />
		<meta name="keywords" content="<?php echo $res->keyword?>" />
		<title>::預約看屋::</title>
		<link rel="stylesheet" href="css/reset.css" />
		<link rel="stylesheet" href="css/themes/default/easyui.css" />
		<link rel="stylesheet" href="css/themes/icon.css" />
		<link rel="stylesheet" href="css/style.css" />
		<script type="text/javascript" src="js/head.min.js"></script>
		<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
		<script type="text/javascript">
		var p_id = <?php echo $_GET['id']?>;
		$(function(){
			$('#city').combobox({
				url:'cities.json',
				valueField:'id',
				textField:'text',
				editable:false,
				required:true,
				missingMessage:'此欄位必填'
			});
			$('input[type=number]').numberbox().validatebox({
				required:true,
				missingMessage:'此欄位必填'
			});
			$('#email').validatebox({
				required:true,
				validType:'email',
				missingMessage:'此欄位必填',
				invalidMessage:'請輸入正確的email格式'
			});
			$('#year').numberbox({
				min:2010
			}).validatebox({
				required:true,
				missingMessage:'此欄位必填'
			});
			$('#month').numberbox({
				min:1,
				max:12
			}).validatebox({
				required:true,
				missingMessage:'此欄位必填'
			});
			$('#day').numberbox({
				min:1,
				max:31
			}).validatebox({
				required:true,
				missingMessage:'此欄位必填'
			});
			$('#time').timespinner().validatebox({
				required:true,
				missingMessage:'此欄位必填'
			});
			$('#form1').form({
				url:'data.php',
				onSubmit:function(){
					if(!$('#form1').form('validate')){
						return false;
					}
				},
				success:function(data){
					$.messager.alert('訊息',data,'info');
					cls_form();
				}
			});
			cls_form();
			$('#cls_btn').click(function(){
				cls_form();
			});
			function cls_form(){
				$('#form1').form('clear');
				$('#property_id').attr('value',p_id);
				$('#car1,#plan1,#uses1').attr('checked',true);
			}
		})
		head.ready(function(){
			if(head.browser.ie){
				head.js("http://www.iecss.com/print-protector/javascript/iepp.1-6-2.min.js");	
			}
		});
		</script>
	</head>
	<body class="container_24">
		<article>
			<header>
				<h1><?php echo $res->name;?></h1>
				<?php if($res->img){?>
				<img src="files/images/<?php echo $res->img?>">
				<?php }?>
			</header>
			<section>
				<form method="post" name="form1" id="form1">
				<table>
					<tr>
						<th class="head" colspan=4>馬上索取資料或預約看屋</th>
					</tr>
					<tr>
						<th>預約看屋建案名稱</th>
						<td class="case_name" colspan=3><?php echo $res->name;?></td>
					</tr>
					<tr>
						<th><span class="star">*</span>購屋預算</th>
						<td><input type="number" name="budget1" id="budget1">萬~至<input type="number" name="budget2" id="budget2">萬</td>
						<th><span class="star">*</span>真實姓名</th>
						<td><input type="text" name="name" id="name"><span class="remark">(例如 王大明或王先生/小姐)</span></td>
					</tr>
					<tr>
						<th><span class="star">*</span>需求坪數</th>
						<td><input type="number" name="ping1" id="ping1">坪~至<input type="number" name="ping2" id="ping2">坪</td>
						<th><span class="star">*</span>聯絡電話</th>
						<td><input type="tel" name="tel" id="tel"></td>
					</tr>
					<tr>
						<th><span class="star">*</span>需求房間數</th>
						<td><input type="number" name="rooms1" id="rooms1">房~至<input type="number" name="rooms2" id="rooms2">房</td>
						<th><span class="star">*</span>E-mail</th>
						<td><input type="email" name="email" id="email"></td>
					</tr>
					<tr>
						<th><span class="star">*</span>車位需求</th>
						<td><input type="radio" name="car" id="car1" value=1>有<input type="radio" name="car" id="car2" value=0>無</td>
						<th><span class="star">*</span>所在縣市</th>
						<td><select id="city" name="city"></select></td>
					</tr>
					<tr>
						<th><span class="star">*</span>預購屋時間</th>
						<td colspan=3>
							<input type="radio" name="plan" id="plan1" value=1>急需
							<input type="radio" name="plan" value=2>三個月至半年
							<input type="radio" name="plan" value=3>半年至一年
							<input type="radio" name="plan" value=4>一年以上
						</td>
					</tr>
					<tr>
						<th><span class="star">*</span>希望看屋時間</th>
						<td colspan=3>
							<input type="number" name="year" id="year" maxlength="4">年
							<input type="month" name="month" id="month" maxlength="2">月
							<input type="number" name="day" id="day" maxlength="2">日
							<input type="time" name="time" id="time"><span class="remark">時間(YYYY/MM/DD HH:MM)</span>
						</td>
					</tr>
					<tr>
						<th><span class="star">*</span>購屋用途</th>
						<td colspan=3>
							<input type="radio" name="uses" id="uses1" value=1>首次購屋
							<input type="radio" name="uses" value=2>換屋
							<input type="radio" name="uses" value=3>投資置產
							<input type="radio" name="uses" value=4>工作變更
							<input type="radio" name="uses" value=5>轉換環境<br/>
							<input type="radio" name="uses" value=6>新婚成家
							<input type="radio" name="uses" value=7>租約到期
							<input type="radio" name="uses" value=8>子女求學
							<input type="radio" name="uses" value=9>其他
							<input type="text" name="other" id="other">
						</td>
					</tr>
					<tr>
						<th class="left" colspan=4>您的其他需求或意見</th>
					</tr>
					<tr>
						<td colspan=4><textarea name="content" id="content"></textarea></td>
					</tr>
					<tr>
						<td colspan=4 class="actions">
							<input type="hidden" name="property_id" id="property_id">
							<button type="submit" id="sub_btn">送出</button>
							<button type="button" id="cls_btn">清除</button>
						</td>
					</tr>
				</table>
				</form>
			</section>
			<footer>
				
			</footer>
		</article>
	</body>
</html>
