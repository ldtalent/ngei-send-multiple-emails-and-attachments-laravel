<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
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
    //
    public function send(Request $request)
    {
        $data = request()->validate([
            'email'=>'required',
            'cc'=>'required',
            'subject'=>'min:2|required',
            'message'=>'required',
            'attachments'=>'max:5060',
        ]);
//        dd($data['attachments']);
//        dd($data['cc']);
        $files = $request->file('attachments');
        if ($request->hasFile('attachments')){
            foreach ($files as $file){
                $attachment = $file->store('emails','public');
            }
            $insert = Attachment::create([
                'email'=>$data['email'],
                'cc'=>$data['cc'],
                'subject'=>$data['subject'],
                'message'=>$data['message'],
                'attachments'=>$attachment,
                'send'=>'10',
            ]);
        }
//        return redirect()->back();
    }
}
