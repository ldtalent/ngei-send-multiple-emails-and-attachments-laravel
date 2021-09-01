<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class AttachmentController extends Controller
{
    //
    public function index()
    {
        $users = User::orderBy('id')->get();
        $emails = Attachment::orderBy('id')->get();
        return view('welcome', compact('users', 'emails'));
    }

    //
    public function send(Request $request)
    {
        $data = request()->validate([
            'email' => 'required',
            'cc' => 'required',
            'subject' => 'min:2|required',
            'message' => 'required',
            'attachments' => 'max:5060',
        ]);
        $message = new Attachment();
        $message->email = $data['email'];
        $message->cc = $data['cc'];
        $message->subject = $data['subject'];
        $message->message = $data['message'];
        foreach ($request->attachments as $file) {
            $filename =$file->getClientOriginalName();
            $path = $file->store('emails', 'public');
            $message->attachments = $path;
        }
        $message->save();
        if ($message) {
            $count = 1;
            foreach ($data['cc'] as $cc) {
                $count++;
            }
            DB::update('update attachments set send=? where id=?', [$count, $message->id]);
        }
//        $emailData = array(
//            'email' => $data['email'],
//            'cc' => $data['cc'],
//            'subject' => $data['subject'],
//            'message' => $data['message'],
//            'attachments' => $path,
//        );
        $files = $request->attachments;
        \Mail::send('mails', function ($message) use ($data, $file,$files, $path) {
            $message->to($data['email']);
            $message->cc($data['cc']);
            $message->from(env('MAIL_FROM_ADDRESS'));
            $message->subject($data['subject']);
            foreach ($files as $f){
                $message->attach(
                    $f->getRealPath(),array(
                        'as'=>$f->getClientOriginalName(),
                        'mime'=>$f->getMimeType(),
                    )
                );
            }
        });
        return redirect()->back();
    }
}
