import config from './config.js';

export function generateAddBrandFormBtn() {
    const html = `
        <button type="button" class="btn btn-primary col-12" id="add-brand-form-btn">Add Brand</button>
    `;

    $('#add-brand-form-btn').html(html);
}

export function generateTopList(brands) {
    let num = 1;
    let html = '';

    brands.forEach(brand => {
        html += `
            <div class="row align-items-center list-row">
                <div class="col-sm-1 border list-col">${num++}</div>
                <div class="col-sm-2 border list-col"><img src="${config.apiDomain}/storage/${brand.image}" alt="${brand.name}" width="50"></div>
                <div class="col-sm-2 border list-col">${brand.name}</div>
                <div class="col-sm-4 border list-col">
                    <div class="starability-result list-stars" data-rating="${brand.rating}"></div>
                </div>
                <div class="col-sm-3 border list-col">
                  <button type="button" class="btn btn-primary">Update</button>
                  <button type="button" class="btn btn-danger delete-brand" data-id="${brand.id}">Delete</button>
                </div>
            </div>
        `;
    });

    $('#list-brands').html(html);
}

export function generateBrandForm(countries) {
    let optionsHtml = '<option value="">-None-</option>';

    if (typeof countries !== 'undefined' && countries.length > 0) {
        optionsHtml += countries.map(country => `<option value="${country.id}">${country.name}</option>`).join('');
    }

    const formHtml = `
        <form class="row g-2 align-items-end">
            <div class="col-sm-2">
                <label for="brand-image" class="col-form-label">Image</label>
                <input type="file" class="form-control" id="brand-image" name="image" accept="image/*" required>
                <div class="invalid-feedback">Please enter a valid image.</div>
            </div>
            <div class="col-sm-3">
                <label for="brand-name" class="col-form-label">Name</label>
                <input type="text" class="form-control" id="brand-name" name="name" placeholder="example" required>
                <div class="invalid-feedback">Please enter a valid name.</div>
            </div>
            <div class="col-sm-2">
                <label for="brand-rating" class="col-form-label">Rating</label>
                <select class="form-select" id="brand-rating" name="rating" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label for="brand-country" class="col-form-label">Country</label>
                <select class="form-select" id="brand-country" name="country_id" required>
                    ${optionsHtml}
                </select>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary" id="submit-brand-form-btn">Submit</button>
            </div>
        </form>
    `;

    $('#create-brand-form').html(formHtml);
}
