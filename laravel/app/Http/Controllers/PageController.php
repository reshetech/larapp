<?php namespace App\Http\Controllers;

use App\Http\Requests;

use Redirect;
use Request;
use Validator;

use Mail;

class PageController extends Controller {

	public function getContact()
    {
        return view('pages.contact');
    }

    public function postContact()
    {
        $input = Request::all();

        // Validation
        $rules = array(
            'name'     => 'required|min:2',
            'mail'     => 'required|email',
            'message'  => 'required|min:2'
        );


        $v = Validator::make( $input, $rules );

        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())-> withInput($input);
        }


        $input['message'] = preg_replace('/[^a-zA-Z0-9 \-\_\.\,]/', '', $input['message']);

        // Send mail
        $data = [$input['name'], $input['mail'], $input['phone'], $input['message']];


        $this->sendMail( $data );

        return Redirect::to("blog")->with("success", "Thank you.");
    }





    public function sendMail($data)
    {
        Mail::queue('emails.contact', compact('data'), function($message)
        {
            $message->to('johndoe@gmail.com', 'john doe')
                ->from('support@mynewapp.com', 'mynewapp.com' )
                ->subject('A user wants to contact!');
        });
    }

}
