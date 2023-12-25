<x-tenant-admin-layout title="Create Restaurant">
    <h2 class="text-center">Create Restaurant</h2>
    <form id="restaurant-form" action="{{ route('tenant.admin.restaurant.store') }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Restaurant Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your Restaurant Name">
        </div>
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="mb-3">
            <label for="domain" class="form-label">Restaurant domain</label>
            <input type="text" class="form-control" name="domain" id="domain"
                   placeholder="yourdomain.zmenu.test">
            <small id="domain-error" class="text-danger d-none">Invalid domain format</small>
        </div>
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
                const domainInput = $('#domain');
                const domainError = $('#domain-error');
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
                domainInput.on('input', function () {
                    domainError.addClass('d-none');
                    submitButton.prop('disabled', true);

                    const domainValue = $(this).val();
                    if (domainValue) {
                        $.ajax({
                            url: '{{ route('tenant.admin.restaurant.check.domain') }}',
                            type: 'POST',
                            data: {
                                domain: domainValue
                            },
                            headers: {
                                'X-CSRF-TOKEN': '{{csrf_token()}}'
                            },
                            success: function (response) {
                                if (response.valid) {
                                    domainError.addClass('d-none'); // Valid domain
                                    submitButton.prop('disabled', false);

                                } else {
                                    domainError.removeClass('d-none'); // Invalid domain
                                }
                            }
                        });
                    }
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
