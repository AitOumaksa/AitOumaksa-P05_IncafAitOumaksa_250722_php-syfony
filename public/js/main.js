
function createFormData(form) {

    const formattedFormData = new FormData(form);
    return formattedFormData;
}




function alert(message, type, placeholder) {

    placeholder.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

}

function formReset(form) {
    form.reset()
    form.classList.remove('was-validated');
}

function postData(formattedFormData, $url) {
    response = fetch($url, {
        method: 'POST',
        body: formattedFormData
    })

        .then(function (res) {

            if (res.ok) {

                return res.json();
            }
        })
        .then(function (jsonres) {
            return jsonres


        })
    return response
}

function getData($url) {
    response = fetch($url, {
        method: 'GET',
    })

        .then(function (res) {

            if (res.ok) {

                return res.json();
            }
        })
        .then(function (jsonres) {
            return jsonres


        })
    return response
}