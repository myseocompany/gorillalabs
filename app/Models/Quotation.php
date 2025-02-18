<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab_id',
        'quotation_date',
        'payment_method_id',
        'payment_condition_id',
        'validity_period_id',
        'onac_accreditation',
        'ideam_accreditation',
        'file_url'
    ];

    /**
     * Relación con el laboratorio (Cada cotización pertenece a un laboratorio).
     */
    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    /**
     * Relación con el método de pago.
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Relación con la condición de pago.
     */
    public function paymentCondition()
    {
        return $this->belongsTo(PaymentCondition::class);
    }

    /**
     * Relación con el periodo de validez.
     */
    public function validityPeriod()
    {
        return $this->belongsTo(ValidityPeriod::class);
    }

    /**
     * Devuelve "Sí" o "No" para la acreditación ONAC.
     */
    public function getOnacAccreditationTextAttribute()
    {
        return $this->onac_accreditation ? 'Sí' : 'No';
    }

    /**
     * Devuelve "Sí" o "No" para la acreditación IDEAM.
     */
    public function getIdeamAccreditationTextAttribute()
    {
        return $this->ideam_accreditation ? 'Sí' : 'No';
    }

    /**
     * Obtener la URL completa del archivo adjunto.
     */
    public function getFileUrlAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
    
    public function paymentMethods()
    {
        return $this->belongsToMany(PaymentMethod::class, 'quotation_payment_methods');
    }
    

}
