jQuery(document).ready(function () {
    
    jQuery('#btn').on('click', function () {
    
       var name = jQuery("#shortcode_name").val();
      var content =  jQuery("#shortcode_content").val();
      jQuery.ajax({
        type : "post",
        url : custom_shortcode_script_obj.url,
        data : {action: "show_shortcode", name : name, content:content},
             
       },function(){
           console.log('done')
       })
    });

})