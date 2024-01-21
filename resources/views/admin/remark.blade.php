<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Include necessary stylesheets and scripts -->

    <div class="container">
        <h2 class="mt-3">Add Remark for {{ $employee->name }}</h2>
        <form id="remarkForm" name="remarkForm">
            @csrf
            <div class="form-group mb-3">
                <label for="remark">Remark:</label>
                <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                <p></p>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Remark</button>
        </form>
    </div>

    <!-- Include necessary scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#remarkForm').submit(function(e) {
                e.preventDefault();
                $("button[type=submit]").prop('disabled', true)
                var element = $(this)
                $.ajax({
                    url: "{{ route('employee.remark.add', $employee->id) }}",
                    type: "POST",
                    data: element.serializeArray(),
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        window.location.href = "{{ route('admin.dashboard') }}"
                        element.trigger('reset');
                        console.log(response)
                    },
                    error: function(jqXHR, exception) {
                        if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                            var errors = jqXHR.responseJSON.errors;
                            $("button[type=submit]").prop('disabled', false);
                            if (errors['remark']) {
                                $("#remark").addClass('is-invalid').closest('.mb-3').find('p')
                                    .addClass('invalid-feedback').html(errors['remark'][0]);

                            } else {
                                $("#remark").removeClass('is-invalid').closest('.mb-3').find(
                                        'p')
                                    .removeClass('invalid-feedback').html("");
                            }
                        }
                    }
                })

            })
        });
    </script>
</body>

</html>
