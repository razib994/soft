<?php

namespace App\Exports;

use App\Deposit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DepositExport implements FromCollection,WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            "Id",
            "Bank Name",
            'Checkno',
            'Date',
            "Branch_name",
            'Check_image',
            'Depositor Name',
            'Amount'
        ];
    }
    public function collection()
    {
        return collect(Deposit::getDeposit());
//        return Deposit::all();
    }
}
