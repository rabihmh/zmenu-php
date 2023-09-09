<x-tenant-admin-layout title="{{$restaurant->name}}">
    <h1 class="text-center">{{$restaurant->name}}</h1>
    <form id="restaurant-form" action="{{ route('tenant.admin.restaurant.update',$restaurant->id) }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Restaurant Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your Restaurant Name"
                   value="{{$restaurant->name}}">
        </div>
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="mb-3">
            <label for="domain" class="form-label">Restaurant domain</label>
            <input type="text" class="form-control" name="domain" id="domain"
                   placeholder="yourdomain.zmenu.test" value="{{$restaurant->domain}}">
            <small id="domain-error" class="text-danger d-none">Invalid domain format</small>
        </div>
        @error('domain')
        <span class="text-danger">{{$message}}</span>
        @enderror
        @foreach($restaurant->contact_info as $key=>$value)
            <div class="mb-3">
                <label for="domain" class="form-label">Contact Info </label>
                <div class="row d-flex align-content-between">
                    <div class="col-l6">
                        <input type="text" class="form-control" name="contact_info_key_{{$loop->iteration}}" id="domain" value="{{$key}}">
                    </div>
                    <div class="col-l6">
                        <input type="text" class="form-control" name="contact_info_value_{{$loop->iteration}}" id="domain" value="{{$value}}">
                    </div>
                </div>
            </div>
        @endforeach
        @error('domain')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Restaurant photo</label>
            <input type="file" class="form-control-file" name="profile_photo">
        </div>
        @error('profile_photo')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <input type="hidden" id="json-data" name="contact_info">
        @error('contact_info')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div id="input-container">
            <!-- Input fields will be generated here -->
        </div>
        <button type="button" id="add-field-button" class="btn btn-success">Add Contact Info</button>
        <button type="submit" id="submit-button" class="btn btn-primary">Submit</button>
    </form>
    @push('js')
        <script>
            $(document).ready(function () {
                const form = $('#restaurant-form');
                const addFieldButton = $('#add-field-button');
                const submitButton = $('#submit-button');
                let fieldCounter = 0;

                addFieldButton.click(function () {
                    fieldCounter++;

                    const div = $('<div>').addClass('mb-3');
                    const label = $('<label>').addClass('form-label').text(`Contact Info ${fieldCounter}`);

                    const keyInput = $('<input>').attr({
                        type: 'text',
                        class: 'form-control mt-2',
                        name: `key_${fieldCounter}`,
                        placeholder: 'Enter key'
                    });

                    const valueInput = $('<input>').attr({
                        type: 'text',
                        class: 'form-control mt-2',
                        name: `value_${fieldCounter}`,
                        placeholder: 'Enter value'
                    });
                    div.append(label);
                    div.append(keyInput);
                    div.append(valueInput);

                    div.insertBefore(addFieldButton);
                });
                submitButton.click(function (event) {
                    event.preventDefault();

                    const formData = {};

                    $('input[name^="key_"]').each(function () {
                        const key = $(this).val();
                        const value = $(`input[name="value_${$(this).attr('name').substr(4)}"]`).val();
                        formData[key] = value;
                    });

                    const formDataJSON = JSON.stringify(formData);
                    $('#json-data').val(formDataJSON);
                    $('input[name^="key_"], input[name^="value_"]').remove(); // Remove key_ and value_ inputs

                    form.submit();
                });
            });
        </script>

    @endpush

</x-tenant-admin-layout>
