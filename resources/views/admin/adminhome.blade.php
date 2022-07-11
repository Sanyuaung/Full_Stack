@extends('layouts/app')
@section('content')
    @include('sweetalert::alert')
    <link href="/css/admin.css" rel="stylesheet">
    <div class="mt-3 scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Department</th>
                    <th scope="col">Status</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->department }}</td>
                        <td><?php
                        if ($user->status == '0') {
                            echo 'Pending';
                        } elseif ($user->status == '1') {
                            echo 'Approve';
                        } elseif ($user->status == '2') {
                            echo 'Close';
                        } ?>
                        </td>

                        {{-- <td>{{ $user->status == '0' ? 'Pending' : 'Approved' }}</td> --}}
                        <td><a title="Update" class="btn btn-success text-white"
                                href="{{ route('edituser', $user->id) }}">Update</a>
                        <td><a title="Delete" class="btn btn-danger text-white delete-confirm"
                                href="{{ route('deleteUser', $user->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12 mt-3">
        {!! $users->links('custom_pagination') !!}
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            Swal.fire({
                icon: 'warning',
                title: `Are you sure you want to delete this user?`,
                text: "If you delete this, it will be gone forever.",
                timer: 3000,
                showCancelButton: true,
                confirmButtonColor: 'LightSeaGreen',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonColor: 'Crimson',
                cancelButtonText: 'No,cancel!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }
            })
        });
    </script>
@endsection
