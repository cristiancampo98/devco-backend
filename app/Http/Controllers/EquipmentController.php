<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Services\EquipmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class EquipmentController extends Controller
{
    protected $equipmentService;

    public function __construct(EquipmentService $equipmentService)
    {
        $this->equipmentService = $equipmentService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json([
            'status' => 200,
            'data' => $this->equipmentService->getAllEquipments()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'so' => 'required|max:255',
            'type' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }

        $equipment = $this->equipmentService->store($request->all());
        return response()->json([
            'status' => 200,
            'data' => $equipment
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipment = $this->equipmentService->findById($id);

        if (is_null($equipment)) {
            return response()->json([
                'status' => 400,
                'errors' => 'No se encontró información'
            ]);
        }

        if (!is_null($equipment->employee)) {
            return response()->json([
                'status' => 400,
                'errors' => 'Ya se encuentra asignado'
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $equipment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }
        $equipment = $this->equipmentService->findById($id);

        if (is_null($equipment)) {
            return response()->json([
                'status' => 400,
                'errors' => 'No se encontró información'
            ]);
        }

        if (!is_null($equipment->employee)) {
            return response()->json([
                'status' => 400,
                'errors' => 'Ya se encuentra asignado'
            ]);
        }

        $equipment = $this->equipmentService->update($id);

        return response()->json([
            'status' => 200,
            'data' => $equipment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        //
    }
}
