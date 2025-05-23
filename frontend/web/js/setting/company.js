var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;

// let sortDirection = {}; // เก็บทิศทางการ sort ของแต่ละคอลัมน์

// function sortCompany(column) {
//     alert(column);
// }

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




function filterCountryCompany(page) {
    // console.log("Page:", page); // Add this line to check the value of `page`

    const countryId = document.getElementById('countrySelect').value;
    var url = $url + 'setting/company/encode-params-country';
    // alert(page);
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: {
            countryId: countryId,
            page: page
        },
        success: function (data) {
            // window.location.href = "company-grid-filter/" + data.url;
            alert(data);
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed: " + error);
        }
    });
}


function goToPageCompany(nextPage, page, countryId) {
    // alert(page);
    // alert(nextPage);
    // alert(countryId);
    var url = $url + 'setting/company/encode-params-page';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: {
            countryId: countryId,
            page: page,
            nextPage: nextPage
        },
        success: function (data) {
            // window.location.href = "company-grid-filter/" + data.url;
            alert(data);
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed: " + error);
        }
    });
}

// window.sortDirection = {};

function sortCompany(column) {

    const table = document.getElementById('myTable');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    const getCellValue = (row, column) => {
        switch (column) {
            case 'companyName':
                return row.cells[0].innerText.trim().toLowerCase();
            case 'country':
                return row.cells[1].innerText.trim().toLowerCase();
            case 'branch':
                return parseInt(row.cells[2].innerText.trim()) || 0;
            case 'department':
                return parseInt(row.cells[3].innerText.trim()) || 0;
            case 'team':
                return parseInt(row.cells[4].innerText.trim()) || 0;
            case 'employee':
                return parseInt(row.cells[5].innerText.trim()) || 0;
            default:
                return '';
        }
    }

    // toggle direction
    sortDirection[column] = !sortDirection[column];

    rows.sort((a, b) => {
        const valA = getCellValue(a, column);
        const valB = getCellValue(b, column);

        if (typeof valA === 'number' && typeof valB === 'number') {
            return sortDirection[column] ? valA - valB : valB - valA;
        }

        return sortDirection[column] ?
            valA.localeCompare(valB) :
            valB.localeCompare(valA);
    });

    rows.forEach(row => tbody.appendChild(row)); // update order
}

// function sortCompany(field) {
//     let currentSortField = '';
//     let currentSortType = 'ASC';
//     if (currentSortField === field) {
//         currentSortType = (currentSortType === 'ASC') ? 'DESC' : 'ASC';
//     } else {
//         currentSortField = field;
//         currentSortType = 'ASC';
//     }

//     $.ajax({
//         type: 'POST',
//         url: '<?= Yii::$app->homeUrl ?>your/controller/actionCompanyGrid', // เปลี่ยนเป็นของคุณ
//         data: {
//             sortField: currentSortField,
//             sortType: currentSortType,
//             page: 1 // กลับไปหน้าแรกทุกครั้งที่ sort
//         },
//         success: function (res) {
//             $('#company-table-container').html(res); // หรือ div ที่แสดงตาราง
//         }
//     });
// }


function filterPageCompany(page, nowPage) {
    // console.log("Page:", page); // Add this line to check the value of `page`

    const countryId = document.getElementById('countrySelect').value;
    var url = $url + 'setting/company/encode-params-page';
    // alert(page);
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: {
            countryId: countryId,
            page: page,
            nowPage: nowPage
        },
        success: function (data) {
            // window.location.href = "company-grid-filter/" + data.url;
            alert(data);
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed: " + error);
        }
    });
}