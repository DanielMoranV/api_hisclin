<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;

use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    public function index()
    {
        $users = Collaborator::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $user = Collaborator::create($request->all());
        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = Collaborator::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = Collaborator::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $user = Collaborator::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
