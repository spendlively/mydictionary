Ext.define('My.FormHelper', {

    form: null,
    firstField: null,

    getForm: function(){

        var me = this,
            items = this.getFormItems();


        me.form = Ext.create('Ext.form.Panel', {
            xtype: 'formpanel',
            items: items,
            iconCls: 'add',
            cls: 'card2',
            title: 'Добавить',
            listeners: {
                exception: function(form){
                    me.setFocusOnField();
                    form.reset();
                }
            }
        });

        return me.form;
    },

    getFormItems: function() {

        var me = this;

        return [
            {
                xtype: 'fieldset',
                defaults: {
                    required: true
                },
                items: [
                    {
                        xtype: 'textfield',
                        name: 'word',
                        label: 'Слово',
                        listeners: {
                            action: function(q,w,e,r){
                                me.submitForm();
                            },
                            render: function(field) {
                            },
                            painted: function(q,w,e,r,t){
                                me.firstField = q;
                                me.setFocusOnField();
                            }
                        }
                    },
                    {
                        xtype: 'textfield',
                        name: 'translate',
                        label: 'Перевод',
                        listeners: {
                            action: function(q,w,e,r){
                                me.submitForm();
                            }
                        }
                    },
                    {
                        xtype: 'textfield',
                        name: 'phrase',
                        label: 'Фраза',
                        listeners: {
                            action: function(q,w,e,r){
                                me.submitForm();
                            }
                        }
                    },
                    {
                        xtype: 'textfield',
                        name: 'phraseTranslate',
                        label: 'Перевод',
                        listeners: {
                            action: function(q,w,e,r){
                                me.submitForm();
                            }
                        }
                    }
                ]
            },
            {
                xtype: 'toolbar',
                docked: 'bottom',
                scrollable: {
                    direction: 'horizontal',
                    directionLock: true
                },
                items: [
                    {
                        text: 'Сохранить',
                        ui: 'confirm',
                        handler: function() {
                            me.submitForm();
                        }
                    }
                ]
            }
        ];
    },

    submitForm: function(){
        var me = this,
            form = me.form;

        form.submit({
            url: 'php/add.php',
            waitMsg: 'Сохранение...',
            success: function() {
            }
        });
    },

    setFocusOnField: function(){

        var me = this,
            tags;

        if(me.firstField){
            setTimeout(function(){
                tags = me.firstField.dom.getElementsByTagName('input');
                if(tags['word']){
                    tags['word'].focus()
                }
            }, 500);
        }
    }
});

Ext.define('User', {
    extend: 'Ext.data.Model',

    config: {
        fields: [
            { name: 'word',     type: 'string' },
            { name: 'translate', type: 'string' },
            { name: 'phrase', type: 'string' },
            { name: 'phraseTranslate',    type: 'string' }
        ]
    }
});

