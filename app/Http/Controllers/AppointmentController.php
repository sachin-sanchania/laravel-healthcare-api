<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends BaseController
{
    public function cancel(Request $request){
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'appointment_id'=>'required|integer|exists:appointments,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => error_processor($validator)], 403);
        }

        $appointment = Appointment::find($requestData['appointment_id']);

        if (Auth::id() != $appointment->user_id) {
            return $this->errorResponse('Unauthorized user..', [],403);
        }

        if ($appointment){
            $cancellationDeadline = Carbon::parse($appointment->appointment_start_time)->subHours(24);
            $currentTime = Carbon::now();
            if ($currentTime->lte($cancellationDeadline) && $appointment->status == 'booked') {
                return $this->errorResponse('Cancellation is not allowed within 24 hours of the appointment.', [],403);
            }
        }

        $appointment->status = 'cancelled';
        $appointment->save();
        return $this->successResponse($appointment, 'Appointment Cancelled Successfully.');
    }

    public function view(Request $request): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'user_id'=>'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => error_processor($validator)], 403);
        }

        if (Auth::id() != $requestData['user_id']) {
            return $this->errorResponse('Unauthorized user..', [],403);
        }

        $lists = Appointment::with('user','healthcareProfessional')->where('user_id',Auth::id())->get();
        return $this->successResponse($lists, 'Record Fetched Successfully.');
    }

    public function store(Request $request): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'user_id'=>'required|integer|exists:users,id',
            'healthcare_professional_id'=>'required|integer|exists:healthcare_professionals,id',
            'time'=>'required|date_format:d-m-Y H:i:s',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => error_processor($validator)], 403);
        }

        try {

            $existingAppointment = Appointment::where('healthcare_professional_id', $requestData['healthcare_professional_id'])
                ->where('appointment_start_time', '<=', Carbon::parse($requestData['time'])->format('Y-m-d H:i:s'))
                ->where('appointment_end_time', '>=', Carbon::parse($requestData['time'])->format('Y-m-d H:i:s'))
                ->where('status', '!=', 'cancelled')
                ->exists();

            if ($existingAppointment){
                return $this->errorResponse('Slot already booked for the given time. Please choose another time.', [],200);
            }

            $appointment = new Appointment();
            $appointment->user_id = $requestData['user_id'];
            $appointment->healthcare_professional_id = $requestData['healthcare_professional_id'];
            $appointment->appointment_start_time = $requestData['time'];
            $appointment->appointment_end_time = Carbon::parse($requestData['time'])->addHour();
            $appointment->status = 'booked';
            $appointment->save();
            if($appointment){
                return $this->successResponse($appointment, 'Appointment Created Successfully.');
            }
            return response()->json(['status' => 'error', 'data' => [], 'message' => 'Oops! Please try again.'], 500);
        } catch (\Exception $exception){
            Log::critical($exception->getMessage());
            return response()->json(['status' => 'error', 'data' => [],'message'=>$exception->getMessage()], 200);
        }
    }
}
