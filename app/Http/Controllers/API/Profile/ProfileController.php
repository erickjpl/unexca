<?php

namespace App\Http\Controllers\API\Profile;

# Libraries
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
# Repositories
use App\Repositories\Profile\UserRepository;
use App\Repositories\Profile\StudentRepository;
use App\Repositories\Profile\UserDetailRepository;
# Response Resource
use App\Http\Resources\Profile\UserDetailResource;
use App\Http\Resources\Profile\UserResource;

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
    /** @var  UserDetailRepository */
    private $userDetailRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
        $this->studentRepo = new StudentRepository();
        $this->userDetailRepo = new UserDetailRepository();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile\UserDetail  $userDetail
     * @return \App\Http\Resources\Profile\UserResource
     */
    public function user(Request $request, $user)
    {
        $input = $this->config( $request->all() );

        try {
            $model = $this->userRepo->find($user);

            $repository = $this->userRepo->update($input, $model);

            return UserResource::make($repository);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json('El recurso no fue encontrado..!', 404);
        } catch (\App\Exceptions\CustomException $e) {
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile\UserDetail  $userDetail
     * @return \App\Http\Resources\Profile\UserDetailResource
     */
    public function detail(Request $request, $user)
    {
        $input = $this->config( $request->all() );

        try {
            $model = $this->userDetailRepo->first(['user_id' => $user]);

            $repository = $this->userDetailRepo->update($input, $model);

            return UserDetailResource::make($repository);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json('El recurso no fue encontrado..!', 404);
        } catch (\App\Exceptions\CustomException $e) {
            throw $e;
        }
    }

    protected function config($input) 
    {
        if (isset($input['birthdate'])) 
            $input['birthdate'] = \DateTime::createFromFormat('d/m/Y', $request->birthdate); 
        if (isset($input['password'])) 
            $input['password'] = \Hash::make($input['password']);

        return $input;
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
            $repository = $this->studentRepo->find($user, $request->except(['skip', 'limit']));

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
            $repository = $this->userRepo->find($id);

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
