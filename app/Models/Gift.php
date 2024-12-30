<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    public function contacts() {
        return $this->hasMany(Contact::class);
    }
}
