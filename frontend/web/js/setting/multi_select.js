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