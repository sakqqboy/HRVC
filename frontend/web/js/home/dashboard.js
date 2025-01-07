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

    const dataType = data[type];
    if (dataType && dataType[index]) {
        const item = dataType[index]; // ดึงข้อมูลจากดัชนีที่เลือก
        const percentage = item.percentage;

        // อัปเดต stroke-dasharray ของ Progress Bar
        const progressPath = document.getElementById(`${type}-progress`);
        const radius = 15.9155; // รัศมีของวงกลม
        const circumference = 2 * Math.PI * radius; // เส้นรอบวง
        const offset = circumference - (percentage / 100) * circumference;

        // ตั้งค่า stroke-dasharray สำหรับความยาวเต็มของเส้น
        progressPath.style.strokeDasharray = `${circumference}`;
        progressPath.style.strokeDashoffset = `${circumference}`; // เริ่มต้นจาก 0%

        // อัปเดตข้อความเปอร์เซ็นต์ใน <text>
        const percentageText = document.getElementById(`${type}-percentage`);
        percentageText.textContent = `${percentage}%`;

        // เริ่มแอนิเมชันหลังจากเลื่อนค่า
        setTimeout(() => {
            progressPath.style.transition = "stroke-dashoffset 1s ease-out";
            progressPath.style.strokeDashoffset = `${offset}`; // เปลี่ยนค่า offset ตามเปอร์เซ็นต์

            // อัปเดตข้อมูลอื่น ๆ
            document.getElementById(`${type}-name-0`).innerText = item.name;
            document.getElementById(`${type}-target-0`).innerText = item.target;
            document.getElementById(`${type}-result-0`).innerText = item.result;
            document.getElementById(`${type}-last-0`).innerText = item.last || '-';
            document.getElementById(`${type}-due-0`).innerText = item.due || '-';

            const nameElement = document.getElementById(`${type}-name-0`);
            const targetElement = document.getElementById(`${type}-target-0`);
            const resultElement = document.getElementById(`${type}-result-0`);

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
                }, 200); // ระยะเวลา animation (200ms)
            }, 200); // ระยะเวลา animation เลื่อนออก (200ms)
        }, 200); // ระยะเวลา animation เลื่อนออก (200ms)
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
