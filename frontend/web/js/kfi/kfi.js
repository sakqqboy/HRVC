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
        success: function (data) {
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
    var companyId = acType === "update" ? $("#companyId-update").val() : $("#companyId").val();
    var kfiId = $("#kfiId").val();
    var url = $url + 'kfi/management/company-multi-branch';

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId, acType: acType, kfiId: kfiId },
        success: function (data) {
            if (data.status) {
                // เติมข้อมูล branch ลงใน div ที่เหมาะสม
                // alert(data.branchText)
                if (acType === "update") {
                    $("#show-multi-branch-update").html(data.branchText);
                    $("#show-multi-branch-update").show();
                } else {
                    $("#show-multi-branch").html(data.branchText);
                    $("#show-multi-branch").show();
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
        success: function (data) {
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
        $("#unit-" + previous).css("color", "#6E6E6E");
        $("#unit-" + previous).css("border-bottom", "3px solid #94989C");
    }

    $("#currentUnit").val(currentUnit);
    $("#unit-" + currentUnit).css("background-color", "#D7EBFF");
    $("#unit-" + currentUnit).css("color", "#30313D");
    $("#unit-" + currentUnit).css("border-bottom", "3px solid #2580D3");

}
function selectUnitUpdate(currentUnit) {
    var previous = $(".currentUnit").val();
    if (previous != '') {
        $(".previousUnit").val(previous);
        $(".unit-" + previous).css("background-color", "white");
        $(".unit-" + previous).css("color", "#6E6E6E");
        $(".unit-" + previous).css("border-bottom", "3px solid #94989C");
    }
    $(".currentUnit").val(currentUnit);
    $(".unit-" + currentUnit).css("background-color", "#D7EBFF");
    $(".unit-" + currentUnit).css("color", "#30313D");
    $(".unit-" + currentUnit).css("border-bottom", "3px solid #2580D3");
}
function updateKfi(kfiId) {
    // alert(kfiId);
    $("#acType").val('update');
    resetUnit();
    $("#staticBackdrop2").show();
    $("#update-kfi")[0].reset();
    $("#kfiId-update").val(kfiId);
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
            // $("#periodDate-update").val(data.periodCheck);
            $("#from-date").val(data.fromDate);
            $("#to-date").val(data.toDate);
            $("#nextCheckDate-update").val(data.nextCheckDate);
            $("#targetAmount").val(data.targetAmount);
            $("#result").val(data.result);
            $("#kfiDetail").val(data.detail);
            $("#quantRatio").val(data.quantRatio);
            $("#monthName").val(data.month);
            $("#year").val(data.year);
            $("#amountType").val(data.amountType);
            $("#code").val(data.code);
            $("#kfiStatus").val(data.kfiStatus);
        }
    });
}


function openDatePicker() {
    document.getElementById('monthYearPicker').style.display = 'block';
}

function closeDatePicker() {
    var month = document.getElementById('monthSelect').value;
    var year = document.getElementById('yearSelect').value;

    if (month && year) {
        // อัปเดตข้อความใน multi-mount-year
        document.getElementById('multi-mount-year').innerHTML =
            `${getMonthName(month)}, ${year} <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>`;

        // เปลี่ยน style ของ #multi-branch-text
        $("#multi-mount-year").css({
            "color": "var(--HRVC---Text-Black, #30313D)",
            "font-family": '"SF Pro Display"',
            "font-size": "14px",
            "font-style": "normal",
            "font-weight": "500",
            "line-height": "20px"
        });

        // อัปเดต hidden inputs
        document.getElementById('hiddenMonth').value = month;
        document.getElementById('hiddenYear').value = year;

        // ซ่อนตัวเลือกวันที่
        document.getElementById('monthYearPicker').style.display = 'none';

        // เปลี่ยนแปลงสไตล์ของ <span> input-group-text
        const inputGroupText = document.querySelector('.input-group-text');
        inputGroupText.style.backgroundColor = '#D7EBFF';
        inputGroupText.style.border = '0.5px solid #BEDAFF';

        // อัปเดตไอคอนภายใน <span>
        const images = inputGroupText.querySelectorAll('img');
        images[0].src = $url + 'image/calendar-blue.svg';
        images[1].src = $url + 'image/weld.svg';
        images[2].src = $url + 'image/calendar-blue.svg';
    }
}


function getMonthName(month) {
    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ]; return months[month - 1];
}


// กำหนด Flatpickr สำหรับปฏิทินเริ่มต้น
flatpickr("#startDatePicker", {
    inline: true,
    dateFormat: "m/d/Y",
    onChange: function (selectedDates, dateStr) {
        window.startDate = dateStr; // เก็บค่า Start Date
        updateSelectedDates();
    }
});

// กำหนด Flatpickr สำหรับปฏิทินสิ้นสุด
flatpickr("#endDatePicker", {
    inline: true,
    dateFormat: "m/d/Y",
    onChange: function (selectedDates, dateStr) {
        window.endDate = dateStr; // เก็บค่า End Date
        updateSelectedDates();
    }
});

// อัปเดตข้อความวันที่ใน multi-due-term
function updateSelectedDates() {
    const startDate = window.startDate || "Start";
    const endDate = window.endDate || "End";

    // อัปเดตข้อความใน multi-due-term
    document.getElementById("multi-due-term").innerHTML =
        `${startDate} - ${endDate} <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>`;


    // เปลี่ยน style ของ #multi-branch-text
    $("#multi-due-term").css({
        "color": "var(--HRVC---Text-Black, #30313D)",
        "font-family": '"SF Pro Display"',
        "font-size": "14px",
        "font-style": "normal",
        "font-weight": "500",
        "line-height": "20px"
    });

    // อัปเดต hidden inputs
    document.getElementById('fromDate').value = startDate;
    document.getElementById('toDate').value = endDate;


    // ตรวจสอบว่าทั้ง Start Date และ End Date ถูกเลือกแล้ว
    if (window.startDate && window.endDate) {
        // เปลี่ยนแปลงสไตล์ของ <span> เฉพาะใน img-due-term
        const inputGroupText = document.querySelector('#img-due-term .input-group-text');
        inputGroupText.style.backgroundColor = '#D7EBFF';
        inputGroupText.style.border = '0.5px solid #BEDAFF';

        // อัปเดตไอคอนภายใน <span>
        const images = inputGroupText.querySelectorAll('img');
        images[0].src = $url + 'image/calendar-blue.svg';
        images[1].src = $url + 'image/weld.svg';
        images[2].src = $url + 'image/calendar-blue.svg';
    }
}

function updateInputGroupStyle(target, backgroundColor, borderColor, icons) {
    const inputGroupText = target.closest('.input-group').querySelector('.input-group-text');
    inputGroupText.style.backgroundColor = backgroundColor;
    inputGroupText.style.border = `0.5px solid ${borderColor}`;

    const images = inputGroupText.querySelectorAll('img');
    images[0].src = $url + 'image/calendar-blue.svg';
    images[1].src = $url + 'image/weld.svg';
    images[2].src = $url + 'image/calendar-blue.svg';
}


flatpickr("#updateDatePicker", {
    inline: true, // แสดงปฏิทินแบบฝัง
    dateFormat: "d/m/Y", // รูปแบบวันที่เป็น DD/MM/YYYY
    onChange: function (selectedDates, dateStr) {
        updateLastUpdateDate(dateStr);
    }
});

function updateLastUpdateDate(dateStr) {
    // อัปเดตข้อความใน multi-due-update
    document.getElementById('multi-due-update').innerHTML =
        `${dateStr} <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>`;
    // เปลี่ยน style ของ #multi-branch-text
    $("#multi-due-update").css({
        "color": "var(--HRVC---Text-Black, #30313D)",
        "font-family": '"SF Pro Display"',
        "font-size": "14px",
        "font-style": "normal",
        "font-weight": "500",
        "line-height": "20px"
    });

    // ซ่อนปฏิทินหลังจากเลือกวันที่
    document.getElementById('calendar-due-update').style.display = 'none';

    document.getElementById('nextDate').value = dateStr;


    // หากเลือกวันที่แล้ว เปลี่ยนสีพื้นหลังและอัปเดตไอคอน
    if (dateStr) {
        const inputGroupText = document.querySelector('#img-due-update .input-group-text');
        inputGroupText.style.backgroundColor = '#D7EBFF';
        inputGroupText.style.border = '0.5px solid #BEDAFF';

        const images = inputGroupText.querySelectorAll('img');
        images[0].src = $url + 'image/calendar-blue.svg';
        images[1].src = $url + 'image/weld.svg';
        images[2].src = $url + 'image/calendar-blue.svg';
    }
}

function updateIcon(input) {
    const icon = document.getElementById('result-icon');
    if (input.value.trim() === "") {
        // เปลี่ยนเป็นไอคอนสีเทาเมื่อ input ว่าง
        icon.src = "/HRVC/frontend/web/image/result-gray.svg";
    } else {
        // เปลี่ยนเป็นไอคอนสีน้ำเงินเมื่อมีค่า
        icon.src = "/HRVC/frontend/web/image/result-blue.svg";
    }
}




// function branchMultiDepartment() {
//     var multiBranch = [];
//     $(".branch-checkbox:checked").each(function () {
//         multiBranch.push($(this).val());
//     });
//     // alert(0);
//     // updateSelectedCount();
//     // ทำการเรียก AJAX หรือการกระทำเพิ่มเติมตามที่ต้องการ
//     var url = $url + 'kfi/management/branch-multi-department';
//     var acType = $("#acType").val();
//     var kfiId = $("#kfiId").val();
//     $.ajax({
//         type: "POST",
//         dataType: 'json',
//         url: url,
//         data: { multiBranch: multiBranch, acType: acType, kfiId: kfiId },
//         success: function (data) {
//             if (data.status) {
//                 // alert(1);
//                 $("#show-multi-department-update").html(data.textDepartment);
//             } else {
//                 // alert(2);
//                 $("#show-multi-department-update").html('');
//             }
//         }
//     });
// }

function updateSelectedCount() {
    var selectedCount = $(".branch-checkbox:checked").length;  // นับ checkbox ที่ถูกเลือก
    alert(selectedCount);  // ใช้สำหรับทดสอบการนับจำนวน
    $("#selected-count").text(`${selectedCount}`);  // อัปเดตจำนวนที่เลือก
    $("#selected-message").text(
        selectedCount > 0 ? `${selectedCount} Branch(es) Selected` : "No Branches are Selected Yet"
    );
}


function totalBranchUpdate() {
    var totalBranch = 0;
    var data = [];
    var i = 0;
    $('input[id="multi-check-update"]').each(function () {
        data[i] = $(this).val();
        i++;
    });
    totalBranch = data.length;
    return totalBranch;
}
function departmentMultiTeamUpdateKfi(branchId) {
    var sumDepartment = totalDepartmentUpdate(branchId);
    var multiDepartmentBranch = [];
    var multiDepartment = [];
    var multiBranch = [];
    var i = 0;
    $("#multi-check-" + branchId + "-update:checked").each(function () {
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
        $("#multi-check-all-" + branchId + "-update").prop("checked", false);
    } else {
        $("#multi-check-all-" + branchId + "-update").prop("checked", true);
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
    $("#v-kfiId").val(kfiId);
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kfiId: kfiId },
        success: function (data) {
            if (data.status) {

                $("#kfiNameHistory").html(data.kfi.kfiName);
                $("#kfi-branch-flag").attr("src", $url + data.kfi.flag);
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
                if (data.kfi.status == 1) {
                    $("#NextCheckDateHistory").html(data.kfi.nextCheck);
                } else {
                    $("#NextCheckDateHistory").html('-');
                }
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
        success: function (data) {
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
        success: function (data) {
            if (data.status) {
                $("#kfi-name-issue").html(data.kfi.kfiName);
                $("#pills-Issues").html(data.issueText);
                $("#pills-History").html(data.historyText);
                $("#company-issue").html(data.kfi.companyName);
                $("#branch-issue").html(data.kfi.branchName);
                $("#country-issue").html(data.kfi.countryName);
                $("#flag-issue").attr('src', $url + data.kfi.flag);
            }
        }
    });
}
function answerKfiIssue(kfiIssueId) {
    var answer = $("#answer-" + kfiIssueId).val();
    var fd = new FormData();
    var files = $("#attachKfiFileAnswer-" + kfiIssueId)[0].files;
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
    var message = "Attached : " + $("#attachKfiFileAnswer-" + kfiIssueId).val();
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
            $("#assign-search-result").html(data.kfiText);
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
function copyKfi(kfiId) {
    if (confirm('Do you want to make a copy?')) {
        var url = $url + 'kfi/management/copy-kfi?kfiId=' + kfiId;
        window.location.href = url;
    }
}
function showAllTitle(departmentId) {
    $("#all-title-" + departmentId).show();
}
function closeAllTitle(departmentId) {
    $("#all-title-" + departmentId).css("display", "none");
}
function kfiCompanyBranch(companyId, kfiId) {
    var url = $url + 'kfi/management/kfi-branch';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId, kfiId: kfiId },
        success: function (data) {
            $("#kfi-branch").html(data.textBranch);
            $("#kfiName").html(data.kfiName);
            $("#companyName").html(data.companyName);
        }
    });
}
function assignKfiBranch(kfiId, branchId) {
    var checked = 0;
    if ($("#assign-branch-kfi-" + kfiId + '-' + branchId).prop("checked") == true) {
        checked = 1;
    }
    var url = $url + 'kfi/management/kfi-assign-branch';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { branchId: branchId, kfiId: kfiId, checked, checked },
        success: function (data) {
            if (data.status) {
                $("#total-branch-" + kfiId).html(data.totalBranch);
            }
        }
    });
}
function kfiCompanyEmployee(kfiId) {
    var url = $url + 'kfi/management/kfi-employee';
    $("#kfiId").val(kfiId);
    $("#employeeInBranch").html('');
    $("#search-employee-box").css("display", "none");
    $("#search-employee-kfi").val('');
    $("#search-employee-department").val('')
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kfiId: kfiId },
        success: function (data) {
            if (data.status) {
                $("#search-employee-department").html(data.departmentText);
                $("#employeeInBranch").html(data.textEmployee);

            }
        }
    });
}
function kfiEmployee(employeeId, kfiId) {

    var url = $url + 'kfi/management/kfi-assign-employee';
    var checked = 0;
    if ($("#kfi-employee-" + employeeId + '-' + kfiId).prop("checked") == true) {
        checked = 1;
    }
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kfiId: kfiId, employeeId: employeeId, checked: checked },
        success: function (data) {
            if (data.status) {
                $("#totalEmployee-" + kfiId).html(data.totalEmployee);
            }
        }
    });
}
function searchKfiEmployee() {
    var kfiId = $("#kfiId").val();
    $("#search-employee-box").html('');
    var searchText = $("#search-employee-kfi").val();
    var departmentId = $("#search-employee-department").val();
    var url = $url + 'kfi/management/search-kfi-employee';
    // if ($.trim(searchText) != '') {
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kfiId: kfiId, searchText: searchText, departmentId: departmentId },
        success: function (data) {
            if (data.status) {
                $("#search-employee-box").show();
                $("#search-employee-box").html(data.textEmployee);
            }
        }
    });
    // } else { 
    //     $("#search-employee-box").html('');
    //     $("#search-employee-box").css("display","none");
    // }
}
function closeSearchBox() {
    $("#search-employee-box").css("display", "none");
    $("#search-employee-kfi").val('');
}
function changeKfiStatus(status, kfiId) {
    if (status == 1) {
        var text = 'Active';
    } else {
        var text = 'In Active';
    }
    var url = $url + 'kfi/management/change-kfi-status';
    if (confirm('Are you sure to change this KFI to ' + text)) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { kfiId: kfiId, status: status },
            success: function (data) {
                if (data.status) {
                    $("#active-" + kfiId).html(data.newButton);
                }
            }
        });
    }
}
function searchAssignKfi() {
    var month = $("#kfiMonthFilter").val();
    var active = $("#kfiStatusFilter").val();
    var url = $url + 'kfi/management/search-assign-kfi';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { month: month, active: active },
        success: function (data) {
            if (data.status) {
                $("#assign-search-result").html(data.kfiText);
            }
        }
    });

}
function kgiInBranchForKfi(kfiId, branchId) {
    var url = $url + 'kfi/management/kgi-branch';
    $("#kgi-branch").html('');
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kfiId: kfiId, branchId: branchId },
        success: function (data) {
            if (data.status) {
                $("#kgi-branch").html(data.kgiText);
            }
        }
    });
}
function saveSelectedKgi(kfiId) {
    var selectedKgi = [];
    $("input[name='kgi']:checked").each(function () {
        selectedKgi.push($(this).val());
    });
    if (selectedKgi.length == 0) {
        var selectedKgi = '';
    }
    var unCheck = [];
    $("input[name='kgi']").each(function () {
        if (!$(this).prop("checked")) {
            unCheck.push($(this).val());
        }
    });
    if (unCheck.length == 0) {
        var unCheck = '';
    }
    var url = $url + 'kfi/management/assign-kgi-to-kfi';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kfiId: kfiId, selectedKgi: selectedKgi, unCheck: unCheck },
        success: function (data) {
            if (data.status) {
                //    $('.alert-box').slideDown(500);
                //setTimeout(function(){
                // Code to be executed after a delay
                //        $('.alert-box').fadeOut(300);
                //      }, 3000); 
            }
        }
    });
}
function assignKgiTokfi(kgiId, kfiId) {
    var url = $url + 'kfi/management/assign-kgi-to-kfi';
    if ($("#kgi-branch-" + kgiId).prop("checked") == true) {
        var type = 1;
    } else {
        var type = 0;
    }
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kgiId: kgiId, kfiId: kfiId, type: type },
        success: function (data) {
            if (data.status) {

            }
        }
    });
}
function checkAllkfiEmployee(kfiId) {
    var url = $url + 'kfi/management/check-all-kfi-employee';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kfiId: kfiId },
        success: function (data) {
            if ($("#all-kfi-employee-" + kfiId).prop("checked") == true) {

                $.each(data.employeeId, function (key, value) {
                    if ($("#kfi-employee-" + value + '-' + kfiId).prop("checked") == false) {
                        $("#kfi-employee-" + value + '-' + kfiId).prop("checked", true);
                        kfiEmployee(value, kfiId);
                    }
                });
            } else {

                $.each(data.employeeId, function (key, value) {
                    if ($("#kfi-employee-" + value + '-' + kfiId).prop("checked") == true) {
                        $("#kfi-employee-" + value + '-' + kfiId).prop("checked", false);
                        kfiEmployee(value, kfiId);
                    }
                });
            }
        }
    });
}
function relatedKgiForKfi() {
    var kfiId = $("#v-kfiId").val();
    $("#modal-kgi").modal('show');
    var url = $url + 'kfi/management/related-kgi';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kfiId: kfiId },
        success: function (data) {
            $("#related-kgi").html(data.kgiText);
            $("#kfi-name").html(data.kfiName);
        }
    });
}
function prepareKfiNextTarget(kfiHistoryId) {
    $("#copy").modal('show');
    $("#kfiHistoryId").val(kfiHistoryId);
}
function kfiNextTarget() {
    var kfiHistoryId = $("#kfiHistoryId").val();
    var url = $url + 'kfi/management/next-kfi-history';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kfiHistoryId: kfiHistoryId },
        success: function (data) {

        }
    });
}
function viewTabKfi(kfiHistoryId, tabId, role = null) {
    var currentTabId = $("#currentTab").val();
    var kfiId = $("#kfiId").val();
    $("#tab-" + currentTabId).removeClass("view-tab-active").addClass("view-tab");
    $("#tab-" + tabId).removeClass("view-tab").addClass("view-tab-active");
    $("#tab-" + currentTabId + "-blue").hide();
    $("#tab-" + currentTabId + "-black").show();
    $("#tab-" + tabId + "-blue").show();
    $("#tab-" + tabId + "-black").hide();
    $("#currentTab").val(tabId);

    var url;
    var data = { kfiId: kfiId, kfiHistoryId: kfiHistoryId };
    if (tabId == 5) {
        url = $url + 'kfi/view/kfi-kgi';
        data.role = role; // เพิ่ม role เฉพาะแท็บ 5
    } else if (tabId == 1) {
        url = $url + 'kfi/view/kfi-employee';
    } else if (tabId == 2) {
        url = $url + 'kfi/view/all-kfi-history';
    } else if (tabId == 3) {
        url = $url + 'kfi/view/kfi-issue';
    } else if (tabId == 4) {
        url = $url + 'kfi/view/kfi-chart';
    }

    if (url) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: data,
            success: function (response) {
                $("#show-content").html(response.kfiEmployeeTeam || response.monthlyDetailHistoryText || response.kfiIssue || response.kfiChart || response.kgi);
            }
        });
    }
}

function showEditRelateKgi(type, kfiId) {
    if (type == 1) {
        $("#editRelateKgi").hide();
        $("#saveRelateKgi").show();
        $("#cancelRelateKgi").show();
        $('input[id="check-relate-kgi"]').each(function () {
            $(this).show();
        });
        var url = $url + 'kfi/view/kfi-has-kgi';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { kfiId: kfiId },
            success: function (data) {
                $("#kgi").html('');
                $("#kgi").html(data.kgi);
            }
        });
    }
    if (type == 2) {
        $("#editRelateKgi").show();
        $("#saveRelateKgi").hide();
        $("#cancelRelateKgi").hide();
        $('input[id="check-relate-kgi"]').each(function () {
            $(this).hide();
        });
        saveSelectedKgi(kfiId);
        $("#show-content").html('');
        var url = $url + 'kfi/view/kfi-kgi';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { kfiId: kfiId },
            success: function (data) {
                $("#show-content").html(data.kgi);
                $('.alert-box').slideDown(500);
                setTimeout(function () {
                    $('.alert-box').fadeOut(300);
                }, 1000);
            }
        });
    }
    if (type == 0) {
        $("#editRelateKgi").show();
        $("#saveRelateKgi").hide();
        $("#cancelRelateKgi").hide();
        $("#show-content").html('');
        var url = $url + 'kfi/view/kfi-kgi';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { kfiId: kfiId },
            success: function (data) {
                $("#show-content").html('');
                $("#show-content").html(data.kgi);
            }
        });
    }
}