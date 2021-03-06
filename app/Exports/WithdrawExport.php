<?php

namespace App\Exports;

use App\Visitor;
use App\Widraw;
use App\Withdraw;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WithdrawExport implements FromCollection, WithHeadings, ShouldAutoSize
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
            'Check_image'
            ,'Widraw_name',
            'Amount'
        ];
    }
    public function collection()
    {
        return collect(Widraw::getWidraw());
//        return Widraw::all();
    }
}
