function showEmployeeView(content) {
    var old = $("#currentShow").val();
    $("#link" + content).css("font-weight", "bold");
    if (old != content) {
        $("#link" + old).css("font-weight", "400");
        $("#show" + old).css("display", "none");
        $("#currentShow").val(content);
        $("#show" + content).fadeIn();
    }
}

function showFile(index) {
    if (index == 1) {
        if ($("#file1").length > 0) {
            $("#file2").css("display", "none");
            $("#file" + index).show();
            $("#file" + index).document.querySelector("label[for=name]");

        } else {
            alert("Employee resume did't upload yet.");
        }
    } else {
        if ($("#file2").length > 0) {
            $("#file1").css("display", "none");
            $("#file" + index).show();
        } else {
            alert("Employee agreement did't upload yet.");
        }
    }

}
function filterEmployee() {
    var companyId = $("#company-team").val();
    var branchId = $("#branch-team").val();
    var departmentId = $("#department-team").val();
    var teamId = $("#team-department").val();
    var status = $("#status").val();
    var url = $url + 'setting/employee/filter-employee';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { companyId: companyId, branchId: branchId, departmentId: departmentId, teamId: teamId, status: status },
        success: function (data) {


        }
    });

}
function employeeType(status) {
    $("#status").val(status);
    $("#btn-" + 0).addClass('btn-curr');
    $("#btn-" + 1).addClass('btn-curr');
    $("#btn-" + 2).addClass('btn-curr');
    $("#btn-" + status).removeClass('btn-curr');
}
function showAction(employeeId) {
    var showingId = $("#show-action").val();
    $("#employee-action-" + employeeId).show();
    if (showingId != '') {
        $("#employee-action-" + showingId).hide();

    }
    $("#show-action").val(employeeId);
    if (showingId == employeeId) {
        $("#show-action").val('');
    }


}
function deleteEmployee(employeeId) {
    if (confirm('Are you sure to delete this employee')) {
        var url = $url + 'setting/employee/delete-employee';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { employeeId: employeeId },
            success: function (data) {
                if (data.status) {
                    $("#employee-" + employeeId).hide();
                }
            }
        });
    }
}
function checkUploadFile(type) {
    if (![1, 2, 3].includes(type)) return;

    const inputId = (type === 1) ? "resume" : (type === 2) ? "agreement" : "certificate";
    const hasInputId = (type === 1) ? "hasResume" : (type === 2) ? "hasAgreement" : "hasCertificate";
    const checkId = (type === 1) ? "resume-check" : (type === 2) ? "agreement-check" : "certificate-check";
    const btnId = (type === 1) ? "resume-btn" : (type === 2) ? "agreement-btn" : "certificate-btn";
    const fileId = (type === 1) ? "file-edit1" : (type === 2) ? "file-edit2" : "file-edit3";

    const input = document.getElementById(inputId);
    const file = input?.files?.[0];

    const wrapperId = `upload-file${type}`;
    const nameId = `file-uplode-name${type}`;
    const eyeId = `eye-file${type}`;
    const binId = `bin-file${type}`;
    const refesId = `refes-file${type}`;
    const iconId = `icon-file${type}`;

    if (file) {
        let fileName = file.name;
        const fileExtension = fileName.split('.').pop().toLowerCase();
        const maxLength = 26;

        if (fileName.length > maxLength) {
            fileName = fileName.substring(0, maxLength - 3) + '...';
        }

        let iconSrc = "";

        switch (fileExtension) {
            case "doc":
                iconSrc = $url + "image/doc-file.svg";
                break;
            case "mp4":
                iconSrc = $url + "image/mp4-file.svg";
                break;
            case "picture":
                iconSrc = $url + "image/picture-file.svg";
                break;
            case "file":
                iconSrc = $url + "image/file-file.svg";
                break;
            case "xml":
                iconSrc = $url + "image/xml-file.svg";
                break;
            case "ai":
                iconSrc = $url + "image/ai-file.svg";
                break;
            case "pds":
                iconSrc = $url + "image/pds-file.svg";
                break;
            case "pptx":
                iconSrc = $url + "image/pptx-file.svg";
                break;
            case "eps":
                iconSrc = $url + "image/eps-file.svg";
                break;
            case "zip":
                iconSrc = $url + "image/zip-file.svg";
                break;
            case "txt":
                iconSrc = $url + "image/txt-file.svg";
                break;
            case "pdf":
                iconSrc = $url + "image/pdf-file.svg";
                break;
            case "xlsx":
                iconSrc = $url + "image/ex-file.svg";
                break;
            default:
                iconSrc = $url + "image/file-big.svg"; // หรือใช้ icon default
        }


        const now = new Date();
        const time = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const date = now.toLocaleDateString('en-GB');

        document.getElementById(nameId).innerHTML = `
            <label class="font-size-16 font-weight-600" for="name">${fileName}</label>
            <div class="text-secondary text-gray font-size-14">
                <span class="text-gray font-size-12">${time} • ${date}</span>
            </div>
        `;

        document.getElementById(iconId).src = iconSrc;

        const fileEdit = document.getElementById(fileId);
        if (fileEdit) {
            fileEdit.className = "col-lg-4 d-flex justify-content-center align-items-center gap-3";
            fileEdit.innerHTML = `
                <a href="#" onclick="viewFile(${type}); return false;">
                    <img id="${eyeId}" src="${$url}images/icons/Settings/eye.svg" alt="icon" style="width: 23px; height: 23px;">
                </a>
                <a href="#" onclick="removeFile(${type}); return false;">
                    <img class="mt-5 ml-9" id="${binId}" src="${$url}images/icons/Settings/binred.svg" alt="icon" style="width: 28px; height: 28px;">
                </a>
                <a href="#" onclick="resetUpload(${type}); return false;">
                    <img id="${refesId}" src="${$url}image/refes-blue.svg" alt="icon" style="width: 18px; height: 18px;">
                </a>
            `;
        }

        document.getElementById(wrapperId).style.border = "1px solid var(--Stroke-Bluish-Gray, #BBCDDE)";
        document.getElementById(hasInputId).value = 1;
    } else {
        resetUpload(type);
    }
}


// ตัวอย่างฟังก์ชันล้างไฟล์
function resetUpload(type) {
    const wrapperId = `upload-file${type}`;
    const inputId = (type === 1) ? "resume" : "agreement";
    const hasInputId = (type === 1) ? "hasResume" : "hasAgreement";
    const checkId = (type === 1) ? "resume-check" : "agreement-check";

    // ล้าง input file
    const input = document.getElementById(inputId);
    if (input) input.value = "";

    // เคลียร์ hidden input
    document.getElementById(hasInputId).value = '';

    // ซ่อน check icon
    document.getElementById(checkId).style.display = 'none';

    // กู้คืน UI เป็นแบบเดิม (ตามตัวอย่างแรก)
    document.getElementById(wrapperId).innerHTML = `
        <div class="row">
            <div class="col-lg-2 center-center">
                <img id="icon-file${type}" src="${$url}image/file-big.svg" alt="icon" style="width: 40px; height: 40px;">
            </div>
            <div id="file-upload-name${type}" class="col-lg-6 col-md-6 col-12" style="border-right:lightgray solid thin;">
                <label class="text-gray font-size-16 font-weight-500" for="${inputId}">Upload Resume/CV here</label>
                <div class="text-secondary text-gray font-size-14">
                    <span class="text-gray font-size-12">Supported - pdf, .doc, .docx</span>
                </div>
                <div id="filename-display${type}" class="font-size-16 font-weight-600 mt-2"></div>
            </div>
            <div id="file-edit${type}" class="col-lg-4 col-md-6 col-12 text-center pt-13">
                <label for="${inputId}" class="text-blue font-size-16 font-weight-600" style="cursor: pointer;">
                    Upload
                    <img src="${$url}image/file-up-blue.svg" alt="icon" style="width: 16px; height: 16px;">
                </label>
                <span class="ml-5 text-success" id="${inputId}-check" style="display:none;">
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <input type="hidden" value="" id="${hasInputId}">
            </div>
            <input id="${inputId}" style="display:none;" type="file" name="${inputId}" onchange="checkUploadFile(${type})">
        </div>
    `;
}


// ตัวอย่างฟังก์ชันดูไฟล์ (เปิด preview หรือดาวน์โหลด)
function viewFile(type) {
    let inputId = "";

    if (type === 1) {
        inputId = "resume";
    } else if (type === 2) {
        inputId = "agreement";
    } else if (type === 3) {
        inputId = "certificate";
    } else {
        return alert("Invalid file type.");
    }

    const input = document.getElementById(inputId);
    const file = input?.files?.[0];
    if (!file) return alert("No file to view.");

    const fileURL = URL.createObjectURL(file);
    window.open(fileURL, '_blank');
}

function removeFile(type) {
    const confirmDelete = confirm('Do you want to delete the file?');

    if (confirmDelete) {
        // ผู้ใช้กด "OK"
        if (type === 1) {
            // สร้าง HTML แบบดั้งเดิมของ upload file กลับไปแทนที่ div
            const originalHTML = `
            <div class="row">
                <div class="col-lg-2 center-center">
                    <img id="icon-file1" src="${$url}image/file-big.svg"
                        alt="icon" style="width: 40px; height: 40px;">
                </div>
                <div id="file-uplode-name1" class="col-lg-6 col-md-6 col-12"
                    style="border-right:lightgray solid thin;">
                    <label class="text-gray font-size-16 font-weight-500" for="name">
                        Upload Resume/CV here
                    </label>
                    <div class="text-secondary text-gray font-size-14">
                        <span class="text-gray font-size-12">Supported - pdf, .doc, .docx</span>
                    </div>
                </div>
                <div id="file-edit1" class="col-lg-4 col-md-6 col-12 text-center pt-13">
                    <label id="resume-btn" for="resume" class="text-blue font-size-16 font-weight-600" style="cursor: pointer;">
                        Upload
                        <img src="${$url}image/file-up-blue.svg" alt="icon"
                            style="width: 16px; height: 16px;">
                    </label>
                    <span class="ml-5 text-success" id="resume-check" style="display:none;">
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </span>
                </div>
                <input id="resume" style="display:none;" type="file" name="resume"
                        onchange="javascript:checkUploadFile(1)">
                    <input type="hidden" value="" id="hasResume">
            </div>
        `;
            document.getElementById("upload-file1").style.border = "border:1.22px dashed var(--Stroke-Bluish-Gray, #BBCDDE)";

            // แทนที่ div ด้วย HTML ดั้งเดิม
            document.getElementById("upload-file1").innerHTML = originalHTML;
        }

        if (type === 2) {
            // สมมติว่า $url คือตัวแปร JS ที่เก็บ path Yii::$app->homeUrl แล้ว
            const originalHTML = `
                <div class="row">
                    <div class="col-lg-2 center-center">
                        <img id="icon-file2" src="${$url}image/file-big.svg"
                            alt="icon" style="width: 40px; height: 40px;">
                    </div>
                    <div id="file-uplode-name2" class="col-lg-6 col-md-6 col-12"
                        style="border-right:lightgray solid thin;">
                        <label class="text-gray font-size-16 font-weight-500" for="name">
                            Upload Agreement Here
                        </label>
                        <div class="text-secondary text-gray  font-size-14">
                            <span class="text-gray font-size-12"> Supported - pdf, .doc, .docx</span>
                        </div>
                    </div>
                    <div id="file-edit2" class="col-lg-4 col-md-6 col-12 text-center pt-13">
                        <label id="agreement-btn" type="button" for="agreement"
                            class="text-blue font-size-16 font-weight-600" style="cursor:pointer;">
                            Upload
                            <img src="${$url}image/file-up-blue.svg" alt="icon" style="width: 16px; height: 16px;">
                        </label>
                        <span class="ml-5 text-success" id="agreement-check" style="display:none;">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                    </div>
                    <input id="agreement" style="display:none;" type="file" name="agreement"
                            onchange="javascript:checkUploadFile(2)">
                    <input type="hidden" value="" id="hasAgreement">
                </div>
            `;

            // ตั้งค่า border แบบถูกต้อง
            const uploadFile2Div = document.getElementById("upload-file2");
            uploadFile2Div.style.border = "1.22px dashed var(--Stroke-Bluish-Gray, #BBCDDE)";

            // แทนที่ div ด้วย HTML ดั้งเดิม
            uploadFile2Div.innerHTML = originalHTML;
        }

        if (type === 3) {
            // สมมติว่า $url คือตัวแปร JS ที่เก็บ path Yii::$app->homeUrl แล้ว
            const originalHTML = `
        <div class="row">
            <div class="col-lg-2 center-center">
                <img id="icon-file3" src="${$url}image/file-big.svg"
                    alt="icon" style="width: 40px; height: 40px;">
            </div>
            <div id="file-uplode-name3" class="col-lg-6 col-md-6 col-12"
                style="border-right:lightgray solid thin;">
                <label class="text-gray font-size-16 font-weight-500" for="name">
                    Upload Certificate
                </label>
                <div class="text-secondary text-gray  font-size-14">
                    <span class="text-gray font-size-12"> Supported - pdf, .doc, .docx</span>
                </div>
            </div>
            <div id="file-edit3" class="col-lg-4 col-md-6 col-12 text-center pt-13">
                <label id="certificate-btn" type="button" for="certificate"
                    class="text-blue font-size-16 font-weight-600" style="cursor:pointer;">
                    Upload
                    <img src="${$url}image/file-up-blue.svg" alt="icon" style="width: 16px; height: 16px;">
                </label>
                <span class="ml-5 text-success" id="certificate-check" style="display:none;">
                    <i class="fa fa-check" aria-hidden="true"></i>
                </span>
                <input id="certificate" style="display:none;" type="file" name="certificate"
                    onchange="javascript:checkUploadFile(3)">
                <input type="hidden" value="" id="hascertificatet">
            </div>
        </div>
    `;
            document.getElementById("upload-file3").style.border = "1.22px dashed var(--Stroke-Bluish-Gray, #BBCDDE)";
            // แทนที่ div ด้วย HTML ดั้งเดิม
            document.getElementById("upload-file3").innerHTML = originalHTML;
        }
    } else {
        // ผู้ใช้กด "Cancel"
        console.log('User canceled file deletion.');
    }
}

// function resetUpload(type) {
//     // if (type === 1) {
//     //     document.getElementById("resume").value = '';
//     //     checkUploadFile(1);
//     // }
//     // if (type === 2) {
//     //     document.getElementById("agreement").value = '';
//     //     checkUploadFile(2);
//     // }
// }

function changeStatus() {
    var pimStatus = $("#pim-status").val();
    $("#pim-status").removeClass('select-create-status');
    $("#pim-status").removeClass('select-complete-status');
    if (pimStatus == 1) {
        $("#pim-status").addClass('select-create-status');
    }
    if (pimStatus == 2) {
        $("#pim-status").addClass('select-complete-status');
    }
}

function togglePassword() {
    const passwordInput = document.getElementById("password");
    const icon = document.getElementById("toggleIcon");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.src =
            $url + "image/e-pass.svg"; // เปลี่ยนเป็น icon ตาปิด
    } else {
        passwordInput.type = "password";
        icon.src =
            $url + "image/e-pass.svg"; // เปลี่ยนเป็น icon ตาเปิด
    }
}



function initRadioSelection(containerSelector = '.radio-wrapper') {
    const svgNS = "http://www.w3.org/2000/svg";
    const container = document.querySelector(containerSelector);
    if (!container) return;

    container.querySelectorAll('.radio-item').forEach(item => {
        item.addEventListener('click', () => {
            const clickedRadio = item.querySelector('input[type="radio"]');
            const selectedValue = parseInt(clickedRadio.value);

            container.querySelectorAll('.radio-item').forEach(i => {
                const radio = i.querySelector('input[type="radio"]');
                const radioValue = parseInt(radio.value);
                const cycle = i.querySelector('.radio-cycle');

                // ลบ svg ติ๊กถูก เดิม
                const existingSvg = cycle.querySelector('.check-svg');
                if (existingSvg) existingSvg.remove();

                if (radioValue <= selectedValue) {
                    // ปรับสีและใส่ svg
                    i.style.background = '#FFFFFF';
                    i.style.borderColor = '#BBCDDE';
                    cycle.style.background = '#FFD000';
                    cycle.style.borderColor = '#FFD000';

                    const svg = document.createElementNS(svgNS, "svg");
                    svg.setAttribute("width", "13");
                    svg.setAttribute("height", "9");
                    svg.setAttribute("viewBox", "0 0 13 9");
                    svg.setAttribute("fill", "none");
                    svg.classList.add("check-svg");

                    const path = document.createElementNS(svgNS, "path");
                    path.setAttribute("d", "M2.27734 5.85714L4.52734 8L11.2773 2");
                    path.setAttribute("stroke", "#30313D");
                    path.setAttribute("stroke-width", "2");
                    path.setAttribute("stroke-linecap", "square");
                    path.setAttribute("stroke-linejoin", "round");

                    svg.appendChild(path);
                    cycle.appendChild(svg);

                    radio.checked = radioValue === selectedValue;
                } else {
                    // รีเซต
                    i.style.background = '#DCDCDC';
                    i.style.borderColor = '#BBCDDE';
                    cycle.style.background = '#F5F5F5';
                    cycle.style.borderColor = '#2580D3';
                    radio.checked = false;
                }
            });
        });
    });
    // <<< NEW: trigger click on pre-checked radio
    const preChecked = container.querySelector('.radio-item input[type="radio"]:checked');
    if (preChecked) {
        preChecked.closest('.radio-item').click();
    }
}

function initCheckboxSelection(containerSelector = '.checkbox-wrapper') {
    const svgNS = "http://www.w3.org/2000/svg";
    const container = document.querySelector(containerSelector);
    if (!container) return;

    container.querySelectorAll('.checkbox-item').forEach(item => {
        item.addEventListener('click', () => {
            const checkbox = item.querySelector('input[type="checkbox"]');
            const cycle = item.querySelector('.checkbox-cycle');

            if (checkbox.checked) {
                // ถ้าเลือกอยู่แล้ว จะเป็นการยกเลิกเลือก
                checkbox.checked = false;

                // ลบ svg ติ๊กถูก
                const existingSvg = cycle.querySelector('.check-svg');
                if (existingSvg) existingSvg.remove();

                // รีเซตสี
                item.style.background = '#DCDCDC';
                item.style.borderColor = '#BBCDDE';
                cycle.style.background = '#F5F5F5';
                cycle.style.borderColor = '#2580D3';

            } else {
                // เลือก checkbox
                checkbox.checked = true;

                // เปลี่ยนสีพื้นหลัง
                item.style.background = '#FFFFFF';
                item.style.borderColor = '#BBCDDE';
                cycle.style.background = '#FFD000';
                cycle.style.borderColor = '#FFD000';

                // สร้าง svg checkmark
                const existingSvg = cycle.querySelector('.check-svg');
                if (!existingSvg) {
                    const svg = document.createElementNS(svgNS, "svg");
                    svg.setAttribute("width", "13");
                    svg.setAttribute("height", "9");
                    svg.setAttribute("viewBox", "0 0 13 9");
                    svg.setAttribute("fill", "none");
                    svg.classList.add("check-svg");

                    const path = document.createElementNS(svgNS, "path");
                    path.setAttribute("d", "M2.27734 5.85714L4.52734 8L11.2773 2");
                    path.setAttribute("stroke", "#30313D");
                    path.setAttribute("stroke-width", "2");
                    path.setAttribute("stroke-linecap", "square");
                    path.setAttribute("stroke-linejoin", "round");

                    svg.appendChild(path);
                    cycle.appendChild(svg);
                }
            }
        });
    });

    // === รันเริ่มต้นสำหรับ checkbox ที่ถูก checked ===
    container.querySelectorAll('.checkbox-item input[type="checkbox"]:checked').forEach(checkbox => {
        const item = checkbox.closest('.checkbox-item');
        const cycle = item.querySelector('.checkbox-cycle');

        item.style.background = '#FFFFFF';
        item.style.borderColor = '#BBCDDE';
        cycle.style.background = '#FFD000';
        cycle.style.borderColor = '#FFD000';

        const existingSvg = cycle.querySelector('.check-svg');
        if (!existingSvg) {
            const svg = document.createElementNS(svgNS, "svg");
            svg.setAttribute("width", "13");
            svg.setAttribute("height", "9");
            svg.setAttribute("viewBox", "0 0 13 9");
            svg.setAttribute("fill", "none");
            svg.classList.add("check-svg");

            const path = document.createElementNS(svgNS, "path");
            path.setAttribute("d", "M2.27734 5.85714L4.52734 8L11.2773 2");
            path.setAttribute("stroke", "#30313D");
            path.setAttribute("stroke-width", "2");
            path.setAttribute("stroke-linecap", "square");
            path.setAttribute("stroke-linejoin", "round");

            svg.appendChild(path);
            cycle.appendChild(svg);
        }
    });

}



function loadTeamsSelect(departmentId) {
    const employeeTeamId = document.getElementById('employeeTeamId');
    const teamId = parseInt(employeeTeamId.value);

    fetch($url + 'setting/department/department-team-list', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
        },
        body: JSON.stringify({ departmentId: departmentId })
    })
        .then(response => response.json())
        .then(data => {
            const teamSelect = document.getElementById('teamSelectId');
            teamSelect.innerHTML =
                '<option value="" disabled selected hidden>Select his/her team</option>';

            const teams = Object.values(data); // ✅ ดึง array จาก object

            teams.forEach(team => {
                const option = document.createElement('option');
                option.value = team.teamId;
                option.textContent = team.teamName;

                // ✅ เลือกค่าเดิมของพนักงานถ้ามี
                if (!isNaN(teamId) && teamId === parseInt(team.teamId)) {
                    option.selected = true;
                }

                teamSelect.appendChild(option);
            });


            const iconImg = document.getElementById('teamIconImg');
            const iconDiv = document.getElementById('teamIcon');
            if (teamId) {
                iconImg.src = homeUrl + 'image/teams.svg';
                //alert(selectedValue);
                iconDiv.classList.remove('cycle-current-gray');
                iconDiv.classList.add('cycle-current-green');

            } else {
                iconDiv.classList.remove('cycle-current-green');
                iconDiv.classList.add('cycle-current-gray');
            }

            teamSelect.disabled = false;
        });
}



function loadTitlesSelect(departmentId) {
    const employeeTitleId = document.getElementById('employeeTitleId');
    const titleId = parseInt(employeeTitleId?.value || 0);

    fetch($url + 'setting/department/department-title-list', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
        },
        body: JSON.stringify({
            departmentId: departmentId
        })
    })
        .then(response => response.json())
        .then(data => {
            const titleSelect = document.getElementById('titleSelectId');
            titleSelect.innerHTML =
                '<option value="" disabled selected hidden>What is his/her Title?</option>';

            if (data && typeof data === 'object') {
                Object.values(data).forEach(title => {
                    const option = document.createElement('option');
                    option.value = title.titleId;
                    option.textContent = title.titleName;

                    if (title.titleId === titleId) {
                        option.selected = true;
                    }

                    titleSelect.appendChild(option);
                });

                titleSelect.disabled = false;

                // แก้ตรงนี้: ต้องเอา getElementById ก่อนถึงจะใช้ iconImg ได้
                const iconImg = document.getElementById('titleIconImg');
                const iconDiv = document.getElementById('titleIcon');
                // ตรวจสอบว่า titleId มีค่าจริงก่อน fetch
                if (titleId) {
                    iconImg.src = homeUrl + 'images/icons/white-icons/MasterSetting/title.svg';
                    iconDiv.classList.remove('cycle-current-gray');
                    iconDiv.classList.add('cycle-current-blue');

                    fetch($url + 'setting/title/get-title-detail', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
                        },
                        body: JSON.stringify({ titleId: titleId })
                    })
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('no-existing').style.display = 'none';

                            const html = `
                                <div>
                                    <span class="font-size-20 font-weight-600">${data.titleName}</span>
                                </div>
                                <div class="center-center" style="gap: 63px; margin: 36px 29px;">
                                    <div class="row" style="border-right:lightgray solid thin;">
                                        <div class="row mb-36">
                                            <span class="font-size-16 font-weight-500 mb-22">Purpose of the Job</span>
                                            <span class="font-size-14 font-weight-400">${data.purpose}</span>
                                        </div>
                                        <div class="row">
                                            <span class="font-size-16 font-weight-500 mb-22">Core Responsibility</span>
                                            <span class="font-size-14 font-weight-400">${data.jobDescription}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <span class="font-size-16 font-weight-500 mb-22">Key Responsibility</span>
                                        <span class="font-size-14 font-weight-400">${data.keyResponsibility}</span>
                                    </div>
                                </div>
                            `;
                            document.getElementById('descriptionTitle').innerHTML = html;
                        });
                }
            }

        });
}


flatpickr("#birthdate-select", {
    dateFormat: "d/m/Y",
    maxDate: "today",
    onChange: function (selectedDates, dateStr, instance) {
        // เปลี่ยนข้อความใน #birthdate-select
        document.getElementById("birthdate-select").innerHTML = `
            ${dateStr} <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
        `;

        // เซ็ตค่าวันเกิดใน hidden input
        document.getElementById("birthDate").value = dateStr;

        // เปลี่ยนรูปภาพ calendar เป็น calendar-blue.svg
        const calendarImg = document.querySelector('#group-birtdate img');
        if (calendarImg) {
            calendarImg.src = $url + "image/calendar-blue.svg";
        }

        // เปลี่ยน background-color และ border ของ input-group-text
        const inputGroupText = document.querySelector('#group-birtdate .input-group-text');
        if (inputGroupText) {
            inputGroupText.style.backgroundColor = "rgb(215, 235, 255)";
            inputGroupText.style.border = "0.5px solid rgb(190, 218, 255)";
        }
    }
});

flatpickr("#hiring-select", {
    dateFormat: "d/m/Y",
    maxDate: "today",
    onChange: function (selectedDates, dateStr, instance) {
        document.getElementById("hiringDate").value = dateStr;
        document.getElementById("hiring-select").innerHTML = dateStr;

        // เปลี่ยนสีพื้นหลัง & icon
        document.getElementById("calendar-icon-hiring").style.backgroundColor = "rgb(215, 235, 255)";
        document.getElementById("calendar-icon-hiring").style.border = "0.5px solid rgb(190, 218, 255)";
        document.getElementById("calendar-img-hiring").src =
            $url + "image/calendar-blue.svg";
    }
});

flatpickr("#startProbationPicker", {
    inline: true,
    dateFormat: "d/m/Y",
    onChange: function (selectedDates, dateStr) {
        window.startDate = dateStr; // เก็บค่า Start Date
        updateSelectedDates();
    }
});

// กำหนด Flatpickr สำหรับปฏิทินสิ้นสุด
flatpickr("#endProbationPicker", {
    inline: true,
    dateFormat: "d/m/Y",
    onChange: function (selectedDates, dateStr) {
        window.endDate = dateStr; // เก็บค่า End Date
        updateSelectedDates();
    }
});


function initCerDateCalendar() {
    const calendarContainer = document.getElementById("flatpickrContainer");
    const trigger = document.getElementById("multi-cer-term");
    const label = document.getElementById("cer-date-label");
    const startInput = document.getElementById("fromCerDate");
    const endInput = document.getElementById("toCerDate");
    const checkbox = document.getElementById("noExpiryCheckbox");
    const rangeInput = document.getElementById("rangeCalendarInput");

    if (!calendarContainer || !trigger || !rangeInput || !checkbox) {
        console.warn('Calendar elements not found. Maybe popup not fully rendered yet.');
        return;
    }

    flatpickr(rangeInput, {
        mode: "range",
        dateFormat: "d-m-Y",
        defaultDate: [
            startInput.value || null,
            endInput.value || null
        ],
        onChange: function (selectedDates, dateStr, instance) {

            if (selectedDates.length === 2) {
                const [start, end] = selectedDates;
                const formattedStart = flatpickr.formatDate(start, "d-m-Y");
                const formattedEnd = flatpickr.formatDate(end, "d-m-Y");

                startInput.value = formattedStart;
                endInput.value = formattedEnd;
                label.innerText = `${formattedStart} - ${formattedEnd}`;
                // ✅ เปลี่ยน background
                const iconGroup = document.getElementById("due-term-cer-group");
                iconGroup.style.backgroundColor = "rgb(215, 235, 255)";
                iconGroup.style.border = "0.5px solid rgb(190, 218, 255)";

                // ✅ เปลี่ยนรูปภาพ
                const startImg = document.getElementById("start-img-cer");
                const weldImg = document.getElementById("weld-img-cer");
                const endImg = document.getElementById("end-img-cer");

                if (startImg) {
                    startImg.src = $url + "image/calendar-blue.svg";
                }
                if (weldImg) {
                    weldImg.src = $url + "image/weld.svg";
                }
                if (endImg) {
                    endImg.src = $url + "image/calendar-blue.svg";
                }

                // ปิด calendar
                calendarContainer.style.display = "none";
            }
        }
    });

    trigger.addEventListener("click", function () {
        calendarContainer.style.display =
            (calendarContainer.style.display === "none" || calendarContainer.style.display === "") ? "block" : "none";
    });

    document.addEventListener("click", function (event) {
        if (!calendarContainer.contains(event.target) && !trigger.contains(event.target)) {
            calendarContainer.style.display = "none";
        }
    });

    if (startInput.value && endInput.value) {
        label.innerText = `${startInput.value} - ${endInput.value}`;
    }
}



// ฟังก์ชันปรับสถานะตาม checkbox
function updateMultiDueTermState() {
    const checkbox = document.getElementById('override-probation-employee');
    const hiddenInput = document.getElementById('override-probation-employee-hidden');
    const multiDueTerm = document.getElementById('multi-due-term');
    if (checkbox.checked) {
        hiddenInput.value = "1";
        multiDueTerm.style.backgroundColor = ""; // เปิดใช้งาน
        multiDueTerm.style.pointerEvents = "auto";
    } else {
        hiddenInput.value = "0";
        multiDueTerm.style.backgroundColor = "#e9ecef"; // เทา ปิดใช้งาน
        multiDueTerm.style.pointerEvents = "none";
    }

    document.getElementById('override-probation-employee').addEventListener('change', function () {
        if (this.checked) {
            hiddenInput.value = "1";
            multiDueTerm.style.backgroundColor = ""; // หรือสีพื้นหลังปกติ เช่น "#fff"
            multiDueTerm.style.pointerEvents = "auto"; // เปิดให้คลิกได้
        } else {
            hiddenInput.value = "0";
            multiDueTerm.style.backgroundColor = "#e9ecef";
            multiDueTerm.style.pointerEvents = "none"; // ปิดไม่ให้คลิก
        }
    });
}





function openPopupModalCertificate() {
    var url = $url + 'setting/employee/modal-certificate'
    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            $('#certificateModalBody').html(response);
            $('#certificateModal').modal('show');
            setTimeout(() => {
                initCerDateCalendar();
            }, 100); // หรือ 200ms ถ้าจำเป็น
        },
        error: function () {
            $('#certificateModalBody').html('<p class="text-danger">Failed to load content.</p>');
            $('#certificateModal').modal('show');
        }
    });
}

function flatpickrDate() {

    var birthDate = document.getElementById('birthDate').value;
    // alert(birthDate);
    if (birthDate) {
        var el = document.getElementById('birthdate-select');
        if (el) {
            el.innerHTML = `${birthDate} <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>`;
        } else {
            console.warn('Element #birthdate-select not found');
        }

        const inputGroupText = document.querySelector('#group-birtdate .input-group-text');
        if (inputGroupText) {
            inputGroupText.style.backgroundColor = "rgb(215, 235, 255)";
            inputGroupText.style.border = "0.5px solid rgb(190, 218, 255)";
        }

        const calendarImg = document.querySelector('#group-birtdate img');
        if (calendarImg) {
            calendarImg.src = $url + "image/calendar-blue.svg";
        }
    }

    var hiringDate = document.getElementById('hiringDate').value;
    // alert(hiringDate);

    if (hiringDate) {
        var el = document.getElementById('hiring-select');
        if (el) {
            el.innerHTML = `${birthDate} <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>`;
        } else {
            console.warn('Element #hiring-select not found');
        }

        const inputGroupText = document.querySelector('#group-hiringdate .input-group-text');
        if (inputGroupText) {
            inputGroupText.style.backgroundColor = "rgb(215, 235, 255)";
            inputGroupText.style.border = "0.5px solid rgb(190, 218, 255)";
        }

        const calendarImg = document.querySelector('#group-hiringdate img');
        if (calendarImg) {
            calendarImg.src = $url + "image/calendar-blue.svg";
        }
    }

    const fromDate = document.getElementById('fromDate')?.value;
    const toDate = document.getElementById('toDate')?.value;
    // alert(fromDate);

    if (toDate && fromDate) {
        const el = document.getElementById('multi-due-term');
        if (fromDate && toDate && el) {
            el.innerHTML = `${fromDate} - ${toDate} <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>`;
        } else if (!el) {
            console.warn('Element #multi-due-term not found');
        }

        const inputGroupText = document.querySelector('#group-due-term .input-group-text');
        if (inputGroupText) {
            inputGroupText.style.backgroundColor = '#D7EBFF';
            inputGroupText.style.border = '0.5px solid #BEDAFF';
        }

        const images = inputGroupText.querySelectorAll('img');
        if (images) {
            images[0].src = $url + 'image/calendar-blue.svg';
            images[1].src = $url + 'image/weld.svg';
            images[2].src = $url + 'image/calendar-blue.svg';
        }
    }


}

function changeStatusEmployee() {
    const selectElement = document.getElementById('pim-status');
    const selectedId = parseInt(selectElement.value);

    // กำหนดคลาสใหม่ตาม employeeConditionId
    let newClass = '';

    switch (selectedId) {
        case 1:
            newClass = 'select-blue';
            break;
        case 2:
        case 3:
            newClass = 'select-blackblue';
            break;
        case 4:
            newClass = 'select-yellow';
            break;
        case 5:
        case 6:
            newClass = 'select-orange';
            break;
        case 7:
            newClass = 'select-pink';
            break;
        case 8:
            newClass = 'select-red';
            break;
        case 9:
            newClass = 'select-whiteorange';
            break;
        default:
            newClass = 'select-employee-status';
            break;
    }

    // ล้างคลาสเก่าออกทั้งหมด แล้วใส่เฉพาะคลาสสีใหม่
    selectElement.className = newClass;
}

