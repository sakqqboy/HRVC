var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
$('#teamModal').on('hidden.bs.modal', function () {
    location.reload(); // รีเฟรชหน้า
});

function branchCompany() {
    var companyId = $("#company-team").val();
    // alert(companyId);
    var url = $url + 'setting/team/company-branch';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId },
        success: function (data) {
            $("#branch-team").removeAttr("disabled", "true");
            $("#branch-team").html(data.textSelect);
        }
    });
}
function branchCompany2() {
    var companyId = $("#company-team2").val();
    var url = $url + 'setting/team/company-branch';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId },
        success: function (data) {
            $("#branch-team2").removeAttr("disabled", "true");
            $("#branch-team2").html(data.textSelect);
        }
    });
}

function departmentBranch() {
    var branchId = $("#branch-team").val();
    // alert(branchId);
    var url = $url + 'setting/team/branch-department';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { branchId: branchId },
        success: function (data) {
            $("#department-team").removeAttr("disabled", "true");
            $("#department-team").html(data.textSelect);
        }
    });
}

function teamDepartment() {
    var departmentId = $("#department-team").val();
    // alert(departmentId);
    var url = $url + 'setting/team/department-team';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { departmentId: departmentId },
        success: function (data) {
            $("#team-department").removeAttr("disabled", "true");
            $("#team-department").html(data.textSelect);
            $("#title-department").removeAttr("disabled", "true");
            $("#title-department").html(data.textSelectTitle);
        }
    });
}

function branchCompanyFilter() {
    var companyId = $("#company-team-filter").val();
    var url = $url + 'setting/team/company-branch';
    $("#department-team-filter").attr("disabled", "true");
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId },
        success: function (data) {
            $("#branch-team-filter").removeAttr("disabled", "true");
            $("#branch-team-filter").html(data.textSelect);
        }
    });
}

function departmentBranchFilter() {
    var branchId = $("#branch-team-filter").val();
    var url = $url + 'setting/team/branch-department';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { branchId: branchId },
        success: function (data) {
            $("#department-team-filter").removeAttr("disabled", "true");
            $("#department-team-filter").html(data.textSelect);
        }
    });
}

function teamDepartmentFilter() {
    var departmentId = $("#department-team-filter").val();
    var url = $url + 'setting/team/department-team';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { departmentId: departmentId },
        success: function (data) {
            $("#team-department-filter").removeAttr("disabled", "true");
            $("#team-department-filter").html(data.textSelect);
        }
    });
}

function saveCreateTeam() {
    var branchId = $("#branch-team").val();
    var companyId = $("#company-team").val();
    var departmentId = $("#department-team").val();
    var teamName = $("#teamName").val();
    var fag = 1;
    var textError = '';
    if (companyId == '') {
        fag = 0;
        textError = 'Please select Company';
    } else if (branchId == '') {
        fag = 0;
        textError = 'Please select Branch';
    } else if (departmentId == '') {
        fag = 0;
        textError = 'Please select Department';
    } else if ($.trim(teamName) == '') {
        fag = 0;
        textError = 'Team name can not be null';
    }
    if (fag = 0) {
        alert(textError);
    } else {
        var url = $url + 'setting/team/save-create-team';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { departmentId: departmentId, teamName: teamName },
            success: function (data) {
                if (data.status) {

                    $("#company-team").val('');
                    $("#branch-team").val('');
                    $("#branch-team").attr("disabled", "true");
                    $("#department-team").val('');
                    $("#department-team").attr("disabled", "true");
                    $("#teamName").val('');
                    $("#show-team").prepend(data.textNewTeam);
                } else {
                    alert('Can not create dupplicate team name in the same department.');
                }
            }
        });
    }
}

function updateTeam(teamId) {
    var url = $url + 'setting/team/update-team';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { teamId: teamId },
        success: function (data) {
            $("#create-team").css("display", "none");
            $("#update-team").show();
            $("#reset-team").show();
            $("#teamId").val(teamId);
            $("#teamName").val(data.teamName);
            $("#company-team").html(data.textAllCompany);
            $("#branch-team").removeAttr("disabled", "true");
            $("#branch-team").html(data.textAllBranch);
            $("#department-team").removeAttr("disabled", "true");
            $("#department-team").html(data.textAllDepartment);
        }
    });
}

$("#update-team").click(function (e) {
    var branchId = $("#branch-team").val();
    var companyId = $("#company-team").val();
    var teamId = $("#teamId").val();
    var departmentId = $("#department-team").val();
    var teamName = $("#teamName").val();
    var fag = 1;
    var textError = '';
    if (companyId == '') {
        fag = 0;
        textError = 'Please select Company';
    } else if (branchId == '') {
        fag = 0;
        textError = 'Please select Branch';
    } else if (departmentId == '') {
        fag = 0;
        textError = 'Please select Department';
    } else if ($.trim(teamName) == '') {
        fag = 0;
        textError = 'Team name can not be null';
    }
    if (fag = 0) {
        alert(textError);
    } else {
        var url = $url + 'setting/team/save-update-team';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { departmentId: departmentId, teamName: teamName, teamId: teamId },
            success: function (data) {
                if (data.status) {
                    $("#company-team").val('');
                    $("#branch-team").val('');
                    $("#branch-team").attr("disabled", "true");
                    $("#department-team").val('');
                    $("#department-team").attr("disabled", "true");
                    $("#teamName").val('');
                    $("#team-" + teamId).html(data.textUpdateTeam);
                } else {
                    alert('Can not create dupplicate team name in the same department.');
                }
            }
        });
    }
});
$("#reset-team").click(function (e) {
    $("#company-team").val('');
    $("#teamId").val('');
    $("#branch-team").val('');
    $("#teamName").val('');
    $("#branch-team").attr("disabled", "true");
    $("#department-team").val('');
    $("#department-team").attr("disabled", "true");
    $("#update-team").css("display", "none");
    $("#reset-team").css("display", "none");
    $("#create-team").show();
});

// function deleteTeam(teamId) {
//     if (confirm("Are you sure to delete this Team")) {
//         var url = $url + 'setting/team/delete-team';
//         $.ajax({
//             type: "POST",
//             dataType: 'json',
//             url: url,
//             data: { teamId: teamId },
//             success: function (data) {
//                 if (data.status) {
//                     $("#team-" + teamId).hide(200);
//                 } else {
//                     alert("Can not delete this team.");
//                 }

//             }
//         });
//     }
// }
// function filterTeam() {
//     var companyId = $("#company-team-filter").val();
//     var branchId = $("#branch-team-filter").val();
//     var departmentId = $("#department-team-filter").val();
//     var url = $url + 'setting/team/filter-team';
//     $.ajax({
//         type: "POST",
//         dataType: 'json',
//         url: url,
//         data: { companyId: companyId, branchId: branchId, departmentId: departmentId },
//         success: function (data) {


//         }
//     });
// }

function openPopupModalTeam(url) {
    // alert(url);
    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            $('#teamModalBody').html(response);

            $('#teamDeleteModal').html('');
            $('#teamModal').modal('show');
        },
        error: function () {
            $('#teamModalBody').html('<p class="text-danger">Failed to load content.</p>');
            $('#teamModal').modal('show');
        }
    });
}

function addTeamInput() {
    // alert('Button clicked!');
    const container = document.getElementById('teamInputsContainer');

    const newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.name = 'teamName[]';
    newInput.className = 'form-control mb-2';
    newInput.style.width = '330px';
    newInput.placeholder = 'Write the name of the Team ';

    container.appendChild(newInput);
}


function filterTeam(page) {
    // console.log("Page:", page); // Add this line to check the value of `page`

    // const companyId = document.getElementById('companySelect').value;
    // const branchId = document.getElementById('branchSelect').value;
    const companyId = document.getElementById('company-filter').value;
    const branchId = document.getElementById('branch-filter').value;
    const departmentId = document.getElementById('department-filter').value;

    var url = $url + 'setting/team/encode-params-filter';
    // alert(page);
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: {
            companyId: companyId,
            branchId: branchId,
            departmentId: departmentId,
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



function goToPageTeam(nextPage, page, departmentId, companyId, branchId) {
    // alert(page);
    // alert(nextPage);
    // alert(departmentId);
    var url = $url + 'setting/team/encode-params-page';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: {
            companyId: companyId,
            branchId: branchId,
            departmentId: departmentId,
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

let sortDirection = {
    teamName: true,
    employee: true
};

function sortTeam(column) {
    const table = document.getElementById('myTable');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    const getCellValue = (row, column) => {
        switch (column) {
            case 'teamName':
                // ดึงชื่อทีมจาก .circle-container ด้านใน <td> แรก
                return row.querySelector('td:nth-child(1) .circle-container').textContent.trim().toLowerCase();
            case 'employee':
                // ดึงจำนวนพนักงานจาก .number-current-cycle
                const empCount = row.querySelector('.number-current-cycle');
                return empCount ? parseInt(empCount.textContent.trim()) : 0;
            default:
                return '';
        }
    };

    // toggle direction
    sortDirection[column] = !sortDirection[column];

    rows.sort((a, b) => {
        const valA = getCellValue(a, column);
        const valB = getCellValue(b, column);

        if (typeof valA === 'number' && typeof valB === 'number') {
            return sortDirection[column] ? valA - valB : valB - valA;
        }

        return sortDirection[column]
            ? valA.localeCompare(valB)
            : valB.localeCompare(valA);
    });

    rows.forEach(row => tbody.appendChild(row)); // update order
}




function renderTeamList(teams) {
    const container = document.getElementById('schedule-list');
    container.innerHTML = '';

    if (!Array.isArray(teams)) {
        console.error('teams is not an array:', teams);
        return;
    }

    teams.forEach(team => {
        const html = `
        <li class="schedule-item" data-id="${team.teamId}" style="padding: 13px 20px; background-color: #FFFFFF;">
            <div class="row align-items-center dept-name">
                <div class="col-10 dept-label" style="font-weight: 600; font-size: 16px;">
                    ${team.teamName}
                </div>
                <div class="col-2 text-end">
                    <a href="#" style="cursor: pointer;"
                    onclick="openModalDeleteTeam('${team.teamId}')" class="no-underline icon-delete">
                        <img src="${$url}images/icons/Settings/binred.svg" alt="Delete"
                            class="pim-icon bin-icon transition-icon">
                    </a>
                    <a href="#" class="no-underline icon-edit" onclick="handleTeamEditClick(event, this)">
                        <img src="${$url}image/edit-blue.svg" alt="Edit"
                            class="pim-icon edit-icon transition-icon" style="margin-top: -3px;">
                        <span class="text-blue edit-label transition-label" style="font-weight: 500;">Edit</span>
                    </a>
                </div>
            </div>
        </li>`;
        container.insertAdjacentHTML('beforeend', html);
    });

    let targetTeamId = document.getElementById('teamId')?.value;
    const targetLi = container.querySelector(`li[data-id="${targetTeamId}"]`);

    if (targetTeamId && targetLi) {
        const editBtn = targetLi.querySelector('.icon-edit');
        handleTeamEditClick(null, editBtn);
    }
}

function updateTeamList(teams) {
    const container = document.getElementById('schedule-list');
    container.innerHTML = '';

    if (!Array.isArray(teams)) {
        console.error('teams is not an array:', teams);
        return;
    }

    teams.forEach(team => {
        const html = `
        <li class="schedule-item" data-id="${team.teamId}" style="padding: 13px 20px; background-color: #FFFFFF;">
            <div class="row align-items-center dept-name">
                <div class="col-10 dept-label" style="font-weight: 600; font-size: 16px;">
                    ${team.teamName}
                </div>
                <div class="col-2 text-end">
                    <a href="#" style="cursor: pointer;"
                    onclick="openModalDeleteTeam('${team.teamId}')" class="no-underline icon-delete">
                        <img src="${$url}images/icons/Settings/binred.svg" alt="Delete"
                            class="pim-icon bin-icon transition-icon">
                    </a>
                    <a href="#" class="no-underline icon-edit" onclick="handleTeamEditClick(event, this)">
                        <img src="${$url}image/edit-blue.svg" alt="Edit"
                            class="pim-icon edit-icon transition-icon" style="margin-top: -3px;">
                        <span class="text-blue edit-label transition-label" style="font-weight: 500;">Edit</span>
                    </a>
                </div>
            </div>
        </li>`;
        container.insertAdjacentHTML('beforeend', html);
    });
}


function initTeamSearch(inputId = 'Search', listSelector = '#schedule-list .schedule-item') {
    // alert('initTeamSearch');
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

function actionSaveTeam(departmentId, teamName) {
    // alert(branchId);
    // alert(deptName);
    var url = $url + 'setting/team/save-team';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { departmentId: departmentId, teamName: teamName },
        success: function (data) {
            if (data.success && data.teams) {
                renderTeamList(data.teams); // เรียกฟังก์ชันวาด HTML ใหม่
            } else {
                alert('ไม่สามารถบันทึกได้');
            }
        }
    });

}


function openModalDeleteTeam(teamId) {
    // alert(teamId);
    var url = $url + 'setting/team/modal-delete';
    // alert(url);
    $.ajax({
        url: url,
        type: 'GET',
        data: { teamId: teamId },
        success: function (response) {
            // alert(response);
            document.getElementById('teamModal').style.opacity = '0.1';
            document.getElementById('teamModal').style.pointerEvents = 'none';
            $('#teamDeleteModal').html(response);
            $('#teamDeleteModal').modal('show');
        },
        error: function () {
            $('#teamDeleteModal').html('<p class="text-danger">Failed to load content.</p>');
            $('#teamDeleteModal').modal('show');
        }
    });
}


function handleTeamEditClick(e, element) {
    if (e) e.preventDefault();

    const li = element.closest('li');
    const teamId = li.getAttribute('data-id');
    const teamName = li.querySelector('.dept-label').textContent.trim();

    li.style.display = 'none';
    originalLi = li;
    currentEditingId = teamId;

    const inputHTML = `
        <li class="edit-temp-item mt-30" data-id="${teamId}">
            <div class="input-group">
                <input type="text" name="teamNameList" id="editTeamInputlist" value="${teamName}" class="form-control dep-${teamId}"
                    placeholder="Write team name">
                <span class="input-group-text" id="enterHintlist" style="background-color: #ffff; border-left: none;">
                    <div class="city-crad-company" id="hintTextlist" style="color: #ffffff; background-color: #2580D3;">
                        <img src="${$url}image/enter-white.svg" style="width: 24px; height: 24px;">
                        Enter to Save
                    </div>
                </span>
            </div>
        </li>`;

    li.insertAdjacentHTML('afterend', inputHTML);

    const input = document.getElementById('editTeamInputlist');
    // input.focus();
    setTimeout(() => {
        // alert('focus');
        // if (e != null) {
        input.focus();
        input.setSelectionRange(input.value.length, input.value.length); // ให้เคอร์เซอร์อยู่ท้ายข้อความ
        // }
    }, 500);

    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            // $('#teamModal').modal('hide');
            // alert('สำเร็จ');
            saveTeamEdit(input.value.trim());
            // location.reload(); // รีเฟรชหน้าทันทีหลังจากกด Enter
        }
    });

    input.addEventListener('blur', function () {
        saveTeamEdit(input.value.trim());
        cancelEdit(input.value.trim());
    });
    const targetDeptIdInput = document.getElementById('departmentId');
    const targetDeptId = targetDeptIdInput?.value;

}


function saveTeamEdit(newValue) {
    if (!currentEditingId || !originalLi) return;
    // alert(newValue);
    updateteamName(currentEditingId, newValue);
}


function updateteamName(teamId, teamName) {
    // $("#departmentId").val(departmentId);
    // alert(teamId);
    // alert(teamName);
    var url = $url + 'setting/team/update-team';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { teamId: teamId, teamName: teamName },
        success: function (data) {
            if (data.success && data.teams) {
                // alert('บันทึกสำเร็จ');
                updateTeamList(data.teams); // เรียกฟังก์ชันวาด HTML ใหม่
            } else {
                alert(data.message || 'ไม่สามารถบันทึกได้');
            }
        },
        error: function (xhr, status, error) {
            console.error(error);
            // alert('เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์');
        }
    });
}


function openCloseTeamModal() {
    document.getElementById('teamModal').style.opacity = '1';
    document.getElementById('teamModal').style.pointerEvents = 'auto';
    // $('#departmentDeleteModal').html(response);
    $('#teamDeleteModal').modal('hide');
}

$('#teamDeleteModal').on('hidden.bs.modal', function () {
    openCloseTeamModal();
});

function updateTeamModalContent(teamId) {
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
        modalBody.innerHTML = `Are you sure you want to delete this team? Once deleted, it cannot be restored. However, you can always create a new team if needed`;
    }

    // เปลี่ยน footer
    const modalFooter = document.querySelector('.modal-footer');
    if (modalFooter) {
        modalFooter.innerHTML = `
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                style="width: 100px; display: flex; align-items: center; justify-content: center; background: #2580D3; border: none; color: white;"
                onclick="openCloseTeamModal()">
                <img src="${$url}images/icons/Settings/cancle.svg" alt="Cancel"
                    style="width: 14px; height: 14px; margin-right: 5px;">
                Cancel
            </button>
            <a href="javascript:deleteTeam('${teamId}')" class="btn btn-outline-danger"
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


function deleteTeam(teamId) {
    // alert(teamId);
    // updateTeamModalContent(teamId);
    var url = $url + 'setting/team/delete-team';
    $.ajax({
        url: url,
        type: 'POST',
        data: { teamId: teamId },
        success: function (response) {
            // สมมุติว่า server ส่ง JSON กลับมา
            // เช่น { success: true, departments: [...] }
            if (response.success && response.departments) {
                openCloseTeamModal();
                renderTeamList(response.departments); // อัปเดตรายการ department
            } else {
                alert(response.message || 'ไม่สามารถลบได้');
            }
        }
    });
}


