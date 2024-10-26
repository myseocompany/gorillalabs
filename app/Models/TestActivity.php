<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestActivity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type_id'];

    public function type()
    {
        return $this->belongsTo(TestActivityType::class, 'type_id');
    }
}
