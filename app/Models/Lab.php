<?php

// app/Models/Lab.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'nit', 'contact', 'city', 'department', 'address', 
        'phone', 'email', 'administrative_acts', 'start_date', 
        'end_date', 'resolution_compliance', 'attention_channels'
    ];

    // Relación con los tests
    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
