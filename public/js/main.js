const store = {};
// Insère le jwt dans l'objet store.
store.setJWT = function (data) {
    this.JWT = data;
};

store.setJWT('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE2NjExOTgyNzIsImV4cCI6MTY2MzI3MTg3MiwiaWQiOjF9._n5C4UjCP-1GJtQ-sLHGHK1hkoBQER78FkC-qGChlPnet7N0M6n4lb4t2KvQfMY0kobBpd3MFhPr3VJhsOYtuw');

const tokenOption = {
    headers: {
        'Authorization': `Bearer ${store.JWT}`
    },
};





function createFormData(form) {

    const formattedFormData = new FormData(form);
    //postData(formattedFormData);
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
        ...tokenOption,
        method: 'POST',
        body: formattedFormData
    })

        .then(function (res) {

            if (res.ok) {
                //console.log(res);
                // console.log('res', res.json());

                return res.json();
            }
        })
        .then(function (jsonres) {
            //console.log(jsonres);
            //console.log('console', jsonres);
            return jsonres


        })
    return response
}

function getData($url) {
    response = fetch($url, {
        ...tokenOption,
        method: 'GET',
    })

        .then(function (res) {

            if (res.ok) {
                //console.log(res);
                // console.log('res', res.json());

                return res.json();
            }
        })
        .then(function (jsonres) {
            //console.log(jsonres);
            //console.log('console', jsonres);
            return jsonres


        })
    return response
}