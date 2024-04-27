<?php

namespace App\Http\Controllers;

use App\Models\ClinicHistory;
use Illuminate\Http\Request;

class ClinicHistoryController extends Controller
{
    public function index()
    {
        $clinicHistories = ClinicHistory::all();
        return response()->json($clinicHistories);
    }

    public function store(Request $request)
    {
        $clinicHistory = ClinicHistory::create($request->all());
        return response()->json($clinicHistory, 201);
    }

    public function show($id)
    {
        $clinicHistory = ClinicHistory::findOrFail($id);
        return response()->json($clinicHistory);
    }

    public function update(Request $request, $id)
    {
        $clinicHistory = ClinicHistory::findOrFail($id);
        $clinicHistory->update($request->all());
        return response()->json($clinicHistory, 200);
    }

    public function destroy($id)
    {
        $clinicHistory = ClinicHistory::findOrFail($id);
        $clinicHistory->delete();
        return response()->json(null, 204);
    }
}
