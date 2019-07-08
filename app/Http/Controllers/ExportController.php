<?php

namespace App\Http\Controllers;

use App\Ware;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Exports\UserExport;
use App\Exports\ProductExport;
use App\Exports\NoteExport;

class ExportController extends Controller
{
    use Exportable;

    public function export()
    {
        return Excel::download(new UserExport(), 'report.xlsx');
    }
    public function exportprd($id)
    {
        $ware = Ware::findOrFail($id);
        return Excel::download(new ProductExport($ware), 'report.xlsx');
    }
    public function exportnote($id)
    {
        $ware = Ware::findOrFail($id);
        return Excel::download(new NoteExport($ware), 'report.xlsx');
    }
}
