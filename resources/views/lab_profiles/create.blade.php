@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Crear Perfil de Laboratorio</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lab_profiles.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Persona de Contacto</label>
            <input type="text" name="contact_person" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono de Contacto</label>
            <input type="text" name="contact_phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Correo de Contacto</label>
            <input type="email" name="contact_email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Razón Social del Laboratorio</label>
            <input type="text" name="lab_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Especialización</label>
            <input type="text" name="specialization" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Número de Licencia</label>
            <input type="text" name="license_number" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Dirección</label>
            <textarea name="address" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Ciudad</label>
            <input type="text" name="city" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Estado/Provincia</label>
            <input type="text" name="state" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Código Postal</label>
            <input type="text" name="postal_code" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">País</label>
            <input type="text" name="country" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Fax</label>
            <input type="text" name="fax" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Sitio Web</label>
            <input type="url" name="website" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
