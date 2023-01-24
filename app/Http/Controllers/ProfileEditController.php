<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ProfileEditController extends Controller
{
    public function promote(Request $request, $target)
    {
        if ($request->user()->id == $target) {return("Error! You can't modify your own role!");}; $targetUser = DB::table('users')->where('id', $target)->first();
        if ($request->user()->role_id > $targetUser->role_id) {return("Error! The user you are trying to modify has a higher role!");} 
        if ($request->user()->role_id == $targetUser->role_id) {return("Error! The user you are trying to modify has the same role as you!");} 

        DB::table('users')
        ->where('id', $target)  
        ->limit(1)  
        ->update(array('role_id' => $targetUser->role_id-1)); 

        return(Redirect::route('dashboard'));
    }

    public function demote(Request $request, $target)
    {
        if ($request->user()->id == $target) {return("Error! You can't modify your own role!");}; $targetUser = DB::table('users')->where('id', $target)->first();
        if ($request->user()->role_id > $targetUser->role_id) {return("Error! The user you are trying to modify has a higher role!");} 
        if ($targetUser->role_id == DB::table('roles')->get()->last()->id) {return("Error! There is no lower role!");} 

        DB::table('users')
        ->where('id', $target)  
        ->limit(1)  
        ->update(array('role_id' => $targetUser->role_id+1)); 

        return(Redirect::route('dashboard'));
    }

    public function modify(Request $request, $target)
    {
        return dd($request);
    }
}
