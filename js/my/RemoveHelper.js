Ext.define('My.RemoveHelper', {
    getRemovePanel: function () {

        var me = this,
                panel = {
                    margin: '150 0 0 0',
                    title: 'Удалить',
                    iconCls: 'trash',
                    cls: 'card4',
                    items: [
                        {
                            xtype: 'button',
                            text: 'Удалить выделенные',
                            padding: 20,
                            margin: 20,
                            handler: function () {
                                Ext.Msg.confirm("Удаление", "Удалить выбранные записи?", me.remove, me);
                            }
                        }
                    ]
                };

        return panel;
    },
    
    getIds: function(){
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

            return ids;
        }
        else{
            return [];
        }
    },
    
    remove: function(answer){
        var me = this,
            ids = me.getIds();
    
        if(answer === 'no') return false;
    
        if(!ids.length){
            Ext.Msg.alert("Удаление", "Записи не выбраны!");
            return false;
        }
        
        if(answer === 'yes'){
            Ext.Ajax.request({
                url: 'php/remove.php',
                params: {
                    ids: JSON.stringify(ids)
                },
                success: function(response){
                    response = JSON.parse(response.responseText);
                    console.log(response);
                    if(response.result === true){
                        Ext.Msg.alert("Удаление", "Выбранные записи успешно удалены!", function(cmd){
                            if(cmd === 'ok'){
                                window.location.reload();
                            }
                        });
                    }
                    else{
                        Ext.Msg.alert("Удаление", "Ошибка!");
                    }
                }
            });
        }
    }
});
