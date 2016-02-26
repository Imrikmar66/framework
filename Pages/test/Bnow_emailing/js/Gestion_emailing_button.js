(function() {
    tinymce.PluginManager.add('bnow_emailing_mce_button', function(editor, url) {
        editor.addButton('bnow_emailing_mce_button', {
            text: '',
            image: url+'/email-icon.png',
            onclick: function() {
                editor.insertContent('[emailing_form to="" template="" id=""][/emailing_form]');
            }
        });
    });
})();