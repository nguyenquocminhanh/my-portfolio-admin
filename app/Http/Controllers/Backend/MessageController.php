<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\HireMessage;
use Illuminate\Support\Carbon;
use App\Notifications\MessageNotification;
use App\Notifications\HireNotification;

class MessageController extends Controller
{
    public function MessageAll() {
        $messages = Message::latest()->get();
        return view('admin.message.message_all', compact('messages'));
    }

    public function MessageView($id) {
        $message = Message::findOrFail($id);
        $message->update([
            'read_at' => Carbon::now()
        ]);
        return view('admin.message.message_view', compact('message'));
    }

    public function MessageDelete($id) {
        $message = Message::findOrFail($id);
        $message->delete();
        
        $notification = array(
            'message' => 'Message Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('message.all')->with($notification);
    }

    public function ContactReadAll() {
        $messages = Message::where('read_at', null)->get();
        $messages->each(function($mess, $key) {
            $mess->update([
                'read_at' => Carbon::now()
            ]);
        });

        $notification = array(
            'message' => 'Contact Message Read Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    // Hire
    public function HireAll() {
        $messages = HireMessage::latest()->get();
        return view('admin.message.hire_all', compact('messages'));
    }

    public function HireView($id) {
        $message = HireMessage::findOrFail($id);
        $message->update([
            'read_at' => Carbon::now()
        ]);
        return view('admin.message.hire_view', compact('message'));
    }

    public function HireDelete($id) {
        $message = HireMessage::findOrFail($id);
        $message->delete();
        
        $notification = array(
            'message' => 'Message Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('hire.all')->with($notification);
    }

    public function HireReadAll() {
        $messages = HireMessage::where('read_at', null)->get();
        $messages->each(function($mess, $key) {
            $mess->update([
                'read_at' => Carbon::now()
            ]);
        });

        $notification = array(
            'message' => 'Hire Message Read Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // API
    public function MessageStore(Request $request) {
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');

        try {
            $mess = Message::create([
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message,
                'created_at' => Carbon::now()
            ]);

            // $basic  = new \Vonage\Client\Credentials\Basic(env('NEXMO_KEY'), env('NEXMO_SECRET'));
            // $client = new \Vonage\Client($basic);
     
            // $message = $client->message()->send([
            //     'to' => env('VONAGE_SMS_TO'),
            //     'from' => env('VONAGE_SMS_FROM'),
            //     'text' => 'On '.date('M d, Y, g:i A', strtotime($mess->created_at)).', you have received a contact message from '.$name.' ('.$email.') with message '.$message
            // ]);

            // send mail + SMS notification
            $mess->notify(new MessageNotification($mess));

            return response([
                'message' => "Thank You! Message Was Sent!",
                'contact_message' => $mess
            ], 200);    // Success 200 code

        } catch(Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function HireMessageStore(Request $request) {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone_number = $request->input('phone_number');
        $message = $request->input('message');

        try {
            $mess = HireMessage::create([
                'name' => $name,
                'email' => $email,
                'phone_number' => $phone_number,
                'message' => $message,
                'created_at' => Carbon::now()
            ]);

            // $basic  = new \Vonage\Client\Credentials\Basic(env('NEXMO_KEY'), env('NEXMO_SECRET'));
            // $client = new \Vonage\Client($basic);
     
            // $message = $client->message()->send([
            //     'to' => env('VONAGE_SMS_TO'),
            //     'from' => env('VONAGE_SMS_FROM'),
            //     'text' => 'On '.date('M d, Y, g:i A', strtotime($mess->created_at)).', you have received a hiring request from '.$name.' ('.$email.', '.$phone_number.') with message '.$message
            // ]);

            $mess->notify(new HireNotification($mess));

            return response([
                'message' => "Thank You! Message Was Sent!",
                'hire_message' => $mess
            ], 200);    // Success 200 code

        } catch(Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
