var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function companyBranchKfi() {
    var companyId = $("#company-create-kfi").val();
    var url = $url + 'kfi/management/company-branch';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId },
        success: function(data) {
            if (data.status) {
                $("#branch-create-kfi").html(data.branchText);
                $("#branch-create-kfi").removeAttr("disabled", "true");
                $("#department-create-kfi").val("");
                $("#department-create-kfi").html('<option value=""> Select Department</option>');
                $("#department-create-kfi").attr("disabled", "true");
            }

        }
    });
}
function companyMultiBrachKfi() { 
	clearEveryShow();
    var acType = $("#acType").val();
    if (acType == "update") {
        var companyId = $("#companyId-update").val();
    } else { 
        var companyId = $("#companyId").val();
    }
    var kfiId = $("#kfiId").val();
	var url = $url + 'kfi/management/company-multi-branch';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { companyId: companyId, acType: acType,kfiId:kfiId },
		success: function(data) {
            if (data.status) {
                if (acType == "update") {
                    $("#show-multi-branch-update").html(data.branchText);
                    
                } else { 
                    $("#show-multi-branch").html(data.branchText);
                }
		    }
		}
	   });
}

function branchDepartmentKfi() { 
    var branchId = $("#branch-create-kfi").val();
    var url = $url + 'kfi/management/branch-department';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { branchId: branchId },
        success: function(data) {
            if (data.status) {
                $("#department-create-kfi").html(data.departmentText);
                $("#department-create-kfi").removeAttr("disabled", "true");
            }

        }
    });
    if (branchId == 'all') { 
        $("#department-create-kfi").removeAttr("disabled", "true");
        $("#department-create-kfi").html('<option value="all"> All</option>');
    }
}
function selectUnit(currentUnit) {
    var previous = $("#currentUnit").val();
    if (previous != '') {
        $("#previousUnit").val(previous);
        $("#unit-" + previous).css("background-color", "white");
        $("#unit-" + previous).css("color", "black");
    }

    $("#currentUnit").val(currentUnit);
    $("#unit-" + currentUnit).css("background-color", "#3366FF");
    $("#unit-" + currentUnit).css("color", "white");

}
function selectUnitUpdate(currentUnit) {
    var previous = $(".currentUnit").val();
    if (previous != '') {
        $(".previousUnit").val(previous);
        $(".unit-" + previous).css("background-color", "white");
        $(".unit-" + previous).css("color", "black");
    }
    $(".currentUnit").val(currentUnit);
    $(".unit-" + currentUnit).css("background-color", "#3366FF");
    $(".unit-" + currentUnit).css("color", "white");
}
function updateKfi(kfiId) {
    $("#acType").val('update');
    resetUnit();
    $("#staticBackdrop2").show();
    $("#update-kfi")[0].reset();
    var url = $url + 'kfi/management/update-kfi';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kfiId: kfiId },
        success: function (data) {
            $("#kfiName").val(data.kfiName);
            $("#companyId-update").val(data.companyId);
            $(".currentUnit").val(data.unitId);
            $(".previousUnit").val(data.unitId);
            $("#show-multi-branch-update").html(data.textBranch);
            $("#show-multi-department-update").html(data.textDepartment);
            $(".unit-" + parseInt(data.unitId)).css("background-color", "#3366FF");
            $(".unit-" + data.unitId).css("color", "white");
            $("#periodDate-update").val(data.periodCheck);
			$("#nextCheckDate-update").val(data.nextCheckDate);
            $("#targetAmount").val(data.targetAmount);
            $("#kfiDetail").val(data.detail);
            $("#quantRatio").val(data.quantRatio);
            $("#monthName").val(data.month);
            $("#year").val(data.year);
            $("#amountType").val(data.amountType);
            $("#code").val(data.code);
            $("#kfiStatus").val(data.kfiStatus);
            $("#kfiId").val(kfiId);
        }
    });
}
function branchMultiDepartmentUpdateKfi() {
	var multiBranch = [];
	var sumBranch = totalBranchUpdate();
	var i = 0;
		$("#multi-check-update:checked").each(function () {
			multiBranch[i] = $(this).val();
			i++;
		});
	if (sumBranch != multiBranch.length) {
		$("#check-all-branch-update").prop("checked", false);
	} else { 
		$("#check-all-branch-update").prop("checked", true);
	}
	var url = $url + 'kfi/management/branch-multi-department';
	var acType = $("#acType").val();
	var kfiId=$("#kfiId").val();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { multiBranch: multiBranch, acType: acType,kfiId:kfiId },
		success: function (data) {
			if (data.status) {
				$("#show-multi-department-update").html(data.textDepartment);
			} else {
				$("#show-multi-department-update").html('');
			}
		}
	});
}
function totalBranchUpdate() { 
	var totalBranch = 0;
	var data = [];
	var i = 0;
	$('input[id="multi-check-update"]').each(function () {
		data[i] = $(this).val();
		i++;
	});
	totalBranch=data.length;
	return totalBranch;
}
function departmentMultiTeamUpdateKfi(branchId) { 
	var sumDepartment = totalDepartmentUpdate(branchId);
	var multiDepartmentBranch = [];
	var multiDepartment = [];
	var multiBranch = [];
	var i = 0;
		$("#multi-check-"+branchId+"-update:checked").each(function () {
			multiDepartmentBranch[i] = $(this).val();
			i++;
		});
		$("#multi-check-update:checked").each(function () {
			multiBranch[i] = $(this).val();
			i++;
		});
		$(".multi-check-department-update:checked").each(function () {
			multiDepartment[i] = $(this).val();
			i++;
		});
	if (sumDepartment != multiDepartmentBranch.length) {
		$("#multi-check-all-" + branchId+"-update").prop("checked", false);
	} else { 
		$("#multi-check-all-" + branchId+"-update").prop("checked", true);
	}

}
function totalDepartmentUpdate(branchId) {
	var totalDepartment = 0;
	var data = [];
	var i = 0;
	$('input[id="multi-check-' + branchId + '-update"]').each(function () {
		data[i] = $(this).val();
		i++;
	});
	totalDepartment = data.length;
	return totalDepartment;
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

function kfiHistory(kfiId) {

    var url = $url + 'kfi/management/history';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kfiId: kfiId },
        success: function(data) {
            if (data.status) {

                $("#kfiNameHistory").html(data.kfi.kfiName);
                // alert(data.kfi.status);
                if (data.kfi.status == 1) {
                    $("#statusHistory").html('Inprocess');
                    $("#statusHistory").removeClass("bg-warning");
                    $("#statusHistory").removeClass("text-dark");
                    $("#statusHistory").addClass("bg-success");
                } else {
                    $("#statusHistory").html('complete');
                    $("#statusHistory").removeClass("bg-success");
                    $("#statusHistory").removeClass("text-dark");
                    $("#statusHistory").addClass("bg-warning");
                    $("#statusHistory").addClass("text-dark");
                }
                $("#companyHistory").html(data.kfi.companyName);
                $("#branchHistory").html(data.kfi.branchName);
                let month = data.kfi.monthName.substring(0, 3);
                $("#monthHistory").html(month);
                if (data.kfi.quanRatio == 1) {
                    $("#quanRatioHistory").html('Quantuty');
                } else {
                    $("#quanRatioHistory").html('Quality');
                }
                $("#targetHistory").html(data.kfi.targetAmount);
                $("#codeHistory").html(data.kfi.code);
                $("#resultHistory").html(data.kfi.result);
                $("#progressHistory").css("width", data.kfi.ratio + '%');
                $("#decimalHistory").html(data.kfi.ratio);
                $("#detailHistory").html(data.kfi.detail);
                $("#deadlineHistory").html(data.kfi.checkDate);
                $("#NextCheckDateHistory").html(data.kfi.nextCheck);
                $("#unitHistory").html(data.kfi.unit);
                $("#countryHistory").html(data.kfi.countryName);
                $("#showHistory").html(data.history);
            }

        }
    });
    $("#staticBackdrop3").show();
}

function prepareDeleteKfi(kfiId) {
    $("#kfiId-modal").val(kfiId);
}

function deleteKfi() {
    var url = $url + 'kfi/management/delete-kfi';
    var kfiId = $("#kfiId-modal").val();
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kfiId: kfiId },
        success: function(data) {
            if (data.status) {
                $("#staticBackdrop4").modal("hide");
                $("#kfi-" + kfiId).hide();

            }
        }
    });
}
$("#pills-Issues-tab-kfi").click(function () {
    $("#pills-Issues-tab-kfi").addClass("text-primary");
    $("#pills-History-tab-kfi").removeClass("text-primary");
    $("#pills-History").removeClass("active");
    $("#pills-Issues-tab-kfi").css("border-bottom", "5px #0d6efd solid");
    $("#pills-History-tab-kfi").removeAttr("style");
});
$("#pills-History-tab-kfi").click(function () {
    $("#pills-History-tab-kfi").addClass("text-primary");
    $("#pills-Issues-tab-kfi").removeClass("text-primary");
    $("#pills-Issues").removeClass("active");
    $("#pills-History-tab-kfi").attr("style");
    $("#pills-History-tab-kfi").css("border-bottom", "5px #0d6efd solid");
    $("#pills-Issues-tab-kfi").removeAttr("style");
});
function showKfiComment(kfiId) { 
    var url = $url + 'kfi/management/show-comment';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kfiId: kfiId },
        success: function(data) {
            if (data.status) {
                $("#kfi-name-issue").html(data.kfi.kfiName);
                $("#pills-Issues").html(data.issueText);
                $("#pills-History").html(data.historyText);
                $("#company-issue").html(data.kfi.companyName);
                $("#branch-issue").html(data.kfi.branchName);
                $("#country-issue").html(data.kfi.countryName);
                $("#flag-issue").attr('src',$url+data.kfi.flag);
            }
        }
    });
}
function answerKfiIssue(kfiIssueId) { 
    var answer = $("#answer-" + kfiIssueId).val();
    var fd = new FormData();
    var files = $("#attachKfiFileAnswer-"+kfiIssueId)[0].files;
    if (files.length > 0) {
        fd.append('file', files[0]);

    }
    fd.append('answer', answer);
    fd.append('kfiIssueId', kfiIssueId);
    var url = $url + 'kfi/management/save-kfi-answer';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: fd,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status) { 
                $("#solution-" + kfiIssueId).append(data.commentText);
                $("#answer-" + kfiIssueId).val('');
            }
        }
    });
}
function showSelectFileName(kfiIssueId) {
    var message = "Attached : "+$("#attachKfiFileAnswer-" + kfiIssueId).val();
    $("#fileName-" + kfiIssueId).html(message);
}
function showAttachFileName(kfiId) { 
    var message = "Attached : " + $("#attachKfiFile").val();
    $("#attachFile-" + kfiId).html(message);
}
function kfiFilter() {
    var companyId = $("#company-filter").val();
    var branchId = $("#branch-filter").val();
    var year = $("#year-filter").val();
    var month = $("#month-filter").val();
    var status = $("#status-filter").val();
    var type = $("#type").val();
    var url = $url + 'kfi/management/search-kfi';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId, branchId: branchId, month: month, status: status, year: year, type: type },
        success: function (data) {
			
        }
    });
}
function changeAcType(type) { 
    if (type == 1) {
        $("#acType").val("create");
    } else { 
        $("#acType").val("update");
    }
}