<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ware extends Model
{
    protected $table = "wares";

    protected $fillable = [
        'name', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function notes()
    {
        return $this->hasMany('App\Note');
    }
    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_ware')->withPivot('quantity')->withTimestamps();
    }
    public function getWares()
    {
        $wares = Ware::with('user')->get();
        return $wares;
    }
    public function getWarebyID($id)
    {
        $wares = Ware::findOrFail($id);
        return $wares;
    }
    public function insertWare($name, $user_id)
    {
        $ware = Ware::create([
            'name' => $name,
            'user_id' => $user_id,

        ]);
        return $ware;
    }
    public function deleteWare($id)
    {
        $wares = Ware::findOrFail($id);
        $wares->delete();
        return $wares;
    }
}
