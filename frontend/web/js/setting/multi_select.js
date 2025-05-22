const tags = document.getElementById('tags');
const input = document.getElementById('input-tag');

input.addEventListener('keydown', function (event) {
    if (event.key === 'Enter') {

        event.preventDefault();
        var currentId = parseInt($("#currentId").val());
        var nextId = currentId + 1;
        const tag = document.createElement('li');
        const tagContent = input.value.trim();


        if (tagContent !== '') {
            tag.innerText = tagContent;
            tag.innerHTML += '<span class="delete-button" id="' + currentId + '" onClick="javascript:deleteTags(' + currentId + ')">X</span>';
            // tags.appendChild(tag);
            $("#show-text").append(tag);
            $("#currentId").val(nextId);
            var tagValue = '<input type="hiddin" name="tags[]" id="tag-' + currentId + '" value="' + tagContent + '">';
            $("#tag-value").append(tagValue);
            input.value = '';

        }
    }
});

/*tags.addEventListener('click', function (event) {
    
    if (event.target.classList.contains('delete-button')) {
       
         event.target.parentNode.remove();
    }
});*/
function deleteTags(id) {
    tags.addEventListener('click', function (event) {
        if (event.target.classList.contains('delete-button')) {
            event.target.parentNode.remove();
        }
    });
    $("#tag-" + id).remove();
}


function applySelectStyleGroup(select) {
    // ตรวจสอบว่า value มีจริง (แม้ว่าเป็น "0" ก็ถือว่า valid)
    const hasValue = select.value !== "" && select.value !== null;

    // เปลี่ยน class
    if (hasValue) {
        select.classList.remove("select-pim");
        select.classList.add("select-pimselect");
    } else {
        select.classList.remove("select-pimselect");
        select.classList.add("select-pim");
    }

    // กรณีเปลี่ยน Company
    if (select.id === "companySelect") {
        const branchSelect = document.getElementById("branchSelect");
        const departmentSelect = document.getElementById("departmentSelect");

        if (hasValue) {
            branchSelect.disabled = false;
        } else {
            branchSelect.disabled = true;
            branchSelect.value = "";
            applySelectStyleGroup(branchSelect);
        }

        // reset และ disable department ทุกครั้งที่เปลี่ยน company
        departmentSelect.disabled = true;
        departmentSelect.value = "";
        applySelectStyleGroup(departmentSelect);
    }

    // กรณีเปลี่ยน Branch
    if (select.id === "branchSelect") {
        const departmentSelect = document.getElementById("departmentSelect");

        if (hasValue) {
            departmentSelect.disabled = false;
        } else {
            departmentSelect.disabled = true;
            departmentSelect.value = "";
        }

        applySelectStyleGroup(departmentSelect);
    }
}
