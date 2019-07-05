<?php

namespace App\Http\Controllers;

use App\Note;
use App\Product;
use App\Ware;
use Illuminate\Http\Request;
use App\Http\Requests\NoteRequest;

class NoteController extends Controller
{
    protected $productModel;
    protected $noteModel;

    public function __construct(Note $note, Product $product)
    {
        $this->noteModel = $note;
        $this->productModel = $product;
    }


    public function store(NoteRequest $request)
    {
        $wareID = $request->id;
        $name = $request->name;
        $type = $request->type;

        $note = $this->noteModel->addNote($name, $type, $wareID);
        $products = $request->productname;
        $quantity = $request->quantity;
        foreach ($products as $key => $product) {
            $prd = $this->productModel->getProduct($product);
            if ($prd) {
                $change = $this->changeQuantity($type, $quantity[$key], $prd);
                if (!$change) {
                    return redirect()->back()->with('error', "Số lương hàng muốn xuất ra lớn hơn hàng có trong kho");
                }
            } else {
                if ($type == 1) {
                    return redirect()->back()->with('error', "Bạn không có hàng trong kho mà đòi xuất");
                }
                $this->productModel->addProduct($product, $quantity[$key], $wareID);
            }
            $note->products()->attach([$prd->id => ['quantity' => $quantity[$key]]]);
        }

        return redirect()->back()->with('message', "Xuất nhập kho thành công");
    }



    public function changeQuantity($type, $quantity, $prd)
    {
        if ($type == 2) {
            $prd->quantity += $quantity;
            $prd->save();
        } else {
            if ($prd->quantity > $quantity) {
                $prd->quantity -= $quantity;
                $prd->save();
            }
            return false;
        }
    }
}
