Ext.define('My.ListHelper', {

    statics: {
        list: null
    },

    getList: function() {

        var me = this,
            store = Ext.create('Ext.data.Store', {
            fields: ['id', 'word', 'translate', 'phrase', 'translatePhrase', 'time'],
            autoLoad: true,
            grouper: {
                groupFn: function(record) {
                    var time = record.get('time');
                    return Ext.Date.format(new Date(time), 'd.m.Y');
                },
		sortProperty: 'time',
		direction: 'DESC'
            },
            proxy: {
                type: 'ajax',
                url: 'php/select.php'
//                method: 'GET'
            }
        });

        My.ListHelper.list = Ext.create('Ext.List', {
            id: 'list',
            itemTpl: '<b>{word}</b> ({translate})<br><small>{phrase}</small><br><small>{translatePhrase}</small>',
            infinite: true,
            useSimpleItems: true,
            variableHeights: true,
            striped: true,
            ui: 'round',
            store: store,
            cls: 'card1',
            iconCls: 'list',
            title: 'Список',
            mode: 'multi',
            grouped: true,
            listeners: {
                selectionchange: function(ths, records, eOpts){
//                    var selection = me.list.getSelection();
//                    if(selection.length){
//                        for(var i in selection){
//                            
//                        }
//                    }
                }
//                select: function(view, record){
////                    console.log(me.list.getStore().getSelectionModel());
////                    console.log(view);
//                    console.log(record);
////                    console.log(view.items.items);
////                    console.log(view.items.items.length);
//                },
//                deselect: function(){
//                    console.log('deselect');
//                }
            }
        });

        return My.ListHelper.list;
    }
});
