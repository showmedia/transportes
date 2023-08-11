<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    public function frete() {
        return $this->belongsTo('App\Models\Frete', 'fretes_id');
    }
}
