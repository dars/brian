var budgetRender = function(value,p,record){
	return value+"萬~"+record.data.budget2+"萬";
}
var pingRender = function(value,p,record){
	return value+"坪~"+record.data.ping2+"坪";
}
var roomsRender = function(value,p,record){
	return value+"房~"+record.data.rooms2+"房";
}
var viewRender = function(value,p,record){
	return value+'-'+record.data.month+'-'+record.data.day+' '+record.data.time;
}
var carRender = function(value){
	if(value == '1'){
		return "<span>有</span>";
	}else{
		return "<span>無</span>";
	}	
}
var planRender = function(value){
	if(value == 1){
		return "<span>急需</span>";
	}else if(value == 2){
		return "<span>三個月至半年</span>";
	}else if(value == 3){
		return "<span>半年至一年</span>";
	}else if(value == 4){
		return "<span>一年以上</span>";
	}
}
var usesRender = function(value,p,record){
	if(value == 1){
		return "<span>首次購屋</span>";
	}else if(value == 2){
		return "<span>換屋</span>";
	}else if(value == 3){
		return "<span>投資置產</span>";
	}else if(value == 4){
		return "<span>工作變更</span>";
	}else if(value == 5){
		return "<span>轉換環境</span>";
	}else if(value == 6){
		return "<span>新婚成家</span>";
	}else if(value == 7){
		return "<span>租約到期</span>";
	}else if(value == 8){
		return "<span>子女求學</span>";
	}else if(value == 9){
		return "<span>"+record.data.other+"</span>";
	}
}
var cityRender = function(value){
	switch(value){
		case 1:
			return "<span>基隆市</span>";
			break;
		case 2:
			return "<span>台北市</span>";
			break;
		case 3:
			return "<span>台北縣</span>";
			break;
		case 4:
			return "<span>宜蘭縣</span>";
			break;
		case 5:
			return "<span>桃園縣</span>";
			break;
		case 6:
			return "<span>新竹縣</span>";
			break;
		case 7:
			return "<span>新竹市</span>";
			break;
		case 8:
			return "<span>苗栗縣</span>";
			break;
		case 9:
			return "<span>台中市</span>";
			break;
		case 10:
			return "<span>台中縣</span>";
			break;
		case 11:
			return "<span>彰化縣</span>";
			break;
		case 12:
			return "<span>南投縣</span>";
			break;
		case 13:
			return "<span>雲林縣</span>";
			break;
		case 14:
			return "<span>嘉義市</span>";
			break;
		case 15:
			return "<span>台南市</span>";
			break;
		case 16:
			return "<span>台南縣</span>";
			break;
		case 17:
			return "<span>高雄市</span>";
			break;
		case 18:
			return "<span>高雄縣</span>";
			break;
		case 19:
			return "<span>屏東縣</span>";
			break;
		case 20:
			return "<span>花蓮縣</span>";
			break;
		case 21:
			return "<span>台東縣</span>";
			break;
		case 22:
			return "<span>澎湖縣</span>";
			break;
		case 23:
			return "<span>金門縣</span>";
			break;
		case 24:
			return "<span>連江縣</span>";
			break;
	}
}