var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;



function updateLayerName(layerId) {
    var layerName = $("#layerName" + layerId).val();
    var url = $url + 'setting/layer/update-layer-name';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { layerId: layerId, layerName: layerName },
        success: function(data) {
            if (data.status) {
                $("#right-layer-" + layerId).html(layerName);
                $("#bottom-layer-" + layerId).html(layerName);
                $("#layerName-" + layerId).html(data.layerName)
            } else {
                alert(layerName + " is existing.");
            }

        }
    });
}

function updateSubLayerName(subLayerId) {
    var subLayerName = $("#subLayerName-" + subLayerId).val();
    var layerId = $("#layerId").val();
    var url = $url + 'setting/layer/update-sub-layer-name';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { layerId: layerId, subLayerName: subLayerName, subLayerId: subLayerId },
        success: function(data) {
            if (data.status) {

            } else {
                alert(subLayerName + " is existing in this layer.");
            }
        }
    });
}

function updateSubLayerTag(subLayerId) {
    var tag = $("#subLayerTag-" + subLayerId).val();
    var url = $url + 'setting/layer/update-sub-layer-tag';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { subLayerId: subLayerId, tag: tag },
        success: function(data) {
            if (data.status) {
                $("#sub-layer-tag-" + data.layerId).html(data.tag);
            } else {

            }

        }
    });
}

function updateLayerTag(layerId) {
    var tag = $("#shortTag" + layerId).val();
    var url = $url + 'setting/layer/update-layer-tag';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { layerId: layerId, tag: tag },
        success: function(data) {
            if (data.status) {

            } else {

            }

        }
    });
}

function addNewLayer(priority) {

    if (confirm('Do you want to create new layer?')) {
        var url = $url + 'setting/layer/add-new-layer';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { priority: priority },
            success: function(data) {
                if (data.status) {
                    location.reload();
                } else {
                    alert('Somthing went wrong, try again later.')
                }

            }
        });
    }
}

function deleteLayer(layerId) {
    if (confirm('Are you sure to delete this layer?')) {
        var url = $url + 'setting/layer/delete-layer';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: url,
            data: { layerId: layerId },
            success: function(data) {
                if (data.status) {
                    location.reload();
                } else {
                    alert('Somthing went wrong, try again later.')
                }

            }
        });
    }
}
function filterLayerTitle() { 
    var branchId = $("#branch-team").val();
    var departmentId = $("#department-team").val();
    var url = $url + 'setting/layer/filter-layer-title';
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { branchId: branchId,departmentId:departmentId },
        success: function(data) {
            if (data.status) {
                $("#layer-result").html(data.textResult);
            } 

        }
    });
}
