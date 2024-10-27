<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(16); // Obtener 16 customers por página
        return view('customers.index', compact('customers'));
    }
}