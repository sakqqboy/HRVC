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
// let direction = '';

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
            // alert(error);
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
            // alert(error);
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
            // alert(error);
            console.error('Error:', error);
        }
    });
}


function updateData(index, type, direction) {
    const data = {
        'KFI': KFIData,
        'KGI': KGIData,
        'KPI': KPIData
    };
    // alert(index);

    const dataType = data[type];
    if (dataType && dataType[index]) {
        const item = dataType[index]; // ดึงข้อมูลจากดัชนีที่เลือก
        // alert(direction);
        // อัปเดตข้อมูล Progress Bar
        const percentage = item.percentage;
        // const percentage = 60;

        // อัปเดต stroke-dasharray ของ Progress Bar
        const progressPath = document.getElementById(`${type}-progress`);
        const dashArrayValue = `${percentage}, 100`;
        progressPath.setAttribute("stroke-dasharray", dashArrayValue);

        // อัปเดตข้อความเปอร์เซ็นต์ใน <text>
        const percentageText = document.getElementById(`${type}-percentage`);
        // alert(percentage);
        percentageText.textContent = `${percentage}%`;

        // const progressElement = document.getElementById(`${type}-progress`);
        // progressElement.setAttribute('data-percentage', item.percentage);
        // setProgress(progressElement, item.percentage);

        document.getElementById(`${type}-name-0`).innerText = item.name;
        document.getElementById(`${type}-target-0`).innerText = item.target;
        document.getElementById(`${type}-result-0`).innerText = item.result;
        document.getElementById(`${type}-last-0`).innerText = item.last || '-';
        document.getElementById(`${type}-due-0`).innerText = item.due || '-';

        const nameElement = document.getElementById(`${type}-name-0`);
        const targetElement = document.getElementById(`${type}-target-0`);
        const resultElement = document.getElementById(`${type}-result-0`);

        // alert(nameElement);

        // กำหนดคลาสสำหรับเลื่อนเข้าและเลื่อนออกตามทิศทาง
        const outClass = direction == 'right' ? 'slide-out-animation-left' : 'slide-out-animation-right';
        const inClass = direction == 'right' ? 'slide-in-animation-left' : 'slide-in-animation-right';

        // เพิ่มคลาสสำหรับเลื่อนออก
        targetElement.classList.add(outClass);
        resultElement.classList.add(outClass);
        nameElement.classList.add(outClass);

        setTimeout(() => {
            // อัปเดตข้อความใหม่
            targetElement.innerText = item.target;
            resultElement.innerText = item.result;
            nameElement.innerText = item.name;

            // ลบคลาสเลื่อนออกและเพิ่มคลาสเลื่อนเข้า
            targetElement.classList.remove(outClass);
            resultElement.classList.remove(outClass);
            nameElement.classList.remove(outClass);


            targetElement.classList.add(inClass);
            resultElement.classList.add(inClass);
            nameElement.classList.add(inClass);
            // ลบคลาสเลื่อนเข้าเมื่อ animation เสร็จสิ้น
            setTimeout(() => {
                targetElement.classList.remove(inClass);
                resultElement.classList.remove(inClass);
                nameElement.classList.remove(inClass);
            }, 200); // ระยะเวลา animation (500ms)
        }, 200); // ระยะเวลา animation เลื่อนออก (500ms)

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

    // เรียกใช้ฟังก์ชัน updateData เพื่อนำข้อมูลไปแสดงผล
    updateData(currentKFIIndex, 'KFI', direction);
}

// ฟังก์ชันเพื่อเปลี่ยนข้อมูล KGI เมื่อคลิกปุ่มซ้ายหรือขวา
function changeKGIData(direction) {
    if (direction == 'right') {
        currentKGIIndex = (currentKGIIndex + 1) % KGIData.length;
    } else if (direction == 'left') {
        currentKGIIndex = (currentKGIIndex - 1 + KGIData.length) % KGIData.length;
    }
    updateData(currentKGIIndex, 'KGI', direction);
}

// ฟังก์ชันเพื่อเปลี่ยนข้อมูล KPI เมื่อคลิกปุ่มซ้ายหรือขวา
function changeKPIData(direction) {
    if (direction == 'right') {
        currentKPIIndex = (currentKPIIndex + 1) % KPIData.length;
    } else if (direction == 'left') {
        currentKPIIndex = (currentKPIIndex - 1 + KPIData.length) % KPIData.length;
    }
    updateData(currentKPIIndex, 'KPI', direction);
}

// function handleAjaxSuccess() {
//     $('.progress').each(function () {
//         const percentage = parseInt($(this).data('percentage'), 10);

//         if (isNaN(percentage) || percentage < 0 || percentage > 100) {
//             console.error(`Invalid percentage value: ${percentage}`);
//             return;
//         }
//         setProgress(this, percentage);
//     });
// }


// function setProgress(element, percentage) {
//     const progressLeft = element.querySelector('.progress-left .progress-bar');
//     const progressRight = element.querySelector('.progress-right .progress-bar');
//     const progressValue = element.querySelector('.progress-value');

//     // ดึงค่าสีจาก data attribute
//     const colorLeft = $(element).data('color-left');
//     const colorRight = $(element).data('color-right');
//     const colorAfter = $(element).data('color-after');

//     // อัปเดตสีของ progress bar
//     progressRight.style.borderColor = colorRight;
//     progressLeft.style.borderColor = colorLeft;

//     // เปลี่ยนสีของ ::after โดยใช้ CSS custom property
//     $(element).css('--color-after', colorAfter);

//     // เพิ่มเอฟเฟกต์เลื่อนค่าเปอร์เซ็นต์
//     progressValue.style.opacity = 0; // ซ่อนข้อความเก่าชั่วคราว
//     // progressValue.style.transform = 'translateY(-10px)'; // ขยับข้อความขึ้น
//     setTimeout(() => {
//         progressValue.textContent = `${percentage}%`; // เปลี่ยนข้อความใหม่
//         progressValue.style.opacity = 1; // แสดงข้อความใหม่
//         // progressValue.style.transform = 'translateY(0)'; // กลับมาตำแหน่งเดิม
//     }, 300); // เวลาที่ตรงกับ transition ใน CSS

//     // คำนวณการหมุน
//     if (percentage <= 50) {
//         progressRight.style.transform = `rotate(${(percentage / 50) * 180}deg)`;
//         progressLeft.style.transform = `rotate(0deg)`;
//     } else {
//         progressRight.style.transform = `rotate(180deg)`;
//         progressLeft.style.transform = `rotate(${((percentage - 50) / 50) * 180}deg)`;
//     }
// }

