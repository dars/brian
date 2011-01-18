var loader = new Image();
loader.src = "images/ajax-loader.gif";
var pstore = new Ext.data.JsonStore({
	proxy:new Ext.data.HttpProxy({url:'plist.php',method:'post'}),
	root:'res',
	totalProperty:'totalProperty',
	fields:[
		{name:'id',type:'int'},
		{name:'name',type:'string'},
		{name:'img',type:'string'},
		{name:'keyword',type:'string'},
		{name:'description',type:'string'},
		{name:'email',type:'string'},
	]
});
pstore.load();
var pcm = new Ext.grid.ColumnModel([
	new Ext.grid.RowNumberer(),
	{header:'ID',dataIndex:'id',width:18,align:'center'},
	{header:'建案名稱',dataIndex:'name'},
	{header:'email',dataIndex:'email'}
]);
var pgrid = new Ext.grid.GridPanel({
	store:pstore,
	cm:pcm,
	loadMask:true,
	autoHeight:true,
	viewConfig:{forceFit:true},
	stripeRows:true,
	enableHdMenu:false,
	autoExpandColumn:'name',
	frame:true
});
var form = new Ext.form.FormPanel({
	autoScroll:true,
	labelAlign:'right',
	title:'設定配置',
	labelWidth:100,
	frame:true,
	fileUpload:true,
	defaults: {
        anchor: '95%',
		msgTarget: 'side'
	},
	items:[{
		layout:'column',
		items:[{
			columnWidth:0.4,
			layout:'fit',
			items:[pgrid]
		},{
			columnWidth:0.6,
			xtype:'fieldset',
			labelWidth:120,
			title:'基本配置設定',
			border:true,
			autoHeight:true,
			defaults:{
				anchor:'90%'
			},
			style:'margin-left:10px;padding:5px',
			items:[{
	    		xtype:'box',
	    		autoEl:{
	    		    tag:'div',
	    		    id:'img_dv', 
	    		    align:'center',
	    		    children:[{
	    		    	id:'head_img',
	    		    	tag:'img',
	    		    	src:Ext.BLANK_IMAGE_URL
 	    		    }]
 	    		}
			},{			
	    		fieldLabel:'圖片',
	    		name:'img',
	    		xtype:'fileuploadfield',
	    		id:'img_txt',
	    		buttonText:'瀏覽'
			},{
				xtype:'hidden',
				name:'id'
			},{			
	    		xtype:'textfield',
	    		name:'name',
	    		fieldLabel:'建案名稱'
			},{			
	    		xtype:'textfield',
	    		name:'keyword',
	    		fieldLabel:'關鍵字'
			},{			
	    		xtype:'textarea',
	    		name:'description',
	    		fieldLabel:'建案簡介'
			},{			
	    		xtype:'textfield',
	    		name:'email',
	    		fieldLabel:'Email'
			},{
				xtype:'displayfield',
				fieldLabel:'網址',
				name:'url',
				id:'url',
				value:''
			}]			
		}],buttons:[{
			text:'儲存',
			handler:function(){
				if(form.getForm().isValid()){
					form.getForm().submit({
						url: 'upload.php',
	    	    		waitMsg: '資料儲存中...',
	    	    		success: function(fp, o){
	    	    			show_Growl(1,'訊息','資料已儲存成功');
        	    			form.getForm().reset();
							Ext.get('head_img').dom.src=Ext.BLANK_IMAGE_URL;
							pstore.reload();
							store.reload();
						}
					});
				}
			}
		},{
			text:'新增',
			handler:function(){
				form.getForm().reset();
				Ext.get('head_img').dom.src=Ext.BLANK_IMAGE_URL;
			}
		},{
			text:'刪除',
			handler:function(){
				var id = form.getForm().findField('id').getValue();
				if(id == ''){
					Ext.Msg.alert('提醒','請選擇需要刪除的資料！');
				}else{
					Ext.Msg.confirm('提醒','確定刪除此比資料，將會一併刪除相關聯絡我們記錄',function(btn){
						if(btn == 'yes'){
							Ext.Ajax.request({
								url:'delete.php',
								params:{id:form.getForm().findField('id').getValue()},
								success:function(){
									show_Growl(1,'訊息','資料已刪除');
        	    					form.getForm().reset();
									Ext.get('head_img').dom.src=Ext.BLANK_IMAGE_URL;
									pstore.reload();
								}
							});
						}
					});
				}
			}
		}]
	}]
});
pgrid.on('rowclick',function(grid,rowIndex,event){
	var record = grid.getStore().getAt(rowIndex);
	form.getForm().loadRecord(record);
	form.getForm().findField('img').setValue('');
	form.getForm().findField('url').setValue('http://www.number-media.com.tw/brian/index.php?id='+record.data.id);
	Ext.get('head_img').dom.src = Ext.BLANK_IMAGE_URL;
	if(record.data.img){
		Ext.get('head_img').dom.src = loader.src;
		tmp=new Image();
		tmp.src='files/images/'+record.data.img;
		tmp.onload = function(){
			Ext.get('head_img').dom.src = tmp.src;
		}
	}
});
