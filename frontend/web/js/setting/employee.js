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
    if (type == 1) {
        if ($("#resume").length > 0) {
            $("#hasResume").val(1);
            $("#resume-check").show()
        } else {
            $("#hasResume").val('');
            $("#resume-check").hide()
        }
    }
    if (type == 2) {
        if ($("#agreement").length > 0) {
            $("#hasAgreement").val(1);
            $("#agreement-check").show()
        } else {
            $("#hasAgreement").val('');
            $("#agreement-check").hide()
        }
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

