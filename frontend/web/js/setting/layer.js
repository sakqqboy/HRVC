var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;

function addSubLayer(layerId) {
    var url = $url + 'setting/layer/add-sub-layer';
    var sublayerName = $("#sublayer-" + layerId).val();
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: url,
        data: { layerId: layerId, sublayerName: sublayerName },
        success: function(data) {
            if (data.status) {
                alert("Added Sublayer " + sublayerName);
                $("#sublayer-" + layerId).val('');
            } else {
                alert(sublayerName + " is existing.");
                $("#sublayer-" + layerId).val('');
            }

        }
    });
}

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
            } else {
                alert(layerName + " is existing.");
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