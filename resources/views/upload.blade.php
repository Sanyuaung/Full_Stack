@extends('layouts/app')
@section('content')
    @include('sweetalert::alert')

    <div class="container-fluid mt-5">
        <div class="text-center">
            <a href="{{ route('home') }}" class="btn white-text btn-indigo btn-rounded-pill float-left"
                role="button">Home</a>
            <a href="{{ route('pdf') }}" class="btn white-text btn-indigo btn-rounded-pill"
                onclick="confirm('You sure you want to download?')" role="button">Download PDF</a>
        </div>
        <br>
        <table class="table table-hover text-center aqua-gradient black-text">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Institution Code</th>
                    <th scope="col">Acquiriing Bank Name</th>
                    <th scope="col">Account Number</th>
                    <th scope="col">Settlement Date</th>
                    <th scope="col">MPU Commission</th>
                    <th scope="col">Acquiriing Settlement Amount</th>
                    <th scope="col">Debit</th>
                    <th scope="col">Credit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->NO }}</td>
                        <td><b>{{ $user->Institution_Code }}</td>
                        <td><b>{{ $user->Short_Name }}</td>
                        <td><b>{{ $user->Account_Number }}</td>
                        <td><b>{{ $user->date }}</td>
                        <td><b>{{ $user->MPU_Comm }}</td>
                        <td><b>{{ $user->Acq_Bank_Settle_Amt }}</td>
                        <td><b>{{ $user->Debit }}</td>
                        <td><b>{{ $user->Credit }}</td>
                    </tr>
                @endforeach
            </tbody>
            <thead>
                @foreach ($one as $one)
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">{{ $one->one }}</th>
                @endforeach
                @foreach ($two as $two)
                    <th scope="col">{{ $two->two }}</th>
                @endforeach
                @foreach ($three as $three)
                    <th scope="col">{{ $three->three }}</th>
                @endforeach
                @foreach ($four as $four)
                    <th scope="col">{{ $four->four }}</th>
                @endforeach
                </tr>
            </thead>
        </table>
    </div>
@endsection
