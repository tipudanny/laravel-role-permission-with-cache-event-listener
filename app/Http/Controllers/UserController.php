<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Http\Requests\ChangePassword;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\NewUserRegistration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        //This will NOT fire the update event:
        //User::where('id',$id)->update($request->validated());

        //This will fire the update event:
        $user = User::find($id);
        //Case: You need to retrieve the user from the database and then save that user in order to fire the event.

        if (!empty($user)){
            try {
                $user->update($request->validated());
                return response()->json(['data'=> 'User Update successfully.' ],201);
            }
            catch (Throwable $e){
                report($e);
            }
        }
        return response()->json(['data'=> 'Invalid request' ]);
    }
    /*
     * Change User Password
     *
     * */
    public function changePassword(ChangePassword $request, $id)
    {
        $user = User::find($id);

        if (!empty($user)){

            if(!Hash::check( $request->current_password , $user->password)){
                return response()->json(['error'=> 'Current Password wrong !! Try Again.' ],422);
            }

            if(!Hash::check($request->password, $user->password)){
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
                return response()->json(['success'=> 'Password Changed Successfully.' ],201);
            }
            return response()->json(['error'=> 'New Password should not be same as Old Password.' ],422);

        }
        return response()->json(['error'=> 'Invalid request' ],422);
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
