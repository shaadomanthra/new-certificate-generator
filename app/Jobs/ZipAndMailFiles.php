<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// Storage
use Illuminate\Support\Facades\Storage;

// Zip Archive
use ZipArchive;

use Mail;

class ZipAndMailFiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $session_key;
    protected $email;

    public function __construct($session_key, $email)
    {   
        $this->session_key = $session_key;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $session_key = $this->session_key;
        $email = $this->email;

        $zip = new ZipArchive();
        $filename = $session_key.'.zip';

        $tmp_location  = Storage::disk('tmp')->getDriver()->getAdapter()->getPathPrefix();

        if($zip->open($tmp_location.$filename, ZipArchive::CREATE) === TRUE)
        {

            $files = Storage::files("tmp/".$session_key);

            foreach($files as $key => $value) {

                $relativeNameInZipFile = basename($value);

                $zip->addFile($tmp_location.$session_key."/".$relativeNameInZipFile, $relativeNameInZipFile);
            }
            $zip->close();
        }    

        Storage::disk("tmp")->deleteDirectory($session_key);

        Mail::send('pages.dashboard.zipMail', ["session_key"=>$session_key], function ($message) use($email){
            $message->from("info@xplore.co.in", 'Xplore');
            $message->to($email);
            $message->subject('Certificates Zip File');
        });
    }
}
