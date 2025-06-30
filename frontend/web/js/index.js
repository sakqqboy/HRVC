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
