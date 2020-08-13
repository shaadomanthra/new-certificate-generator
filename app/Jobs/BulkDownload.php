<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// Model
use App\Template;

// Database
use Illuminate\Support\Facades\DB;

// FPDF
use Codedge\Fpdf\Fpdf\Fpdf;

// Storage
use Illuminate\Support\Facades\Storage;

// Intervention Image
use Image;

// String Functions
use Illuminate\Support\Str;

class BulkDownload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $record;
    public $session_key;

    public function __construct($record, $session_key)
    {
        $this->record = $record;
        $this->session_key = $session_key;

        // echo $this->session_key;

        // $this->handle($record, $session_key);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {                
        $record = $this->record;
        $session_key = $this->session_key;

        $template = new Template();

        // Create a directory with session token name
        Storage::disk("tmp")->makeDirectory($session_key);

        $original_template_name = $record->template;

        $template_name = explode("_", $original_template_name);

        if(sizeof($template_name) == 3){
            if($template_name[0] == "default"){
                $name = Str::of($record->name)->slug("-");
                $method = $template_name[1]."_".$template_name[2];
                $template_data = json_decode(Storage::disk("default_conf")->get($method.".json"));
                $img = $template->$method($template_data, $record);
            }
            else{
                $method = $template_name[1]."_".$template_name[2];
                $template_data = json_decode(Storage::disk("certificate_templates")->get($template_name[0]."_".$method.".json"));
                $img = $template->$method($template_data, $record);
            }
        }
        else{
            $template_data = json_decode(Storage::disk("certificate_templates")->get($original_template_name.".json"));
            $img = $template->template($template_data, $record);
        }
        $img = Image::make($img);

        $width = $img->width();
        $height = $img->height();

        $img = explode(',',$img);
        $img = 'data://text/plain;base64,'. $img[1];

        $pdf = new FPDF('L', 'mm', array($height, $width));
        $pdf->AddPage();
        $pdf->Image($img, 0, 0, 0, $height, 'JPG'); 

        $tmp_location  = Storage::disk('tmp')->getDriver()->getAdapter()->getPathPrefix();

        $pdf->Output('F', $tmp_location.$session_key."/".$record->name."-".$record->verification_id.".pdf");
    }
}
