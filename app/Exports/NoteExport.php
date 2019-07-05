<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Ware;
use App\User;
use Illuminate\Support\Facades\Auth;

class NoteExport implements FromCollection, WithHeadings, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */



    protected $ware;

    public function __construct($ware)
    {
        $this->ware = $ware;
    }
    public function collection()
    {
        $user = Auth::user();
        $notes = $this->ware->notes;
        $stt = 1;


        foreach ($notes as $note) {
            $list = '';
            foreach ($note->products as $key => $product) {
                $list .= ' Sp'.($key +1).':'.$product->name.', số lượng'.$product->pivot->quantity;
            }
            $note_arr[] = array(
                '0' => $stt,
                '1' => $note->name,
                '2' => $note->type == 1 ? "xuất" : "nhập",
                '3' => $user->name,
                '4' => $list,
                '5' => $note->created_at,
            );
            $stt++;
        }
        return (collect($note_arr));
    }
    public function headings(): array
    {
        return [
            'ID',
            'Tên phiếu xuất nhập',
            'Loại xuất nhập',
            'Người quản lý kho hàng',
            'Số lượng xuất nhập',
            'Thời gian nhập xuất kho hàng',
        ];
    }
    public function registerEvents(): array
    {
        // $wallet = \Auth::user()->wallet;
        // $id = $wallet->id;
        // $count = Expend::whereMonth('created_at', '=', date($this->month))->where('wallet_id', $id)->get()->count();
        // $count += 2;
        // $total = $count + 1;


        $styleArray = [
            'font' => [
                'bold' => true,
            ]
        ];
        return [
            BeforeSheet::class => function (BeforeSheet $event) use ($styleArray) {
                $event->sheet->setCellValue('A1', 'Danh sách phiếu nhập xuất');
            },

            AfterSheet::class => function (AfterSheet $event) use ($styleArray) {
                $event->sheet->getStyle('A2:G2')->applyFromArray($styleArray);
                $event->sheet->getStyle('A1')->applyFromArray($styleArray);
                // $event->sheet->getStyle('E' . $total)->applyFromArray($styleArray);
                // $event->sheet->getStyle('F' . $total)->applyFromArray($styleArray);
                // $event->sheet->setCellValue('F' . $total, '=SUM(F3:F' . $count . ')');
                // $event->sheet->setCellValue('E' . $total, 'Tổng chệnh lệch thu chi tháng ' . $this->month);
            },
        ];
    }
}
