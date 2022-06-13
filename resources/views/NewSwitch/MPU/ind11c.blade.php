@extends('layouts/app')
@section('content')
    <link href="/css/mpu.css" rel="stylesheet">
    <a class="float-start mb-3" title="Back" href="{{ route('MPUHome') }}" role="button"><span class="iconify"
            data-icon="akar-icons:arrow-back-thick" style="color: #d80000;" data-width="25"></span></a>
    <a class="float-start ml-15 mb-3" href="{{ route('downloadIND11c') }}" title="Download"
        onclick="return confirm('Are you sure you want to download?')" role="button">&nbsp;&nbsp;&nbsp;<span
            class="iconify" data-icon="ic:sharp-sim-card-download" style="color: #d80000;" data-width="25"></span></a>
    <span class="float-end mb-3 text-danger">{{ $filename }}</span></span>
    <div class="mt-3 scroll-table-container">
        <table class="table-bordered border-white scroll-table">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Record_Type</th>
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
                    <th scope="col">Date_Authorization</th>
                    <th scope="col">RRN</th>
                    <th scope="col">Acquring_IIN</th>
                    <th scope="col">Forwarding_IIN</th>
                    <th scope="col">Merchant_Type</th>
                    <th scope="col">Card_Acceptor_Terminal_Identification</th>
                    <th scope="col">Card_Acceptor_Identification</th>
                    <th scope="col">Card_Acceptor_Name</th>
                    <th scope="col">Original_Transaction_Information</th>
                    <th scope="col">Message_Reason_Code</th>
                    <th scope="col">Receiving_IIN</th>
                    <th scope="col">Issuing_IIN</th>
                    <th scope="col">Identifer_of_Transaction_Feature</th>
                    <th scope="col">Point_of_Service_Condition_Code</th>
                    <th scope="col">Merchant_Country_Code</th>
                    <th scope="col">Authorization_Type</th>
                    <th scope="col">Service_Fee_Receivable</th>
                    <th scope="col">Service_Fee_Payable</th>
                    <th scope="col">Reserved</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ind11c as $ind11c)
                    <tr>
                        <td>{{ $ind11c->NO }}</td>
                        <td>{{ $ind11c->Record_Type }}</td>
                        <td>{{ $ind11c->PAN }}</td>
                        <td>{{ $ind11c->Processing_Code }}</td>
                        <td>{{ $ind11c->Amount_Transaction }}</td>
                        <td>{{ $ind11c->Amount_Settlement }}</td>
                        <td>{{ $ind11c->Sett_Conversion_Rate }}</td>
                        <td>{{ $ind11c->Currency_Code_Transaction }}</td>
                        <td>{{ $ind11c->Settlement_Currency_Code }}</td>
                        <td>{{ $ind11c->Transmission_Date_and_Time }}</td>
                        <td>{{ $ind11c->System_Trace_Audit_Number }}</td>
                        <td>{{ $ind11c->Authorization_Identification_Response }}</td>
                        <td>{{ $ind11c->Date_Authorization }}</td>
                        <td>{{ $ind11c->RRN }}</td>
                        <td>{{ $ind11c->Acquring_IIN }}</td>
                        <td>{{ $ind11c->Forwarding_IIN }}</td>
                        <td>{{ $ind11c->Merchant_Type }}</td>
                        <td>{{ $ind11c->Card_Acceptor_Terminal_Identification }}</td>
                        <td>{{ $ind11c->Card_Acceptor_Identification }}</td>
                        <td>{{ $ind11c->Card_Acceptor_Name }}</td>
                        <td>{{ $ind11c->Original_Transaction_Information }}</td>
                        <td>{{ $ind11c->Message_Reason_Code }}</td>
                        <td>{{ $ind11c->Receiving_IIN }}</td>
                        <td>{{ $ind11c->Issuing_IIN }}</td>
                        <td>{{ $ind11c->Identifer_of_Transaction_Feature }}</td>
                        <td>{{ $ind11c->Point_of_Service_Condition_Code }}</td>
                        <td>{{ $ind11c->Merchant_Country_Code }}</td>
                        <td>{{ $ind11c->Authorization_Type }}</td>
                        <td>{{ $ind11c->Service_Fee_Receivable }}</td>
                        <td>{{ $ind11c->Service_Fee_Payable }}</td>
                        <td>{{ $ind11c->Reserved }}</td>
                    </tr>
                @endforeach
                </tr>
            </tbody>
        </table>
    </div>
@endsection
