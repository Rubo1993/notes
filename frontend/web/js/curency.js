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

input.onchange = function () {
    var file = input.files[0];

    drawOnCanvas(file);   // see Example 6
    displayAsImage(file); // see Example 7
};

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