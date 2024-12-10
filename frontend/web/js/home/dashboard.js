var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
function loadCompanyTap(companyId) {
    var url = $baseUrl + 'home/default/company-tab';

    $.ajax({
        type: "POST",
        dataType: 'html', // รับข้อมูลเป็น HTML
        url: url,
        data: { companyId: companyId },
        success: function (data) {
            $('#tab-content-container').html(data); // อัปเดตเนื้อหาของแท็บ
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

function loadTeamTap(companyId, teamId) {
    var url = $baseUrl + 'home/default/team-tab';

    $.ajax({
        type: "POST",
        dataType: 'html', // รับข้อมูลเป็น HTML
        url: url,
        data: { companyId: companyId, teamId: teamId },
        success: function (data) {
            $('#tab-content-container').html(data); // อัปเดตเนื้อหาของแท็บ
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

function loadSelfTap(companyId, teamId, employeeId) {
    var url = $baseUrl + 'home/default/self-tab';

    $.ajax({
        type: "POST",
        dataType: 'html', // รับข้อมูลเป็น HTML
        url: url,
        data: { companyId: companyId, teamId: teamId, employeeId: employeeId },
        success: function (data) {
            $('#tab-content-container').html(data); // อัปเดตเนื้อหาของแท็บ
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

