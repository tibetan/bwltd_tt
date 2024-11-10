
export function showLoader(containerId) {
    const container = document.getElementById(containerId);
    const loader = document.createElement('div');
    loader.className = 'spinner-border text-primary';
    loader.setAttribute('role', 'status');
    loader.id = 'loading-spinner';

    const loaderText = document.createElement('span');
    loaderText.className = 'visually-hidden';
    loaderText.innerText = 'Loading...';
    loader.appendChild(loaderText);

    container.appendChild(loader);
}

export function hideLoader() {
    const loader = document.getElementById('loading-spinner');
    if (loader) {
        loader.remove();
    }
}
