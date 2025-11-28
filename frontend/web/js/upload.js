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
    }
});
$("#imageUpload").on("change", function () {
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

$("#uploadImag").on("mouseenter", function () {
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