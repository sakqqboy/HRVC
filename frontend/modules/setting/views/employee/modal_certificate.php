<div class="between-start">
    <!-- head modal -->
    <div>
        <span class="text-blue font-size-24 font-weight-500">
            Add Certificate
        </span>
    </div>
    <div>
        <a href="javascript:void(0);" onclick="$('#certificateModal').modal('hide');">
            <img src="<?= Yii::$app->homeUrl ?>image/modal-exit.svg" style="width: 24px; height: 24px;">
        </a>
    </div>
</div>

<div class="row" style="gap: 37px; ">
    <div class="d-flex" style="gap: 38px;">
        <div class="avatar-upload" style="margin:0px">
            <div class="avatar-preview" id="imagePreview" style="
                            background-color: white;
                            fill: #FFF; 
                            stroke-width: 1px;
                            stroke: var(--Primary-Blue---HRVC, #2580D3);
                            border-radius: 20%;
                            padding: 10px;
                            text-align: center;
                            cursor: pointer;
                        ">
                <label for="imageUpload" class="upload-label" style="cursor: pointer;  display: block;">
                    <img src="<?= Yii::$app->homeUrl ?>image/upload-plusimg.svg" style="width: 150px; height: 150px;"
                        alt="Upload Icon">
                </label>
                <input type="file" name="cerImage" id="image" class="upload up upload-checklist" style="display: none;">
            </div>
        </div>
        <div class="row" style="gap: 12px; ">
            <div class="container">
                <div class="row mb-30">
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-size-16 font-weight-500">
                            <span class="text-danger">*</span> Certificate Name
                        </label>
                        <input type="text" class="form-control font-size-14" id="cerName" name="cerName"
                            placeholder="Write the name of the certificate" value="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-size-16 font-weight-500">
                            <span class="text-danger">*</span> Issuing Institute / Authority
                        </label>
                        <input type="text" class="form-control font-size-14" id="issuingName" name="issuingName"
                            placeholder="Write the issuer authority name" value="">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label for="issueExpiryDate" class="form-label font-size-16 font-weight-500">
                            <span class="text-danger">*</span> Issue & Expiry Date
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top" title="ttt" alt="Help icon">
                        </label>
                        <!-- <input type="text" class="form-control font-size-14" value=""> -->

                        <!-- ✅ แก้ ID ให้ไม่ซ้ำ -->
                        <div class="input-group" id="cer-due-term-group" style="position: relative;">
                            <span class="input-group-text pb-10 pt-10" id="due-term-icon-group"
                                style="background-color: #C3C3C3; border:0.5px solid #818181; border-radius: 36px; gap: 4px; z-index: 1; height: 40px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" data-icon="calendar"
                                    id="start-img-cer" alt="Calendar" style="width: 16px; height: 16px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/weld-gray.svg" data-icon="weld" alt="Weld"
                                    id="weld-img-cer" style="width: 16px; height: 16px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" data-icon="calendar"
                                    id="end-img-cer" alt="Calendar" style="width: 16px; height: 16px;">
                            </span>

                            <!-- ✅ ตัวที่เปิด datepicker -->
                            <div class="form-control" id="multi-cer-term"
                                style="border-radius: 53px; text-align: center; cursor: pointer; position: absolute; width: 100%; height: 40px;">
                                <span class="font-size-12 font-weight-500 ml-60" id="cer-date-label">
                                    start date - end date
                                </span>
                                <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
                            </div>

                            <!-- ✅ hidden -->
                            <input type="hidden" id="fromCerDate" name="fromDate"
                                value="<?= isset($data['cerStart']) ? $data['cerStart'] : '' ?>" required>
                            <input type="hidden" id="toCerDate" name="toDate"
                                value="<?= isset($data['cerEnd']) ? $data['cerEnd'] : '' ?>" required>
                        </div>

                        <!-- ✅ ปฏิทิน (แสดงเฉพาะ Flatpickr) -->
                        <div class="calendar-container" id="flatpickrContainer"
                            style="display: none; position: absolute; padding: 10px; border: 1px solid #ddd; border-radius: 10px; background: #fff; width: 350px; gap: 3px; z-index: 1;">
                            <input type="text" id="rangeCalendarInput" value="start date - end date"
                                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="credentialLink" class="form-label font-size-16 font-weight-500">
                            <span class="text-danger">*</span> Credential Link
                        </label>
                        <input type="text" class="form-control font-size-14" id="credential" name="credential"
                            placeholder="Input the link of evidence (if any)" value="">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-start align-items-center" style="gap: 10px;">
                <input type="checkbox" id="noExpiryCheckbox">
                <label class="mb-0" for="noExpiryCheckbox">The Certificate does not have expiry date</label>
            </div>
        </div>
    </div>

    <div class="between-start d-flex  align-items-center">
        <div id="upload-file2" class="form-control"
            style="border:1.22px dashed var(--Stroke-Bluish-Gray, #BBCDDE); width: 60%; ">
            <div class="row">
                <div class="col-lg-2 center-center">
                    <img id="icon-file2" src="<?= Yii::$app->homeUrl ?>image/file-big.svg" alt="icon"
                        style="width: 40px; height: 40px;">
                </div>
                <div id="file-uplode-name3" class="col-lg-6 col-md-6 col-12" style="border-right:lightgray solid thin;">
                    <label class="text-gray font-size-16 font-weight-500" for="name">
                        Upload Certificate
                    </label>
                    <div class="text-secondary text-gray  font-size-14">
                        <span class="text-gray font-size-12"> Supported - pdf, .doc, .docx, png, jpeg</span>
                    </div>
                </div>
                <div id="file-edit3" class="col-lg-4 col-md-6 col-12 text-center pt-13">
                    <label id="certificate-btn" type="button" for="certificate"
                        class="text-blue font-size-16 font-weight-600">
                        Upload
                        <img src="<?= Yii::$app->homeUrl ?>image/file-up-blue.svg" alt="icon"
                            style="width: 16px; height: 16px;">
                    </label>
                    <span class="ml-5 text-success" id="certificate-check" style="display:none;">
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </span>

                </div>
                <input id="certificate" style="display:none;" type="file" name="certificate"
                    onchange="javascript:checkUploadFile(2)">
            </div>
        </div>
        <div class="d-flex" style="gap: 22px;">
            <a href="javascript:void(0);" onclick="$('#certificateModal').modal('hide');"
                style="text-decoration: none;">
                <button type="button" class="btn-cancel-group"
                    action="<?= Yii::$app->homeUrl ?>setting/group/create-group">Cancel</button>
            </a>

            <button type="button" class="btn-save-group" onclick="createSchedule()">
                Create <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                    style="width: 20px; height: 20px;">
            </button>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
const calendarContainer = document.getElementById("flatpickrContainer");
const trigger = document.getElementById("multi-cer-term");
const label = document.getElementById("cer-date-label");
const startInput = document.getElementById("fromCerDate");
const endInput = document.getElementById("toCerDate");
const rangeInput = document.getElementById("rangeCalendarInput");
const checkbox = document.getElementById("noExpiryCheckbox");

// เปิด flatpickr แบบ range
flatpickr(rangeInput, {
    mode: "range",
    dateFormat: "Y-m-d",
    defaultDate: [
        startInput.value || null,
        endInput.value || null
    ],
    onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length === 2) {
            const [start, end] = selectedDates;
            const formattedStart = flatpickr.formatDate(start, "Y-m-d");
            const formattedEnd = flatpickr.formatDate(end, "Y-m-d");

            startInput.value = formattedStart;
            endInput.value = formattedEnd;
            label.innerText = `${formattedStart} - ${formattedEnd}`;

            // ปิด calendar
            calendarContainer.style.display = "none";
        }
    }
});

// แสดง/ซ่อน calendar
trigger.addEventListener("click", function() {
    // alert('dd');
    calendarContainer.style.display = (calendarContainer.style.display === "none" ||
        calendarContainer.style.display === "") ? "block" : "none";
});

// ปิดเมื่อคลิกข้างนอก
document.addEventListener("click", function(event) {
    if (!calendarContainer.contains(event.target) && !trigger.contains(event.target)) {
        calendarContainer.style.display = "none";
    }
});

// โหลด label ถ้ามีค่าจากเดิม
if (startInput.value && endInput.value) {
    label.innerText = `${startInput.value} - ${endInput.value}`;
}

// ✅ ปิด/เปิดการเลือกวันตาม checkbox
checkbox.addEventListener("change", function() {
    const isDisabled = checkbox.checked;
    // alert('ddd');
    if (isDisabled) {
        // ปิดปฏิทิน
        calendarContainer.style.display = "none";

        // ล้างค่า
        startInput.value = '';
        endInput.value = '';
        rangeInput.value = '';
        label.innerText = 'No expiry date';
        trigger.style.pointerEvents = 'none';
        trigger.style.opacity = '0.6';
    } else {
        // เปิดให้เลือกวันได้
        trigger.style.pointerEvents = 'auto';
        trigger.style.opacity = '1';
        label.innerText = (startInput.value && endInput.value) ?
            `${startInput.value} - ${endInput.value}` :
            'start date - end date';
    }
});
</script>