<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('patient')->orderby('created_at', 'desc')->get();

        return response()->json([
            'appointments' => $appointments
        ],200);
    }

    public function create()
    {
        $formData = [
            'code' => null,
            'appt_datetime' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'arrived_at' => null,
            'status' => 'pending',
            'patients_id' => null
        ];

        return response()->json($formData);
    }

    public function store(Request $request)
    {
        $appointmentData = $request->input("code");
        $appointmentData = $request->input("appt_datetime");
        $appointmentData = $request->input("patient_id");
        $appointmentData = $request->input("created_at");
        $appointmentData = $request->input("arrived_at");
        $appointmentData = $request->input("status");

        $appointment = Appointment::create($appointmentData);
    }

    public function reschedule($id)
    {
        $appointment = Appointment::find($id);

        $formData = [
            'code' => $appointment->code,
            'appt_datetime' => $appointment->appt_datetime,
            'created_at' => $appointment->created_at,
            'arrived_at' => null,
            'status' => 'reschedule',
            'patients_id' => $appointment->patients_id
        ];

        return response()->json($formData);
    }

    public function update(Request $request, string $id)
    {
        $appointment = Appointment::find($id);

        // Update the appointment model with the new data from the request
        $appointment->status = 'rescheduled';
        $appointment->save();

        // Create new appointment for the same patient
        $appointmentData = $appointment->code;
        $appointmentData = $request->input("appt_datetime");
        $appointmentData = $appointment->patient_id;
        $appointmentData = date('Y-m-d H:i:s');
        $appointmentData = null;
        $appointmentData = 'pending';

        $appointment = Appointment::create($appointmentData);
    }

    public function arrived($id)
    {
        $appointment = Appointment::find($id);
        $appointment->status = 'arrived';
        $appointment->arrived_at = date('Y-m-d H:i:s');
        $appointment->save();
    }
}
