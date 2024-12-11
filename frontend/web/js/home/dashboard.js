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

function loadCompanyTap(companyId) {
    var url = $baseUrl + 'home/default/company-tab';

    $.ajax({
        type: "POST",
        dataType: 'html', // รับข้อมูลเป็น HTML
        url: url,
        data: { companyId: companyId },
        success: function (data) {
            $('#tab-content-container').html(data);
            updateKFIData(currentKFIIndex);
            initializeTabContent(); // เรียกฟังก์ชันจัดการเนื้อหาใหม่
            handleAjaxSuccess()
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
            $('#tab-content-container').html(data);
            initializeTabContent(); // เรียกฟังก์ชันจัดการเนื้อหาใหม่
            handleAjaxSuccess()
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
            $('#tab-content-container').html(data);
            initializeTabContent(); // เรียกฟังก์ชันจัดการเนื้อหาใหม่
            handleAjaxSuccess()
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}


function initializeTabContent() {
    // ฟังก์ชันที่จะเรียกทุกครั้งเมื่อเนื้อหาใหม่ถูกโหลด
    updateKPIData(currentKPIIndex);
    updateKGIData(currentKGIIndex);
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


// ฟังก์ชันเพื่ออัปเดตข้อมูล KFI บนหน้าเว็บ
function updateKFIData(index) {
    const data = KFIData[index];
    // อัปเดตเปอร์เซ็นต์ใน progress bar
    document.getElementById('KFI-progress').setAttribute('data-percentage', data.percentage);
    document.querySelector('.progress-value').innerText = data.percentage + '%';
    // อัปเดตค่า target และ result
    document.getElementById('KFI-name-0').innerText = data.name;
    document.getElementById('KFI-target-0').innerText = data.target;
    document.getElementById('KFI-result-0').innerText = data.result;
    document.getElementById('KFI-last-0').innerText = data.last; // อัปเดตวันที่ Last Updated
    document.getElementById('KFI-due-0').innerText = data.due; // อัปเดตวันที่ Due Update Date
}

// เริ่มแสดงข้อมูลชุดแรก

// ฟังก์ชันเพื่ออัปเดตข้อมูล KGI บนหน้าเว็บ
function updateKGIData(index) {
    const data = KGIData[index];
    // อัปเดตเปอร์เซ็นต์ใน progress bar
    document.getElementById('KGI-progress').setAttribute('data-percentage', data.percentage);
    document.querySelector('.progress-value').innerText = data.percentage + '%';
    // อัปเดตค่า target และ result
    document.getElementById('KGI-name-0').innerText = data.name;
    document.getElementById('KGI-target-0').innerText = data.target;
    document.getElementById('KGI-result-0').innerText = data.result;
    document.getElementById('KGI-last-0').innerText = data.last; // อัปเดตวันที่ Last Updated
    document.getElementById('KGI-due-0').innerText = data.due; // อัปเดตวันที่ Due Update Date
}

// ฟังก์ชันเพื่ออัปเดตข้อมูล KPI บนหน้าเว็บ
function updateKPIData(index) {

    const data = KPIData[index];
    // อัปเดตเปอร์เซ็นต์ใน progress bar
    document.getElementById('KPI-progress').setAttribute('data-percentage', data.percentage);
    document.querySelector('.progress-value').innerText = data.percentage + '%';
    // อัปเดตค่า target และ result
    document.getElementById('KPI-name-0').innerText = data.name;
    document.getElementById('KPI-target-0').innerText = data.target;
    document.getElementById('KPI-result-0').innerText = data.result;
    document.getElementById('KPI-last-0').innerText = data.last; // อัปเดตวันที่ Last Updated
    document.getElementById('KPI-due-0').innerText = data.due; // อัปเดตวันที่ Due Update Date
}



// ฟังก์ชันเพื่อเปลี่ยนข้อมูล KFI เมื่อคลิกปุ่มซ้ายหรือขวา
function changeKFIData(direction) {
    if (direction === 'right') {
        currentKFIIndex = (currentKFIIndex + 1) % KFIData.length;
    } else if (direction === 'left') {
        currentKFIIndex = (currentKFIIndex - 1 + KFIData.length) % KFIData.length;
    }
    updateKFIData(currentKFIIndex);
}


// ฟังก์ชันเพื่อเปลี่ยนข้อมูล KGI เมื่อคลิกปุ่มซ้ายหรือขวา
function changeKGIData(direction) {
    if (direction === 'right') {
        currentKGIIndex = (currentKGIIndex + 1) % KGIData.length;
    } else if (direction === 'left') {
        currentKGIIndex = (currentKGIIndex - 1 + KGIData.length) % KGIData.length;
    }
    updateKGIData(currentKGIIndex);
}


// ฟังก์ชันเพื่อเปลี่ยนข้อมูล KPI เมื่อคลิกปุ่มซ้ายหรือขวา
function changeKPIData(direction) {

    if (direction === 'right') {
        currentKPIIndex = (currentKPIIndex + 1) % KPIData.length;
    } else if (direction === 'left') {
        // alert('5555');
        currentKPIIndex = (currentKPIIndex - 1 + KPIData.length) % KPIData.length;
    }
    updateKPIData(currentKPIIndex);
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


// function formatNumber($number) {
//     if ($number >= 1000000) {
//         return number_format($number / 1000000, 2). ' M'; // For millions
//     } elseif($number >= 1000) {
//         return number_format($number / 1000, 2). ' K'; // For thousands
//     }
//     return number_format($number, 2); // For smaller numbers
// }