var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
$("#create-branch").click(function(e) {
    var url = $url + 'setting/branch/save-create-branch';
    var branchName = $("#branchName").val();
    var companyId = $("#company").val();
    var description = $("#description").val();
    if ($.trim(branchName) == '') {
        alert("Branch name can not be null");
    } else if (companyId == '') {
        alert('Please select company');
    } else {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { branchName: branchName, companyId: companyId, description: description },
            success: function(data) {
                if (data.status) {
                    $("#branchName").val('');
                    $("#description").val('');
                    $("#company-branch").prepend(data.newBranch);
                } else {
                    alert("Can't create duplicate branch name.");
                }

            }
        });
    }
});

function deleteBranch(branchId) {
    if (confirm("Are you sure to delete this branch")) {
        var url = $url + 'setting/branch/delete-branch';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { branchId: branchId },
            success: function(data) {
                if (data.status) {
                    $("#branch-" + branchId).hide(200);
                } else {
                    alert("Can not delete this branch.");
                }

            }
        });
    }
}

function updateBranch(branchId) {
    var url = $url + 'setting/branch/update-branch';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { branchId: branchId },
        success: function(data) {
            $("#create-branch").css("display", "none");
            $("#update-branch").show();
            $("#reset-branch").show();
            $("#branchId").val(branchId);
            $("#branchName").val(data.branchName);
            $("#description").val(data.description);
            $("#company").val(data.companyId);
        }
    });
}
$("#update-branch").click(function(e) {
    var url = $url + 'setting/branch/save-update-branch';
    var branchName = $("#branchName").val();
    var branchId = $("#branchId").val();
    var companyId = $("#company").val();
    var description = $("#description").val();
    if ($.trim(branchName) == '') {
        alert("Branch name can not be null");
    } else {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { branchName: branchName, branchId: branchId, description: description, companyId: companyId },
            success: function(data) {
                if (data.status) {
                    $("#branchId").val('');
                    $("#branchName").val('');
                    $("#description").val('');
                    $("#update-branch").css("display", "none");
                    $("#reset-branch").css("display", "none");
                    $("#create-branch").show();
                    $("#branch-" + branchId).html('');
                    $("#branch-" + branchId).html(data.updateBranch);
                } else {
                    alert("Can't create duplicate branch name.");
                }
            }
        });
    }
});
$("#reset-branch").click(function(e) {
    $("#branchId").val('');
    $("#branchName").val('');
    $("#description").val('');
    $("#update-branch").css("display", "none");
    $("#reset-branch").css("display", "none");
    $("#create-branch").show();
});

function filterBranchCompany() {
    var companyId = $("#filter-branch").val();
    var url = $url + 'setting/branch/search-branch';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId },
        success: function(data) {

        }
    });
}