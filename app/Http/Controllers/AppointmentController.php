<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Worker;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // create appointment

    public function store(Request $request  )
    {
        // Validate input (adjust validation rules as needed)
        $request->validate([
            'worker_id' => 'required|exists:workers,id', // Assuming you have a workers table
        ]);

        // Create a new appointment
        $appointment = new Appointment();
        $appointment->user_id = auth()->user()->id;
        $appointment->worker_id = $request->input('worker_id');
        // $appointment->date = $request->input('date');
        // Set other appointment properties if needed

        $appointment->save();


    // 
    return response([
        'message' => "Appointment Created."
    ],200);

    }


    // update 
    public function cancel($id)
    {
        $appointment = Appointment::find($id);
        if(!$appointment)
        {
            return response([
                'message' => "Appointment Not Found."
            ],403);
        }

        $appointment->delete();

        return response([
            'message' => "Appointment canceled."
        ],200);

    }


    public function show()
{
    $appointments = Appointment::orderBy('id', 'asc')->get();

    return response([
        'appointments' => $appointments
    ],200);

}
}
