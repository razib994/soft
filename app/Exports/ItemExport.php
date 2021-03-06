<?php

namespace App\Exports;

use App\Category;
use App\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ItemExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            "ID",
            "Category Name",
            "Item Name",
        ];
    }
    public function collection()
    {
        return collect(Item::getitem());
//        return Item::all();
    }
}
