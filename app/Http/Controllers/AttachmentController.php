<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    //
    public  function index()
    {
        $users = User::orderBy('id')->get();
        return view('welcome',compact('users'));
    }
}
