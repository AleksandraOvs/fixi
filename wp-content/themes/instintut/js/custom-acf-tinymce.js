(function($) {
    function custom_acf_tinymce_plugin(editor) {
        editor.addButton('attention', {
            text: 'Attention',
            icon: false,
            onclick: function() {
                editor.insertContent('<div class="attention">' + editor.selection.getContent() + '</div>');
            }
        });
    }

    function init_custom_acf_tinymce() {
        tinymce.PluginManager.add('attention', custom_acf_tinymce_plugin);
    }

    // Initialize the plugin only after TinyMCE is loaded
    if (typeof tinymce !== 'undefined') {
        init_custom_acf_tinymce();
    } else {
        $(document).on('tinymce-editor-init', init_custom_acf_tinymce);
    }

    // Hook into ACF's wysiwyg initialization
    acf.add_filter('wysiwyg_tinymce_settings', function(mceInit, id, $field) {
        mceInit.external_plugins = mceInit.external_plugins || {};
        mceInit.external_plugins['attention'] = customAcfTinymce.pluginUrl;
        mceInit.toolbar1 += ' attention';
        return mceInit;
    });
})(jQuery);
