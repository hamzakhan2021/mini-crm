<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Company extends Model
{
    use HasFactory;

    public $guarded = [
        'created_at',
        'updated_at'
    ];

    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset("$value"),
        );
    }

}
