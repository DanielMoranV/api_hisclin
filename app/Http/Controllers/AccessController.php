<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Collaborator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccessController extends Controller
{
    public function index()
    {
        $accesses = Access::all();
        return response()->json($accesses);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']); // Cifrar la contraseña antes de guardarla
        $access = Access::create($data);
        return response()->json($access, 201);
    }

    public function show($id)
    {
        $access = Access::findOrFail($id);
        return response()->json($access);
    }

    public function update(Request $request, $id)
    {
        $access = Access::findOrFail($id);
        $data = $request->all();

        // Verificar si se proporcionó una nueva contraseña
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']); // Cifrar la nueva contraseña
        }

        $access->update($data);
        return response()->json($access, 200);
    }
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    public function destroy($id)
    {
        $access = Access::findOrFail($id);
        $access->delete();
        return response()->json(null, 204);
    }

    public function getCollaboratorByAccess($username)
    {
        // Buscar el acceso por nombre de usuario
        $access = Access::where('username', $username)->first();

        // Verificar si se encontró el acceso
        if (!$access) {
            return response()->json(['message' => 'No se encontró ningún acceso con el nombre de usuario proporcionado'], 404);
        }

        // Obtener el usuario asignado a ese acceso
        $collaborator = $access->collaborator;

        // Retornar el usuario
        return response()->json($collaborator);
    }

    public function createAccessAndCollaborator(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'dni' => 'required|unique:collaborators',
            'password' => 'required',
            'role_id' => 'required|exists:roles,id',
            // Otros campos necesarios
        ]);

        // Generar el nombre de usuario igual al DNI
        $username = $request->input('dni');

        // Iniciar una transacción
        DB::beginTransaction();

        try {
            // Crear el usuario
            $user = Collaborator::create([
                'fullname' => $request->input('fullname'),
                'dni' => $request->input('dni'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'url_photo_profile' => $request->input('url_photo_profile'),
                // Otros campos necesarios para el usuario
            ]);
            // Crear el acceso asociado al usuario
            $access = Access::create([
                'username' => $username,
                'password' => Hash::make($request->input('password')),
                'status' => $request->input('status', 'offline'), // Valor predeterminado
                'role_id' => $request->input('role_id'),
                'collaborator_id' => $user->id, // Asociar el usuario recién creado al acceso
            ]);

            // Confirmar la transacción
            DB::commit();

            // Retornar la respuesta con el acceso creado
            return response()->json($access, 201);
        } catch (\Exception $e) {
            // En caso de error, deshacer la transacción
            DB::rollBack();

            // Retornar un mensaje de error
            return response()->json(['message' => 'Error al crear el acceso y el usuario ' . $e], 500);
        }
    }
}
