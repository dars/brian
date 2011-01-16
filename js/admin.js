Ext.onReady(function(){
	Ext.BLANK_IMAGE_URL = 'images/s.gif';
	Ext.QuickTips.init();
	Ext.override(Ext.data.Store, {
		storeOptions : function(o) {
			o = Ext.apply({}, o);
			if(o.params){
				o.params = Ext.apply({}, o.params);
			}
			delete o.callback;
			delete o.scope;
			this.lastOptions = o;
		}
	});
	win.show();
	var keyNav = new Ext.KeyNav(Ext.get('password'),{
		enter:function(){
			login_submit();
		}
	});
	var tp = new Ext.TabPanel({
	    region:'center',
	    activeTab:0,
	    items:[grid,form]
	});
	
	var vp = new Ext.Viewport({
	    layout:'border',
	    items:[{
	    	region:'north',
	    	contentEl:'header'
	    },tp]
	});
	
});
function show_Growl(type,title,string){
	if(type == 1){
		Ext.ux.Growl.notify({
			title: title, 
			message: string,
			iconCls:'x-growl-notice',
			alignment: "tr-tr",
			offset: [-10, 10]
		});
	}else{
		Ext.ux.Growl.notify({
			title: title, 
			message: string,
			iconCls:'x-growl-error',
			alignment: "tr-tr",
			offset: [-10, 10]
		});
	}
}

