<?php

namespace App\Exports;

use App\Models\jcb;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class DataExport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize
{

    use Exportable;

    public function collection()
    {
        return collect(jcb::show());
    }
    public function headings(): array
    {
        return [
            'No',
            'Institution Code',
            'Acquiring Bank Name',
            'Account Number',
            'Settlement Date',
            'MPU Commussion',
            'Acquiriing Settlement Amount',
            'Debit',
            'Credit',
        ];
    }
    public function map($users): array
    {
        return [

            $users->NO,
            $users->Institution_Code,
            $users->Short_Name,
            $users->Account_Number,
            $users->date,
            $users->MPU_Comm,
            $users->Acq_Bank_Settle_Amt,
            $users->Debit,
            $users->Credit,
        ];
    }
}