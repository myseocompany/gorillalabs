<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidityPeriod extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
}
