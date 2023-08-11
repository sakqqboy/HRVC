function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});

function readURLBanner(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreviewBanner').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreviewBanner').hide();
            $('#imagePreviewBanner').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUploadBanner").change(function() {
    readURLBanner(this);
});