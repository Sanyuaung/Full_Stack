@extends('layouts/app')
@section('content')
    <link href="/css/mpu.css" rel="stylesheet">
    <a class="float-start mb-3" title="Back" href="{{ route('MPUHome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('downlodINC11E') }}" title="Download"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #d80000;" data-width="25"></span></a>
    <span class="float-end mb-3 text-danger">{{ $filename }}</span></span>
    <div class="mt-3 scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">recordtype</th>
                    <th scope="col">PAN</th>
                    <th scope="col">Processing_Code</th>
                    <th scope="col">Amount_Transaction</th>
                    <th scope="col">Amount_Settlement</th>
                    <th scope="col">Sett_Conversion_Rate</th>
                    <th scope="col">Currency_Code_Transaction</th>
                    <th scope="col">Settlement_Currency_Code</th>
                    <th scope="col">Transmission_Date_and_Time</th>
                    <th scope="col">System_Trace_Audit_Number</th>
                    <th scope="col">Authorization_Identification_Response</th>
                    <th scope="col">Date_of_Authorization</th>
                    <th scope="col">RRN</th>
                    <th scope="col">Acquiring_IIN</th>
                    <th scope="col">Forwarding_IIC</th>
                    <th scope="col">Merchant_Type</th>
                    <th scope="col">Card_Acceptor_Terminal_Identification</th>
                    <th scope="col">Card_Acceptor_Identification_Code</th>
                    <th scope="col">Card_Acceptor_Name</th>
                    <th scope="col">Original_Transaction_Information</th>
                    <th scope="col">Message_Reason_Code</th>
                    <th scope="col">Receivig_IIC</th>
                    <th scope="col">Issuing_IIC</th>
                    <th scope="col">Identifier_of_Transaction_Features</th>
                    <th scope="col">Point_of_Service_Condition_Code</th>
                    <th scope="col">Merchant_Currency</th>
                    <th scope="col">Authorization_Type</th>
                    <th scope="col">Service_Fee_Receivable</th>
                    <th scope="col">Service_Fee_Payable</th>
                    <th scope="col">Reserved</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inc11e as $inc11e)
                    <tr>
                        <td>{{ $inc11e->NO }}</td>
                        <td>{{ $inc11e->recordtype }}</td>
                        <td>{{ $inc11e->PAN }}</td>
                        <td>{{ $inc11e->Processing_Code }}</td>
                        <td>{{ $inc11e->Amount_Transaction }}</td>
                        <td>{{ $inc11e->Amount_Settlement }}</td>
                        <td>{{ $inc11e->Sett_Conversion_Rate }}</td>
                        <td>{{ $inc11e->Currency_Code_Transaction }}</td>
                        <td>{{ $inc11e->Settlement_Currency_Code }}</td>
                        <td>{{ $inc11e->Transmission_Date_and_Time }}</td>
                        <td>{{ $inc11e->System_Trace_Audit_Number }}</td>
                        <td>{{ $inc11e->Authorization_Identification_Response }}</td>
                        <td>{{ $inc11e->Date_of_Authorization }}</td>
                        <td>{{ $inc11e->RRN }}</td>
                        <td>{{ $inc11e->Acquiring_IIN }}</td>
                        <td>{{ $inc11e->Forwarding_IIC }}</td>
                        <td>{{ $inc11e->Merchant_Type }}</td>
                        <td>{{ $inc11e->Card_Acceptor_Terminal_Identification }}</td>
                        <td>{{ $inc11e->Card_Acceptor_Identification_Code }}</td>
                        <td>{{ $inc11e->Card_Acceptor_Name }}</td>
                        <td>{{ $inc11e->Original_Transaction_Information }}</td>
                        <td>{{ $inc11e->Message_Reason_Code }}</td>
                        <td>{{ $inc11e->Receivig_IIC }}</td>
                        <td>{{ $inc11e->Issuing_IIC }}</td>
                        <td>{{ $inc11e->Identifier_of_Transaction_Features }}</td>
                        <td>{{ $inc11e->Point_of_Service_Condition_Code }}</td>
                        <td>{{ $inc11e->Merchant_Currency }}</td>
                        <td>{{ $inc11e->Authorization_Type }}</td>
                        <td>{{ $inc11e->Service_Fee_Receivable }}</td>
                        <td>{{ $inc11e->Service_Fee_Payable }}</td>
                        <td>{{ $inc11e->Reserved }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
