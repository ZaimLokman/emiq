<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
   public function get_patients()
    {
        $patients = Patient::all();

        return response()->json([
            'patients' => $patients
        ],200);
    }
}
