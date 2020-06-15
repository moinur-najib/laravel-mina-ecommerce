<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisions extends Model
{
    public function districts() {
        return $this->hasMany(District::class);
    }
}
