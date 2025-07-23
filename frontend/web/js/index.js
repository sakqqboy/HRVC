function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#old-image").hide();
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function () {
    readURL(this);
});

function readURLBanner(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#old-banner").hide();
            $('#imagePreviewBanner').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreviewBanner').hide();
            $('#imagePreviewBanner').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUploadBanner").change(function () {
    readURLBanner(this);
});

// document.querySelector("#files").onchange = function () {
//     const fileName = this.files[0]?.name;
//     const label = document.querySelector("label[for=name]");
//     label.innerText = fileName ?? "Browse Files";
// };

function showPassword(i) {
    $("#password").removeAttr("type");
}

function setPassword(i) {
    $("#password").attr("type", "password");
}


function showclickno() {
    $("#showlevel").show();
}
function showLoading() { 
    $("#img-loading").addClass('col-12');
    $("#main-body").addClass('d-none');
    $("#img-loading").removeClass('d-none');
}

$(window).on('scroll', function () {
    const box = $('#box-wrapper');
    const offset = box.offset().top;
    const scrollY = $(window).scrollTop();
    var fag = $("#minPage").val();
    var totalPage=$("#totalPage").val();
    if (scrollY >= offset - 70) {
        if (fag == 0) {
            box.addClass('mt-30');
            $("#pim-content").addClass('pt-10');
            $("#main-body").removeClass("pim-content");
            if (totalPage == 0) {
                $("#main-body").addClass("pim-content2");
            } else {
                $("#main-body").addClass("pim-content3");
            }
            $("#minPage").val(1);
        }
    
    } else { 
        if (scrollY < offset - 120) {
            box.removeClass('mt-30');
            $("#pim-content").removeClass('pt-10');
            if (totalPage == 0) {
                $("#main-body").removeClass("pim-content2");
            } else { 
                    $("#main-body").removeClass("pim-content3");
            }
            $("#main-body").addClass("pim-content");
            $("#minPage").val(0);
        }
    } 
        
});
