<?php

namespace App\Http\Controllers\API\Profile;

# Libraries
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
# Repositories
use App\Repositories\Profile\UserRepository;
use App\Repositories\Profile\StudentRepository;

/**
 * Class ProfileController
 * @package App\Http\Controllers\API\Profile
 */

class ProfileController extends Controller
{
    /** @var  UserRepository */
    private $userRepo;
    /** @var  StudentRepository */
    private $studentRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
        $this->studentRepo = new StudentRepository();
    }

    public function index(Request $request)
    {
        try {
            $users = $this->userRepo->paginate(
                $request->get('perPage'),
                $request->except(['skip', 'limit']),
                $request->except(['skip', 'limit'])
            );

            if ( ! empty($users) ) 
                return response()->json($users->toArray(), 200);

            return response()->json(array('info' => 'No se encontraron datos.', 'status' => '204'));
        } catch (\App\Exceptions\CustomException $e) {
            throw $e;
        }
    }

    public function store(CreateUserAPIRequest $request)
    {
        try { 
            $user = $this->userRepo->create($request->all());

            return response()->json($user->toArray(), 201);
        } catch (\App\Exceptions\CustomException $e) {
            throw $e;
        }
    }

    public function show(Request $request, $user)
    {
        try {
            $repository = $this->userRepo->find($user, $request->except(['skip', 'limit']));

            return response()->json($repository->toArray(), 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json('El recurso no fue encontrado..!', 404);
        } catch (\App\Exceptions\CustomException $e) {
            throw $e;
        }
    }

    public function update($id, UpdateUserAPIRequest $request)
    {
        try {
            $repository = $this->userRepo->find($user);

            if (empty($repository)) 
                return response()->json(array('info' => 'El cliente no puede ser actualizado.', 'status' => '204'));

            $repository = $this->userRepo->update($request->all(), $id);

            return response()->json($repository->toArray(), 201);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json('El recurso no fue encontrado..!', 404);
        } catch (\App\Exceptions\CustomException $e) {
            throw $e;
        }
    }

    public function destroy($user)
    {
        try {
            $repository = $this->userRepo->find($user);

            if ( empty($repository) )
                return response()->json(array('info' => 'El usuario no puede ser eliminado.', 'status' => '204'));

            $repository->delete();

            return response()->json($repository->toArray(), 202);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json('El recurso no fue encontrado..!', 404);
        } catch (\App\Exceptions\CustomException $e) {
            throw $e;
        }
    }
}
