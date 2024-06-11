function move() {
    var elem = document.getElementById("myBarprogress_steps");
    var width = 0;
    var id = setInterval(frame, 20);

    function frame() {
        if (width >= 100) {
            clearInterval(id);
            document.getElementById("myP").className = "w3-text-green w3-animate-opacity";
            document.getElementById("myP").innerHTML = "3  steps completed!";
        } else {
            width++;
            elem.style.width = width + '%';
            var num = width * 1 / 40;
            num = num.toFixed(0)
            document.getElementById("number_steps_first").innerHTML = num;
        }
    }
}


