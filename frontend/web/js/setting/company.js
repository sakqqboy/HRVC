var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;

function deleteCompany(companyId) {
    if (confirm("Are you sure to delete this company?")) {
        var url = $url + 'setting/company/delete-company';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { companyId: companyId },
            success: function(data) {
                if (data.status) {
                    $("#company-" + companyId).hide(200);
                } else {
                    alert("Can not delete this company.");
                }

            }
        });
    }
}

function companyBranch() {
    var companyId = $("#company").val();
    //alert(companyId);
    var url = $url + 'setting/company/company-branch';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId },
        success: function(data) {
            if (data.status) {
                $("#branch").html(data.branchText);
            }

        }
    });
}