var store = new Ext.data.JsonStore({
	proxy: new Ext.data.HttpProxy({url:'list.php'}),
	totalProperty:'totalProperty',
	root:'res',
	fields:[
		{name:'id',type:'int'},
		{name:'pname',type:'string'},
		{name:'budget1',type:'int'},
		{name:'budget2',type:'int'},
		{name:'name',type:'string'},
		{name:'ping1',type:'int'},
		{name:'ping2',type:'int'},
		{name:'tel',type:'string'},
		{name:'rooms1',type:'int'},
		{name:'rooms2',type:'int'},
		{name:'email',type:'string'},
		{name:'car',type:'int'},
		{name:'city',type:'int'},
		{name:'plan',type:'int'},
		{name:'year',type:'int'},
		{name:'month',type:'int'},
		{name:'day',type:'int'},
		{name:'time',type:'string'},
		{name:'uses',type:'int'},
		{name:'other',type:'string'},
		{name:'content',type:'string'},
		{name:'created',type:'string'}
	],
	remoteSort:true
});
store.load({params:{start:0,limit:20}});
var sm = new Ext.grid.CheckboxSelectionModel();
var cols = new Ext.grid.ColumnModel([
	sm,
	new Ext.grid.RowNumberer(),
	{header:'ID',dataIndex:'id',width:28,align:'center',id:'id'},
	{header:'建案名稱',dataIndex:'pname'},
	{header:'預算',dataIndex:'budget1',renderer:budgetRender},
	{header:'坪數',dataIndex:'ping1',renderer:pingRender},
	{header:'房數',dataIndex:'rooms1',renderer:roomsRender},
	{header:'聯絡姓名',dataIndex:'name'},
	{header:'聯絡電話',dataIndex:'tel'},
	{header:'聯絡email',dataIndex:'email'},
	{header:'所在縣市',dataIndex:'city',renderer:cityRender},
	{header:'車位',dataIndex:'car',renderer:carRender},
	{header:'購屋時間',dataIndex:'plan',renderer:planRender},
	{header:'看屋時間',dataIndex:'year',renderer:viewRender},
	{header:'用途',dataIndex:'uses',renderer:usesRender},
	{header:'建立日期',dataIndex:'created',format:'Y-m-d H:i:s'}
]);
cols.defaultSortable = true;

var delRec = function(){
	var index = grid.getSelectionModel().getSelections();
	if (index.length<1) {
		Ext.Msg.alert('訊息','您沒有選擇要刪除的紀錄');
		return false;
	}else{
		var i = 0;
		var len = index.length;
		tmp=new Array();
		while(i < len){
			tmp.push(index[i].get('id'));
			store.remove(index[i]);
			i++;
		}
		Ext.Ajax.request({
			url: 'delete.php',
			success: function(res){
				Ext.ux.Growl.notify({
                    title: "訊息", 
                    message: "資料已成功刪除",
                    iconCls:'x-growl-notice',
                    alignment: "tr-tr",
                	offset: [-10, 10]
                });
			},
			params: {'foo[]': tmp}
		});
		grid.view.refresh();
	}
}
var logout = function(){
	win.show();
	Ext.Ajax.request({
		url:'login.php',
		success:function(){
			Ext.ux.Growl.notify({
                title: "訊息", 
                message: "您已成功登出",
                iconCls:'x-growl-notice',
                alignment: "tr-tr",
            	offset: [-10, 10]
            });
		},
		params:{'logout':1}
	});
}
var filter_ds = new Ext.data.JsonStore({
	proxy:new Ext.data.HttpProxy({method:'post',url:'filter.php'}),
	root:'root',
	fields:[
		{name:'id'},
		{name:'name'}
	]
});

var filter_combo = new Ext.form.ComboBox({
	fieldLabel:'建案名稱',
	id:'filter_combo',
	store:filter_ds,
	editable:false,
	triggerAction:'all',
	mode:'local',
	hiddenName:'filter_id',
	displayField:'name',
	valueField:'id',
	width:140,
	emptyText:'請選擇'
});

var filter = new Ext.form.FormPanel({
	frame:true,
	labelAlign:'right',
	labelWidth:100,
	items:[filter_combo],buttons:[{
		text:'不分類',
		handler:function(){
			filter.getForm().reset();
			store.baseParams.start = 0;
			store.baseParams.limit = 20;
			store.baseParams.property_id = '';
			store.load();
		}
	}]
});
filter_combo.on('select',function(){
	store.baseParams.start = 0;
	store.baseParams.limit = 20;
	store.baseParams.property_id = this.getValue();
	store.load();
});
var filter_menu = new Ext.menu.Menu({items:[filter]});
filter_menu.on('show',function(){
	filter_ds.load();
})
var excel = function(){
	Ext.Ajax.request({
		url: 'excel.php',
		success: function(res){
			Ext.Msg.show({
				title:'下載',
				msg:'請點選<a href=\'excel.php?file='+res.responseText+'\' target=\'_blank\' class=\'xls\' \>此處下載Excel</a>',
				buttons:Ext.Msg.CANCEL,
				width:350
			});
		},
		params: {foo:grid.getStore().baseParams.property_id}
	});
}
var grid = new Ext.grid.GridPanel({
	sm:sm,
	title:'顧客資訊清單',
	id:'type1',
	stripeRows:true,
	loadMask:true,
	store:store,
	cm:cols,
	enableHdMenu:false,
	viewConfig:{
    	forceFit:true,
    	enableRowBody:true,
    	showPreview:true,
    	getRowClass : function(record, rowIndex, p, store){
    		if(record.data.content.length>0){
	    		p.body = '<p class=\'content\'>'+record.data.content+'</p>';
				return 'x-grid3-row-expanded';
			}else{
				return 'x-grid3-row-collapsed';
			}
		}
	},
	bbar:new Ext.PagingToolbar({
		pageSize:20,
		store:store,
		displayInfo:true
	}),
	tbar:new Ext.Toolbar([{
		id:'del',
		text:'刪除',
		iconCls:'delete',
		tooltip:'刪除選取資料列',
		handler:function(){
			Ext.Msg.confirm('確認','確定要刪除已選擇的資料？',function(btn){if(btn == 'yes'){delRec();}});
		}
	},{
		id:'xls',
		text:'匯出Excel',
		iconCls:'xls',
		tooltip:'匯出所有資料到Excel',
		handler:excel
	},{
		id:'logout',
		text:'登出帳號',
		iconCls:'logout',
		tooltip:'登出帳號',
		handler:function(){
			Ext.Msg.confirm('確認','確定要登出此帳號？',function(btn){if(btn == 'yes'){logout();}});
		}
	},{
		text:'過濾建案',
		menu:filter_menu
	}])
});
