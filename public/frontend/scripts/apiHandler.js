import config from './config.js';

export function getTopList() {
    return fetch(config.getApiUrl('brands'),{
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'CF-IPCountry': config.iPCountryHeaderValue  // For test
        },
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error while receiving data');
            }
            return response.json();
        });
}

export function createBrandForm() {
    return fetch(config.getApiUrl('brands/create'),{
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error while receiving data');
            }
            return response.json();
        });
}

export function storeData(data) {
    const formData = new FormData();
    for(const name in data) {
        formData.append(name, data[name]);
    }

    return fetch(config.getApiUrl('brands'), {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
        },
        body: formData,
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error while creation data');
            }
            return response.json();
        });
}

export function deleteData(id) {
    return fetch(config.getApiUrl(`brands/${id}`), {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json',
        },
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error deleting data');
            }

            if (response.status === 204) {
                return null;
            }

            return response.json();
        });
}
