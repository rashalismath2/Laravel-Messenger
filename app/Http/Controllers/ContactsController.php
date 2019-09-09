<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ContactsController extends Controller
{
    public function get(){
        $contacts=User::all()->except(auth()->user()->id);
        return response()->json($contacts)->setStatusCode(200);
    }
}
