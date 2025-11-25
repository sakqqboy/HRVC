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
     var save=1;
     	  if (!file){ return;}
    if (file.size > (2 * 1024 * 1024)) {
        alert("File size over than 2 MB");
            $(this).val("");
        return;
    }else{
	//  let img = new Image();
    // img.src = URL.createObjectURL(file);
    // img.onload = function () {
    //     let w = img.width;
    //     let h = img.height;
    //     if (w !== h) {
    //         alert("รูปต้องเป็นสี่เหลี่ยมจัตุรัส (กว้าง = สูง)");
    //         $("#imgUpload").val("");
    //             $(this).val("");
    //         return;
    //     }else{
            uploadedCerFile = file;
                // alert('1');
                $('#old-image').attr('src', URL.createObjectURL(file));
                $('#d-up-img1').hide();
                $('#d-up-img2').hide();

                iconBinRe();
        //}
    //}
}
});
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