Ext.define('My.DownloadHelper', {
    getDownloadPanel: function () {

        var me = this,
                panel = {
                    margin: '150 0 0 0',
                    title: 'Скачать',
                    iconCls: 'download',
                    cls: 'card3',
                    items: [
                        {
                            xtype: 'button',
                            text: 'Скачать mp3',
                            padding: 20,
                            margin: 20,
                            handler: function () {
                                var idsQuery = me.getIdsQuery();
                                if(idsQuery !== false){
                                    window.location = "php/downloadMp3.php?plain=true&ids=" + idsQuery;
                                }
                            }
                        },
                        {
                            xtype: 'button',
                            text: 'Скачать mp3 (обратный) ',
                            padding: 20,
                            margin: 20,
                            handler: function () {
                                var idsQuery = me.getIdsQuery();
                                if(idsQuery !== false){
                                    window.location = "php/downloadMp3.php?plain=false&ids=" + idsQuery;
                                }
                            }
                        }
                    ]
                };

        return panel;
    },
    
    getIdsQuery: function(){
        var me = this,
            list = My.ListHelper.list,
                selection = list.getSelection(),
                ids = [],
                idsQuery = '';

        if (selection.length) {

            for (var i in selection) {
		var id = parseInt(selection[i].data.id);
                ids.push(id);
            }

            idsQuery = JSON.stringify(ids);
            
            return idsQuery;
        }
        else{
            return false;
        }
    }
});
