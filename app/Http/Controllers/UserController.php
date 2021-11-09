<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\NewUserRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $page = (request()->has('page')) ? request()->get('page') : 1 ;
        $user = Cache::tags('users')->rememberForever('users'.$page,function (){
            return User::with(['has_role', 'has_permissions'])->latest()->paginate();
        });
        /*return response()->json([
            'data'=> $user
        ]);*/

        return UserResource::collection($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRegistrationRequest $request)
    {
        try {
            $user = User::create($request->validated());

            //use anyone notify() or Notification

            //$user->notify(new NewUserRegistration($user));
            //Notification::send($user, new NewUserRegistration($user));

            //Send Mail using Event Listener

            //Event dispatch from User Model 'Created'
            //Event::listen('UserCreated', $user);
            //\event(new UserCreated($user));

            return response()->json(['data'=> 'User registration successfully. Please verify your Email Address.' ],201);
        }
        catch (Throwable $e){
            report($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return array
     */
    public function update(UserUpdateRequest $request, $id)
    {
        return $request->all();
        try {
            User::where('id',$id)->update($request->validated());
            return response()->json(['data'=> 'User Update successfully.' ],201);
        }
        catch (Throwable $e){
            report($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
