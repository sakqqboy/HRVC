var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
let modalTestCallCount = 0;

function showTitleList(departmentId) {
    var url = $url + 'setting/department/title-list';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { departmentId: departmentId },
        success: function (data) {
            $("#title-list-" + departmentId).show();
            $("#title-list-" + departmentId).html(data.titleList);
        }
    });

}

function closeTitleList(departmentId) {
    $("#title-list-" + departmentId).css("display", "none");
}

function createDepartment() {
    var companyId = $("#company").val();
    var branchId = $("#branch").val();
    var departmentName = $("#departmentName").val();
    if ($.trim(departmentName) == '') {
        alert("Department name can not be null");
    } else if (companyId == '' || companyId == null) {
        alert('Please select company');
    } else if (branchId == '' || branchId == null) {
        alert('Please select branch');
    } else {
        var url = $url + 'setting/department/save-create-department';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { branchId: branchId, companyId: companyId, departmentName: departmentName },
            success: function (data) {
                if (data.status) {
                    $("#branch").val('');
                    $("#departmentName").val('');
                    $("#all-department-list").prepend(data.newDepartment);
                } else {
                    alert(data.errorText);
                }
            }
        });
    }
}

function goToPageDepartment(nextPage, page, countryId) {
    // alert(page);
    // alert(nextPage);
    // alert(countryId);
    var url = $url + 'setting/department/encode-params-page';
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

function updateDepartment(departmentId) {
    var url = $url + 'setting/department/update-department';
    $("#departmentId").val(departmentId);
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { departmentId: departmentId },
        success: function (data) {
            $("#create-department").css("display", "none");
            $("#update-department").show();
            $("#reset-department").show();
            $("#department").val(data.branchId);
            $("#branch").html(data.branchText);
            $("#branch").val(data.branchId);
            $("#company").val(data.companyId);
            $("#departmentName").val(data.departmentName);
        }
    });
}


$("#update-department").click(function (e) {
    var url = $url + 'setting/department/save-update-department';
    var departmentName = $("#departmentName").val();
    var branchId = $("#branch").val();
    var companyId = $("#company").val();
    var departmentId = $("#departmentId").val();
    if ($.trim(departmentName) == '') {
        alert("Branch name can not be null");
    } else if (companyId == '' || companyId == null) {
        alert('Please select company');
    } else if (branchId == '' || branchId == null) {
        alert('Please select branch');
    } else {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { departmentName: departmentName, branchId: branchId, companyId: companyId, departmentId: departmentId },
            success: function (data) {
                if (data.status) {
                    $("#departmentId").val('');
                    $("#departmentName").val('');
                    $("#branch").val('');
                    $("#update-department").css("display", "none");
                    $("#reset-department").css("display", "none");
                    $("#create-department").show();
                    $("#department-" + departmentId).html('');
                    $("#department-" + departmentId).html(data.updateDepartment);
                } else {
                    alert("Can't create duplicate department name.");
                }
            }
        });
    }
});
$("#reset-department").click(function (e) {
    $("#departmentId").val('');
    $("#departmentName").val('');
    $("#branch").val('');
    $("#update-department").css("display", "none");
    $("#reset-department").css("display", "none");
    $("#create-department").show();
});

function deleteDepartment(departmentId) {
    var url = $url + 'setting/department/delete-department';
    $.ajax({
        url: url,
        type: 'POST',
        data: { departmentId: departmentId },
        success: function (response) {
            // สมมุติว่า server ส่ง JSON กลับมา
            // เช่น { success: true, departments: [...] }
            if (response.success && response.departments) {
                openCloseModal();
                renderDepartmentList(response.departments); // อัปเดตรายการ department
            } else {
                alert(response.message || 'ไม่สามารถลบได้');
            }
        }
    });
}

function modalTest(departmentId) {
    var url = $url + 'setting/department/modal-test';
    $.ajax({
        url: url,
        type: 'POST',
        data: { departmentId: departmentId },
        success: function (response) {
            if (response.success && response.departments) {
                renderDepartmentList(response.departments); // อัปเดตรายการ department
            } else {
                alert(response.message || 'ไม่สามารถลบได้');
            }
        }
    });
}

function sortDepartment(column) {

    const table = document.getElementById('myTable');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    const getCellValue = (row, column) => {
        switch (column) {
            case 'brachName':
                return parseInt(row.cells[2].innerText.trim()) || 0;
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


function filterCountryDepartment(page) {
    // console.log("Page:", page); // Add this line to check the value of `page`

    const countryId = document.getElementById('countrySelect').value;
    const companyId = document.getElementById('companySelect').value;
    const branchId = document.getElementById('branchSelect').value;
    // nextPage = 1;
    // alert(page);
    // alert(nextPage);
    // alert(countryId);
    // alert(companyId);
    var url = $url + 'setting/department/encode-params-country';
    // alert(page);
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: {
            countryId: countryId,
            companyId: companyId,
            branchId: branchId,
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

function openPopupModalDepartment(url) {
    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            $('#departmentModalBody').html(response);

            $('#departmentDeleteModal').html('');
            $('#departmentModal').modal('show');
        },
        error: function () {
            $('#departmentModalBody').html('<p class="text-danger">Failed to load content.</p>');
            $('#departmentModal').modal('show');
        }
    });
}

function openModalDeleteDepartment(departmentId) {
    var url = $url + 'setting/department/modal-delete';
    // alert(modalurl);
    $.ajax({
        url: url,
        type: 'GET',
        data: { departmentId: departmentId },
        success: function (response) {
            // alert(response);
            document.getElementById('departmentModal').style.opacity = '0.1';
            document.getElementById('departmentModal').style.pointerEvents = 'none';
            $('#departmentDeleteModal').html(response);
            $('#departmentDeleteModal').modal('show');
        },
        error: function () {
            $('#departmentDeleteModal').html('<p class="text-danger">Failed to load content.</p>');
            $('#departmentDeleteModal').modal('show');
        }
    });
}

function openCloseModal() {
    document.getElementById('departmentModal').style.opacity = '1';
    document.getElementById('departmentModal').style.pointerEvents = 'auto';
    // $('#departmentDeleteModal').html(response);
    $('#departmentDeleteModal').modal('hide');
}

$('#departmentDeleteModal').on('hidden.bs.modal', function () {
    openCloseModal();
});


function actionSaveDepartment(branchId, deptName) {
    // alert(branchId);
    // alert(deptName);
    var url = $url + 'setting/department/save-department';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { branchId: branchId, deptName: deptName },
        success: function (data) {
            if (data.success && data.departments) {
                renderDepartmentList(data.departments); // เรียกฟังก์ชันวาด HTML ใหม่
            } else {
                alert('ไม่สามารถบันทึกได้');
            }
        }
    });

}

function updateModalContent(departmentId) {
    // เปลี่ยน title
    const modalTitle = document.querySelector('#staticBackdrop4Label');
    if (modalTitle) {
        modalTitle.innerHTML = `
            <img src="${$url}images/icons/Settings/warning.svg" alt="Warning"
                style="width: 24px; height: 24px; margin-right: 8px;">
            Deletion Warning
        `;
    }

    // เปลี่ยน body
    const modalBody = document.querySelector('.modal-body');
    if (modalBody) {
        modalBody.innerHTML = `Are you sure you want to delete this department? Once deleted, it cannot be restored. However, you can always create a new department if needed.`;
    }

    // เปลี่ยน footer
    const modalFooter = document.querySelector('.modal-footer');
    if (modalFooter) {
        modalFooter.innerHTML = `
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                style="width: 100px; display: flex; align-items: center; justify-content: center; background: #2580D3; border: none; color: white;"
                onclick="openCloseModal()">
                <img src="${$url}images/icons/Settings/cancle.svg" alt="Cancel"
                    style="width: 14px; height: 14px; margin-right: 5px;">
                Cancel
            </button>
            <a href="javascript:deleteDepartment('${departmentId}')" class="btn btn-outline-danger"
                style="width: 100px; display: flex; align-items: center; justify-content: center; margin-left: 10px;"
                onmouseover="this.querySelector('.pim-icon').src='${$url}images/icons/Settings/binwhite.svg'"
                onmouseout="this.querySelector('.pim-icon').src='${$url}images/icons/Settings/binred.svg'">
                <img src="${$url}images/icons/Settings/binred.svg" alt="Delete" class="pim-icon"
                    style="width: 14px; height: 14px; margin-right: 5px;">
                Delete
            </a>
        `;
    }
}


function updateDepartmentName(departmentId, departmentName) {
    // $("#departmentId").val(departmentId);
    // alert(departmentId);
    // alert(departmentName);
    var url = $url + 'setting/department/update-department';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { departmentId: departmentId, departmentName: departmentName },
        success: function (data) {
            if (data.success && data.departments) {
                // alert('บันทึกสำเร็จ');
                renderDepartmentList(data.departments); // เรียกฟังก์ชันวาด HTML ใหม่
            } else {
                // alert('ไม่สามารถบันทึกได้');
                alert(data.message);
            }
        }
    });
}

function renderDepartmentList(departments) {
    // alert(departments);
    const container = document.getElementById('schedule-list');

    container.innerHTML = '';
    departments.forEach(dept => {
        const html = `
        <li class="schedule-item" data-id="${dept.departmentId}" style="padding: 13px 20px; background-color: #FFFFFF;">
            <div class="row align-items-center dept-name">
                <div class="col-10 dept-label" style="font-weight: 600; font-size: 16px;">
                    ${dept.departmentName}
                </div>
                <div class="col-2 text-end">
                    <a  onclick="openModalDeleteDepartment('${dept.departmentId}')" class="no-underline icon-delete">
                        <img src="/HRVC/frontend/web/images/icons/Settings/binred.svg" alt="Delete"
                            class="pim-icon bin-icon transition-icon">
                    </a>
                    <a href="#" class="no-underline icon-edit" onclick="handleEditClick(event, this)">
                        <img src="/HRVC/frontend/web/image/edit-blue.svg" alt="Edit"
                            class="pim-icon edit-icon transition-icon" style="margin-top: -3px;">
                        <span class="text-blue edit-label transition-label" style="font-weight: 500;">Edit</span>
                    </a>
                </div>
            </div>
        </li>`;
        container.insertAdjacentHTML('beforeend', html);
    });


    // ดึงเฉพาะ li ที่ต้องการให้ทำงานอัตโนมัติ
    const targetDeptId = document.getElementById('departmentId')?.value;
    const targetLi = container.querySelector(`li[data-id="${targetDeptId}"]`);

    if (targetDeptId) {
        const editBtn = targetLi.querySelector('.icon-edit');
        handleEditClick(null, editBtn); // ส่ง null แทน event, แล้วให้ handleEditClick จัดการเอง
    }

}


function handleEditClick(e, element) {
    if (e) e.preventDefault();

    const li = element.closest('li');
    const deptId = li.getAttribute('data-id');
    const deptName = li.querySelector('.dept-label').textContent.trim();

    li.style.display = 'none';
    originalLi = li;
    currentEditingId = deptId;

    const inputHTML = `
        <li class="edit-temp-item mt-30" data-id="${deptId}">
            <div class="input-group">
                <input type="text" name="departmentNameList" id="editDeptInputlist" value="${deptName}" class="form-control dep-${deptId}"
                    placeholder="Write department name">
                <span class="input-group-text" id="enterHintlist" style="background-color: #ffff; border-left: none;">
                    <div class="city-crad-company" id="hintTextlist" style="color: #ffffff; background-color: #2580D3;">
                        <img src="/HRVC/frontend/web/image/enter-white.svg" style="width: 24px; height: 24px;">
                        Enter to Save
                    </div>
                </span>
            </div>
        </li>`;

    // alert(deptId);
    // $(".dep-" + deptId).first().focus();
    // document.querySelector('.dep-' + deptId).focus();

    li.insertAdjacentHTML('afterend', inputHTML);

    const input = document.getElementById('editDeptInputlist');
    // input.focus();
    setTimeout(() => {
        input.focus();
        input.setSelectionRange(input.value.length, input.value.length); // ให้เคอร์เซอร์อยู่ท้ายข้อความ
    }, 500);

    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            $('#departmentModal').modal('hide');
            saveEdit(input.value.trim());
            location.reload(); // รีเฟรชหน้าทันทีหลังจากกด Enter
        }
    });

    input.addEventListener('blur', function () {
        cancelEdit(input.value.trim());
    });
    const targetDeptIdInput = document.getElementById('departmentId');
    const targetDeptId = targetDeptIdInput?.value;

    // if (targetDeptId) {
    //     if (modalTestCallCount <= 2) {
    //         modalTest(targetDeptId);
    //         modalTestCallCount++; // เพิ่มจำนวนครั้งที่เรียก modalTest
    //         console.log('modalTest called ' + modalTestCallCount + ' times');
    //     }
    // }
}

function initDepartmentSearch(inputId = 'Search', listSelector = '#schedule-list .schedule-item') {
    const searchInput = document.getElementById(inputId);
    if (!searchInput) return;

    searchInput.addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        const items = document.querySelectorAll(listSelector);

        items.forEach(item => {
            const name = item.querySelector('.col-10')?.textContent.toLowerCase() || '';
            item.style.display = name.includes(keyword) ? 'block' : 'none';
        });
    });
}



function openConfirmModal() {
    // ทำให้ modal แรก fade หรือ blur
    // document.getElementById('departmentModalBody').style.opacity = '0.3';
    // document.getElementById('departmentModalBody').style.pointerEvents = 'none';

    // เปิด modal ที่สอง
    const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
    confirmModal.show();

    // เมื่อ modal ยืนยันถูกปิด ให้คืนค่าป็อปอัพแรกกลับมา
    document.getElementById('confirmModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById('mainModalContent').style.opacity = '1';
        document.getElementById('mainModalContent').style.pointerEvents = 'auto';
    }, { once: true });
}


function cancelEdit(newValue) {
    if (currentEditingId) {
        // เปลี่ยนข้อความใน li เดิม
        const label = originalLi.querySelector('.dept-label');
        label.textContent = newValue || label.textContent;
        // ลบ input และคืน li
        const inputLi = document.querySelector('.edit-temp-item');
        if (inputLi) inputLi.remove();
        if (originalLi) originalLi.style.display = '';
        currentEditingId = null;
        originalLi = null;
    }
}

function saveEdit(newValue) {
    if (!currentEditingId || !originalLi) return;
    // cancelEdit(newValue);
    // 🟡 ส่งข้อมูลกลับเซิร์ฟเวอร์ได้ตรงนี้ ถ้าต้องการ update จริง
    // alert(newValue);
    updateDepartmentName(currentEditingId, newValue);
}

function goToPageDepartment(nextPage, page, countryId, companyId, branchId) {
    // alert(page);
    // alert(nextPage);
    // alert(countryId);
    // alert(companyId);
    // alert(branchId);
    var url = $url + 'setting/department/encode-params-page';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: {
            countryId: countryId,
            companyId: companyId,
            branchId: branchId,
            page: page,
            nextPage: nextPage
        },
        success: function (data) {
            // window.location.href = "company-grid-filter/" + data.url;
            // alert(data);
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed: " + error);
        }
    });
}


function savetitleList(departmentId, titleId) {
    if ($("#title-" + titleId + "-" + departmentId).prop("checked") == true) {
        var check = 1;
    } else {
        var check = 0;
    }
    var url = $url + 'setting/department/save-department-title';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { departmentId: departmentId, titleId: titleId, check: check },
        success: function (data) {
            $("#title-department-" + departmentId).html(data.departmentTitle);
        }
    });
}
function filterDepartment() {
    var companyId = $("#company-team-filter").val();
    var branchId = $("#branch-team-filter").val();
    var url = $url + 'setting/department/filter-department';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId, branchId: branchId },
        success: function (data) {

        }
    });
}


function addDepartmentInput() {
    // alert('Button clicked!');
    const container = document.getElementById('departmentInputsContainer');

    const newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.name = 'departmentName[]';
    newInput.className = 'form-control mb-2';
    newInput.style.width = '330px';
    newInput.placeholder = 'Write the name of the Department ';

    container.appendChild(newInput);
}