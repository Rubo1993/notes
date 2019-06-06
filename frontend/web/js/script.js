//
//
// $('.js-data-example-ajax').select2({
//     ajax: {
//         url: 'https://api.github.com/search/repositories',
//         dataType: 'json',
//         data:
//         // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
//     }
// });


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




function updateSymbol(e){
    var selected = $(".currency-selector option:selected");
    $(".currency-symbol").text(selected.data("symbol"))
    $(".currency-amount").prop("placeholder", selected.data("placeholder"))
    $('.currency-addon-fixed').text(selected.text())
}

$(".currency-selector").on("change", updateSymbol)

updateSymbol()
$(document).ready(function(e) {
    $(".showonhover").click(function(){
        $("#selectfile").trigger('click');
    });
});


var input = document.querySelector('input[type=file]'); // see Example 4

// input.onchange = function () {
//     var file = input.files[0];
//
//     drawOnCanvas(file);   // see Example 6
//     displayAsImage(file); // see Example 7
// };

function drawOnCanvas(file) {
    var reader = new FileReader();

    reader.onload = function (e) {
        var dataURL = e.target.result,
            c = document.querySelector('canvas'), // see Example 4
            // ctx = c.getContext('2d'),
            img = new Image();

        img.onload = function() {
            c.width = img.width;
            c.height = img.height;
            ctx.drawImage(img, 0, 0);
        };

        img.src = dataURL;
    };

    reader.readAsDataURL(file);
}

function displayAsImage(file) {
    var imgURL = URL.createObjectURL(file),
        img = document.createElement('img');

    img.onload = function() {
        URL.revokeObjectURL(imgURL);
    };

    img.src = imgURL;
    document.body.appendChild(img);
}


// upload user img start
$("#upfile1").click(function () {
    $("#file1").trigger('click');
});
$("#cv1").click(function () {
    $("#cv").trigger('click');
});
// $("#upfile3").click(function () {
//     $("#file3").trigger('click');
// });

// upload user img end
// infos start

// function myFunction() {
//     var x = document.getElementById("sec1");
//     var y=document.getElementById("sec2");
//     var z=document.getElementById("sec3");
//     if (x.style.display === "none") {
//         x.style.display = "block";
//         y.style.display = "none";
//         z.style.display = "none";
//     } else {
//         // x.style.display = "none";
//         // y.style.display = "block";
//     }
//
// }


// infos end


// select2

// $('.js-data-example-ajax').select2({
//     ajax: {
//         // url: 'https://api.github.com/search/repositories',
//         dataType: 'json'
//         // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
//     }
// });
// select 2 end


// $('.note_search').select2({
//     ajax: {
//         delay: 800,
//         url: base_url + 'notes/sell',
//         type: "POST",
//         dataType: 'json',
//         data: function (params) {
//             return {
//                 s: params.term,
//                 page: params.page || 1,
//             };
//         },
//         processResults: function (data) {
//             var results = [];
//             $.each(data, function (id, text) {
//                 results.push({
//                     "id": id,
//                     "text": text,
//                 });
//             });
//             return {
//                 results: results,
//                 pagination: {
//                     "more": results.length < 5 ? false : true,
//                 }
//             };
//         },
//     }
// })


// $(document).on("click","#whishlist_btn",function () {
//     alert('da');
// })
















// $(document).on("click","#whishlist_btn",function () {
    // alert($(this).attr("data-id"));
    // var url=$(this).attr("data-url");

    // var id =$(this).attr("data-id");
    // $.post(url, {'id': id}, function(result){
        // $("span").html(result);
    // });
// })
// whislist end
