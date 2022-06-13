@extends('layouts/app')
@section('content')
    <link href="/css/mpu.css" rel="stylesheet">
    <a class="float-start mb-3" title="Back" href="{{ route('UPIHome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('upidownload') }}" title="Download"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #d80000;" data-width="25"></span></a>
    <span class="float-end mb-3">{{ $filename }}</span></span>
    <div class="mt-3 scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">bitmap</th>
                    <th scope="col">Cardno</th>
                    <th scope="col">Txn_Amount</th>
                    <th scope="col">Curr</th>
                    <th scope="col">Txn_datetime</th>
                    <th scope="col">trace_no</th>
                    <th scope="col">Auth_ID_resp</th>
                    <th scope="col">Date_Auth</th>
                    <th scope="col">RRN</th>
                    <th scope="col">Acq_ID</th>
                    <th scope="col">Forward_ID</th>
                    <th scope="col">merchant_type</th>
                    <th scope="col">Card_acceptor_id</th>
                    <th scope="col">Card_acceptorid_code</th>
                    <th scope="col">Card_acceptor_name</th>
                    <th scope="col">Origin_txn</th>
                    <th scope="col">msg_reason</th>
                    <th scope="col">single_dual</th>
                    <th scope="col">GSCS_serial</th>
                    <th scope="col">Receiving_ID</th>
                    <th scope="col">Issuing_ID</th>
                    <th scope="col">ID_GSCS</th>
                    <th scope="col">Txn_initial_channel</th>
                    <th scope="col">Txn_features</th>
                    <th scope="col">Txn_scenario</th>
                    <th scope="col">Reserved</th>
                    <th scope="col">other_info</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ifc99c as $ifc99c)
                    <tr>
                        <td>{{ $ifc99c->NO }}</td>
                        <td>{{ $ifc99c->bitmap }}</td>
                        <td>{{ $ifc99c->Cardno }}</td>
                        <td>{{ $ifc99c->Txn_Amount }}</td>
                        <td>{{ $ifc99c->Curr }}</td>
                        <td>{{ $ifc99c->Txn_datetime }}</td>
                        <td>{{ $ifc99c->trace_no }}</td>
                        <td>{{ $ifc99c->Auth_ID_resp }}</td>
                        <td>{{ $ifc99c->Date_Auth }}</td>
                        <td>{{ $ifc99c->RRN }}</td>
                        <td>{{ $ifc99c->Acq_ID }}</td>
                        <td>{{ $ifc99c->Forward_ID }}</td>
                        <td>{{ $ifc99c->merchant_type }}</td>
                        <td>{{ $ifc99c->Card_acceptor_id }}</td>
                        <td>{{ $ifc99c->Card_acceptorid_code }}</td>
                        <td>{{ $ifc99c->Card_acceptor_name }}</td>
                        <td>{{ $ifc99c->Origin_txn }}</td>
                        <td>{{ $ifc99c->msg_reason }}</td>
                        <td>{{ $ifc99c->single_dual }}</td>
                        <td>{{ $ifc99c->GSCS_serial }}</td>
                        <td>{{ $ifc99c->Receiving_ID }}</td>
                        <td>{{ $ifc99c->Issuing_ID }}</td>
                        <td>{{ $ifc99c->ID_GSCS }}</td>
                        <td>{{ $ifc99c->Txn_initial_channel }}</td>
                        <td>{{ $ifc99c->Txn_features }}</td>
                        <td>{{ $ifc99c->Txn_scenario }}</td>
                        <td>{{ $ifc99c->Reserved }}</td>
                        <td>{{ $ifc99c->other_info }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
