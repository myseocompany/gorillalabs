<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestActivityType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function activities()
    {
        return $this->hasMany(TestActivity::class, 'type_id');
    }
}
