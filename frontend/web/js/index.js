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


function w3_close() {
    $("main").removeClass("col-lg-12");
    $("main").addClass("col-lg-10");
}

function w3_open() {
    $("mySidebar").removeClass("col-lg-10");
    $("mySidebar").css("display", "none");

}

const imgDiv = document.querySelector('.profile-pic-div');
const img = document.querySelector('#photo');
const file = document.querySelector('#file');
const uploadBtn = document.querySelector('#uploadBtn');


imgDiv.addEventListener('mouseenter', function () {
    uploadBtn.style.display = "block";
});


imgDiv.addEventListener('mouseleave', function () {
    uploadBtn.style.display = "none";
});

file.addEventListener('change', function () {

    const choosedFile = this.files[0];

    if (choosedFile) {

        const reader = new FileReader();

        reader.addEventListener('load', function () {
            img.setAttribute('src', reader.result);
        });

        reader.readAsDataURL(choosedFile);

    }
});

document.querySelector("#files").onchange = function () {
    const fileName = this.files[0]?.name;
    const label = document.querySelector("label[for=name]");
    label.innerText = fileName ?? "Browse Files";
};

