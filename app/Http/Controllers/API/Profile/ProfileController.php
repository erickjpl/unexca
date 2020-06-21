<?php

namespace App\Http\Controllers\API\Profile;

# Libraries
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
# Repositories
use App\Repositories\Profile\UserRepository;

/**
 * Class ProfileController
 * @package App\Http\Controllers\API\Profile
 */

class ProfileController extends Controller
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function index(Request $request)
    {
        try {
            /*
            $users = $this->userRepository->all(
                $request->except(['skip', 'limit']),
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
            */
            $users = $this->userRepository->paginate(
                $request->get('perPage'),
                $request->except(['skip', 'limit']),
                $request->except(['skip', 'limit'])
            );

            if ( ! empty($users) ) 
                return response()->json($users->toArray(), 200);

            return response()->json(array('info' => 'No se encontraron datos.', 'status' => '204'));
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    public function store(CreateUserAPIRequest $request)
    {
        try { 
            $user = $this->userRepository->create($request->all());

            return response()->json($user->toArray(), 201);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    public function show($user)
    {
        try {
            $repository = $this->userRepository->find($request->except(['skip', 'limit']));

            if ( empty($repository) ) 
                return response()->json(array('info' => 'Usuario no encontrado.', 'status' => '204'));

            return response()->json($repository->toArray(), 200);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    public function update($id, UpdateUserAPIRequest $request)
    {
        try {
            $repository = $this->userRepository->find($request->except(['skip', 'limit']));

            if (empty($repository)) 
                return response()->json(array('info' => 'El cliente no puede ser actualizado.', 'status' => '204'));

            $repository = $this->userRepository->update($request->all(), $id);

            return response()->json($repository->toArray(), 201);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }

    public function destroy($id)
    {
        try {
            /** @var User $user */
            $repository = $this->userRepository->find($id);

            if ( empty($repository) )
                return response()->json(array('info' => 'El usuario no puede ser eliminado.', 'status' => '204'));

            $repository->delete();

            return response()->json($repository->toArray(), 202);
        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(array('info' => 'Ha ocurrido un error con la base de datos'), 500);
        }
    }
}
