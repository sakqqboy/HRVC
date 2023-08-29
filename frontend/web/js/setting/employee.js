function showEmployeeView(content) {
    var old = $("#currentShow").val();
    $("#link" + content).css("font-weight", "bold");
    if (old != content) {
        $("#link" + old).css("font-weight", "400");
        $("#show" + old).css("display", "none");
        $("#currentShow").val(content);
        $("#show" + content).fadeIn();
    }
}

function showFile(index) {
    if (index == 1) {
        $("#file2").css("display", "none");
    } else {
        $("#file1").css("display", "none");
    }
    $("#file" + index).show();
}