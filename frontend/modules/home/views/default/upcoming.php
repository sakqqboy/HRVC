<?php 
// echo '55555';
?>
<ul class="list-unstyled small">

    <li class="schedule-item mt-5">
        <strong>Update KPI</strong> - Non-Japanese Client<br>
        <span class="text-muted">10:00 AM, 01/12/2024</span>
    </li>
    <li class="schedule-item mt-5">
        <strong>Submit Report</strong> - Team Performance<br>
        <span class="text-muted mt-5">2:00 PM, 01/12/2024</span>
    </li>
    <li class="schedule-item mt-5">
        <strong>Update KPI</strong> - Non-Japanese Client<br>
        <span class="text-muted">10:00 AM, 01/12/2024</span>
    </li>
    <li class="schedule-item mt-5">
        <strong>Submit Report</strong> - Team Performance<br>
        <span class="text-muted">2:00 PM, 01/12/2024</span>
    </li>
    <li class="schedule-item mt-5">
        <strong>Update KPI</strong> - Non-Japanese Client<br>
        <span class="text-muted">10:00 AM, 01/12/2024</span>
    </li>
    <li class="schedule-item mt-5">
        <strong>Submit Report</strong> - Team Performance<br>
        <span class="text-muted">2:00 PM, 01/12/2024</span>
    </li>

</ul>


<script>
$(document).ready(function() {
    restData()
});

var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;

function restData() {
    var url = $url + `home/dashboard/upcoming-schedule`;
    // alert(url);
    $.ajax({
        type: "POST",
        dataType: 'JSON',
        url: url,
        success: function(data) {
            // alert(data);
        },
    });
}
</script>