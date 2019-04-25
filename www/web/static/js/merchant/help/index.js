;
var help_index_ops = {
    init:function(){
        this.eventBind();
    },
    eventBind:function(){
        hljs.initHighlightingOnLoad();
    }
};

$(document).ready( function(){
    help_index_ops.init();
} );