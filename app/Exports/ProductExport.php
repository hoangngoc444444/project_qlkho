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

class ProductExport implements FromCollection, WithHeadings, WithEvents
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
        $products = $this->ware->products;
        $stt = 1;
        $xuat = array();
        $nhap = array();
        foreach ($products as $product) {
            $prd_id = $product->id;
            $notes = $this->ware->notes;
            $xuat[$prd_id] = 0;
            $nhap[$prd_id] = 0;
            foreach ($notes as $note) {
                foreach ($note->products as $key => $prd) {
                    if ($prd->id == $prd_id && $note->type == 1) {
                        $xuat[$prd_id] += $prd->pivot->quantity;
                    }
                    if ($prd->id == $prd_id && $note->type == 2) {
                        $nhap[$prd_id] += $prd->pivot->quantity;
                    }
                }
            }
            $results[] = array(
                '0' => $stt,
                '1' => $product->name,
                '2' => $product->pivot->quantity,
                '3' => $xuat[$prd_id],
                '4' => $nhap[$prd_id]
            );
            $stt++;
        }
        return (collect($results));
    }
    public function headings(): array
    {
        return [
            'STT',
            'Tên sản phẩm',
            'Số lượng trong kho hiện tại',
            'Số lượng đã từng xuất ra',
            'Số lượng đã từng nhập vào',
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
                $event->sheet->setCellValue('A1', 'Danh sách sản phẩm trong kho');
            },

            AfterSheet::class => function (AfterSheet $event) use ($styleArray) {
                $event->sheet->getStyle('A2:E2')->applyFromArray($styleArray);
                $event->sheet->getStyle('A1')->applyFromArray($styleArray);
                // $event->sheet->getStyle('E' . $total)->applyFromArray($styleArray);
                // $event->sheet->getStyle('F' . $total)->applyFromArray($styleArray);
                // $event->sheet->setCellValue('F' . $total, '=SUM(F3:F' . $count . ')');
                // $event->sheet->setCellValue('E' . $total, 'Tổng chệnh lệch thu chi tháng ' . $this->month);
            },
        ];
    }
}
