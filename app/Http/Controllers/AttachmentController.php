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
    public  function index()
    {
        $users = User::orderBy('id')->get();
        $emails = Attachment::orderBy('id')->get();
        return view('welcome',compact('users','emails'));
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
        $files = $request->file('attachments');
//        $url = $request->file('image');
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
            if ($insert){
                $count = 1;
                foreach ($data['cc'] as $cc)
                {
                    $count++;
                }
//                dd($count);
                DB::update('update attachments set send=? where id=?',[$count,$insert->id]);
            }
            $emailData = array(
                'email'=>$data['email'],
                'cc'=>$data['cc'],
                'subject'=>$data['subject'],
                'message'=>$data['message'],
                'attachments'=>$attachment,
            );
            $sendMail = \Mail::send('mails',$emailData,function ($message) use($data,$file,$attachment){
                $message->to($data['email']);
                $message->cc($data['cc']);
                $message->from(env('MAIL_FROM_ADDRESS'));
                $message->subject($data['subject']);
                $message->attach(
                    $file->getRealPath(),array(
                        'as'=>$file->getClientOriginalName(),
                        'mime'=>$file->getMimeType()
                    )
                );
            });
            if ($sendMail){

            }
        }
        return redirect()->back();
    }
}
