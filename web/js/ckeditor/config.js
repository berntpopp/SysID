/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';

    config.inlinesave = {
        postUrl: 'save-about',
//        onSave: function (editor) {
//            console.log('clicked save', editor);
//            return true;
//        },
        onSuccess: function (editor, data) {
            saveEditorContents(editor);            
            
            var element = $('#' + editor.name);            
            element.css({outline: "0px solid green"});
            element.animate({outlineWidth: 5}, 100, function() {
                element.animate({outlineWidth: 0}, 500, function(){});
            });
            
            //console.log('save successful', editor, data);
        },
        onFailure: function (editor, status, request) {
            
            var element = $('#' + editor.name);            
            element.css({outline: "0px solid red"});
            element.animate({outlineWidth: 5}, 150, function() {
                element.animate({outlineWidth: 0}, 600, function(){});
            });
            
            console.log('save failed', editor, status, request);
        },
        useJSON: false,
        useColorIcon: true
    };

    config.inlinecancel = {
        onCancel: function (editor) {
            restoreEditorContents(editor);
            //console.log('cancel', editor);
        }
    };       

    config.toolbar = 'MyToolbar';

    config.toolbar_MyToolbar =
            [
                {name: 'document', items: ['Inlinesave', 'Inlinecancel']},
                {name: 'clipboard', items: ['Undo', 'Redo']},
                {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                        '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
                {name: 'insert', items: ['Table', 'HorizontalRule', 'SpecialChar']},
                {name: 'links', items: ['Link', 'Unlink']},
                '/',
                {name: 'styles', items: ['Format', 'Font', 'FontSize']},
                {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat']},
                {name: 'colors', items: ['TextColor', 'BGColor']},
                {name: 'tools', items: ['ShowBlocks']}
            ];
};