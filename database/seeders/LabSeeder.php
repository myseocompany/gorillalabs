<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabSeeder extends Seeder
{
    public function run()
    {
        // Inserción de datos en la tabla labs desde import_ideam
        DB::statement("
            INSERT INTO labs (name, nit, contact, city, department, address, phone, email, administrative_acts, start_date, end_date, resolution_compliance, attention_channels, created_at, updated_at)
            SELECT DISTINCT 
                TRIM(`Nombre del Laboratorio`) AS name,
                TRIM(`Nit`) AS nit,
                TRIM(`Contacto`) AS contact,
                TRIM(`municipality`) AS city,
                TRIM(`department`) AS department,
                TRIM(`Dirección`) AS address,
                TRIM(`Teléfono`) AS phone,
                TRIM(`Correo`) AS email,
                TRIM(`Actos administrativos que soportan el alcance`) AS administrative_acts,
                CASE 
                    WHEN TRIM(`Desde`) != '' THEN STR_TO_DATE(TRIM(`Desde`), '%Y/%m/%d') 
                    ELSE '1900-01-01'
                END AS start_date,
                CASE 
                    WHEN TRIM(`Hasta`) != '' THEN STR_TO_DATE(TRIM(`Hasta`), '%Y/%m/%d') 
                    ELSE '9999-12-31'
                END AS end_date,
                TRIM(`Acogimiento a Resolución`) AS resolution_compliance,
                TRIM(`Canales de Atención Grupo de Acreditación de Laboratorios`) AS attention_channels,
                NOW() AS created_at,
                NOW() AS updated_at
            FROM import_ideam
            WHERE TRIM(`Nombre del Laboratorio`) IS NOT NULL
              AND TRIM(`Nit`) IS NOT NULL
            ON DUPLICATE KEY UPDATE
                name = VALUES(name),
                contact = VALUES(contact),
                city = VALUES(city),
                department = VALUES(department),
                address = VALUES(address),
                phone = VALUES(phone),
                email = VALUES(email),
                administrative_acts = VALUES(administrative_acts),
                start_date = VALUES(start_date),
                end_date = VALUES(end_date),
                resolution_compliance = VALUES(resolution_compliance),
                attention_channels = VALUES(attention_channels),
                updated_at = NOW();
        ");

        // Eliminación de duplicados en la tabla labs
        DB::statement("
            DELETE l1
            FROM labs l1
            JOIN labs l2
            ON l1.nit = l2.nit
            AND l1.id < l2.id;
        ");
    }
}
