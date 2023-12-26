<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendMailJob;
use Illuminate\Support\Facades\Validator;


class SendEmailController extends Controller
{
    public function index()
    {
        return view('kirim-email');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        dispatch(new SendMailJob($data));
        return redirect()->route('kirim-email')->with('status', 'Email berhasil dikirim');
    }

    public function sendEmail (Request $request) {
        $data = $request->all();
        
        $inputRequest = $request->input();
        $validator = Validator::make($inputRequest, [
        'email'     => 'unique:users,email|required|string',
        'subject'   => 'required',
    ]);

    if ($validator->fails()) {
      $error                = $validator->messages()->first();
      $response['status']   = false;
      $response['message']  = $error;
      return response()->json($response, 400);
    }
 
        dispatch(new SendMailJob($data));
 
        return response()->json([
            "message" => "Email berhasil dikirim",
        ], 200);

    }
}
