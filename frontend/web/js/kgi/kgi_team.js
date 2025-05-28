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
function viewTabTeamKgi(kgiTeamHistoryId, tabId, kgiId, kgiTeamId) {
    var currentTabId = $("#currentTab").val();
    var kgiId = $("#kgiId").val();
    $("#tab-" + currentTabId).removeClass("view-tab-active");
    $("#tab-" + currentTabId).addClass("view-tab");
    $("#tab-" + tabId).removeClass("view-tab");
    $("#tab-" + tabId).addClass("view-tab-active");
    $("#tab-" + currentTabId + "-blue").hide();
    $("#tab-" + currentTabId + "-black").show();
    $("#tab-" + tabId + "-blue").show();
    $("#tab-" + tabId + "-black").hide();
    $("#currentTab").val(tabId);
    if (tabId == 1) {
        var url = $url + 'kgi/kgi-team/kgi-team-employee';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { kgiId: kgiId, kgiTeamHistoryId: kgiTeamHistoryId,kgiTeamId:kgiTeamId },
            success: function (data) {
                $("#show-content").html(data.kgiEmployeeTeam);
                if (viewType == 'list') {
                    $('#man-check').css("display", 'none');
                    $('#all').show();
                    $('#employee-all').show();
                    $('#kgi-employee').css("display", 'none');
                    $("#viewType").val('list');
                }
            }
        });
    }
    if (tabId == 2) {
        var url = $url + 'kgi/kgi-team/all-kgi-history';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { kgiTeamId: kgiTeamId, kgiTeamHistoryId: kgiTeamHistoryId },
            success: function (data) {
                $("#show-content").html(data.monthlyDetailHistoryText);
            }
        });
    }
    if (tabId == 3) {
        var url = $url + 'kgi/view/kgi-issue';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { kgiId: kgiId },
            success: function (data) {
                $("#show-content").html(data.kgiIssue);
            }
        });
    }
    if (tabId == 4) {
        var url = $url + 'kgi/kgi-team/kgi-team-chart';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { kgiTeamId: kgiTeamId, kgiTeamHistoryId: kgiTeamHistoryId, kgiId: kgiId },
            success: function (data) {
                $("#show-content").html(data.kgiChart);
            }
        });
    }
    if (tabId == 5) {
        var url = $url + 'kgi/view/kgi-kpi';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { kgiId: kgiId },
            success: function (data) {
                $("#show-content").html(data.kpi);
            }
        });
    }
}
function autoUpdateResultTeam(kgiTeamId) {
	if ($("#historic-checkbox-kgi-team").prop("checked") == true) {
			$("#override-checkbox-kgi-team").prop("checked", false);
			
			var url = $url + 'kgi/kgi-team/auto-result';
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: url,
				data: { kgiTeamId: kgiTeamId },
				success: function (data) {
					$("#result-update").val(data.result);
					$("#auto-result").val(data.result);
				}
			});
			$("#result-update").prop("disabled", true);
	} else { 
		$("#override-checkbox-kgi-team").prop("checked", true);
		$("#result-update").val($("#previous-result").val());
		$("#result-update").prop("disabled", false);
	}
}
function overrideUpdateTeam() { 
	if ($("#override-checkbox-kgi-team").prop("checked") == true) {
		$("#historic-checkbox-kgi-team").prop("checked", false);
		$("#result-update").prop("disabled", false);
		$("#result-update").val($("#previous-result").val());
	} else { 
		$("#historic-checkbox-kgi-team").prop("checked", true).trigger('change');
	}
}
function validateFormKgiTeam() {
    var fromDate = document.getElementById('fromDate').value.trim();
    var toDate = document.getElementById('toDate').value.trim();
    var nextDate = $('#nextDate').val();
    if (!fromDate && !toDate) {
        alert("Please fill in Due Term");
        return false;
    } else if (!fromDate) {
        alert("Please fill in Start Date");
        return false;
    } else if (!toDate) {
        alert("Please fill in End Date");
        return false;
    } else if (nextDate == '') {
        alert("Please fill in Target Due Update Date");
        return false;
    } else if ($('#check1').prop('checked') == false && $('#check2').prop('checked') == false) {
        alert("Please check the status");
        return false;
    } else {
        return true;
    }
}


function kgiTeamHistoryView(kgiId, teamId) { 
    var viewType = $("#viewType").val();
    //alert(viewType);
var url = $url + 'kgi/view/kgi-team-history-view';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { teamId: teamId, kgiId: kgiId,viewType:viewType },
        success: function (data) {
            if (data.status) {
                $("#all").css('display', 'none');
                $("#all").html('');
                $("#employee-all").css('display', 'none');
                $("#employee-all").html('');
                $("#man-check").show();
                $("#kgi-employee").show();
                $("#man-check").html(data.history);
            }

        }
    });
}