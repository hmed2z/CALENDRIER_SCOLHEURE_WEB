function loadList(url, listElement, renderItem) {
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            listElement.empty();
            data.forEach(function (item) {
                listElement.append(renderItem(item));
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Raw server response:', jqXHR.responseText);
            console.error('Error data:', jqXHR, textStatus, errorThrown);
        },
    });
}
/*
function deleteItem(url, id, onSuccess) {
    $.ajax({
        url: url,
        type: 'POST',
        data: { id: id, _method: 'delete' },
        dataType: 'json',
        success: onSuccess,
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Raw server response:', jqXHR.responseText);
            console.error('Error data:', jqXHR, textStatus, errorThrown);
        },
    });
}
*/

function deleteItem(url, id, onSuccess) {
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _method: 'delete',
            id: id,
        },
        success: function (data) {
            console.log('Item supprimé:', data);
            onSuccess();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Raw server response:', jqXHR.responseText);
            console.error('Error data:', jqXHR, textStatus, errorThrown);
        },
    });
}

function updateItem(url, id, data, onSuccess) {
    $.ajax({
        url: url + '?id=' + id,
        type: 'PUT',
        data: data,
        success: onSuccess,
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Raw server response:', jqXHR.responseText);
            console.error('Error data:', jqXHR, textStatus, errorThrown);
        },
    });
}