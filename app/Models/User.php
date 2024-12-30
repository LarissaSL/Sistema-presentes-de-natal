<?php

namespace App\Models;

use App\Services\OperationsService;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
