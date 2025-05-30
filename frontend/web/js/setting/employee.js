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
    if (type !== 1 && type !== 2) return;

    const inputId = (type === 1) ? "resume" : "agreement";
    const hasInputId = (type === 1) ? "hasResume" : "hasAgreement";
    const checkId = (type === 1) ? "resume-check" : "agreement-check";

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

        let iconSrc = $url + "image/ex-file.svg";
        if (fileExtension === "pdf") {
            iconSrc = $url + "image/pdf-file.svg";
        }

        const now = new Date();
        const time = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const date = now.toLocaleDateString('en-GB');

        document.getElementById(wrapperId).innerHTML = `
            <div class="row">
                <div class="col-lg-2 center-center">
                    <img id="${iconId}" src="${iconSrc}" alt="icon" style="width: 40px; height: 40px;">
                </div>
                <div id="${nameId}" class="col-lg-6 col-md-6 col-12" style="border-right:lightgray solid thin;">
                    <label class="font-size-16 font-weight-600" for="name">${fileName}</label>
                    <div class="text-secondary text-gray font-size-14">
                        <span class="text-gray font-size-12">${time} • ${date}</span>
                    </div>
                </div>
                <div id="file-edit${type}" class="col-lg-4 d-flex justify-content-center align-items-center gap-3">
                    <a href="#" onclick="viewFile('${fileName}')">
                        <img id="${eyeId}" src="${$url}images/icons/Settings/eye.svg" alt="icon" style="width: 23px; height: 23px;">
                    </a>
                    <a href="#" class="mt-5 ml-9" onclick="removeFile(${type})">
                        <img id="${binId}" src="${$url}images/icons/Settings/binred.svg" alt="icon" style="width: 28px; height: 28px;">
                    </a>
                    <a href="#" onclick="resetUpload(${type})">
                        <img id="${refesId}" src="${$url}image/refes-blue.svg" alt="icon" style="width: 18px; height: 18px;">
                    </a>
                </div>
            </div>
        `;

        document.getElementById(wrapperId).style.border = "1px solid var(--Stroke-Bluish-Gray, #BBCDDE)";
        document.getElementById(hasInputId).value = 1;
        document.getElementById(checkId).style.display = 'inline';
    } else {
        document.getElementById(hasInputId).value = '';
        document.getElementById(checkId).style.display = 'none';
    }
}


function viewFile(fileName) {
    alert("Preview file: " + fileName);
    // หรือใช้ window.open(pathToFile) ถ้ามี path
}


function removeFile(type) {
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
                    <label for="resume" class="text-blue font-size-16 font-weight-600" style="cursor: pointer;">
                        Upload
                        <img src="${$url}image/file-up-blue.svg" alt="icon"
                            style="width: 16px; height: 16px;">
                    </label>
                    <span class="ml-5 text-success" id="resume-check" style="display:none;">
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </span>
                    <input id="resume" style="display:none;" type="file" name="resume"
                        onchange="javascript:checkUploadFile(1)">
                    <input type="hidden" value="" id="hasResume">
                </div>
            </div>
        `;
        document.getElementById("upload-file1").style.border = "border:1.22px dashed var(--Stroke-Bluish-Gray, #BBCDDE)";

        // แทนที่ div ด้วย HTML ดั้งเดิม
        document.getElementById("upload-file1").innerHTML = originalHTML;
    }
}

function resetUpload(type) {
    if (type === 1) {
        document.getElementById("resume").value = '';
        checkUploadFile(1);
    }
}

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
}

