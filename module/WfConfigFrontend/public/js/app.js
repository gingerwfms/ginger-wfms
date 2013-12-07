(function() {
    var root = this;
    
    var Backbone = root.Backbone;
    var _ = root._;
    var $ = root.jQuery;
    
    var Workflow = Backbone.Model.extend({});
    
    
    
    var App = {
        workflow : null,
        init : function(WorkflowData) {  
            this.workflow = new Workflow(WorkflowData);
            return this;
        },
        run : function() {
            console.log(this.workflow.get('name'));
        }
    };    
    $(root).ready(function(){     
        if (typeof root['WorkflowData'] == 'undefined') {
            alert("Can not start Workflow Configurator. WorkflowData is missing.");
        } else {
            App.init(root.WorkflowData).run();
        }
    });
}).call(this);