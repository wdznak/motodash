<?php

namespace App\Motodash\Users\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Motodash\Contracts\Repositories\UserVehicleRepository;

class UserController extends Controller
{
    /**
     *  User main page controller
     *
     * @return view
     */
    public function show()
    {
        return view('layouts.user.user_homepage');
    }


    /**
     * Remove the specified user from storage.
     *
     * @param  App\Models\User $user
     * @return redirect
     */
    public function destroy(User $user)
    {
        if(\Gate::denies('modify-user', $user)) {
            abort(403);
        }

        $user->delete();

        return redirect('/');
    }
}
