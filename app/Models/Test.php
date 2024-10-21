<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab_id', 'accreditation_status', 'matrix', 'component', 'activity', 'group', 'variable',
        'technique', 'method', 'direct_measurement_interval', 'station_name', 'station_address',
        'latitude', 'longitude', 'equipment_identification'
    ];

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }
}
