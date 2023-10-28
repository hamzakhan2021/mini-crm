<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory;

    public $guarded = [
        'created_at',
        'updated_at'
    ];

    public function company() : BelongsTo {
        return $this->BelongsTo(Company::class);
    }
}
