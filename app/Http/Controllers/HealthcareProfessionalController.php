<?php

namespace App\Http\Controllers;

use App\Models\HealthcareProfessional;

class HealthcareProfessionalController extends BaseController
{
    public function lists(): \Illuminate\Http\JsonResponse
    {
        try {
            $professionals = HealthcareProfessional::query()->orderBy('name', 'asc')->get();
            return $this->successResponse($professionals, 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), [],500);
        }
    }
}
