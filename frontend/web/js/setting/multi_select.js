const tags = document.getElementById('tags');
const input = document.getElementById('input-tag');

input.addEventListener('keydown', function (event) {
    if (event.key === 'Enter') {

        event.preventDefault();

        const tag = document.createElement('li');
        const tagContent = input.value.trim();


        if (tagContent !== '') {

            tag.innerText = tagContent;
            tag.innerHTML += '<span class="delete-button">X</span>';
            // tags.appendChild(tag);
            $("#show-text").append(tag);
            //input.appendChild(tag);
            input.value = '';
        }
    }
});

tags.addEventListener('click', function (event) {
    if (event.target.classList.contains('delete-button')) {
        event.target.parentNode.remove();
    }
});