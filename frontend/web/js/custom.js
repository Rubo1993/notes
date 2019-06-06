jQuery(function () {
    jQuery('#showall').click(function () {
        jQuery('.targetDiv').show();
    });
    jQuery('.showSingle').click(function () {
        jQuery('.targetDiv').hide();
        jQuery('#div' + $(this).attr('target')).show();
    });
});

$(document).ready(function () {
    $(document).on('click', '.add', (function () {
        $(".clone_this >.cln").clone().appendTo(".append_there");
    }));
    $(document).on('click', ".remove", function () {
        $(this).parent('div').remove();

    });

});

function updateSymbol(e) {
    var selected = $(".currency-selector option:selected");
    $(".currency-symbol").text(selected.data("symbol"))
    $(".currency-amount").prop("placeholder", selected.data("placeholder"))
    $('.currency-addon-fixed').text(selected.text())
}

$(".currency-selector").on("change", updateSymbol)

updateSymbol()
$(document).ready(function (e) {
    $(".showonhover").click(function () {
        $("#selectfile").trigger('click');
    });
});


var input = document.querySelector('input[type=file]'); // see Example 4


function drawOnCanvas(file) {
    var reader = new FileReader();

    reader.onload = function (e) {
        var dataURL = e.target.result,
            c = document.querySelector('canvas'), // see Example 4
            // ctx = c.getContext('2d'),
            img = new Image();

        img.onload = function () {
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

    img.onload = function () {
        URL.revokeObjectURL(imgURL);
    };

    img.src = imgURL;
    document.body.appendChild(img);
}


// upload user img start
// $("#upfile1").click(function () {
//     $("#file1").trigger('click');
// });
// $("#cv1").click(function () {
//     $("#cv").trigger('click');
// });

$(document).on("click", "#add_to_cart", function () {
    var this_bt = $(this);
    var chang = $('#change_txt');
    $btn = $('#add_to_cart');
    $message = $('#cart_message');
    var url = $(this).attr("data-url");
    var id = $(this).attr("data-id");

    $.get(url, {'id': id}, function (result) {
        if (result) {
            if (result == 'product_in_cart') {

                chang.html("Զամբյուղ");
                $('#add_to_cart').attr("href", "/author/cart");
            } else {
                $message.show();
            }
        }
    });
})


$(document).ready(function () {
    $("#review_not").click(function () {
        var url = $(this).attr("data-url");
        var id = $(this).attr("data-id");
        $remove_not = $('#review_note_js');
        $.ajax({
            type: "GET",
            url: url,
            data: {'id': id},
            success: function (data) {
                if (data === 'note selected') {
                    $remove_not.hide();
                } else {
                    alert('error')
                }
            }
        });
    });
});


$(document).ready(function () {
    $("#specializ_submit_btn").click(function () {
        var favorite = [];
        var url = $(this).attr("data-url");

        $("input[name='sport']:checked").each(function () {
            favorite.push($(this).val());
        });
        $.ajax({
            type: "GET",
            url: url,
            dataType: 'json',
            data: {'favorite': JSON.stringify(favorite)},
            success: function (data) {

            },
            // error:function (error) {
            //     // alert('preferenc not save')
            //     alert(error)
            // }
        });
    });
});
// $(document).ready(function () {
//     $("#educat_save").click(function () {
//         var univer = [];
//         var url = $(this).attr("data-url");
//         $("input[name='faculty_id']").each(function () {
//             univer.push($(this).val());
//             alert(univer);
//         });
//         // $.ajax({
//         //     type: "GET",
//         //     url: url,
//         //     dataType: 'json',
//         //     data: {'univer': JSON.stringify(univer)},
//         //     success: function (data) {
//         //
//         //     },
//         //     error:function (error) {
//         //         alert('univer not save')
//         //     }
//         // });
//     });
// });









$(document).on("click", ".whishlist_btn", function () {
    var url = $(this).attr("data-url");
    var this_btn = $(this);
    var id = $(this).attr("data-id");
    $.get(url, {'id': id}, function (result) {
        if (result === "Note in whishlist") {
            this_btn.addClass('liked');
            this_btn.html("Ջնջել")
        } else {
            this_btn.removeClass('liked');
            this_btn.html("Նախընտրելի")
        }
    });
});

$(document).on("click", ".review_not", function () {
        var url = $(this).attr("data-url");
        var id = $(this).attr("data-id");
        var parent = $(this).closest('.review_note_js')
        var remove_not = $('.review_note_js');
        $.ajax({
            type: "GET",
            url: url,
            data: {'id': id},
            success: function (data) {
                if (data === 'note selected') {
                    // remove_not.hide();
                    parent.hide();
                }

            }
        });
});


$(document).ready(function () {
    $(".not_is_ready").click(function () {
        var url = $(this).attr("data-url");
        var this_btn = $(this);
        var id = $(this).attr("data-id");
        $.ajax({
            type: "GET",
            url: url,
            data: {'id': id},
            success: function (data) {
                if (data === 'not is ready') {
                    this_btn.prop('disabled', true);
                    this_btn.html("Նոթը ստուգված է")
                }
            }
        });
    });
});





