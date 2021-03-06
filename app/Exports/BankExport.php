<?php

namespace App\Exports;

use App\Bank;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BankExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            "id",
            "Bank Name",
            "Account No",
            "Branch Name",
            "Amount",
        ];
    }

    public function collection()
    {
        return collect(Bank::getBank());
//        return Bank::all();
    }
}
