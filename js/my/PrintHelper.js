Ext.define('My.PrintHelper', {

    panel: null,

    getPrintPanel: function () {

        var me = this;

        me.panel = Ext.create('Ext.Panel', {
            margin: '0 0 0 0',
            title: 'Распечатать',
            iconCls: 'settings',
            cls: 'card6',
            items: [],
            listeners: {
                show: function(q,w,e){
                    me.showList();
                }
            }
        });

        return me.panel;
    },

    showList: function(){

        var me = this,
            data = me.getData(),
            html = '<div style="font-size: 12px;">',
            newWindow,
            ind = 1;

        for(var i in data){
            html += '<br><strong>' + ind + ')</strong> ' + data[i].translate + '<strong> (' + data[i].word + ')</strong>';
            html += '<br>' + data[i].translatePhrase + '<strong> (' + data[i].phrase + ')</strong><br>';
            ind++;
        }
        html += '</div>';

        newWindow = window.open("data:text/xml; charset=utf-8", "", "");
        newWindow.document.write(html);
        newWindow.focus();
    },

    getData: function(){

        var me = this,
            list = My.ListHelper.list,
                selection = list.getSelection(),
                data = [];

        if (selection.length) {

            for (var i in selection) {
                var id = parseInt(selection[i].data.id);
                data.push(selection[i].data);
            }

            return data;
        }
        else{
            return [];
        }
    }
});
