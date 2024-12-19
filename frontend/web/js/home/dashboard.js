var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;

let currentKFIIndex = 0; // Initial index for KFI
let currentKGIIndex = 0; // Initial index for KGI
let currentKPIIndex = 0; // Initial index for KPI
let KFIData = []; // Declare globally
let KGIData = []; // Declare globally
let KPIData = []; // Declare globally


function loadCompanyTap(companyId) {
    var url = $baseUrl + 'home/default/company-tab';

    $.ajax({
        type: "POST",
        dataType: 'html', // รับข้อมูลเป็น HTML
        url: url,
        data: { companyId: companyId },
        success: function (data) {
            // currentKPIIndex = 0;
            $('#tab-content-container').html(data);
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}
function loadTeamTap(teamId) {
    var url = $baseUrl + 'home/default/team-tab';

    $.ajax({
        type: "POST",
        dataType: 'html', // รับข้อมูลเป็น HTML
        url: url,
        data: { teamId: teamId },
        success: function (data) {
            // currentKPIIndex = 0;
            $('#tab-content-container').html(data);
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

function loadSelfTap(employeeId) {
    var url = $baseUrl + 'home/default/self-tab';

    $.ajax({
        type: "POST",
        dataType: 'html', // รับข้อมูลเป็น HTML
        url: url,
        data: { employeeId: employeeId },
        success: function (data) {
            // currentKPIIndex = 0;
            $('#tab-content-container').html(data);
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}


function updateData(index, type) {
    const data = {
        'KFI': KFIData,
        'KGI': KGIData,
        'KPI': KPIData
    };
    // alert(index);

    const dataType = data[type];
    if (dataType && dataType[index]) {
        const item = dataType[index]; // ดึงข้อมูลจากดัชนีที่เลือก

        // อัปเดตข้อมูล Progress Bar
        const progressElement = document.getElementById(`${type}-progress`);
        progressElement.setAttribute('data-percentage', item.percentage);
        setProgress(progressElement, item.percentage);

        document.getElementById(`${type}-name-0`).innerText = item.name;
        document.getElementById(`${type}-target-0`).innerText = item.target;
        document.getElementById(`${type}-result-0`).innerText = item.result;
        document.getElementById(`${type}-last-0`).innerText = item.last || '-';
        document.getElementById(`${type}-due-0`).innerText = item.due || '-';
        // document.getElementById(`${type}-count-0`).innerText = item.count || '-';

    } else {
        console.error(`No data found for ${type} with index ${index}`);
    }
}

function changeKFIData(direction) {
    // เปลี่ยนดัชนีตามทิศทางที่คลิก
    if (direction == 'right') {
        // ถ้ากดขวา จะเพิ่มดัชนี
        currentKFIIndex = (currentKFIIndex + 1) % KFIData.length; // ถ้าเกินขอบเขตจะวนกลับไปที่ 0
    } else if (direction == 'left') {
        // ถ้ากดซ้าย จะลดดัชนี
        currentKFIIndex = (currentKFIIndex - 1 + KFIData.length) % KFIData.length; // ถ้าเกินขอบเขตจะวนกลับไปที่ท้ายสุด
    }

    // ดึงข้อมูลชุดที่เลือกจาก KFIData ตามดัชนีที่ได้
    // const selectedKFI = KFIData[currentKFIIndex];
    // alert(`Selected KFI Item: ${JSON.stringify(selectedKFI)}`); // แสดงข้อมูลชุดที่เลือก

    // เรียกใช้ฟังก์ชัน updateData เพื่อนำข้อมูลไปแสดงผล
    updateData(currentKFIIndex, 'KFI');
}

// ฟังก์ชันเพื่อเปลี่ยนข้อมูล KGI เมื่อคลิกปุ่มซ้ายหรือขวา
function changeKGIData(direction) {
    if (direction == 'right') {
        currentKGIIndex = (currentKGIIndex + 1) % KGIData.length;
    } else if (direction == 'left') {
        currentKGIIndex = (currentKGIIndex - 1 + KGIData.length) % KGIData.length;
    }
    updateData(currentKGIIndex, 'KGI');
}

// ฟังก์ชันเพื่อเปลี่ยนข้อมูล KPI เมื่อคลิกปุ่มซ้ายหรือขวา
function changeKPIData(direction) {
    if (direction == 'right') {
        currentKPIIndex = (currentKPIIndex + 1) % KPIData.length;
    } else if (direction == 'left') {
        currentKPIIndex = (currentKPIIndex - 1 + KPIData.length) % KPIData.length;
    }
    updateData(currentKPIIndex, 'KPI');
}

function handleAjaxSuccess() {
    $('.progress').each(function () {
        const percentage = parseInt($(this).data('percentage'), 10);

        if (isNaN(percentage) || percentage < 0 || percentage > 100) {
            console.error(`Invalid percentage value: ${percentage}`);
            return;
        }
        setProgress(this, percentage);
    });
}



function setProgress(element, percentage) {
    const progressLeft = element.querySelector('.progress-left .progress-bar');
    const progressRight = element.querySelector('.progress-right .progress-bar');
    const progressValue = element.querySelector('.progress-value');

    // ดึงค่าสีจาก data attribute
    const colorLeft = $(element).data('color-left');
    const colorRight = $(element).data('color-right');
    const colorAfter = $(element).data('color-after');

    // อัปเดตสีของ progress bar
    progressRight.style.borderColor = colorRight;
    progressLeft.style.borderColor = colorLeft;

    // เปลี่ยนสีของ ::after โดยใช้ CSS custom property
    $(element).css('--color-after', colorAfter); // ใช้ CSS custom property

    // อัปเดตข้อความแสดงเปอร์เซ็นต์
    progressValue.textContent = `${percentage}%`;

    // คำนวณการหมุน
    if (percentage <= 50) {
        progressRight.style.transform = `rotate(${(percentage / 50) * 180}deg)`;
        progressLeft.style.transform = `rotate(0deg)`;
    } else {
        progressRight.style.transform = `rotate(180deg)`;
        progressLeft.style.transform = `rotate(${((percentage - 50) / 50) * 180}deg)`;
    }
}
