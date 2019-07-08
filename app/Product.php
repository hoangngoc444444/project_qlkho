<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        'name','quantity'
    ];


    public function notes()
    {
        return $this->belongsToMany('App\Note', 'product_note')->withPivot('quantity')->withTimestamps();
    }
    public function wares()
    {
        return $this->belongsToMany('App\Ware', 'product_ware')->withPivot('quantity')->withTimestamps();
    }


    public function addProduct($product, $quantity, $ware_id)
    {
        $prd = Product::firstOrCreate([
            'name' => $product,
        ], [
            'name' => $product,
        ]);
        $prd->wares()->attach([$ware_id => ['quantity' => $quantity]]);

        return $prd;
    }


    public function getProduct($product, $ware)
    {
        $prd = Product::where('name', $product)->first();

        if ($prd) {
            foreach ($ware->products as $key => $pr) {
                if ($pr->id == $prd->id) {
                    return $pr;
                }
            }
        } else {
            return false;
        }
    }
}
