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
    <link rel="stylesheet" href="{{ asset('backend-assets/css/login.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container-fluid">
        <div class="table-container card-body table-responsive p-0">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <a href="{{ route('admin.logout') }}">
                <button type="button" class="btn btn-warning mb-4 float-end"> <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout</button>
            </a>

            <table class="table table-striped table-hover">
                <thead class="table-success">
                    <tr>
                        <th width="60">ID</th>
                        <th width="50">Photo</th>
                        <th>Name</th>
                        <th>Enail</th>
                        <th>DOB</th>
                        <th>Mobile</th>
                        <th>Applied_For</th>
                        <th width="100">Remark</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($employee->isNotEmpty())
                        @foreach ($employee as $employees)
                            <tr>
                                <td>{{ $employees->id }}</td>
                                <td>
                                    @if ($employees->photo)
                                        <img src="{{ asset('storage/' . $employees->photo) }}" class="img-thumbnail"
                                            width="50" alt="Employee Photo">
                                    @else
                                        <img src="img/product-1.jpg" class="img-thumbnail" width="50">
                                    @endif
                                </td>
                                <td><a href="#">{{ $employees->name }}</a></td>
                                <td>{{ $employees->email }}</td>
                                <td>{{ $employees->dob }} </td>
                                <td>{{ $employees->mobile }}</td>
                                <td>
                                    {{ $employees->applied_for }}

                                </td>
                                <td>
                                    <a href="{{ route('employee.edit', $employees->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button type="button" class="btn btn-primary btn-sm ms-1"
                                        onclick="loadRemarks({{ $employees->id }})" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">Records Not Found</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>

        {{-- ======================MODAL FOR REMARK==================== --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Remarks</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="remarkModalBody">

                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
        <script>
            function loadRemarks(employeeId) {
                var url = "{{ route('employee.remark.get', 'ID') }}"
                var newUrl = url.replace("ID", employeeId)
                // Fetch remarks for the employee via AJAX
                $.ajax({
                    url: newUrl,
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Check if the response is an array
                        if (response[0].remarks.length > 0) {
                            // Remarks exist, update modal body with remarks
                            var remarksList = '<ul>';
                            $.each(response[0].remarks, function(index, remark) {
                                remarksList += '<li>' + remark.remark + '</li>';
                            });
                            remarksList += '</ul>';
                            $('#remarkModalBody').html(remarksList);
                        } else {
                            // No remarks
                            $('#remarkModalBody').html('<p>No remarks available.</p>');
                        }

                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }

            $(document).ready(function() {
                // Check if a success message exists and fade it out after 5 seconds
                var successMessage = $('.alert-success');
                if (successMessage.length > 0) {
                    successMessage.delay(2000).fadeOut();
                }
            });
        </script>
</body>

</html>
