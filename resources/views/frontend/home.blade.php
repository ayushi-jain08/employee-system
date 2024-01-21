<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('front-assets/css/registration.css') }}">

</head>

<body>
    <div class="container">
        <h2 class="text-center heading">Employee Registration</h2>
        <div id="message-container">
            <!-- Messages will be displayed here -->
        </div>
        <form name="employeeForm" id="employeeForm">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label label-head">
                    Name: </label>
                <div class="form-display">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" id="name" name="name" class="form-control " placeholder="your name"
                        title="Alphabetic characters only">
                    <p class="error"></p>
                </div>
            </div>

            <div class="mb-3">
                <label for="fatherName" class="form-label label-head">Father's Name:</label>
                <div class="form-display">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" class="form-control" id="father_name" name="father_name"
                        placeholder="your father name" title="Alphabetic characters only">
                    <p class="error"></p>
                </div>
            </div>

            <div class="mb-3">
                <label for="mobile" class="form-label label-head">Mobile Number:</label>
                <div class="form-display">
                    <i class="fa-solid fa-mobile"></i>
                    <input type="tel" class="form-control" id="mobile" name="mobile" title="Numeric and 10 digits"
                        placeholder="your mobile no.">
                    <p class="error"></p>
                </div>

            </div>

            <div class="mb-3">
                <label for="dob" class="form-label label-head">Date of Birth:</label>
                <div class="form-display">
                    <i class="fa-solid fa-calendar-days"></i>
                    <input type="date" id="dob" name="dob" class="form-control" placeholder="your dob">
                    <p class="error"></p>
                </div>

            </div>

            <div class="mb-3">
                <label for="appliedFor" class="form-label label-head">Applied For:</label>
                <div class="form-display">
                    <i class="fa-solid fa-briefcase"></i>
                    <input type="text" id="applied_for" name="applied_for" class="form-control"
                        placeholder="postion applied for">
                    <p class="error"></p>
                </div>

            </div>

            <div class="mb-3">
                <label for="email" class="form-label label-head">Email:</label>
                <div class="form-display">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" class="form-control" id="email" name="email" placeholder="your email">
                    <p class="error"></p>
                </div>

            </div>

            <div class="mb-3">
                <label for="photo" class="form-label label-head">Upload Photo:</label>
                <div class="form-display">
                    <i class="fa-solid fa-circle-user"></i>
                    <input type="file" class="form-control" id="photo" placeholder="your photo" name="photo"
                        accept="image/*">
                    <p class="error"></p>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script>

        $(document).ready(function () {
            $('#employeeForm').submit(function (e) {
                e.preventDefault();
                var submitButton = $("button[type=submit]");
                submitButton.prop('disabled', true);
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('user.create') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function (response) {
                        $('#employeeForm')[0].reset();
                        // Enable the submit button
                        $("button[type=submit]").prop('disabled', false);
                        $('.error').removeClass('is-invalid').html("")
                        $("input[type=text], select").removeClass('is-invalid')
                        $('#message-container').html('<div class="alert alert-success">🎉🎉 You are Registration successfully!!</div>');

                    },

                    error: function (jqXHR, exception) {
                        if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                            var errors = jqXHR.responseJSON.errors;

                            $('.error').removeClass('is-invalid').html("")
                            $("input[type=text], select").removeClass('is-invalid')
                            $.each(errors, function (key, value) {
                                $(`#${key}`).addClass('is-invalid').closest('.mb-3')
                                    .find('p')
                                    .addClass('invalid-feedback')
                                    .html(value);
                            })
                            submitButton.prop('disabled', false)
                        }

                    },
                    complete: function () {
                        // Re-enable the submit button only if there are no validation errors
                        if ($('.is-invalid').length === 0) {
                            submitButton.prop('disabled', false);
                        }
                    }
                });
            })
        })

    </script>
</body>

</html>