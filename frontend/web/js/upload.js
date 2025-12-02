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
let statusOldBanner = 0;


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
// $("#imageUploadBanner").on("change", function () {
    
// 	 let file = this.files[0];
//     //  	  if (!file){ return;}
//     //       if (!['image/jpeg','image/png'].includes(file.type)) {
//     //     alert('Only JPEG and PNG files are allowed.');
//     //     event.target.value = '';
//     //     return;
//     //       }
//     // if (file.size > (2 * 1024 * 1024)) {
//     //     alert("File size over than 2 MB");
//     //         $(this).val("");
//     //     return;
//     // }else{
//         alert(file);
//             uploadedCerFile = file;
//                 $('#old-banner').attr('src', URL.createObjectURL(file));
//                 $('#d-up-img1').hide();
//                 $('#d-up-img2').hide();
//                 iconBinRe();
//     // }
// });

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
        $('#old-banner').attr('src', URL.createObjectURL(file));
        $("#icon-banner").hide();
    }
});

$("#imagePreviewBanner").on("click", function (e) {
    e.stopPropagation(); // ❗ กันไม่ให้ event เด้งกลับเข้ามาอีก
    $('#imageUploadBanner').click(); 
});


$("#imagePreviewBanner").on("mouseenter", function () {
        let bgImg = $("#imagePreviewBanner").css("background-image");
        if (bgImg !== 'none'){
            statusOldBanner = 1; // มีรูปอย่างน้อย 1 รูป
            // alert(statusOldBanner);
        } else {
            statusOldBanner = 0; // ไม่มีรูปเลย
            // alert(statusOldBanner);
        }
        if(statusOldBanner == 1) {
            // if (!$("#bin-banner").is(":visible")) $("#bin-banner").fadeIn(200);
            // if (!$("#refes-banner").is(":visible")) $("#refes-banner").fadeIn(200);
            $("#bin-banner").show();
            $("#refes-banner").show();

            $("#imagePreviewBanner").css({
                    "filter": "brightness(50%)",
                    "transition": "filter 0.3s"
            });
        }
});

$("#imagePreviewBanner,#bin-banner,#refes-banner").on("mouseleave", function (e) {
        const to = e.relatedTarget; // element ที่เมาส์กำลังจะไป
        // ถ้า relatedTarget เป็น null → อย่า hide เลย
        if (!to) {
            return;
        }
        // ถ้ายังอยู่บนปุ่ม หรือ element ลูกของปุ่ม → ไม่ hide
        if (
            $(to).closest("#bin-banner").length > 0 ||
            $(to).closest("#refes-banner").length > 0 ||
            $(to).closest("#banner-action-buttons").length > 0 ||
            $(to).closest("#imagePreviewBanner").length > 0
        ) {
            console.log("still inside buttons");
            return;
        }
        $("#bin-banner").stop(true, true).fadeOut(200);
        $("#refes-banner").stop(true, true).fadeOut(200);
        $("#imagePreviewBanner").css({
            "filter": "brightness(100%)"
        });
});

$("#imagePreview").on("mouseenter", function () {
    let bgImg = $("#imagePreview").css("background-image");
    if (bgImg !== 'none'){
        statusOldImage = 1; // มีรูปอย่างน้อย 1 รูป
    } else {
        statusOldImage = 0; // ไม่มีรูปเลย
    }
    if(statusOldImage == 1) {

    if (!$("#bin-img").is(":visible")) $("#bin-img").fadeIn(200);
    if (!$("#refes-img").is(":visible")) $("#refes-img").fadeIn(200);


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

$("#imagePreview,#bin-img,#refes-img").on("mouseleave", function (e) {
    const to = e.relatedTarget; // element ที่เมาส์กำลังจะไป

    // ถ้า relatedTarget เป็น null → อย่า hide เลย
    if (!to) {
        return;
    }

    // ถ้ายังอยู่บนปุ่ม หรือ element ลูกของปุ่ม → ไม่ hide
    if (
        $(to).closest("#bin-img").length > 0 ||
        $(to).closest("#refes-img").length > 0 ||
        $(to).closest("#cer-action-buttons").length > 0 ||
        $(to).closest("#imagePreview").length > 0
    ) {
        console.log("still inside buttons");
        return;
    }

    // ออกจากรูป + ปุ่มทั้งหมด → ค่อย hide
    $("#bin-img").stop(true, true).fadeOut(200);
    $("#refes-img").stop(true, true).fadeOut(200);

    $("#imagePreview").css({
        "filter": "brightness(100%)"
    });
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



$("#bin-banner").on("click", function () {

    // เคลียร์ไฟล์ input
    $("#imageUploadBanner").val("");

    // เคลียร์ background image
    $("#imagePreviewBanner").css("background-image", "");
    $("#old-banner").attr("src", ""); 
    
    // Reset แสง ให้เห็น icon-image ชัด ๆ
    $("#old-banner").css("filter", "brightness(100%)");

    // แสดง UI อัปโหลดกลับมา
    // $("#icon-image").show();
    // $("#d-up-img1").show();
    // $("#d-up-img2").show();


    // ซ่อนปุ่มลบและรีเฟรช
    $("#bin-banner").hide();
    $("#refes-banner").hide();
    $("#icon-banner").show();
});


$("#refes-banner").on("click", function () {
    $('#imageUploadBanner').click(); // เปิด file picker
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