var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;

function branchCompany() {
    var companyId = $("#company-team").val();
    var url = $url + 'setting/team/company-branch';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId },
        success: function (data) {
            $("#branch-team").removeAttr("disabled", "true");
            $("#branch-team").html(data.textSelect);
        }
    });
}
function branchCompany2() {
    var companyId = $("#company-team2").val();
    var url = $url + 'setting/team/company-branch';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId },
        success: function (data) {
            $("#branch-team2").removeAttr("disabled", "true");
            $("#branch-team2").html(data.textSelect);
        }
    });
}

function departmentBranch() {
    var branchId = $("#branch-team").val();
    var url = $url + 'setting/team/branch-department';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { branchId: branchId },
        success: function (data) {
            $("#department-team").removeAttr("disabled", "true");
            $("#department-team").html(data.textSelect);
        }
    });
}

function teamDepartment() {
    var departmentId = $("#department-team").val();
    var url = $url + 'setting/team/department-team';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { departmentId: departmentId },
        success: function (data) {
            $("#team-department").removeAttr("disabled", "true");
            $("#team-department").html(data.textSelect);
            $("#title-department").removeAttr("disabled", "true");
            $("#title-department").html(data.textSelectTitle);
        }
    });
}

function branchCompanyFilter() {
    var companyId = $("#company-team-filter").val();
    var url = $url + 'setting/team/company-branch';
    $("#department-team-filter").attr("disabled", "true");
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId },
        success: function (data) {
            $("#branch-team-filter").removeAttr("disabled", "true");
            $("#branch-team-filter").html(data.textSelect);
        }
    });
}

function departmentBranchFilter() {
    var branchId = $("#branch-team-filter").val();
    var url = $url + 'setting/team/branch-department';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { branchId: branchId },
        success: function (data) {
            $("#department-team-filter").removeAttr("disabled", "true");
            $("#department-team-filter").html(data.textSelect);
        }
    });
}

function teamDepartmentFilter() {
    var departmentId = $("#department-team-filter").val();
    var url = $url + 'setting/team/department-team';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { departmentId: departmentId },
        success: function (data) {
            $("#team-department-filter").removeAttr("disabled", "true");
            $("#team-department-filter").html(data.textSelect);
        }
    });
}

function saveCreateTeam() {
    var branchId = $("#branch-team").val();
    var companyId = $("#company-team").val();
    var departmentId = $("#department-team").val();
    var teamName = $("#teamName").val();
    var fag = 1;
    var textError = '';
    if (companyId == '') {
        fag = 0;
        textError = 'Please select Company';
    } else if (branchId == '') {
        fag = 0;
        textError = 'Please select Branch';
    } else if (departmentId == '') {
        fag = 0;
        textError = 'Please select Department';
    } else if ($.trim(teamName) == '') {
        fag = 0;
        textError = 'Team name can not be null';
    }
    if (fag = 0) {
        alert(textError);
    } else {
        var url = $url + 'setting/team/save-create-team';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { departmentId: departmentId, teamName: teamName },
            success: function (data) {
                if (data.status) {

                    $("#company-team").val('');
                    $("#branch-team").val('');
                    $("#branch-team").attr("disabled", "true");
                    $("#department-team").val('');
                    $("#department-team").attr("disabled", "true");
                    $("#teamName").val('');
                    $("#show-team").prepend(data.textNewTeam);
                } else {
                    alert('Can not create dupplicate team name in the same department.');
                }
            }
        });
    }
}

function updateTeam(teamId) {
    var url = $url + 'setting/team/update-team';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { teamId: teamId },
        success: function (data) {
            $("#create-team").css("display", "none");
            $("#update-team").show();
            $("#reset-team").show();
            $("#teamId").val(teamId);
            $("#teamName").val(data.teamName);
            $("#company-team").html(data.textAllCompany);
            $("#branch-team").removeAttr("disabled", "true");
            $("#branch-team").html(data.textAllBranch);
            $("#department-team").removeAttr("disabled", "true");
            $("#department-team").html(data.textAllDepartment);
        }
    });
}

$("#update-team").click(function (e) {
    var branchId = $("#branch-team").val();
    var companyId = $("#company-team").val();
    var teamId = $("#teamId").val();
    var departmentId = $("#department-team").val();
    var teamName = $("#teamName").val();
    var fag = 1;
    var textError = '';
    if (companyId == '') {
        fag = 0;
        textError = 'Please select Company';
    } else if (branchId == '') {
        fag = 0;
        textError = 'Please select Branch';
    } else if (departmentId == '') {
        fag = 0;
        textError = 'Please select Department';
    } else if ($.trim(teamName) == '') {
        fag = 0;
        textError = 'Team name can not be null';
    }
    if (fag = 0) {
        alert(textError);
    } else {
        var url = $url + 'setting/team/save-update-team';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { departmentId: departmentId, teamName: teamName, teamId: teamId },
            success: function (data) {
                if (data.status) {
                    $("#company-team").val('');
                    $("#branch-team").val('');
                    $("#branch-team").attr("disabled", "true");
                    $("#department-team").val('');
                    $("#department-team").attr("disabled", "true");
                    $("#teamName").val('');
                    $("#team-" + teamId).html(data.textUpdateTeam);
                } else {
                    alert('Can not create dupplicate team name in the same department.');
                }
            }
        });
    }
});
$("#reset-team").click(function (e) {
    $("#company-team").val('');
    $("#teamId").val('');
    $("#branch-team").val('');
    $("#teamName").val('');
    $("#branch-team").attr("disabled", "true");
    $("#department-team").val('');
    $("#department-team").attr("disabled", "true");
    $("#update-team").css("display", "none");
    $("#reset-team").css("display", "none");
    $("#create-team").show();
});

function deleteTeam(teamId) {
    if (confirm("Are you sure to delete this Team")) {
        var url = $url + 'setting/team/delete-team';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { teamId: teamId },
            success: function (data) {
                if (data.status) {
                    $("#team-" + teamId).hide(200);
                } else {
                    alert("Can not delete this team.");
                }

            }
        });
    }
}
function filterTeam() {
    var companyId = $("#company-team-filter").val();
    var branchId = $("#branch-team-filter").val();
    var departmentId = $("#department-team-filter").val();
    var url = $url + 'setting/team/filter-team';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId, branchId: branchId, departmentId: departmentId },
        success: function (data) {


        }
    });
}

function addTeamInput() {
    // alert('Button clicked!');
    const container = document.getElementById('teamInputsContainer');

    const newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.name = 'teamName[]';
    newInput.className = 'form-control mb-2';
    newInput.style.width = '330px';
    newInput.placeholder = 'Write the name of the Team ';

    container.appendChild(newInput);
}