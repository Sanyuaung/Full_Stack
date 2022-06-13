@extends('layouts/app')
@section('content')
    @include('sweetalert::alert')
    <link href="/css/jcb.css" rel="stylesheet">
    <a class="float-start mb-3" title="Back" href="{{ route('JCBHome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('pdf') }}" title="Download"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #d80000;" data-width="25"></span></a>
    <span class="float-end mb-3">{{ $filename }}</span></span>
    <div class="scroll-table-container">
        <table class="table-bordered border-white scroll-table">
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
                        <td>{{ $user->Institution_Code }}</td>
                        <td>{{ $user->Short_Name }}</td>
                        <td>{{ $user->Account_Number }}</td>
                        <td>{{ $user->date }}</td>
                        <td>{{ $user->MPU_Comm }}</td>
                        <td>{{ $user->Acq_Bank_Settle_Amt }}</td>
                        <td>{{ $user->Debit }}</td>
                        <td>{{ $user->Credit }}</td>
                    </tr>
                @endforeach
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
            </tbody>
        </table>
    </div>
@endsection
