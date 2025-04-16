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
            success: function (data) {
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
        success: function (data) {
            if (data.status) {
                $("#branch").html(data.branchText);
            }

        }
    });
}
function companyDepartment() {
    var companyId = $("#company").val();
    var url = $url + 'setting/company/company-department';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId },
        success: function (data) {
            if (data.status) {
                $("#department").html(data.department);
            }

        }
    });
}

function getOrdinalSuffix(day) {
    if (day > 3 && day < 21) return 'th';
    switch (day % 10) {
        case 1:
            return 'st';
        case 2:
            return 'nd';
        case 3:
            return 'rd';
        default:
            return 'th';
    }
}

flatpickr("#founded", {
    dateFormat: "Y-m-d", // format ที่ส่งไป server
    altInput: true,
    altFormat: "F Y", // ชั่วคราว จะเปลี่ยนทีหลัง
    onChange: function (selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
            const d = selectedDates[0];
            const day = d.getDate();
            const month = d.toLocaleString('default', {
                month: 'long'
            });
            const year = d.getFullYear();
            const suffix = getOrdinalSuffix(day);

            const formatted = `${suffix} ${month} ${year}`;
            instance.altInput.value = formatted;
        }
    }
});