// const uploadBox = document.getElementById('upload-box');
// const inputFile = document.querySelector('.input-file');

// uploadBox.addEventListener('click', () => inputFile.click());

// // Drag & Drop
// uploadBox.addEventListener('dragover', (e) => {
//     e.preventDefault();
//     uploadBox.style.backgroundColor = '#eceff1';
// });
// uploadBox.addEventListener('dragleave', (e) => {
//     e.preventDefault();
//     uploadBox.style.backgroundColor = '#f9fafb';
// });
// uploadBox.addEventListener('drop', (e) => {
//     e.preventDefault();
//     uploadBox.style.backgroundColor = '#f9fafb';
//     const files = e.dataTransfer.files;
//     if(files.length > 0){
//         inputFile.files = files;
//         handleFiles({target: inputFile});
//     }
// });
let statusOldImage = 0;


$("#imgUpload").on("change", function () {
	 let file = this.files[0];
     	  if (!file){ return;}
          if (!['image/jpeg','image/png'].includes(file.type)) {
        alert('Only JPEG and PNG files are allowed.');
        event.target.value = '';
        return;
          }
    if (file.size > (2 * 1024 * 1024)) {
        alert("File size over than 2 MB");
            $(this).val("");
        return;
    }else{
            uploadedCerFile = file;
                $('#old-image').hide();
                $('#icon-image').hide();
                $('#d-up-img1').hide();
                $('#d-up-img2').hide();
                $('#new-image').show();
                $('#new-image').attr('src', URL.createObjectURL(file));
                // iconBinRe();
                statusOldImage = 1;

    }
});
$("#imageUpload").on("change", function () {
    // alert(1);
	 let file = this.files[0];
     	  if (!file){ return;}
          if (!['image/jpeg','image/png'].includes(file.type)) {
        alert('Only JPEG and PNG files are allowed.');
        event.target.value = '';
        return;
          }
    if (file.size > (2 * 1024 * 1024)) {
        alert("File size over than 2 MB");
            $(this).val("");
        return;
    }else{
            uploadedCerFile = file;
                // iconBinRe();
                $('#icon-image').hide();
                $('#d-up-img1').hide();
                $('#d-up-img2').hide();
                statusOldImage = 1;
    }
});
$("#imageUploadBanner").on("change", function () {
	 let file = this.files[0];
     	  if (!file){ return;}
          if (!['image/jpeg','image/png'].includes(file.type)) {
        alert('Only JPEG and PNG files are allowed.');
        event.target.value = '';
        return;
          }
    if (file.size > (2 * 1024 * 1024)) {
        alert("File size over than 2 MB");
            $(this).val("");
        return;
    }else{
            uploadedCerFile = file;
                $('#old-image').attr('src', URL.createObjectURL(file));
                $('#d-up-img1').hide();
                $('#d-up-img2').hide();
                iconBinRe();
    }
});

$("#imagePreview").on("mouseenter", function () {
    let bgImg = $("#imagePreview").css("background-image");
    if (bgImg !== 'none'){
        statusOldImage = 1; // มีรูปอย่างน้อย 1 รูป
    } else {
        statusOldImage = 0; // ไม่มีรูปเลย
    }
    // alert(statusOldImage);
    if(statusOldImage == 1) {
        if ($("#bin-img").is(":hidden")) $("#bin-img").fadeIn(300);
        if ($("#refes-img").is(":hidden")) $("#refes-img").fadeIn(300);
        // alert(statusOldImage);
        if ($("#imagePreview").is(":visible")) {
            $("#imagePreview").css({
                "filter": "brightness(50%)",
                "transition": "filter 0.3s"
            });
        } else {
            $("#imagePreview").css({
                "filter": "brightness(50%)",
                "transition": "filter 0.3s"
            });
        }
    }
});

$("#imagePreview").on("mouseleave", function () {
    $("#bin-img").fadeOut(300);
    $("#refes-img").fadeOut(300);
    $("#imagePreview").css({
        "filter": "brightness(100%)"
    });
});

$("#bin-img").on("click", function () {

    // เคลียร์ไฟล์ input
    $("#imageUpload").val('');

    // เคลียร์ background image
    $("#imagePreview").css("background-image", "");

    // Reset แสง ให้เห็น icon-image ชัด ๆ
    $("#imagePreview").css("filter", "brightness(100%)");

    // แสดง UI อัปโหลดกลับมา
    $("#icon-image").show();
    $("#d-up-img1").show();
    $("#d-up-img2").show();

    // ซ่อนปุ่มลบและรีเฟรช
    $("#bin-img").hide();
    $("#refes-img").hide();
});
$("#refes-img").on("click", function () {
    $('#imageUpload').click(); // เปิด file picker
});


$("#uploadImag").on("mouseenter", function () {
    let oldImgSrc = $("#old-image").attr("src");
    let newImgSrc = $("#new-image").attr("src");

    // ถ้า old หรือ new มีค่าซักอัน → status = 1
    if ((oldImgSrc && oldImgSrc.trim() !== "") ||
        (newImgSrc && newImgSrc.trim() !== "")) {

        statusOldImage = 1; // มีรูปอย่างน้อย 1 รูป
    } else {
        statusOldImage = 0; // ไม่มีรูปเลย
    }

    if(statusOldImage == 1) {
    if ($("#bin-file").is(":hidden")) $("#bin-file").fadeIn(300);
    if ($("#refes-file").is(":hidden")) $("#refes-file").fadeIn(300);

    if ($("#old-image").is(":visible")) {
        $("#old-image").css({
            "filter": "brightness(50%)",
            "transition": "filter 0.3s"
        });
    } else {
        $("#new-image").css({
            "filter": "brightness(50%)",
            "transition": "filter 0.3s"
        });
    }
    }
});

$("#uploadImag").on("mouseleave", function () {
    $("#bin-file").fadeOut(300);
    $("#refes-file").fadeOut(300);
    $("#old-image, #new-image").css({
        "filter": "brightness(100%)"
    });
});

// // Hover เพื่อโชว์/ซ่อน icon
// // เมื่อเมาส์เข้า → รูปมืดลง + แสดงปุ่ม
// $("#new-image, #old-image, #bin-file, #refes-file").on("mouseenter", function () {
//     // แสดงปุ่ม — เช็คก่อนว่าแสดงหรือยัง
//     console.log('3');
//     if ($("#bin-file").is(":hidden")) $("#bin-file").fadeIn(300);
//     if ($("#refes-file").is(":hidden")) $("#refes-file").fadeIn(300);

//     // ถ้า old-image โชว์ → ให้ทำ effect กับ old-image
//     if ($("#old-image").is(":visible")) {
//         $("#old-image").css({
//             "filter": "brightness(50%)",
//             "transition": "filter 0.3s"
//         });
//     } 
//     // ถ้า old-image ซ่อน → ทำ effect กับ new-image
//     else {
//         $("#new-image").css({
//             "filter": "brightness(50%)",
//             "transition": "filter 0.3s"
//         });
//     }
// });

// if ($("#new-image").is(":visible")) {
// // เมื่อเมาส์ออก → รูปกลับปกติ + ซ่อนปุ่ม
// console.log('1');
//     $("#new-image").on("mouseleave", function () {
//         $("#bin-file").fadeOut(300);
//         $("#refes-file").fadeOut(300);
//         $("#new-image").css({
//             "filter": "brightness(100%)", // คืนสีเดิม
//             "transition": "filter 0.3s"
//         });
//     });
// }

// if ($("#old-image").is(":visible")) {
// console.log('2');
//     $("#old-image").on("mouseleave", function () {
//         $("#bin-file").fadeOut(300);
//         $("#refes-file").fadeOut(300);
//         $("#new-image").css({
//                 "filter": "brightness(100%)", // คืนสีเดิม
//                 "transition": "filter 0.3s"
//         });
//     });
// }

function handleFiles(event) {
    const file = event.target.files[0];
    if (!file) return;

    if (!['image/jpeg','image/png'].includes(file.type)) {
        alert('Only JPEG and PNG files are allowed.');
        event.target.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e){
        const img = document.getElementById('preview-image');
        img.src = e.target.result;
        img.onload = function(){
            if(img.naturalWidth <= img.naturalHeight){
                alert('Please upload a landscape (horizontal) image.');
                event.target.value = '';
                document.getElementById('preview-container').style.display='none';
            } else {
                document.getElementById('preview-container').style.display = 'block';
                document.getElementById('system-picture') = file;
            }
        };
    };
    reader.readAsDataURL(file);
}