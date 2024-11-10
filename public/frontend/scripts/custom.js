import { showLoader, hideLoader } from './loader.js';
import { getTopList, createBrandForm, storeData, deleteData } from './apiHandler.js';
import { generateAddBrandFormBtn, generateTopList, generateBrandForm } from './utils.js';

document.addEventListener('DOMContentLoaded', function() {

    function fetchTopList() {
        getTopList()
            .then(data => {
                const result = data.data;
                if (result !== 'undefined' && result.length > 0) {
                    generateTopList(result);
                } else {
                    document.getElementById('list-brands').innerText = 'List is empty!';
                }
            })
            .catch(error => {
                document.getElementById('list-brands').innerText = error.message;
            });
    }

    generateAddBrandFormBtn();
    fetchTopList();

    $(document).on('click', '#add-brand-form-btn button', function() {
        this.style.display = 'none';
        showLoader('create-brand-form');
        createBrandForm()
            .then(data => {
                hideLoader();
                generateBrandForm(data.countries);
            })
            .catch(error => {
                hideLoader();
                document.getElementById('create-brand-form').innerText = error.message;
            });
        });

    $(document).on('click', '#submit-brand-form-btn', function(event) {
        event.preventDefault();

        const form = $('#create-brand-form form');

        if (!form[0].checkValidity()) {
            form.addClass('was-validated');
            return;
        }

        showLoader('create-brand-form');
        $('#create-brand-form form').css('display', 'none');

        const formData = {
            image: document.getElementById('brand-image').files[0],
            name: document.getElementById('brand-name').value,
            rating: document.getElementById('brand-rating').value,
            country_id: document.getElementById('brand-country').value
        };

        storeData(formData)
            .then(data => {
                hideLoader();
                generateAddBrandFormBtn();
                fetchTopList();
            })
            .catch(error => {
                hideLoader();
                document.getElementById('create-brand-form').innerText = error.message;
                generateAddBrandFormBtn();
            });
    });

    $(document).on('click', '#list-brands .list-row .delete-brand', function(event) {
        event.preventDefault();

        const id = parseInt($(this).data('id'));

        if (confirm('Are you sure you want to delete this brand?')) {
            deleteBrand(id);
        } else {
            console.log('Deletion cancelled');
        }
    });

    function deleteBrand(id) {
        showLoader('list-brands');
        deleteData(id)
            .then(data => {
                hideLoader();
                fetchTopList();
            })
            .catch(error => {
                hideLoader();
                document.getElementById('list-brands').innerText = error.message;
            });
    }
});
