<?php
use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$statusform = 'create';
$this->title = 'Create Employee';
?>

<?php $form = ActiveForm::begin([
    'id' => 'create-employee',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'setting/employee/save-create-employee'
]); ?>
<div class="mt-100">
    <div class="avatar-upload" style="margin:0px">
        <div class="avatar-preview" id="cerPreview" style="
            background-color: white;
            fill: #FFF; 
            stroke-width: 1px;
            stroke: var(--Primary-Blue---HRVC, #2580D3);
            border-radius: 20%;
            padding: 10px;
            text-align: center;
            cursor: pointer;">
            <label for="cerimage" class="upload-label" style="cursor: pointer; display: block;">
                <img id="previewImage" src="<?= Yii::$app->homeUrl ?>image/upload-plusimg.svg"
                    style="width: 150px; height: 150px;" alt="Upload Icon">
            </label>
        </div>
        <input type="file" name="cerImage" id="cerimage" style="display: none;">
    </div>

    <div id="upload-file3" class="form-control"
        style="border:1.22px dashed var(--Stroke-Bluish-Gray, #BBCDDE); width: 60%; ">
        <div class="row">
            <div class="col-lg-2 center-center">
                <img id="icon-file3" src="<?= Yii::$app->homeUrl ?>image/file-big.svg" alt="icon"
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
            <input id="certificate" style="display:none;" type="file" name="certificate" multiple>
        </div>
    </div>

    <button type="button" class="btn-save-group" onclick="createScheduleTest()">
        Create <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" style="width: 20px; height: 20px;">
    </button>


    <!-- container สำหรับเก็บ input ไฟล์ทั้งหมด -->
    <div id="imgInputsContainer"></div>

    <div id="fileInputsContainer"></div>


    <button type="submit">Upload</button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
let uploadedCerFile = null; // สำหรับ cerimage
let uploadedCertificateFiles = []; // สำหรับ certificate (multiple files)

// $('#cerPreview').on('click', function() {
//     $('#cerimage').trigger('click');
// });

$('#cerimage').on('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        uploadedCerFile = file;
        $('#previewImage').attr('src', URL.createObjectURL(file));
    }
});

$('#certificate').on('change', function(e) {
    uploadedCertificateFiles = Array.from(e.target.files); // เก็บไฟล์หลายไฟล์
    if (uploadedCertificateFiles.length > 0) {
        $('#certificate-check').show();
    } else {
        $('#certificate-check').hide();
    }
});

function createScheduleTest() {
    // สร้าง hidden input สำหรับ cerimage (ถ้ามี)
    if (uploadedCerFile) {
        const dtCer = new DataTransfer();
        dtCer.items.add(uploadedCerFile);
        const countCer = $('#fileInputsContainer input[type="file"]').length + 1;
        const inputNameCer = 'cerImageHidden' + countCer;
        const inputIdCer = 'cerImageHidden' + countCer;

        const newInputCer = $('<input>', {
            type: 'file',
            name: inputNameCer,
            id: inputIdCer,
            style: 'display:none'
        });
        newInputCer[0].files = dtCer.files;
        $('#fileInputsContainer').append(newInputCer);
        alert('File input cerimage #' + countCer + ' created.');
    } else {
        alert('Please upload a cerimage file first!');
        return;
    }

    // สร้าง hidden input สำหรับ certificate (ถ้ามี)
    if (uploadedCertificateFiles.length > 0) {
        uploadedCertificateFiles.forEach((file, index) => {
            const dtCert = new DataTransfer();
            dtCert.items.add(file);

            const countCert = $('#imgInputsContainer input[type="file"]').length + 1;
            const inputNameCert = 'certificateHidden' + countCert;
            const inputIdCert = 'certificateHidden' + countCert;

            const newInputCert = $('<input>', {
                type: 'file',
                name: inputNameCert,
                id: inputIdCert,
                style: 'display:none'
            });
            newInputCert[0].files = dtCert.files;
            $('#imgInputsContainer').append(newInputCert);
        });
        alert(uploadedCertificateFiles.length + ' certificate file(s) added.');
    }
}
</script>


<?php ActiveForm::end(); ?>