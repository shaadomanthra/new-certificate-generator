<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Storage
use Illuminate\Support\Facades\Storage;

// String Functions
use Illuminate\Support\Str;

// Intervention Image
use Image;

// FPDF
use Codedge\Fpdf\Fpdf\Fpdf;

// Models
use App\CertificateDetails;
use App\Template;

class rootController extends Controller
{
    
    public function index(){
        return view('pages.index');
    }

    // Displays the certificate
    public function show_certificate($verification_id){
        $user_data = CertificateDetails::where('verification_id', $verification_id)->get();
        $user_data = $user_data[0];

        $count = (CertificateDetails::where('verification_id', $verification_id)->get())->count();

        if($count > 0){
            $img = $this->get_certificate($verification_id, $user_data);
            return view("pages.certificate")->with("img", $img)->with("user_data", $user_data)->with("verification_id", $verification_id);
        }
        else{
            return view("pages.certificate")->with("info", "No Certificate Available");
        }
    }

    // Downloads the Certificate
    public function download_certificate(Request $request){
        
        $user_data = CertificateDetails::where('verification_id', $request->verification_id)->get();
        $user_data = $user_data[0];
        $img = $this->get_certificate($request->verification_id, $user_data);

        $width = Image::make($img)->width();
        $height = Image::make($img)->height();

        $img = explode(',',$img);
        $img = 'data://text/plain;base64,'. $img[1];

        $pdf = new FPDF('L', 'mm', array($height, $width));
        $pdf->AddPage();
        $pdf->Image($img, 0, 0, 0, $height, 'JPG'); 
        $pdf->Output('D', 'Certificate.pdf');
    }

    // Generates the certificate 
    public function get_certificate($verification_id, $user_data){

        $template = new Template();

        $full_template_name = $user_data->template;
        $template_name = explode("_", $full_template_name);

        $img = "";

        if(sizeof($template_name) == 3){
            if($template_name[0] == 'default'){
                $template_data = json_decode(Storage::disk("default_conf")->get("template_".$template_name[2].".json"));
            }
            else{
                $template_data = json_decode(Storage::disk("certificate_templates")->get($template_name[0]."_template_".$template_name[2].".json"));
            }
            $temp_name = "template_".$template_name[2];
            $img = $template->$temp_name($template_data, $user_data);
        }
        else{
            $template_data = json_decode(Storage::disk("certificate_templates")->get($full_template_name.".json"));
            $img = $template->template($template_data, $user_data);
        }
        
        return $img;
    }
}
