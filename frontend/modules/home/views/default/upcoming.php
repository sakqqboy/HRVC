<ul id="schedule-list" class="list-unstyled small">
    <!-- รายการที่ได้จาก REST API จะถูกเพิ่มที่นี่ -->
</ul>

<script>
$(document).ready(function() {
    restData(); // เรียกฟังก์ชันเพื่อโหลดข้อมูลเมื่อหน้าเพจพร้อม
});

var $baseUrl = window.location.protocol + "//" + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
var $url = $baseUrl;

function restData() {
    var url = $url + `home/dashboard/upcoming-schedule`;

    $.ajax({
        type: "POST",
        dataType: 'JSON',
        url: url,
        success: function(data) {
            console.log("Received data:", data); // Check the structure in the console

            // Check if data has properties or nested arrays
            if (data && typeof data === 'object') {
                // If the data has a property that is an array, extract it.
                // Example: if the data has a 'schedules' key that contains the array
                var schedules = data.schedules || Object.values(data); // Adjust the property name if needed

                if (Array.isArray(schedules)) {
                    // alert(schedules.length); // Now data is an array
                    renderSchedule(schedules); // Pass the array to the render function
                } else {
                    alert("No schedules array found in the data.");
                }
            } else {
                alert("Unexpected data format.");
            }
        },
        error: function(error) {
            console.error("Error fetching data:", error);
        }
    });
}



function renderSchedule(data) {
    var $scheduleList = $("#schedule-list");
    $scheduleList.empty(); // ลบรายการเดิมออกก่อน

    try {
        // ตรวจสอบว่า data เป็น JSON String หรือออบเจกต์
        if (typeof data == "string") {
            data = JSON.parse(data); // แปลง JSON String เป็นออบเจกต์
        }
        // alert(data.length);

        console.log("Data:", data); // แสดงโครงสร้างของข้อมูลใน Console

        // แปลงออบเจกต์ให้เป็นอาร์เรย์หากยังไม่ใช่
        if (!Array.isArray(data)) {
            data = Object.values(data);
        }

        // ตรวจสอบว่ามีข้อมูลในอาร์เรย์หรือไม่
        if (data.length > 0) {
            // alert(JSON.stringify(data));
            // console.log(data.length);
            // alert(data.length);
            var count = 0;
            data.forEach(function(item) {
                // ดึงข้อมูลแต่ละค่า
                var title = item.title && item.title.trim() ? item.title : "Update";
                var description = item.description || "No description available";
                var time = item.time || "No time specified";
                var createDate = item.createDate || "No date specified";
                var page = item.page || "No Data";
                var type = item.type || "No Data";
                var id = item.id || "No Data";
                var historyId = item.historyId || "No Data";
                var typeId = item.typeId || "No Data";
                // ตรวจสอบว่า id, historyId และ typeId มีค่า ไม่ใช่ "No Data"
                if (id != "No Data" && historyId != "No Data" && typeId != "No Data") {
                    // สร้างรายการ HTML
                    var listItem = `
                        <li class="schedule-item mt-5" role="button" tabindex="0" onclick="handleItemClick('${page}', '${type}', '${id}', '${historyId}', '${typeId}')">
                            <strong>${title}</strong> - ${description}<br>
                            <span class="text-muted">${time}, ${createDate}</span>
                        </li>
                    `;
                    $scheduleList.append(listItem);
                }
            });

        } else {
            $scheduleList.append('<li class="text-muted">No schedule available.</li>');
        }
    } catch (error) {
        console.error("Error processing data:", error);
        $scheduleList.append('<li class="text-muted">No schedule available.</li>');
    }
}

function handleItemClick(page, type, id, historyId, typeId) {
    // alert(`page: ${page}\n type: ${type}\n id: ${id}\n historyId: ${historyId}\n typeId: ${typeId}`);
    // page = 'kfi';
    var url = $url + `home/dashboard/endcode-upcomming`;
    // alert(url);
    $.ajax({
        type: "POST",
        dataType: 'JSON',
        url: url,
        data: {
            id: id,
            historyId: historyId,
            typeId: typeId,
            page: page,
            type: type
        },
        success: function(data) {
            // alert(JSON.stringify(data));
            param = data.param;
            part = data.part;
            // alert(param);
            // alert(part);
            const kpiUrl = $url + part + param;
            // alert(kpiUrl);
            window.location.href = kpiUrl;
        },
    });
}
</script>