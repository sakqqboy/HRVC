var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
	$baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;
$('#titleModal').on('hidden.bs.modal', function () {
	location.reload(); // รีเฟรชหน้า
});

function checkDupplicateTitle() {
	var titleName = $("#titleName").val();
	var departmentId = $("#department-team").val();
	var url = $url + 'setting/title/check-dupplicate-title';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { titleName: titleName, departmentId: departmentId },
		success: function (data) {
			if (data.status) {
				$("#create-title").submit();
			} else {
				alert(data.errorText);
			}
		}
	});

}
function checkDupplicateTitleUpdate() {
	var titleName = $("#titleName").val();
	var titleId = $("#titleId").val();
	var departmentId = $("#department-team").val();
	var url = $url + 'setting/title/check-dupplicate-title-update';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { titleName: titleName, departmentId: departmentId, titleId: titleId },
		success: function (data) {
			if (data.status) {
				$("#update-title-form").submit();
			} else {
				alert(data.errorText);
			}
		}
	});
}
function updateTitle(titleId) {
	$("#titleId").val(titleId);
	var url = $url + 'setting/title/update-title';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { titleId: titleId },
		success: function (data) {
			$("#create-title").css("display", "none");
			$("#update-title").show();
			$("#reset-title").show();
			$("#layer").val(data.title.layerId);
			$("#shortTag").val(data.title.shortTag);
			$("#titleName").val(data.title.titleName);
			// $("#jobDescription").html(data.title.jobDescription);
			$("#jobDescription").val(data.title.jobDescription);
			$("#department-team").html(data.department);
			$("#department-team").removeAttr("disabled");
			$("#branch-team").html(data.branch);
			$("#branch-team").removeAttr("disabled");
			$("#company-team").val(data.companyId);
		}
	});
}
$("#update-title").click(function (e) {
	var titleId = $("#titleId").val();
	var titleName = $("#titleName").val();
	var shortTag = $("#shortTag").val();
	var layer = $("#layer").val();
	var departmentId = $("#department-team").val();
	var jobDescription = $("#jobDescription").val();
	if ($.trim(titleName) == '') {
		alert("Title name can not be null");
	} else if (layer == '' || layer == null) {
		alert('Please select Layer');
	} else {
		var url = $url + 'setting/title/save-update-title';
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: url,
			data: { titleName: titleName, shortTag: shortTag, layer: layer, titleId: titleId, departmentId: departmentId, jobDescription: jobDescription },
			success: function (data) {
				$("#titleId").val('');
				$("#titleName").val('');
				$("#shortTag").val('');
				$("#layer").val('')
				$("#company-team").val('');
				$("#branch-team").val('');
				$("#department-team").val('');
				$("#title-" + titleId).html(data.textUpdate);
				$("#jobDescription").val('');

			}
		});
	}
});
$("#reset-title").click(function (e) {
	$("#titleId").val('');
	$("#titleName").val('');
	$("#layer").val('');
	$("#shortTag").val('');
	$("#department-team").val('');
	$("#department-team").prop('disabled', 'true');
	$("#update-title").css("display", "none");
	$("#branch-team").val('');
	$("#company-team").val('')
	$("#branch-team").prop('disabled', 'true');
	$("#reset-title").css("display", "none");
	$("#create-title").show();
});

// function deleteTitle(titleId) {
// 	if (confirm("Are you sure to delete this title")) {
// 		var url = $url + 'setting/title/delete-title?';
// 		var redirect = $("#redirect").val();
// 		var preUrl = $("#preUrl").val();
// 		$.ajax({
// 			type: "POST",
// 			dataType: 'json',
// 			url: url,
// 			data: { titleId: titleId, redirect: redirect, preUrl: preUrl },
// 			success: function (data) {
// 				if (data.status) {
// 					$("#title-" + titleId).hide(200);
// 				} else {
// 					alert("Can not delete this title.");
// 				}

// 			}
// 		});
// 	}
// }

function addDepartmentId() {
	var departmentId = $("#department-team").val();
	$("#departmentId").val(departmentId);
}

// function filterTitle() {
// 	var departmentId = $("#department-team").val();
// 	var branchId = $("#branch-team").val();
// 	var companyId = $("#company-team").val();
// 	var url = $url + 'setting/title/filter-title?';
// 	$.ajax({
// 		type: "POST",
// 		dataType: 'json',
// 		url: url,
// 		data: { departmentId: departmentId, branchId: branchId, companyId: companyId },
// 		success: function (data) {


// 		}
// 	});

// }


function filterTitle(page) {
	// console.log("Page:", page); // Add this line to check the value of `page`

	const companyId = document.getElementById('companySelect').value;
	const branchId = document.getElementById('branchSelect').value;
	const departmentId = document.getElementById('departmentSelect').value;

	// nextPage = 1;
	// alert(page);
	// alert(nextPage);
	// alert(companyId);
	// alert(branchId);
	// alert(departmentId);

	var url = $url + 'setting/title/encode-params-filter';
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


function goToPageTitle(nextPage, page, departmentId, companyId, branchId) {
	// alert(page);
	// alert(nextPage);
	// alert(departmentId);
	var url = $url + 'setting/title/encode-params-page';
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

function departmentTitle() {
	var departmentId = $("#department").val();
	var url = $url + 'setting/department/department-title';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { departmentId: departmentId },
		success: function (data) {

			if (data.status) {
				$("#title").html(data.title);
			}

		}
	});
}


function openPopupModalTitle(url) {
	// alert(url);
	$.ajax({
		url: url,
		type: 'GET',
		success: function (response) {
			$('#titleModalBody').html(response);

			$('#titleDeleteModal').html('');
			$('#titleModal').modal('show');
		},
		error: function () {
			$('#titleModalBody').html('<p class="text-danger">Failed to load content.</p>');
			$('#titleModal').modal('show');
		}
	});
}



function sortTitle(column) {
	const table = document.getElementById('myTable');
	const tbody = table.querySelector('tbody');
	const rows = Array.from(tbody.querySelectorAll('tr'));

	const getCellValue = (row, column) => {
		switch (column) {
			case 'titleName':
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




function renderTitleList(titles) {
	const container = document.getElementById('schedule-list');
	container.innerHTML = '';

	if (!Array.isArray(titles)) {
		console.error('titles is not an array:', titles);
		return;
	}

	titles.forEach(title => {
		const html = `
        <li class="schedule-item" data-id="${title.titleId}" style="padding: 13px 20px; background-color: #FFFFFF;">
            <div class="row align-items-center dept-name">
                <div class="col-10 dept-label" style="font-weight: 600; font-size: 16px;">
                    ${title.titleName}
                </div>
                <div class="col-2 text-end">
                    <a href="#" style="cursor: pointer;"
                    onclick="openModalDeleteTitle('${title.titleId}')" class="no-underline icon-delete">
                        <img src="${$url}images/icons/Settings/binred.svg" alt="Delete"
                            class="pim-icon bin-icon transition-icon">
                    </a>
                    <a href="#" class="no-underline icon-edit" onclick="handleTitleEditClick(event, this)">
                        <img src="${$url}image/edit-blue.svg" alt="Edit"
                            class="pim-icon edit-icon transition-icon" style="margin-top: -3px;">
                        <span class="text-blue edit-label transition-label" style="font-weight: 500;">Edit</span>
                    </a>
                </div>
            </div>
        </li>`;
		container.insertAdjacentHTML('beforeend', html);
	});

	const targetTitleId = document.getElementById('titleId')?.value;
	const targetLi = container.querySelector(`li[data-id="${targetTitleId}"]`);

	if (targetTitleId && targetLi) {
		const editBtn = targetLi.querySelector('.icon-edit');
		handleTitleEditClick(null, editBtn);
	}
}


function initTitleSearch(inputId = 'Search', listSelector = '#schedule-list .schedule-item') {
	// alert('initTitleSearch');
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

function actionSaveTitle(departmentId, titleName) {
	// alert(branchId);
	// alert(deptName);
	var url = $url + 'setting/title/save-title';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { departmentId: departmentId, titleName: titleName },
		success: function (data) {
			if (data.success && data.titles) {
				renderTitleList(data.titles); // เรียกฟังก์ชันวาด HTML ใหม่
			} else {
				alert('ไม่สามารถบันทึกได้');
			}
		}
	});

}


function openModalDeleteTitle(titleId) {
	// alert(titleId);
	var url = $url + 'setting/title/modal-delete';
	alert(url);
	$.ajax({
		url: url,
		type: 'GET',
		data: { titleId: titleId },
		success: function (response) {
			// alert(response);
			document.getElementById('titleModal').style.opacity = '0.1';
			document.getElementById('titleModal').style.pointerEvents = 'none';
			$('#titleDeleteModal').html(response);
			$('#titleDeleteModal').modal('show');
		},
		error: function () {
			alert('error');
			$('#titleDeleteModal').html('<p class="text-danger">Failed to load content.</p>');
			$('#titleDeleteModal').modal('show');
		}
	});
}


function handleTitleEditClick(e, element) {
	if (e) e.preventDefault();

	const li = element.closest('li');
	const titleId = li.getAttribute('data-id');
	const titleName = li.querySelector('.dept-label').textContent.trim();

	li.style.display = 'none';
	originalLi = li;
	currentEditingId = titleId;

	const inputHTML = `
        <li class="edit-temp-item mt-30" data-id="${titleId}">
            <div class="input-group">
                <input type="text" name="titleNameList" id="editTitleInputlist" value="${titleName}" class="form-control dep-${titleId}"
                    placeholder="Write title name">
                <span class="input-group-text" id="enterHintlist" style="background-color: #ffff; border-left: none;">
                    <div class="city-crad-company" id="hintTextlist" style="color: #ffffff; background-color: #2580D3;">
                        <img src="${$url}image/enter-white.svg" style="width: 24px; height: 24px;">
                        Enter to Save
                    </div>
                </span>
            </div>
        </li>`;

	li.insertAdjacentHTML('afterend', inputHTML);

	const input = document.getElementById('editTitleInputlist');
	// input.focus();
	setTimeout(() => {
		input.focus(); Settings / binred.svg
		input.setSelectionRange(input.value.length, input.value.length); // ให้เคอร์เซอร์อยู่ท้ายข้อความ
	}, 500);

	input.addEventListener('keydown', function (e) {
		if (e.key === 'Enter') {
			// $('#titleModal').modal('hide');
			saveTitleEdit(input.value.trim());
			// location.reload(); // รีเฟรชหน้าทันทีหลังจากกด Enter
		}
	});

	input.addEventListener('blur', function () {
		cancelEdit(input.value.trim());
	});
	const targetDeptIdInput = document.getElementById('departmentId');
	const targetDeptId = targetDeptIdInput?.value;

}


function saveTitleEdit(newValue) {
	if (!currentEditingId || !originalLi) return;
	// alert(newValue);
	updatetitleName(currentEditingId, newValue);
}


function updatetitleName(titleId, titleName) {
	// $("#departmentId").val(departmentId);
	// alert(titleId);
	// alert(titleName);
	var url = $url + 'setting/title/update-title';
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: url,
		data: { titleId: titleId, titleName: titleName },
		success: function (data) {
			if (data.success && data.titles) {
				// alert('บันทึกสำเร็จ');
				renderTitleList(data.titles); // เรียกฟังก์ชันวาด HTML ใหม่
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


function openCloseTitleModal() {
	document.getElementById('titleModal').style.opacity = '1';
	document.getElementById('titleModal').style.pointerEvents = 'auto';
	// $('#departmentDeleteModal').html(response);
	$('#titleDeleteModal').modal('hide');
}

$('#titleDeleteModal').on('hidden.bs.modal', function () {
	openCloseTitleModal();
});

function updateTitleModalContent(titleId) {
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
		modalBody.innerHTML = `Are you sure you want to delete this title? Once deleted, it cannot be restored. However, you can always create a new title if needed`;
	}

	// เปลี่ยน footer
	const modalFooter = document.querySelector('.modal-footer');
	if (modalFooter) {
		modalFooter.innerHTML = `
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                style="width: 100px; display: flex; align-items: center; justify-content: center; background: #2580D3; border: none; color: white;"
                onclick="openCloseTitleModal()">
                <img src="${$url}images/icons/Settings/cancle.svg" alt="Cancel"
                    style="width: 14px; height: 14px; margin-right: 5px;">
                Cancel
            </button>
            <a href="javascript:deleteTitle('${titleId}')" class="btn btn-outline-danger"
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


function deleteTitle(titleId) {
	// alert(titleId);
	// updateTitleModalContent(titleId);
	var url = $url + 'setting/title/delete-title';
	$.ajax({
		url: url,
		type: 'POST',
		data: { titleId: titleId },
		success: function (response) {
			// สมมุติว่า server ส่ง JSON กลับมา
			// เช่น { success: true, departments: [...] }
			if (response.success && response.departments) {
				openCloseTitleModal();
				renderDepartmentList(response.departments); // อัปเดตรายการ department
			} else {
				alert(response.message || 'ไม่สามารถลบได้');
			}
		}
	});
}

function saveDeleteTitle(titleId, preUrl) {
	// alert(titleId);
	// updateTitleModalContent(titleId);
	var url = $url + 'setting/title/delete-title';
	$.ajax({
		url: url,
		type: 'POST',
		data: { titleId: titleId, preUrl: preUrl },
		success: function (response) {
			// สมมุติว่า server ส่ง JSON กลับมา
			// เช่น { success: true, departments: [...] }
			// if (response.success && response.departments) {
			// 	openCloseTitleModal();
			// 	renderDepartmentList(response.departments); // อัปเดตรายการ department
			// } else {
			// 	alert(response.message || 'ไม่สามารถลบได้');
			// }
		}
	});
}