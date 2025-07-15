var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;

function numberformat(input) {
    // ลบทุกตัวอักษรที่ไม่ใช่ตัวเลขหรือลูกน้ำ
    input.value = input.value.replace(/[^0-9.]/g, '');
}

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
function branchMultiDepartment() {
    var multiBranch = [];
    var sumBranch = totalBranch();
    var i = 0;

    $("#multi-check:checked").each(function () {
        multiBranch[i] = $(this).val();
        i++;
    });
    var sumBranch = totalBranch();

    if (sumBranch != multiBranch.length) {
        $("#check-all-branch").prop("checked", false);
    } else {
        $("#check-all-branch").prop("checked", true);
    }

    if (multiBranch.length > 0) {
        $('input[id="multi-check"]').each(function () {
            //$(".multiCheck-" + $(this).val()).removeAttr('required');
        });

        let imageSrc = $url + "image/branches.svg"; // กำหนดแหล่งที่มาของภาพ
        let blackimageSrc = $url + "image/branches-black.svg"; // กำหนดแหล่งที่มาของภาพ

        // เปลี่ยนค่าใน <div> ที่มี id="selected-count" เฉพาะใน #image-branches
        $("#image-branches #branch-selected-count").removeClass("cycle-current-gray").addClass("cycle-current-white");
        $("#image-branches #branch-selected-message").html(``);

        if (multiBranch.length == 1) {
            $("#image-branches .cycle-current").slice(0, 3)
                .removeClass("cycle-current")
                .addClass("cycle-current-gray")
                .find("img")
                .attr("src", blackimageSrc);
            // เปลี่ยน class ของ cycle-current-gray เป็น cycle-current สำหรับ 1 div แรก ใน #kfi-branches
            $("#image-branches .cycle-current-gray").slice(0, 1).removeClass("cycle-current-gray").addClass("cycle-current");
            // เปลี่ยนแหล่งที่มาของภาพสำหรับ 1 รูปแรก
            $("#image-branches .cycle-current").slice(0, 1).find("img").attr("src", imageSrc);
        }
        if (multiBranch.length == 2) {
            $("#image-branches .cycle-current").slice(0, 3)
                .removeClass("cycle-current")
                .addClass("cycle-current-gray")
                .find("img")
                .attr("src", blackimageSrc);
            // เปลี่ยน class ของ cycle-current-gray เป็น cycle-current สำหรับ 2 div แรก ใน #image-branches
            $("#image-branches .cycle-current-gray").slice(0, 2).removeClass("cycle-current-gray").addClass("cycle-current");
            // เปลี่ยนแหล่งที่มาของภาพสำหรับ 2 รูปแรก
            $("#image-branches .cycle-current").slice(0, 2).find("img").attr("src", imageSrc);
        }
        if (multiBranch.length >= 3) {
            // เปลี่ยน class ของ cycle-current-gray เป็น cycle-current สำหรับ 3 div แรก ใน #image-branches
            $("#image-branches .cycle-current-gray").slice(0, 3).removeClass("cycle-current-gray").addClass("cycle-current");
            // เปลี่ยนแหล่งที่มาของภาพสำหรับ 3 รูปแรก
            $("#image-branches .cycle-current").slice(0, 3).find("img").attr("src", imageSrc);
        }

        // แสดงจำนวนที่เลือกใน #multi-branch-text
        $("#multi-branch-text").html(multiBranch.length + ` Branches Selected`);

        // เปลี่ยน style ของ #multi-branch-text
        $("#multi-branch-text").css({
            "color": "var(--HRVC---Text-Black, #30313D)",
            "font-family": '"SF Pro Display"',
            "font-size": "14px",
            "font-style": "normal",
            "font-weight": "500",
            "line-height": "20px"
        });
    } else {
        $('input[id="multi-check"]').each(function () {
            //$(".multiCheck-" + $(this).val()).prop('required', true);
        });

        // เปลี่ยนค่าใน <div> เมื่อไม่มีการเลือก checkbox เฉพาะใน #image-branches
        $("#image-branches #branch-selected-count").removeClass("cycle-current-white").addClass("cycle-current-gray");
        $("#image-branches #branch-selected-message").html("No Branches are Selected Yet");

        // เปลี่ยนแหล่งที่มาของภาพกลับเป็น default เฉพาะใน #image-branches
        $("#image-branches .cycle-current img").attr("src", $url + "image/branches-black.svg");

        // เปลี่ยน class ของ cycle-current เป็น cycle-current-gray สำหรับ 3 div แรก ใน #kfi-branches
        $("#image-branches .cycle-current").slice(0, 3).removeClass("cycle-current").addClass("cycle-current-gray");

        // ถ้าไม่ได้เลือกบริษัทใดๆ ให้แสดงข้อความ "Select Branches"
        $("#multi-branch-text").html(`Selected Branches`);

        // คืนค่าการตั้งสไตล์กลับเป็นค่าเดิม
        $("#multi-branch-text").css({
            "color": "var(--Helper-Text-Gray, #8A8A8A)",
            "font-family": '"SF Pro Display", sans-serif',
            "font-size": "14px",
            "font-weight": "400",
            "line-height": "20px",
            "text-transform": "capitalize"
        });
    }

    // สำหรับ Branches
    var selectedBranchCount = multiBranch.length;
    $("#branch-selected-count").text(selectedBranchCount.toString());
    $("#branch-selected-message").text(
        selectedBranchCount > 0
            ? ``
            : "No Branches are Selected Yet"
    );

    var url = $url + 'kgi/management/branch-multi-department';
    var acType = $("#acType").val();
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { multiBranch: multiBranch, acType: acType },
        success: function (data) {
            if (data.status) {
                $("#show-multi-department").html(data.textDepartment);
            } else {
                $("#show-multi-department").html('');
            }
        }
    });
}


function branchMultiDepartmentUpdateKfi() {
    // alert(0);
    var multiBranch = [];
    var sumBranch = totalBranch();
    var i = 0;
    $("#multi-check-update:checked").each(function () {
        multiBranch.push($(this).val());
        i++;
    });

    if (sumBranch != multiBranch.length) {
        $("#check-all-branch-update").prop("checked", false);
    } else {
        $("#check-all-branch-update").prop("checked", true);
    }
    // alert(multiBranch.length);
    if (multiBranch.length > 0) {
        $('input[id="multi-check-update"]').each(function () {
            $(".multiCheck-" + $(this).val()).removeAttr('required');
        });

        let imageSrc = $url + "image/branches.svg"; // กำหนดแหล่งที่มาของภาพ
        let blackimageSrc = $url + "image/branches-black.svg"; // กำหนดแหล่งที่มาของภาพ

        // เปลี่ยนค่าใน <div> ที่มี id="selected-count" เฉพาะใน #kfi-branches
        $("#image-branches #branch-selected-count").removeClass("cycle-current-gray").addClass("cycle-current-white");
        $("#image-branches #branch-selected-message").html(``);

        if (multiBranch.length == 1) {
            $("#image-branches .cycle-current").slice(0, 3)
                .removeClass("cycle-current")
                .addClass("cycle-current-gray")
                .find("img")
                .attr("src", blackimageSrc);
            // เปลี่ยน class ของ cycle-current-gray เป็น cycle-current สำหรับ 1 div แรก ใน #image-branches
            $("#image-branches .cycle-current-gray").slice(0, 1).removeClass("cycle-current-gray").addClass("cycle-current");
            // เปลี่ยนแหล่งที่มาของภาพสำหรับ 1 รูปแรก
            $("#image-branches .cycle-current").slice(0, 1).find("img").attr("src", imageSrc);
        }
        if (multiBranch.length == 2) {
            $("#image-branches .cycle-current").slice(0, 3)
                .removeClass("cycle-current")
                .addClass("cycle-current-gray")
                .find("img")
                .attr("src", blackimageSrc);
            // เปลี่ยน class ของ cycle-current-gray เป็น cycle-current สำหรับ 2 div แรก ใน #image-branches
            $("#image-branches .cycle-current-gray").slice(0, 2).removeClass("cycle-current-gray").addClass("cycle-current");
            // เปลี่ยนแหล่งที่มาของภาพสำหรับ 2 รูปแรก
            $("#image-branches .cycle-current").slice(0, 2).find("img").attr("src", imageSrc);
        }
        if (multiBranch.length >= 3) {
            // เปลี่ยน class ของ cycle-current-gray เป็น cycle-current สำหรับ 3 div แรก ใน #image-branches
            $("#image-branches .cycle-current-gray").slice(0, 3).removeClass("cycle-current-gray").addClass("cycle-current");
            // เปลี่ยนแหล่งที่มาของภาพสำหรับ 3 รูปแรก
            $("#image-branches .cycle-current").slice(0, 3).find("img").attr("src", imageSrc);
        }

        // แสดงจำนวนที่เลือกใน #multi-branch-text
        $("#multi-branch-text").html(multiBranch.length + ` Branches Selected`);

        // เปลี่ยน style ของ #multi-branch-text
        $("#multi-branch-text").css({
            "color": "var(--HRVC---Text-Black, #30313D)",
            "font-family": '"SF Pro Display"',
            "font-size": "14px",
            "font-style": "normal",
            "font-weight": "500",
            "line-height": "20px"
        });
    } else {
        $('input[id="multi-check-update"]').each(function () {
            $(".multiCheck-" + $(this).val()).prop('required', true);
        });

        // เปลี่ยนค่าใน <div> เมื่อไม่มีการเลือก checkbox เฉพาะใน #image-branches
        $("#image-branches #branch-selected-count").removeClass("cycle-current-white").addClass("cycle-current-gray");
        $("#image-branches #branch-selected-message").html("No Branches are Selected Yet");

        // เปลี่ยนแหล่งที่มาของภาพกลับเป็น default เฉพาะใน #image-branches
        $("#image-branches .cycle-current img").attr("src", $url + "image/branches-black.svg");

        // เปลี่ยน class ของ cycle-current เป็น cycle-current-gray สำหรับ 3 div แรก ใน #image-branches
        $("#image-branches .cycle-current").slice(0, 3).removeClass("cycle-current").addClass("cycle-current-gray");

        // ถ้าไม่ได้เลือกบริษัทใดๆ ให้แสดงข้อความ "Select Branches"
        $("#multi-branch-text").html(`Selected Branches`);

        // คืนค่าการตั้งสไตล์กลับเป็นค่าเดิม
        $("#multi-branch-text").css({
            "color": "var(--Helper-Text-Gray, #8A8A8A)",
            "font-family": '"SF Pro Display", sans-serif',
            "font-size": "14px",
            "font-weight": "400",
            "line-height": "20px",
            "text-transform": "capitalize"
        });
    }

    // สำหรับ Branches
    var selectedBranchCount = multiBranch.length;
    $("#branch-selected-count").text(selectedBranchCount.toString());
    $("#branch-selected-message").text(
        selectedBranchCount > 0
            ? ``
            : "No Branches are Selected Yet"
    );
    // updateSelectedCount();
    // ทำการเรียก AJAX หรือการกระทำเพิ่มเติมตามที่ต้องการ
    var url = $url + 'kfi/management/branch-multi-department';
    var acType = $("#acType").val();
    var kfiId = $("#kfiId").val();
    // alert(multiBranch);

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { multiBranch: multiBranch, acType: acType, kfiId: kfiId },
        success: function (data) {
            if (data.status) {
                // alert(1);
                $("#show-multi-department-update").html(data.textDepartment);
            }
        }
    });
}

function departmentMultiTeam(branchId) {
    var sumDepartment = totalDepartment(branchId);
    var multiDepartmentBranch = [];
    var multiDepartment = [];
    var multiBranch = [];
    var allSelectedDepartments = []; // ตัวแปรเก็บผลรวมทั้งหมด
    var i = 0;

    // Collect selected departments for the specific branch
    $("#multi-check-" + branchId + ":checked").each(function () {
        multiDepartmentBranch[i] = $(this).val();
        i++;
    });
    // Collect all selected departments across all branches
    $("#multi-check:checked").each(function () {
        multiBranch[i] = $(this).val();
        i++;
    });

    $(".multi-check-department:checked").each(function () {
        multiDepartment.push($(this).val());
    });

    if (multiDepartment.length > 0) {
        $('input[id="multi-check-' + branchId + '"]').each(function () {
            $(".multiDepartment-" + $(this).val()).removeAttr('required');
        });

        let deptImageSrc = $url + "image/departments.svg"; // แหล่งที่มาของภาพสำหรับ departments
        let deptblackImageSrc = $url + "image/departments-black.svg"; // แหล่งที่มาของภาพสำหรับ departments

        // เปลี่ยน class และข้อความสำหรับ #image-departments
        $("#image-departments #department-selected-count")
            .removeClass("cycle-current-gray")
            .addClass("cycle-current-white");
        $("#image-departments #department-selected-message").html("");

        if (multiDepartment.length == 1) {
            $("#image-departments .cycle-current").slice(0, 3)
                .removeClass("cycle-current")
                .addClass("cycle-current-gray")
                .find("img")
                .attr("src", deptblackImageSrc);
            $("#image-departments .cycle-current-gray").slice(0, 1)
                .removeClass("cycle-current-gray")
                .addClass("cycle-current")
                .find("img")
                .attr("src", deptImageSrc);
        }
        if (multiDepartment.length == 2) {
            $("#image-departments .cycle-current").slice(0, 3)
                .removeClass("cycle-current")
                .addClass("cycle-current-gray")
                .find("img")
                .attr("src", deptblackImageSrc);
            $("#image-departments .cycle-current-gray").slice(0, 2)
                .removeClass("cycle-current-gray")
                .addClass("cycle-current")
                .find("img")
                .attr("src", deptImageSrc);
        }
        if (multiDepartment.length >= 3) {
            $("#image-departments .cycle-current-gray").slice(0, 3)
                .removeClass("cycle-current-gray")
                .addClass("cycle-current")
                .find("img")
                .attr("src", deptImageSrc);
        }


        // แสดงจำนวนที่เลือกใน #multi-department-text
        $("#multi-department-text").html(multiDepartment.length + ` Departments Selected`);

        // เปลี่ยน style ของ #multi-department-text
        $("#multi-department-text").css({
            "color": "var(--HRVC---Text-Black, #30313D)",
            "font-family": '"SF Pro Display"',
            "font-size": "14px",
            "font-style": "normal",
            "font-weight": "500",
            "line-height": "20px"
        });

    } else {
        // $('input[id="multi-check-' + branchId + '"]').each(function () {
        //     $(".multiDepartment-" + $(this).val()).prop('required', true);
        // });

        // เปลี่ยน class และข้อความเมื่อไม่มี departments ที่เลือก
        $("#image-departments #department-selected-count")
            .removeClass("cycle-current-white")
            .addClass("cycle-current-gray");
        $("#image-departments #department-selected-message").html("No Departments are Selected Yet");

        // เปลี่ยนภาพกลับเป็น default
        $("#image-departments .cycle-current img").attr("src", $url + "image/departments-black.svg");
        $("#image-departments .cycle-current").slice(0, 3)
            .removeClass("cycle-current")
            .addClass("cycle-current-gray");


        // ถ้าไม่ได้เลือกบริษัทใดๆ ให้แสดงข้อความ "Select Department"
        $("#multi-department-text").html("Select Department");

        // คืนค่าการตั้งสไตล์กลับเป็นค่าเดิม
        $("#multi-department-text").css({
            "color": "var(--Helper-Text-Gray, #8A8A8A)",
            "font-family": '"SF Pro Display", sans-serif',
            "font-size": "14px",
            "font-weight": "400",
            "line-height": "20px",
            "text-transform": "capitalize"
        });
    }


    // สำหรับ Departments
    var selectedDepartmentCount = multiDepartment.length;
    $("#department-selected-count").text(selectedDepartmentCount.toString());
    $("#department-selected-message").text(
        selectedDepartmentCount > 0
            ? ``
            : "No Departments are Selected Yet"
    );


    var acType = $("#acType").val();
    var url = $url + 'kgi/management/department-multi-team';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { multiDepartment: multiDepartment, multiBranch: multiBranch, acType: acType },
        success: function (data) {
            if (data.status) {
                $("#show-multi-team").html(data.textTeam);
            } else {
                $("#show-multi-team").html('');
            }
        }
    });
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
    // $(".multi-check-department-update:checked").each(function () {
    //     multiDepartment[i] = $(this).val();
    //     i++;
    // });
    if (sumDepartment != multiDepartmentBranch.length) {
        $("#multi-check-all-" + branchId + "-update").prop("checked", false);
    } else {
        $("#multi-check-all-" + branchId + "-update").prop("checked", true);
    }
    $(".multi-check-department-update:checked").each(function () {
        multiDepartment.push($(this).val());
        i++;
    });

    if (multiDepartment.length > 0) {
        $('input[id="multi-check' + branchId + '-update"]').each(function () {
            $(".multiCheck-" + $(this).val()).removeAttr('required');
        });

        let deptImageSrc = $url + "image/departments.svg"; // แหล่งที่มาของภาพสำหรับ departments
        let deptblackImageSrc = $url + "image/departments-black.svg"; // แหล่งที่มาของภาพสำหรับ departments

        // เปลี่ยน class และข้อความสำหรับ #image-departments
        $("#image-departments #department-selected-count")
            .removeClass("cycle-current-gray")
            .addClass("cycle-current-white");
        $("#image-departments #department-selected-message").html("");

        if (multiDepartment.length == 1) {
            $("#image-departments .cycle-current").slice(0, 3)
                .removeClass("cycle-current")
                .addClass("cycle-current-gray")
                .find("img")
                .attr("src", deptblackImageSrc);
            $("#image-departments .cycle-current-gray").slice(0, 1)
                .removeClass("cycle-current-gray")
                .addClass("cycle-current")
                .find("img")
                .attr("src", deptImageSrc);
        }
        if (multiDepartment.length == 2) {
            $("#image-departments .cycle-current").slice(0, 3)
                .removeClass("cycle-current")
                .addClass("cycle-current-gray")
                .find("img")
                .attr("src", deptblackImageSrc);
            $("#image-departments .cycle-current-gray").slice(0, 2)
                .removeClass("cycle-current-gray")
                .addClass("cycle-current")
                .find("img")
                .attr("src", deptImageSrc);
        }
        if (multiDepartment.length >= 3) {
            $("#image-departments .cycle-current-gray").slice(0, 3)
                .removeClass("cycle-current-gray")
                .addClass("cycle-current")
                .find("img")
                .attr("src", deptImageSrc);
        }


        // แสดงจำนวนที่เลือกใน #multi-department-text
        $("#multi-department-text").html(multiDepartment.length + ` Departments Selected`);

        // เปลี่ยน style ของ #multi-branch-text
        $("#multi-department-text").css({
            "color": "var(--HRVC---Text-Black, #30313D)",
            "font-family": '"SF Pro Display"',
            "font-size": "14px",
            "font-style": "normal",
            "font-weight": "500",
            "line-height": "20px"
        });

    } else {
        $('input[id="multi-check"]').each(function () {
            $(".multiCheck-" + $(this).val()).prop('required', true);
        });

        // เปลี่ยน class และข้อความเมื่อไม่มี departments ที่เลือก
        $("#image-departments #department-selected-count")
            .removeClass("cycle-current-white")
            .addClass("cycle-current-gray");
        $("#image-departments #department-selected-message").html("No Departments are Selected Yet");

        // เปลี่ยนภาพกลับเป็น default
        $("#image-departments .cycle-current img").attr("src", $url + "image/departments-black.svg");
        $("#image-departments .cycle-current").slice(0, 3)
            .removeClass("cycle-current")
            .addClass("cycle-current-gray");


        // ถ้าไม่ได้เลือกบริษัทใดๆ ให้แสดงข้อความ "Select Department"
        $("#multi-department-text").html("Select Department");

        // คืนค่าการตั้งสไตล์กลับเป็นค่าเดิม
        $("#multi-department-text").html("Selected Departments").css({
            "color": "var(--Helper-Text-Gray, #8A8A8A)",
            "font-family": '"SF Pro Display", sans-serif',
            "font-size": "14px",
            "font-weight": "400",
            "line-height": "20px",
            "text-transform": "capitalize"
        });
    }

    // สำหรับ Departments
    var selectedDepartmentCount = multiDepartment.length;
    $("#department-selected-count").text(selectedDepartmentCount.toString());
    $("#department-selected-message").text(
        selectedDepartmentCount > 0
            ? ``
            : "No Departments are Selected Yet"
    );

}

function multiTeam(departmentId) {
    var totalChecked = $('input[id^="multi-check-team-"]:checked').length;
    var totalTeams = $('input[id^="multi-check-team-"]').length;

    // ตรวจสอบว่าทุกทีมถูกเลือกหรือไม่
    if (totalChecked === totalTeams) {
        $("#multi-check-all-team").prop("checked", true);
    } else {
        $("#multi-check-all-team").prop("checked", false);
    }

    // ตั้งค่า required ตามจำนวนที่เลือก
    if (totalChecked > 0) {
        $('input[id="multi-check-team-' + departmentId + '"]').each(function () {
            //    $(".multiTeam-department-" + $(this).val()).removeAttr('required');
        });
    } else {
        $('input[id="multi-check-team-' + departmentId + '"]').each(function () {
            //    $(".multiTeam-department-" + $(this).val()).prop('required', true);
        });
    }

    // alert('Selected teams: ' + totalChecked + ' / Total teams: ' + totalTeams);

    if (totalChecked > 0) {
        $('input[id="multi-check-team-' + departmentId + '"]').each(function () {
            $(".multiTeam-department-" + $(this).val()).removeAttr('required');
        });

        let deptImageSrc = $url + "image/teams.svg";
        let deptBlackImageSrc = $url + "image/teams-black.svg";

        $("#image-team #team-selected-count")
            .removeClass("cycle-current-gray")
            .addClass("cycle-current-white");
        $("#image-team #team-selected-message").html("");

        $("#image-team .cycle-current-gray")
            .removeClass("cycle-current-gray")
            .addClass("cycle-current")
            .find("img")
            .attr("src", deptImageSrc);

        if (totalChecked < 3) {
            $("#image-team .cycle-current").slice(totalChecked, 3)
                .removeClass("cycle-current")
                .addClass("cycle-current-gray")
                .find("img")
                .attr("src", deptBlackImageSrc);
        }

        // อัปเดตจำนวนที่เลือก
        $("#team-selected-count").text(totalChecked.toString());
        $("#team-selected-message").text("");

        // ปรับสไตล์ข้อความ
        $("#multi-team-text").html(totalChecked + " Teams Selected").css({
            "color": "#30313D",
            "font-family": '"SF Pro Display"',
            "font-size": "14px",
            "font-weight": "500",
            "line-height": "20px"
        });

    } else {
        $('input[id^="multi-check-team-"]').each(function () {
            //        $(".multiTeam-department-" + $(this).val()).prop('required', true);
        });

        // รีเซ็ตค่าหากไม่มีการเลือก
        $("#image-team .cycle-current").slice(0, 3)
            .removeClass("cycle-current")
            .addClass("cycle-current-gray")
            .find("img")
            .attr("src", $url + "image/teams-black.svg");

        $("#team-selected-count").text("00");
        $("#team-selected-message").text("No Teams are Selected Yet");

        $("#multi-team-text").html("Selected Teams").css({
            "color": "var(--Helper-Text-Gray, #8A8A8A)",
            "font-family": '"SF Pro Display", sans-serif',
            "font-size": "14px",
            "font-weight": "400",
            "line-height": "20px",
            "text-transform": "capitalize"
        });
    }


    // สำหรับ teams
    var selectedTeamCount = totalChecked;
    $("#team-selected-count").text(selectedTeamCount.toString());
    $("#team-selected-message").text(
        selectedTeamCount > 0
            ? ``
            : "No Teams are Selected Yet"
    );
}
function multiTeamUpdate(departmentId) {
    var sumTeam = totalTeamUpdate(departmentId);
    var totalChecked = $('input[id^="multi-check-team-"]:checked').length;

    var multiTeamDepartment = [];
    var i = 0;
    // ตรวจสอบว่าทุกทีมถูกเลือกหรือไม่
    // if (totalChecked === totalTeams) {
    //     $("#multi-check-all-team-" + departmentId + '-update').prop("checked", false);
    // } else {
    //     $("#multi-check-all-team-" + departmentId + '-update').prop("checked", true);
    // }

    // // ตั้งค่า required ตามจำนวนที่เลือก
    // if (totalChecked > 0) {
    //     $('input[id="multi-check-team-' + departmentId + '-update"]').each(function () {
    //         $(".multiTeam-department-update-" + $(this).val()).removeAttr('required');
    //     });
    // } else {
    //     $('input[id="multi-check-team-' + departmentId + '-update"]').each(function () {
    //         $(".multiTeam-department-update-" + $(this).val()).prop('required', true);
    //     });
    // }

    $("#multi-check-team-" + departmentId + "-update:checked").each(function () {
        multiTeamDepartment[i] = $(this).val();
        i++;
    });
    //    alert('totalTeam= '+sumTeam+' totalCheck= '+multiTeamDepartment.length);
    //alert(sumTeam + '=>' + multiTeamDepartment.length);
    if (sumTeam != multiTeamDepartment.length) {
        $("#multi-check-all-team-" + departmentId + '-update').prop("checked", false);
    } else {
        $("#multi-check-all-team-" + departmentId + '-update').prop("checked", true);
    }
    if (totalChecked > 0) {
        $('input[id="multi-check-team-' + departmentId + '-update"]').each(function () {
            //    $(".multiTeam-department-update-" + $(this).val()).removeAttr('required');
        });
    } else {
        $('input[id="multi-check-team-' + departmentId + '-update"]').each(function () {
            //    $(".multiTeam-department-update-" + $(this).val()).prop('required', true);
        });
    }

    if (totalChecked > 0) {
        $('input[id^="multi-check-team-"]').each(function () {
            $(".multiCheck-" + $(this).val()).removeAttr('required');
        });

        let deptImageSrc = $url + "image/teams.svg";
        let deptBlackImageSrc = $url + "image/teams-black.svg";

        $("#image-team #team-selected-count")
            .removeClass("cycle-current-gray")
            .addClass("cycle-current-white");
        $("#image-team #team-selected-message").html("");

        $("#image-team .cycle-current-gray")
            .removeClass("cycle-current-gray")
            .addClass("cycle-current")
            .find("img")
            .attr("src", deptImageSrc);

        if (totalChecked < 3) {
            $("#image-team .cycle-current").slice(totalChecked, 3)
                .removeClass("cycle-current")
                .addClass("cycle-current-gray")
                .find("img")
                .attr("src", deptBlackImageSrc);
        }

        // อัปเดตจำนวนที่เลือก
        $("#team-selected-count").text(totalChecked.toString());
        $("#team-selected-message").text("");

        // ปรับสไตล์ข้อความ
        $("#multi-team-text").html(totalChecked + " Teams Selected").css({
            "color": "#30313D",
            "font-family": '"SF Pro Display"',
            "font-size": "14px",
            "font-weight": "500",
            "line-height": "20px"
        });

    } else {
        $('input[id^="multi-check-team-"]').each(function () {
            //        $(".multiCheck-" + $(this).val()).prop('required', true);
        });

        // รีเซ็ตค่าหากไม่มีการเลือก
        $("#image-team .cycle-current").slice(0, 3)
            .removeClass("cycle-current")
            .addClass("cycle-current-gray")
            .find("img")
            .attr("src", $url + "image/teams-black.svg");

        $("#team-selected-count").text("00");
        $("#team-selected-message").text("No Teams are Selected Yet");

        $("#multi-team-text").html("Selected Teams").css({
            "color": "var(--Helper-Text-Gray, #8A8A8A)",
            "font-family": '"SF Pro Display", sans-serif',
            "font-size": "14px",
            "font-weight": "400",
            "line-height": "20px",
            "text-transform": "capitalize"
        });
    }


    // สำหรับ teams
    var selectedTeamCount = totalChecked;
    $("#team-selected-count").text(selectedTeamCount.toString());
    $("#team-selected-message").text(
        selectedTeamCount > 0
            ? ``
            : "No Teams are Selected Yet"
    );
}

function allTeamUpdate(departmentId) {
    // var totalChecked = $('input[id^="multi-check-team-"]:checked').length;

    // var totalTeams = $('input[id^="multi-check-team-"]').length;
    // alert(totalChecked)
    if ($("#multi-check-all-team-" + departmentId + "-update").prop("checked") == true) {
        $('input[id="multi-check-team-' + departmentId + '-update"]').each(function () {
            $(this).prop("checked", true);
            var totalChecked = $('input[id^="multi-check-team-"]:checked').length;
            // alert(totalChecked)
            if (totalChecked > 0) {
                $('input[id^="multi-check-team-"]').each(function () {
                    $(".multiCheck-" + $(this).val()).removeAttr('required');
                });

                let deptImageSrc = $url + "image/teams.svg";
                let deptBlackImageSrc = $url + "image/teams-black.svg";

                $("#image-team #team-selected-count")
                    .removeClass("cycle-current-gray")
                    .addClass("cycle-current-white");
                $("#image-team #team-selected-message").html("");

                $("#image-team .cycle-current-gray")
                    .removeClass("cycle-current-gray")
                    .addClass("cycle-current")
                    .find("img")
                    .attr("src", deptImageSrc);

                if (totalChecked < 3) {
                    $("#image-team .cycle-current").slice(totalChecked, 3)
                        .removeClass("cycle-current")
                        .addClass("cycle-current-gray")
                        .find("img")
                        .attr("src", deptBlackImageSrc);
                }

                // อัปเดตจำนวนที่เลือก
                $("#team-selected-count").text(totalChecked.toString());
                $("#team-selected-message").text("");

                // ปรับสไตล์ข้อความ
                $("#multi-team-text").html(totalChecked + " Teams Selected").css({
                    "color": "#30313D",
                    "font-family": '"SF Pro Display"',
                    "font-size": "14px",
                    "font-weight": "500",
                    "line-height": "20px"
                });

            } else {
                $('input[id^="multi-check-team-"]').each(function () {
                    $(".multiCheck-" + $(this).val()).prop('required', true);
                });

                // รีเซ็ตค่าหากไม่มีการเลือก
                $("#image-team .cycle-current").slice(0, 3)
                    .removeClass("cycle-current")
                    .addClass("cycle-current-gray")
                    .find("img")
                    .attr("src", $url + "image/teams-black.svg");

                $("#team-selected-count").text("00");
                $("#team-selected-message").text("No Teams are Selected Yet");

                $("#multi-team-text").html("Selected Teams").css({
                    "color": "var(--Helper-Text-Gray, #8A8A8A)",
                    "font-family": '"SF Pro Display", sans-serif',
                    "font-size": "14px",
                    "font-weight": "400",
                    "line-height": "20px",
                    "text-transform": "capitalize"
                });
            }


            // สำหรับ teams
            var selectedTeamCount = totalChecked;
            $("#team-selected-count").text(selectedTeamCount.toString());
            $("#team-selected-message").text(
                selectedTeamCount > 0
                    ? ``
                    : "No Teams are Selected Yet"
            );
        }
        );
    } else {
        $('input[id="multi-check-team-' + departmentId + '-update"]').each(function () {
            $(this).prop("checked", false);
            var totalChecked = $('input[id^="multi-check-team-"]:checked').length;
            // alert(totalChecked)
            if (totalChecked > 0) {
                $('input[id^="multi-check-team-"]').each(function () {
                    $(".multiCheck-" + $(this).val()).removeAttr('required');
                });

                let deptImageSrc = $url + "image/teams.svg";
                let deptBlackImageSrc = $url + "image/teams-black.svg";

                $("#image-team #team-selected-count")
                    .removeClass("cycle-current-gray")
                    .addClass("cycle-current-white");
                $("#image-team #team-selected-message").html("");

                $("#image-team .cycle-current-gray")
                    .removeClass("cycle-current-gray")
                    .addClass("cycle-current")
                    .find("img")
                    .attr("src", deptImageSrc);

                if (totalChecked < 3) {
                    $("#image-team .cycle-current").slice(totalChecked, 3)
                        .removeClass("cycle-current")
                        .addClass("cycle-current-gray")
                        .find("img")
                        .attr("src", deptBlackImageSrc);
                }

                // อัปเดตจำนวนที่เลือก
                $("#team-selected-count").text(totalChecked.toString());
                $("#team-selected-message").text("");

                // ปรับสไตล์ข้อความ
                $("#multi-team-text").html(totalChecked + " Teams Selected").css({
                    "color": "#30313D",
                    "font-family": '"SF Pro Display"',
                    "font-size": "14px",
                    "font-weight": "500",
                    "line-height": "20px"
                });

            } else {
                $('input[id^="multi-check-team-"]').each(function () {
                    $(".multiCheck-" + $(this).val()).prop('required', true);
                });

                // รีเซ็ตค่าหากไม่มีการเลือก
                $("#image-team .cycle-current").slice(0, 3)
                    .removeClass("cycle-current")
                    .addClass("cycle-current-gray")
                    .find("img")
                    .attr("src", $url + "image/teams-black.svg");

                $("#team-selected-count").text("00");
                $("#team-selected-message").text("No Teams are Selected Yet");

                $("#multi-team-text").html("Selected Teams").css({
                    "color": "var(--Helper-Text-Gray, #8A8A8A)",
                    "font-family": '"SF Pro Display", sans-serif',
                    "font-size": "14px",
                    "font-weight": "400",
                    "line-height": "20px",
                    "text-transform": "capitalize"
                });
            }


            // สำหรับ teams
            var selectedTeamCount = totalChecked;
            $("#team-selected-count").text(selectedTeamCount.toString());
            $("#team-selected-message").text(
                selectedTeamCount > 0
                    ? ``
                    : "No Teams are Selected Yet"
            );
        }
        );
    }

}

function companyMultiBrachKfi() {
    var acType = $("#acType").val();
    var companyId = acType == "update" ? $("#companyId").val() : $("#companyId").val();
    var kfiId = $("#kfiId").val();

    // var kfiBranchText = JSON.parse(localStorage.getItem("kfiBranchText")) || [];

    // alert(kfiBranchText);
    // ส่งข้อมูลผ่าน AJAX ไปยังเซิร์ฟเวอร์
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: $url + 'kfi/management/company-multi-branch', // URL ที่รับค่าจาก AJAX
        data: {
            companyId: companyId,
            acType: acType,
            kfiId: kfiId
            // kfiBranchText: kfiBranchText // ส่งค่า branchIds ที่เลือกไป
        },
        success: function (data) {
            if (data.status) {
                // เติมข้อมูลที่ต้องการแสดงกลับจากเซิร์ฟเวอร์
                if (acType == "update") {
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
        $("#unit-" + previous).removeClass("unit-active").addClass("unit-inactive");
    }

    $("#currentUnit").val(currentUnit);
    $("#unit-" + currentUnit).removeClass("unit-inactive").addClass("unit-active");
}
// ฟังก์ชันแสดง/ซ่อนปฏิทิน
function toggleCalendar(triggerId, calendarId) {
    const trigger = document.getElementById(triggerId);
    const calendarPopup = document.getElementById(calendarId);

    if (trigger && calendarPopup) {
        trigger.addEventListener('click', function () {
            calendarPopup.style.display = (calendarPopup.style.display === 'none' || calendarPopup.style.display === '')
                ? 'flex'
                : 'none';
        });
    }
}

function closeCalendarOnDateSelect(datePickerId, calendarId) {
    const datePicker = document.getElementById(datePickerId);
    const calendarPopup = document.getElementById(calendarId);

    if (datePicker) {
        datePicker.addEventListener('change', function () {
            if (calendarPopup) {
                calendarPopup.style.display = 'none'; // ปิด popup เมื่อเลือกวันที่
            }
        });
    }
}
// ฟังก์ชันซ่อนปฏิทินเมื่อคลิกภายนอก
document.addEventListener('click', function (event) {
    const calendars = [
        { buttonId: 'multi-due-term', calendarId: 'calendar-due-term' },
        { buttonId: 'multi-due-update', calendarId: 'calendar-due-update' }
    ];

    calendars.forEach(item => {
        const calendarPopup = document.getElementById(item.calendarId);
        const button = document.getElementById(item.buttonId);

        if (calendarPopup && button) {
            if (!calendarPopup.contains(event.target) && !button.contains(event.target)) {
                calendarPopup.style.display = 'none';
            }
        }
    });
    const picker = document.getElementById('monthYearPicker');
    const trigger = document.getElementById('multi-mount-year');

    if (picker && trigger) {
        if (picker.style.display === 'block' && !picker.contains(event.target) && !trigger.contains(event.target)) {
            picker.style.display = 'none';
        }
    }
});

// เรียกใช้งานฟังก์ชันแสดง/ซ่อนปฏิทิน
toggleCalendar('multi-due-term', 'calendar-due-term');
toggleCalendar('multi-due-update', 'calendar-due-update');

closeCalendarOnDateSelect("endDatePicker", "calendar-due-term");


document.addEventListener("DOMContentLoaded", function () {
    // คำนวณปีปัจจุบัน
    const currentYear = new Date().getFullYear();

    // คำนวณช่วงปี
    const startYear = currentYear - 1; // ปีเริ่มต้น
    const endYear = startYear + 10; // ปีสิ้นสุด

    // เลือก <select> โดย id
    const yearSelect = document.getElementById('yearSelect');

    // ตรวจสอบว่า element ถูกพบหรือไม่
    if (yearSelect) {
        // สร้างตัวเลือกปี
        for (let year = startYear; year <= endYear; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            if (year == currentYear) {
                option.selected = true; // ตั้งค่าปีปัจจุบันเป็นค่าเริ่มต้น
            }
            yearSelect.appendChild(option);
        }
    } else {
        // console.error("Element with id 'yearSelect' not found.");
    }

    var month = document.getElementById('hiddenMonth').value;
    var year = document.getElementById('hiddenYear').value;

    if (month && year) {
        // alert(month);
        document.getElementById('multi-mount-year').innerHTML =
            `${getMonthName(month)}, ${year} <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>`;

        // เปลี่ยนสไตล์ข้อความ
        $("#multi-mount-year").css({
            "color": "var(--HRVC---Text-Black, #30313D)",
            "font-family": '"SF Pro Display"',
            "font-size": "14px",
            "font-style": "normal",
            "font-weight": "500",
            "line-height": "20px"
        });
        // เปลี่ยนแปลงสไตล์ของ <span> input-group-text
        const inputGroupText = document.querySelector('.input-group-text');
        inputGroupText.style.backgroundColor = '#D7EBFF';
        inputGroupText.style.border = '0.5px solid #BEDAFF';

        document.getElementById('monthSelect').value = month;
        document.getElementById('yearSelect').value = year;

        // อัปเดตไอคอนภายใน <span>
        const images = inputGroupText.querySelectorAll('img');
        images[0].src = $url + 'image/calendar-blue.svg';
        images[1].src = $url + 'image/weld.svg';
        images[2].src = $url + 'image/calendar-blue.svg';
    } else {
        const today = new Date();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // แปลงเป็น string และเติม 0 ถ้าจำนวนน้อยกว่า 2 หลัก
        year = today.getFullYear();

        document.getElementById('multi-mount-year').innerHTML =
            `${getMonthName(month)}, ${year} <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>`;

        // เปลี่ยนสไตล์ข้อความ
        $("#multi-mount-year").css({
            "color": "var(--HRVC---Text-Black, #30313D)",
            "font-family": '"SF Pro Display"',
            "font-size": "14px",
            "font-style": "normal",
            "font-weight": "500",
            "line-height": "20px"
        });
        // เปลี่ยนแปลงสไตล์ของ <span> input-group-text
        const inputGroupText = document.querySelector('.input-group-text');
        inputGroupText.style.backgroundColor = '#D7EBFF';
        inputGroupText.style.border = '0.5px solid #BEDAFF';

        // อัปเดตไอคอนภายใน <span>
        const images = inputGroupText.querySelectorAll('img');
        images[0].src = $url + 'image/calendar-blue.svg';
        images[1].src = $url + 'image/weld.svg';
        images[2].src = $url + 'image/calendar-blue.svg';

        document.getElementById('hiddenMonth').value = month;
        document.getElementById('hiddenYear').value = year;
        document.getElementById('monthSelect').value = month;
        document.getElementById('yearSelect').value = year;
    }

    const startDate = document.getElementById('fromDate').value;
    const endDate = document.getElementById('toDate').value;


    if (startDate && endDate) {
        document.getElementById("multi-due-term").innerHTML =
            `${startDate} - ${endDate} <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>`;

        // เปลี่ยนสไตล์ข้อความ
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
        // เปลี่ยนแปลงสไตล์ของ <span> input-group-text
        const inputGroupText = document.querySelector('#img-due-term .input-group-text');
        inputGroupText.style.backgroundColor = '#D7EBFF';
        inputGroupText.style.border = '0.5px solid #BEDAFF';

        // อัปเดตไอคอนภายใน <span>
        const images = inputGroupText.querySelectorAll('img');
        images[0].src = $url + 'image/calendar-blue.svg';
        images[1].src = $url + 'image/weld.svg';
        images[2].src = $url + 'image/calendar-blue.svg';
    }
    const nextCheckDate = document.getElementById('nextDate').value;  // ดึงค่าจาก input hidden

    if (nextCheckDate) {
        // อัปเดตข้อความใน div multi-due-update
        document.getElementById("multi-due-update").innerHTML =
            `${nextCheckDate} <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>`;

        // เปลี่ยนสไตล์ข้อความใน #multi-due-update
        $("#multi-due-update").css({
            "color": "var(--HRVC---Text-Black, #30313D)",
            "font-family": '"SF Pro Display"',
            "font-size": "14px",
            "font-style": "normal",
            "font-weight": "500",
            "line-height": "20px"
        });

        // เปลี่ยนแปลงสไตล์ของ <span> input-group-text
        const inputGroupText = document.querySelector('#img-due-update .input-group-text');
        inputGroupText.style.backgroundColor = '#D7EBFF';
        inputGroupText.style.border = '0.5px solid #BEDAFF';

        // อัปเดตไอคอนภายใน <span>
        const images = inputGroupText.querySelectorAll('img');
        images[0].src = $url + 'image/calendar-blue.svg';
        images[1].src = $url + 'image/weld.svg';
        images[2].src = $url + 'image/calendar-blue.svg';
    }

});




function openDatePicker() {
    const picker = document.getElementById('monthYearPicker');
    picker.style.display = (picker.style.display === 'none' || picker.style.display === '') ? 'block' : 'none';
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

function getOrdinalSuffix(day) {
    if (day >= 11 && day <= 13) return day + "th";
    switch (day % 10) {
        case 1: return day + "st";
        case 2: return day + "nd";
        case 3: return day + "rd";
        default: return day + "th";
    }
}


// กำหนด Flatpickr สำหรับปฏิทินเริ่มต้น
flatpickr("#startDatePicker", {
    inline: true,
    dateFormat: "Y-m-d",
    onChange: function (selectedDates, dateStr) {
        window.startDate = dateStr; // เก็บค่า Start Date
        updateSelectedDates();
    }
});

// กำหนด Flatpickr สำหรับปฏิทินสิ้นสุด
flatpickr("#endDatePicker", {
    inline: true,
    dateFormat: "Y-m-d",
    onChange: function (selectedDates, dateStr) {
        window.endDate = dateStr; // เก็บค่า End Date
        updateSelectedDates();
    }
});



function validateFormKfi(acType) {
    //	event.preventDefault(); // ป้องกันการส่งฟอร์มก่อนการตรวจสอบ
    console.log("validateFormKgi called");
    var multiBranch = [];
    var multiDepartment = [];
    var multiTeam = [];
    var i = 0;
    if (acType != 'update') {
        $("#multi-check:checked").each(function () {
            multiBranch[i] = $(this).val();
            i++;
        });
        var a = 0;
        $(".multi-check-department:checked").each(function () {
            multiDepartment[a] = $(this).val();
            a++;
        });
    } else {
        $("#multi-check-update:checked").each(function () {
            multiBranch[i] = $(this).val();
            i++;
        });
        var a = 0;
        $(".multi-check-department-update:checked").each(function () {
            multiDepartment[a] = $(this).val();
            a++;
        });
    }

    var fromDate = document.getElementById('fromDate').value.trim();
    var toDate = document.getElementById('toDate').value.trim();
    var nextDate = $('#nextDate').val();
    if (multiBranch.length == 0) {
        alert("Please select at least one branch!");
        return false;
    }
    else if (multiDepartment.length == 0) {
        alert("Please select at least one department!");
        return false;
    } else if (!fromDate && !toDate) {
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
    } else {
        return true;
    }
}

// อัปเดตข้อความวันที่ใน multi-due-term
function updateSelectedDates() {

    const fromDate = document.getElementById('fromDate');
    const toDate = document.getElementById('toDate');

    let startDate = window.startDate || (fromDate && fromDate.value !== '' ? fromDate.value : "Start");
    let endDate = window.endDate || (toDate && toDate.value !== '' ? toDate.value : "End");
    let newText = '<span class="calendar-due mr-15" id="calendar-dueterm"></span>';
    let duterm = startDate + ' - ' + endDate;
    let icon = '<i class="fa fa-angle-down" aria-hidden="true" style="position: absolute;right:0;margin-right:15px;"></i>';

    // document.getElementById("multi-due-term").innerHTML = newText + duterm + icon;

    document.getElementById("multi-due-term").innerHTML = duterm + icon;
    document.getElementById("due-term-icon-group").style.backgroundColor = "#D7EBFF";
    document.getElementById("due-term-icon-group").style.border = '0.5px solid #BEDAFF';
    document.getElementById("start-img-probation").src = $url + 'image/calendar-blue.svg';
    document.getElementById("weld-img-probation").src = $url + 'image/weld.svg';
    document.getElementById("end-img-probation").src = $url + 'image/calendar-blue.svg';

    const images1 = '<img src="' + $url + 'image/calendar-gray.svg' + '" alt="from" class="calendar-due-image">';
    const images2 = '<img src="' + $url + 'image/weld-gray.svg' + '" alt="from" class="calendar-due-image">';
    const images3 = '<img src="' + $url + 'image/calendar-gray.svg' + '" alt="from" class="calendar-due-image">';
    $("#calendar-dueterm").html(images1 + images2 + images3);
    // เปลี่ยน style ของ #multi-branch-text
    $("#multi-due-term").css({
        "color": "var(--HRVC---Text-Black, #30313D)",
        "font-weight": "500",
    });

    // อัปเดต hidden inputs
    document.getElementById('fromDate').value = startDate;
    document.getElementById('toDate').value = endDate;


    // ตรวจสอบว่าทั้ง Start Date และ End Date ถูกเลือกแล้ว
    if (window.startDate && window.endDate) {
        // เปลี่ยนแปลงสไตล์ของ <span> เฉพาะใน img-due-term
        const calendarDue = document.querySelector('#multi-due-term .calendar-due');
        calendarDue.style.backgroundColor = '#D7EBFF';
        calendarDue.style.border = '0.5px solid #BEDAFF';

        // อัปเดตไอคอนภายใน <span>
        const images = calendarDue.querySelectorAll('img');
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
    dateFormat: "Y/m/d", // รูปแบบวันที่เป็น DD/MM/YYYY
    onChange: function (selectedDates, dateStr) {
        updateLastUpdateDate(dateStr);
    }
});

function updateLastUpdateDate(dateStr) {
    // อัปเดตข้อความใน multi-due-update
    // document.getElementById('multi-due-update').innerHTML =
    //     `${dateStr} <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>`;
    // เปลี่ยน style ของ #multi-branch-text

    let newText = '<span class="calendar-due mr-50" id="calendar-dueterm-update"></span>';
    let icon = '<i class="fa fa-angle-down" aria-hidden="true" style="position: absolute;right:0;margin-right:15px;"></i>';

    document.getElementById("multi-due-update").innerHTML = newText + dateStr + icon;

    const images1 = '<img src="' + $url + 'image/calendar-gray.svg' + '" alt="from" class="calendar-due-image">';
    const images2 = '<img src="' + $url + 'image/weld-gray.svg' + '" alt="from" class="calendar-due-image">';
    const images3 = '<img src="' + $url + 'image/calendar-gray.svg' + '" alt="from" class="calendar-due-image">';
    $("#calendar-dueterm-update").html(images1 + images2 + images3);
    $("#multi-due-update").css({
        "color": "var(--HRVC---Text-Black, #30313D)",
        "font-weight": "500",
    });
    // ซ่อนปฏิทินหลังจากเลือกวันที่
    document.getElementById('calendar-due-update').style.display = 'none';

    document.getElementById('nextDate').value = dateStr;


    // หากเลือกวันที่แล้ว เปลี่ยนสีพื้นหลังและอัปเดตไอคอน
    if (dateStr) {
        const calendarDue = document.querySelector('#multi-due-update #calendar-dueterm-update');
        calendarDue.style.backgroundColor = '#D7EBFF';
        calendarDue.style.border = '0.5px solid #BEDAFF';

        // อัปเดตไอคอนภายใน <span>
        const images = calendarDue.querySelectorAll('img');
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

function updateResultValue(inputElement) {
    // นำค่าที่กรอกใน result-update ไปใส่ใน result-cheng
    // alert(inputElement.value);
    const resultValue = inputElement.value;
    const resultCheng = document.getElementById('result-cheng');
    resultCheng.value = resultValue;
}

$("#multi-branch").on("click", function (e) {
    var statusform = $("#acType").val();
    if (statusform == "update") {
        $("#show-multi-branch-update").toggle();
    } else {
        $("#show-multi-branch").toggle();
    }
    $(".toggle-icon-branch").toggleClass("fa-angle-down fa-angle-up");

    // e.stopPropagation();
});


$("#multi-department").on("click", function (e) {
    var statusform = $("#acType").val();
    if (statusform == "update") {
        $("#show-multi-department-update").toggle();
    } else {
        $("#show-multi-department").toggle();
    }
    $(".toggle-icon-branch").toggleClass("fa-angle-down fa-angle-up");

    // e.stopPropagation();
});

$("#multi-team").on("click", function (e) {
    var statusform = $("#acType").val();
    if (statusform == "update") {
        $("#show-multi-team-update").toggle();
    } else {
        $("#show-multi-team").toggle();
    }
    $(".toggle-icon-branch").toggleClass("fa-angle-down fa-angle-up");

    // e.stopPropagation();
});

// จับการคลิกในที่อื่น ๆ บน document
$(document).on("click", function (e) {
    // ตรวจสอบว่าไม่ได้คลิกใน #multi-branch หรือ #show-multi-branch
    if (!$(e.target).closest("#multi-branch, #show-multi-branch, #show-multi-branch-update").length) {
        $("#show-multi-branch-update").hide();  // ซ่อน #show-multi-branch-update
        $("#show-multi-branch").hide();  // ซ่อน #show-multi-branch ถ้ามี
        $(".toggle-icon-branch").removeClass("fa-angle-up").addClass("fa-angle-down");  // รีเซ็ตไอคอน
    }

    if (!$(e.target).closest("#multi-department, #show-multi-department, #show-multi-department-update").length) {
        $("#show-multi-department-update").hide();  // ซ่อน #show-multi-department-update
        $("#show-multi-department").hide();  // ซ่อน #show-multi-department ถ้ามี
        $(".toggle-icon-branch").removeClass("fa-angle-up").addClass("fa-angle-down");  // รีเซ็ตไอคอน
    }

    if (!$(e.target).closest("#multi-team, #show-multi-team, #show-multi-team-update").length) {
        $("#show-multi-team-update").hide();  // ซ่อน #show-multi-team-update
        $("#show-multi-team").hide();  // ซ่อน #show-multi-team ถ้ามี
        $(".toggle-icon-branch").removeClass("fa-angle-up").addClass("fa-angle-down");  // รีเซ็ตไอคอน
    }
});



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
    showLoading();
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
    // alert(url);
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { kfiHistoryId: kfiHistoryId },
        success: function (data) {
            // alert(data);
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

function allEmployeesCheck(teamId) {
    var checkboxes = document.querySelectorAll('#employee-in-team-' + teamId + ' input[type="checkbox"]');
    var checkAllCheckbox = document.querySelector('.check-all-' + teamId);
    var checkAllLabel = document.querySelector('.check-all-' + teamId + ' + .custom-checkbox-label');

    var allChecked = true;
    var someChecked = false;
    // alert(0);
    // ตรวจสอบสถานะของ checkbox ทั้งหมดในทีม
    checkboxes.forEach(function (checkbox) {
        if (!checkbox.checked) {
            allChecked = false; // ถ้า checkbox ใดไม่ถูกเลือก
            // alert(0);
        } else {
            someChecked = true; // ถ้ามีบาง checkbox ที่ถูกเลือก
            // alert(1);
        }
    });

    // ถ้าทุก checkbox ถูกเลือก
    if (allChecked) {
        checkAllCheckbox.checked = true;
        checkAllLabel.classList.remove('minus');
        // checkAllLabel.style.top = "0px"; // เอา margin-top ออกถ้าถูกเลือกทั้งหมด
    } else if (someChecked) {
        checkAllCheckbox.checked = false;
        checkAllLabel.classList.add('minus');
        // checkAllLabel.style.top = "0px"; // เอา margin-top ออกถ้าบางตัวถูกเลือก  
        // alert(0);
    } else {
        checkAllCheckbox.checked = false;
        checkAllLabel.classList.remove('minus');
        checkAllLabel.style.top = "3px"; // เพิ่ม margin-top ถ้าไม่มีการเลือก
        // alert(0);
    }
}

// ฟังก์ชันที่ทำงานเมื่อคลิกที่ checkbox "Check All"
function checkAllEmployees(teamId) {
    var checkboxes = document.querySelectorAll('#employee-in-team-' + teamId + ' input[type="checkbox"]');
    var checkAllCheckbox = document.querySelector('.check-all-' + teamId);
    var checkAllLabel = document.querySelector('.check-all-' + teamId + ' + .custom-checkbox-label');

    // ถ้าเลือก "Check All"
    if (checkAllCheckbox.checked) {
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = true; // เลือกทั้งหมด
        });
        checkAllLabel.classList.remove('minus'); // ลบเครื่องหมายลบ
        checkAllLabel.style.top = "0px"; // เอา margin-top ออกถ้าบางตัวถูกเลือก
    } else {
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = false; // ยกเลิกการเลือกทั้งหมด
        });
        checkAllLabel.classList.remove('minus'); // ลบเครื่องหมายลบ
        checkAllLabel.style.top = "0px"; // เอา margin-top ออกถ้าบางตัวถูกเลือก
    }

    // เรียกใช้ allEmployeesCheck เพื่ออัปเดตสถานะของ Check All
    allEmployeesCheck(teamId);
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
function changeStatus(type) {
    var pimStatus = $("#pim-status").val();
    $("#pim-status").removeClass('select-create-status');
    $("#pim-status").removeClass('select-complete-status');
    if (pimStatus == 1) {
        $("#pim-status").addClass('select-create-status');
    } else { 
            $("#pim-status").addClass('select-complete-status');
    }
    if (pimStatus == 2) {
        if (type == 'kgi') {
            var kgiId = $("#kgiId").val();
            var url = $url + 'kgi/management/check-kgi-team';
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: url,
                data: { kgiId: kgiId },
                success: function (data) {
                    if (data.countTeam == 0) {
                        $("#pim-status").addClass('select-complete-status');
                    } else {
                        $("#pim-status").val(1)
                        $("#pim-status").addClass('select-create-status');
                        $("#warning-kgi").modal("show");
                    }

                }
            });

        }
        if (type == 'kpi') {
            var kpiId = $("#kpiId").val();
            var url = $url + 'kpi/management/check-kpi-team';
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: url,
                data: { kpiId: kpiId },
                success: function (data) {
                    if (data.countTeam == 0) {
                        $("#pim-status").addClass('select-complete-status');
                    } else {
                        $("#pim-status").val(1)
                        $("#pim-status").addClass('select-create-status');
                        $("#warning-kpi").modal("show");
                    }

                }
            });

        }
    }
}