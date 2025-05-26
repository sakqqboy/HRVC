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
        if ($("#file1").length > 0) {
            $("#file2").css("display", "none");
            $("#file" + index).show();
            $("#file" + index).document.querySelector("label[for=name]");

        } else {
            alert("Employee resume did't upload yet.");
        }
    } else {
        if ($("#file2").length > 0) {
            $("#file1").css("display", "none");
            $("#file" + index).show();
        } else {
            alert("Employee agreement did't upload yet.");
        }
    }

}
function filterEmployee() {
    var companyId = $("#company-team").val();
    var branchId = $("#branch-team").val();
    var departmentId = $("#department-team").val();
    var teamId = $("#team-department").val();
    var status = $("#status").val();
    var url = $url + 'setting/employee/filter-employee';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId, branchId: branchId, departmentId: departmentId, teamId: teamId, status: status },
        success: function (data) {


        }
    });

}
function employeeType(status) {
    $("#status").val(status);
    $("#btn-" + 0).addClass('btn-curr');
    $("#btn-" + 1).addClass('btn-curr');
    $("#btn-" + 2).addClass('btn-curr');
    $("#btn-" + status).removeClass('btn-curr');
}
function showAction(employeeId) {
    var showingId = $("#show-action").val();
    $("#employee-action-" + employeeId).show();
    if (showingId != '') {
        $("#employee-action-" + showingId).hide();

    }
    $("#show-action").val(employeeId);
    if (showingId == employeeId) {
        $("#show-action").val('');
    }


}
function deleteEmployee(employeeId) {
    if (confirm('Are you sure to delete this employee')) {
        var url = $url + 'setting/employee/delete-employee';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { employeeId: employeeId },
            success: function (data) {
                if (data.status) {
                    $("#employee-" + employeeId).hide();
                }
            }
        });
    }
}
function checkUploadFile(type) {
    if (type == 1) {
        if ($("#resume").length > 0) {
            $("#hasResume").val(1);
            $("#resume-check").show()
        } else {
            $("#hasResume").val('');
            $("#resume-check").hide()
        }
    }
    if (type == 2) {
        if ($("#agreement").length > 0) {
            $("#hasAgreement").val(1);
            $("#agreement-check").show()
        } else {
            $("#hasAgreement").val('');
            $("#agreement-check").hide()
        }
    }
}

function changeStatus() {
    var pimStatus = $("#pim-status").val();
    $("#pim-status").removeClass('select-create-status');
    $("#pim-status").removeClass('select-complete-status');
    if (pimStatus == 1) {
        $("#pim-status").addClass('select-create-status');
    }
    if (pimStatus == 2) {
        $("#pim-status").addClass('select-complete-status');
    }
}