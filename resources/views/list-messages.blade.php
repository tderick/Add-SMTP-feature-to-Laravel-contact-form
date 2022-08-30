<html>

<head>
    <title>Contact Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/plugins/TableCheckAll.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#messages").TableCheckAll();

            $("#multiple-delete").on("click", function() {
                let button = $(this);
                let selected = []

                $("#messages .check:checked").each(function() {
                    selected.push($(this).val());
                });

                Swal.fire({
                    icon: "warning",
                    title: "Are you sure you want to delete this(those) selected message(s)?",
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                            },
                            url: button.data("route"),
                            data: {
                                'selected': selected
                            },
                            success: function(response, textStatus, xhr) {
                                Swal.fire({
                                    icon: "success",
                                    title: response,
                                    showDenyButton: false,
                                    showCancelButton: false,
                                    confirmButtonText: 'Yes'
                                }).then((result) => {
                                    window.location = '/admin/view-messages'
                                });
                            }
                        })
                    }
                })
            });

            $(".delete-message").on("submit", function(e) {
                e.preventDefault();

                let button = $(this)

                Swal.fire({
                    icon: "warning",
                    title: "Are you sure?",
                    text: "You won't be able to revert this.",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!"

                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                            },
                            url: button.data("route"),
                            data: {
                                "_method": "delete"
                            },
                            success: function(response, textStatus, xhr) {
                                Swal.fire({
                                    icon: "success",
                                    text: response,
                                    showDenyButton: false,
                                    showCancelButton: false,
                                    confirmButtonText: "Go on",
                                }).then((result) => {
                                    window.location = '/admin/view-messages'
                                })
                            }
                        })
                    }
                })
            });



        });
    </script>
    <style>
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto my-5">
                <h3 class="text-center mb-5">Contact forms messages</h3>

                <button class="btn btn-danger mb-3" id="multiple-delete"
                    data-route="{{ route('multiple-delete') }}">Delete All
                    Selected</button>

                <table class="table" id="messages">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"><input type="checkbox" class="check-all"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
                            <tr>
                                <td><input type="checkbox" class="check" value={{ $message->id }} /></td>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>
                                    <a href="{{ url('/admin/messages/' . $message->id) }}"
                                        class="btn btn-primary btn-sm">Details</a>

                                    <form method="post" class="delete-message"
                                        data-route="{{ url('/admin/messages/' . $message->id . '/delete') }}"
                                        style="display:inline">

                                        <button type='submit' class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <form method="post" action="{{ url('/logout') }}" style="display:inline">
                    @csrf
                    <button type='submit' class="btn btn-secondary ">Logout</button>
                </form>
        
                
            </div>
        </div>
    </div>
</body>
