var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;

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
    if (confirm("Are you sure to delete this department?")) {
        var url = $url + 'setting/department/delete-department';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { departmentId: departmentId },
            success: function (data) {
                if (data.status) {
                    $("#department-" + departmentId).hide(200);
                } else {
                    alert("Can not delete this branch.");
                }

            }
        });
    }
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
            $('#departmentModal').modal('show');
        },
        error: function () {
            $('#departmentModalBody').html('<p class="text-danger">Failed to load content.</p>');
            $('#departmentModal').modal('show');
        }
    });
}



function openModalDeleteDepartment(url) {
    // $('#departmentDeleteModal').html(url);
    // $('#departmentDeleteModal').modal('show');
    // alert(url);
    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            // alert(response);
            $('#departmentDeleteModal').html(response);
            $('#departmentDeleteModal').modal('show');
        },
        error: function () {
            $('#departmentDeleteModal').html('<p class="text-danger">Failed to load content.</p>');
            $('#departmentDeleteModal').modal('show');
        }
    });

    // $.ajax({
    //     url: url,
    //     type: 'GET',
    //     success: function (response) {
    //         $('#departmentModalBody').html(response);
    //         $('#departmentModal').modal('show');
    //     },
    //     error: function () {
    //         $('#departmentModalBody').html('<p class="text-danger">Failed to load content.</p>');
    //         $('#departmentModal').modal('show');
    //     }
    // });
}

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
    var modalurl = $url + 'setting/department/modal-delete';
    // alert(modalurl);
    departments.forEach(dept => {
        const html = `
        <li class="schedule-item" data-id="${dept.departmentId}" style="padding: 13px 20px; background-color: #FFFFFF;">
            <div class="row align-items-center dept-name">
                <div class="col-10 dept-label" style="font-weight: 600; font-size: 16px;">
                    ${dept.departmentName}
                </div>
                <div class="col-2 text-end">
                    <a  onclick="openModalDeleteDepartment('${modalurl}')" class="no-underline icon-delete">
                        <img src="/HRVC/frontend/web/images/icons/Settings/binred.svg" alt="Delete"
                            class="pim-icon bin-icon transition-icon">
                    </a>
                    <a href="#" class="no-underline icon-edit">
                        <img src="/HRVC/frontend/web/image/edit-blue.svg" alt="Edit"
                            class="pim-icon edit-icon transition-icon" style="margin-top: -3px;">
                        <span class="text-blue edit-label transition-label" style="font-weight: 500;">Edit</span>
                    </a>
                </div>
            </div>
        </li>`;
        container.insertAdjacentHTML('beforeend', html);
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
            alert(data);
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