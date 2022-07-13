@extends('layouts/app')
@section('content')
    <link href="/css/admin.css" rel="stylesheet">
    <div class="table-container">
        <form action="{{ route('editUpdateUser', $edituser->id) }}" method="post">
            @csrf
            <div class="mt-3">
                <table class="table-bordered border-white" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">User Name</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Department</th>
                            <th scope="col">Status</th>
                            <th scope="col">Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td><input readonly type="text" id="materialRegisterFormFirstName" class="text-center form-control"
                                name="username" placeholder="User Name" value="{{ $edituser->name }}"></td>
                        <td><input readonly type="email" id="materialRegisterFormEmail" class="text-center form-control"
                                name="email" placeholder="E-mail" value="{{ $edituser->email }}"></td>
                        <td><select name="department" class="text-center">
                                <option value="" {{ $edituser->department == '' ? 'selected' : '' }}></option>
                                <option value="Admin" {{ $edituser->department == 'Admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="Card" {{ $edituser->department == 'Card' ? 'selected' : '' }}>Card Dept;
                                </option>
                                <option value="Settlement" {{ $edituser->department == 'Settlement' ? 'selected' : '' }}>
                                    Settlement Dept;</option>
                            </select></td>
                        <td><select name="status">
                                <option value="1" {{ $edituser->status == '1' ? 'selected' : '' }}>Approved</option>
                                <option value="0" {{ $edituser->status == '0' ? 'selected' : '' }}>Pending</option>
                            </select></td>
                        <td><button title="Update"  class="btn btn-success text-white" type="submit">Update</button></td>
                        </tr>
                    </tbody>
                </table>
        </form>
        <a class="float-lg-start mt-3" href="{{ route('userhome') }}" role="button"><span>Return</span></a>
    </div>
@endsection
