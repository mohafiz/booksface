function create_client() {
    name     = document.getElementById('app_name').value;
    redirect = document.getElementById('app_redirect').value;

    const data = {
        name: name,
        redirect: redirect
    }

    axios.post('/oauth/clients', data)
        .then(response => {
            location.reload();
        })
        .catch (response => {
            console.log(response);
        });
}

function edit_client(client_id) {
    name     = document.getElementById('app_new_name').value;
    redirect = document.getElementById('app_new_redirect').value;

    const data = {
        name: name,
        redirect: redirect
    }

    axios.put('/oauth/clients/'+client_id, data)
        .then(response => {
            location.reload();
        })
        .catch (response => {
            console.log(response);
        });
}

function delete_client(client_id) {
    axios.delete('/oauth/clients/' + client_id);
}

function revoke_token(token_id) {
    axios.delete('/oauth/tokens/' + token_id);
}