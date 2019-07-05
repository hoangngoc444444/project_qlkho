<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = "notes";

    protected $fillable = [
        'name','ware_id','type'
    ];

    public function ware()
    {
        return $this->belongsTo('App\Ware');
    }
    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_note')->withPivot('quantity')->withTimestamps();
    }

    public function addNote($name, $type, $ware_id)
    {
        $note = Note::create([
            'name' => $name,
            'type' => $type,
            'ware_id' => $ware_id
        ]);
        return $note;
    }
}
