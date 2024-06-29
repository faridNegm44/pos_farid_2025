<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Blog;
use App\Models\Back\Courses;
use App\Models\Back\Faq;
use App\Models\Back\Setting;
use App\Models\Back\Teacher;
use App\Models\Back\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Back\Products;

use Barryvdh\DomPDF\Facade\Pdf;

use AbSelwi\LaravelArabicHtml\HtmlBuilder;
use Dompdf\Dompdf;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

class HomeController extends Controller
{
    public function index(){
        // $settings = Setting::first();
        return view('back.welcome');
    }



    public function reset(){
        $settings = Setting::first();
        // $html = view('back.reset3' , compact('settings'))->toArabicHTML();

        // $pdf = PDF::loadHTML($html)->output();

        // $headers = array(
        //     "Content-type" => "application/pdf",
        // );

        // return response()->streamDownload(
        //     function () use ($pdf) {
        //         return print($pdf);
        //     },
        //     "invoice.pdf",
        //     $headers
        // );





        // $pdf = app()->make('dompdf.wrapper');
        // $pdf->loadHTML('back.reset3');
        // $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // return $pdf->stream();

            return view('back.reset3' , compact('settings'));
        }



    public function barcode(){

        $settings = Setting::first();
        $product = Products::where('id', 2)->first();

        
        $barcode = new DNS1D();
        $code = '123456789'; // Replace with your barcode data

        return view('back.barcode2', compact('code', 'settings', 'product'));


        // return view('back.barcode2', compact('settings', 'product'));
    }




    public function login_post(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ],[
            'email.required' => 'البريد الإلكتروني مطلوب',
            'password.required' => 'الرقم السري مطلوب',
        ]);


        if(Auth::attempt(['email' => request('email') , 'password' => request('password')])){
            User::where('email', request('email'))->update([
                'last_login_time' => now(),
            ]);

            return redirect('/')->with("success_login", "");
        }else{
            session()->put('error_email_or_password', 'من فضلك تأكد من البريد الإلكتروني و الرقم السري');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
