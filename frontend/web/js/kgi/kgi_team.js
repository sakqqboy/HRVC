var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function updateTeamKgi(kgiTeamId) {
    var url = $url + 'kgi/kgi-team/prepare-update';
    $("#kgiTeamId").val(kgiTeamId);
    resetUnit();
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kgiTeamId: kgiTeamId },
        success: function (data) {
            $("#kgi-name").html(data.kgiTeam.kgiName);
            $("#team-name").html(data.kgiTeam.teamName);
            $("#kgi-detail").html(data.kgiTeam.kgiDetail);
            $("#kgi-remark").html(data.kgiTeam.remark);
            $("#quant-ratio").html(data.kgiTeam.quantRatio);
            $("#priority").html(data.kgiTeam.priority);
            $("#amount-type").html(data.kgiTeam.amountType);
            $("#code").html(data.kgiTeam.codeText);
            $(".currentUnit").val(data.kgiTeam.unitId);
            $(".previousUnit").val(data.kgiTeam.unitId);
            $(".unit-" + parseInt(data.kgiTeam.unitId)).css("background-color", "#3366FF");
            $(".unit-" + parseInt(data.kgiTeam.unitId)).css("color", "white");
            $("#status-update").val(data.kgiTeam.status);
            $("#month-update").val(data.kgiTeam.month);
            $("#year-update").val(data.kgiTeam.year);
            $("#target-amount").val(data.kgiTeam.target);
            $("#result").val(data.kgiTeam.result);
            $("#from-date-update").val(data.kgiTeam.fromDate);
            $("#to-date-update").val(data.kgiTeam.toDate);
            $("#nextCheckDate-update").val(data.kgiTeam.nextCheckDate);
        }
    });
}
function kgiTeamHistory(kgiTeamId) {
    var url = $url + 'kgi/kgi-team/kgi-team-view';
    resetUnit();
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kgiTeamId: kgiTeamId },
        success: function (data) {
            $("#next-date-view").html(data.kgiTeam.nextCheckDateText);
            $("#kgi-name-view").html(data.kgiTeam.kgiName);
            $("#prirority-view").html(data.kgiTeam.priority);
            $("#quantRatio-view").html(data.kgiTeam.quantRatio);
            $("#unit-view").html(data.kgiTeam.unit);
            $("#target-view").html(data.kgiTeam.target);
            $("#result-view").html(data.kgiTeam.result);
            $("#percentRatio").css("width", data.kgiTeam.ratio + '%');
            $("#ratio-view").html(data.kgiTeam.ratio);
            $("#code-view").html(data.kgiTeam.code);
            $("#decription-view").html(data.kgiTeam.kgiDetail);
            $("#kgi-history").html(data.history);
        }
    });
}
function kgiTeamHistory2(teamId, kgiId) {
    //
    var url = $url + 'kgi/kgi-team/kgi-team-view2';
    resetUnit();
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { teamId: teamId, kgiId: kgiId },
        success: function (data) {
            if (data.status) {
                //        alert(data.status);
                $("#next-date-team").html(data.kgiTeam.nextCheckDateText);
                $("#kgi-name-team").html(data.kgiTeam.kgiName);
                $("#team-name").html(data.kgiTeam.teamName);
                $("#prirority-team").html(data.kgiTeam.priority);
                $("#quantRatio-team").html(data.kgiTeam.quantRatio);
                $("#unit-team").html(data.kgiTeam.unit);
                $("#target-team").html(data.kgiTeam.target);
                $("#result-team").html(data.kgiTeam.result);
                $("#percentRatio-team").css("width", data.kgiTeam.ratio + '%');
                $("#ratio-team").html(data.kgiTeam.ratio);
                $("#code-team").html(data.kgiTeam.code);
                $("#decription-team").html(data.kgiTeam.kgiDetail);
                $("#kgi-history-team").html(data.history);
                $("#kgi-view-team").modal('show');
            } else {

            }

        }
    });
}
function resetUnit() {
    $(".unit-1").css("color", "black");
    $(".unit-1").css("background-color", "white");
    $(".unit-2").css("color", "black");
    $(".unit-2").css("background-color", "white");
    $(".unit-3").css("color", "black");
    $(".unit-3").css("background-color", "white");
    $(".unit-4").css("color", "black");
    $(".unit-4").css("background-color", "white");
    $(".currentUnit").val('');
    $(".previousUnit").val('');
}
function kgiFilterForTeam() {
    var companyId = $("#company-filter").val();
    var branchId = $("#branch-filter").val();
    var teamId = $("#team-filter").val();
    var month = $("#month-filter").val();
    var status = $("#status-filter").val();
    var year = $("#year-filter").val();
    var type = $("#type").val();
    var url = $url + 'kgi/kgi-team/search-kgi-team';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId, branchId: branchId, teamId: teamId, month: month, status: status, year: year, type: type },
        success: function (data) {

        }
    });
}
function prepareDeleteKgiTeam(kgiTeamId) {
    $("#kgiTeamId-modal").val(kgiTeamId);
}
function deleteKgiTeam() {
    var kgiTeamId = $("#kgiTeamId-modal").val();
    var url = $url + 'kgi/kgi-team/delete-kgi-team';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kgiTeamId: kgiTeamId },
        success: function (data) {
            if (data.status) {
                $("#delete-kgi-team").modal("hide");
                $("#kgi-team-" + kgiTeamId).hide();
            }
        }
    });
}
function assignKgiTeam(kgiId) {
    $("#kgiId-team").val(kgiId);
    var url = $url + 'kgi/kgi-team/assign-kgi-team';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kgiId: kgiId },
        success: function (data) {
            $("#teamInDepartment").html(data.textTeam);
            $("#department-search-team").html(data.textDepartment);
        }
    });
}
function searchKgiTeam() {
    var departmentId = $("#department-search-team").val();
    var teamName = $("#search-team-name").val();
    var kgiId = $("#kgiId-team").val();
    var url = $url + 'kgi/kgi-team/search-team';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { departmentId: departmentId, teamName: teamName, kgiId: kgiId },
        success: function (data) {
            $("#teamInDepartment").html(data.textTeam);
        }
    });
}
function checkKgiTeam(teamId, kgiId) {
    var url = $url + 'kgi/kgi-team/kgi-assign-team';
    var checked = 0;
    if ($("#kgi-team-" + teamId + '-' + kgiId).prop("checked") == true) {
        checked = 1;
    }
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kgiId: kgiId, teamId: teamId, checked: checked },
        success: function (data) {
            if (data.status) {
                // $("#totalEmployee-" + kgiId).html(data.totalEmployee);
                $("#totalTeam-" + kgiId).html(data.countTeam);
            }
        }
    });
}
function checkAllKgiTeam(kgiId) {
    var url = $url + 'kgi/kgi-team/check-all-kgi-team';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        //data: { kgiId: kgiId },
        success: function (data) {
            if ($("#all-kgi-team-" + kgiId).prop("checked") == true) {
                $.each(data.team, function (key, value) {
                    if ($("#kgi-team-" + value + '-' + kgiId).prop("checked") == false) {
                        $("#kgi-team-" + value + '-' + kgiId).prop("checked", true);
                        checkKgiTeam(value, kgiId);
                    }
                });
            } else {

                $.each(data.team, function (key, value) {
                    if ($("#kgi-team-" + value + '-' + kgiId).prop("checked") == true) {
                        $("#kgi-team-" + value + '-' + kgiId).prop("checked", false);
                        checkKgiTeam(value, kgiId);
                    }
                });
            }
        }
    });
}