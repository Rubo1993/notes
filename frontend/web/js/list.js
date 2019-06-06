// $(document).ready(function() {
//     $('#div2,#div3').hide();
// }
jQuery(function() {
    jQuery('#showall').click(function() {
        jQuery('.targetDiv').show();
    });
    jQuery('.showSingle').click(function() {
        jQuery('.targetDiv').hide();
        jQuery('#div' + $(this).attr('target')).show();
    });
});

$(document).ready(function(){
    // $(".add").document.((function(){
    //     $(".clone_form").clone().appendTo(".append_here");
    // });
    $(document).on('click','.add' ,(function(){
        $(".clone_this >.clone_form").clone().appendTo("#appends");
    }));
    $(document).on('click', ".remove", function(){
        $(this).parent('div').remove();

    });

});



