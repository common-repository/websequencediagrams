function wsd_diagram() {
    return "[wsd theme=\"napkin\"]<pre>A->B: C</pre>[/wsd]";
}

(function() {

    /*diagram*/
    tinymce.create('tinymce.plugins.wsd_diagram', {

        init : function(ed, url){
            ed.addButton('wsd_diagram', {
                title : 'WebSequenceDiagrams Shortcode Insering Button',
                onclick : function() {
                    ed.execCommand(
                        'mceInsertContent',
                        false,
                        wsd_diagram()
                        );
                },
                image: url + "/diagram35x35.png"
            });
        },

        getInfo : function() {
            return {
                longname : 'WebSequencDiagram Shortcode Insering Button',
                author : 'Joel Vandal',
                authorurl : 'http://joel.vandal.ca',
                infourl : '',
                version : "1.0"
            };
        }
    });

    tinymce.PluginManager.add('wsd_diagram', tinymce.plugins.wsd_diagram);
})();	

