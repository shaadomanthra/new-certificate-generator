<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\CertificateDetails;
use App\Template;
use App\CertificateTemplates;

use Illuminate\Support\Facades\DB;

// Storage
use Illuminate\Support\Facades\Storage;

// Intervention Image
use Image;

// String Functions
use Illuminate\Support\Str;

// Laravel Charts (Chartisan)
use ConsoleTVs\Charts\BaseChart;
use Chartisan\PHP\Chartisan;


class dashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // ------ Dashboard ------
    public function dashboard(){
        $clients = DB::table("certificate_details")->distinct()->get("client");
        $activities = DB::table("certificate_details")->distinct()->get("activity");

        $data = array();

        foreach($clients as $client){
            foreach($activities as $activity){
                $query = ["client" => $client->client, "activity" => $activity->activity];
                $count = CertificateDetails::where($query)->get()->count();
                $counts = array();
                $counts["client"] = $client->client;
                $counts["activity"] = $activity->activity;
                $counts["count"] = $count;
                array_push($data, $counts);
            }
        }
        return view('pages.dashboard.dashboard')->with("data", $data);
    }
    // ------ End Dashboard ------ 

    // ------ Templates page ------
    // gets the images inside assets and send that to the Templates page 
    public function templates(){
        $images = Storage::files("default_conf/assets/images");
        return view("pages.dashboard.templates")->with("images", $images);
    }

    // Edit predefined Template
    public function edit_default_template(Request $request){

        // Get the template images from assets
        $images = Storage::files("default_conf/assets/images");

        $template = new Template();
        $certificate_design =  $request->certificate_design;

        $logos = Storage::files("logos");
        $signs = Storage::files("signatures");

        // Default user data
        $user_data = json_decode(Storage::disk("default_conf")->get("user.json"));
            
        // Check if the request is to create a new template
        if($request->template == "new"){
    
            $validate = $request->validate([
                "template_name" =>"required",
                "certificate_design" =>"required"
                ]);

            //Check if the template is selected 
            if($request->certificate_design == "not-selected"){
                return view("pages.dashboard.templates")->with("images", $images)->with("info", "Please select a template.");
            }

            $user_defined_name = Str::of($request->template_name)->lower()->studly();    

            $template_name = $user_defined_name."_".$request->certificate_design;
            $exists = Storage::disk("certificate_templates")->exists($template_name.".json");

            if($exists){
                return view("pages.dashboard.templates")->with("images", $images)->with("info", "Template already exists please select another name");
            }
    
            $file = json_decode(Storage::disk("default_conf")->get($certificate_design.".json"));

            $img = $template->$certificate_design($file, $user_data);

            $file = json_decode(Storage::disk("default_conf")->get($certificate_design.".json"));

            return view("pages.dashboard.edit_default_template")
                                            ->with("template_name", $template_name)
                                            ->with("certificate_design", $certificate_design)
                                            ->with("file", $file)
                                            ->with("img", $img)
                                            ->with("logos", $logos)
                                            ->with("signs", $signs);
        }
        // Check if the request is to preview the changes
        else if($request->template == "preview"){
            $inputs = json_decode(json_encode($request->all()));
            $template_name = $request->template_name;

            // --------- Replace the logos and signs if the value is default ---------
            $default_data = json_decode(Storage::disk("default_conf")->get($certificate_design.".json"));
            if($request->main_logo == "default"){
                $inputs->main_logo = $default_data->main_logo;
            }
            if($request->logo == "default"){
                $inputs->logo = $default_data->logo;
            }
            for($i=1; $i<4; $i++){
                $logo = "logo_".$i;
                if($request->$logo == "default"){
                    $inputs->$logo = $default_data->$logo;
                }
            }
            for($i=1; $i<5; $i++){
                $sign = "sign_".$i;
                if($request->$sign == "default"){
                    $inputs->$sign = $default_data->$sign;
                }
            }
            //------- End -------- 
        
            Storage::disk("certificate_templates")->put($template_name.".json", json_encode($inputs));
                
            // Pass the values to the template to generate the image
            $img = $template->$certificate_design($inputs, $user_data);

            $file = json_decode(Storage::disk("certificate_templates")->get($template_name.".json"));

            return view("pages.dashboard.edit_default_template")
                                            ->with("template_name", $template_name)
                                            ->with("certificate_design", $certificate_design)
                                            ->with("file", $file)
                                            ->with("img", $img)
                                            ->with("logos", $logos)
                                            ->with("signs", $signs);

        }
        else if($request->template == "save"){
            $template_name = $request->template_name;
            $template_data = json_decode(json_encode($request->all()));

            // --------- Replace the logos and signs if the value is default ---------
            $default_data = json_decode(Storage::disk("default_conf")->get($certificate_design.".json"));
            if($request->main_logo == "default"){
                $template_data->main_logo = $default_data->main_logo;
            }
            if($request->logo == "default"){
                $template_data->logo = $default_data->logo;
            }
            for($i=1; $i<4; $i++){
                $logo = "logo_".$i;
                if($request->$logo == "default"){
                    $template_data->$logo = $default_data->$logo;
                }
            }
            for($i=1; $i<5; $i++){
                $sign = "sign_".$i;
                if($request->$sign == "default"){
                    $template_data->$sign = $default_data->$sign;
                }
            }
            //------- End -------- 

            Storage::disk("certificate_templates")->put($template_name.".json", json_encode($template_data));

            $query = ["template_name" => $template_name, "template_data" => json_encode($template_data)];

            CertificateTemplates::insert($query);

            return view("pages.dashboard.dashboard")->with("success", "New Template Created");
        }

    }

    // Create a custom template
    public function create_template(Request $request){

        $images = Storage::files("default_conf/asstes/images");

        $template = new Template();

        // Retrieves the Font names
        $fonts = Storage::files('fonts');
        $font_names = [];
        foreach($fonts as $f){
            $values = explode("/", $f);
            $name = explode(".", end($values));
            $name = $name[0];
            array_push($font_names, $name);
        }

        // Get Default user data
        $user_data = json_decode(Storage::disk("default_conf")->get("user.json"));

        // Check if request is to create a new template
        if($request->template_option == "new_template"){
            $request->validate([
                "template_name" => "required",
                "template_design" => "required|image|dimensions:max_width=3508",
            ]);

            $template_name = Str::of($request->template_name)->lower()->studly();

            $exists = Storage::disk('certificate_templates')->exists($template_name.".json");

            if($exists){
                return view("pages.dashboard.templates")->with("images", $images)->with("info", "Template already exists please select a different name");
            }

            if($request->hasFile("template_design")){
                $ext = $request->file("template_design")->getClientOriginalExtension();

                $template_design = "certificate_designs/".$template_name.".".$ext;

                Storage::disk("certificate_designs")->put($template_name.".".$ext, $request->file("template_design")->get());

                // Get default template values
                $file = json_decode(Storage::disk("default_conf")->get("template.json"));
                
                // Change default values to template name and design values
                $file->template_name = (string) $template_name;
                $file->template_design = (string) $template_design;

                $img = $template->template($file, $user_data);

                $file = json_decode(Storage::disk("default_conf")->get("template.json"));
                
                return view("pages.dashboard.create_template")
                                                    ->with("img", $img)
                                                    ->with("template_name", (string) $template_name)
                                                    ->with("template_design", (string) $template_design)
                                                    ->with("file", $file)
                                                    ->with("fonts", $font_names);
            }
            else{
                return view("pages.dashboard.templates")->with("images", $images)->with("info", "Please upload a Template Design");
            }
        }
        // Check if request is to preview the template
        elseif($request->template_option == "preview"){
            $inputs = json_encode($request->all());
            $template_name = json_decode($inputs)->template_name;
            $template_design = json_decode($inputs)->template_design;

            Storage::disk("certificate_templates")->put($template_name.".json", $inputs);

            $file = json_decode(Storage::disk("certificate_templates")->get($template_name.".json"));
            
            $img = $template->template($file, $user_data);
            
            $file = json_decode(Storage::disk("certificate_templates")->get($template_name.".json"));
            
            return view("pages.dashboard.create_template")
                                                ->with("img", $img)
                                                ->with("template_name", (string) $template_name)
                                                ->with("template_design", $template_design)
                                                ->with("file", $file)
                                                ->with("fonts", $font_names);
        }
        // Check if request is to save the template
        elseif($request->template_option == "save"){
            $template_name = $request->template_name;
            $template_data = json_encode($request->all());

            Storage::disk("certificate_templates")->put($template_name.".json", $template_data);

            $query = ["template_name" => $template_name, "template_data" => $template_data];

            CertificateTemplates::insert($query);

            return view("pages.dashboard.dashboard")->with("success", "New Template Created");
        }
    }
    // ------ End Templates ------

    // ------ Uploads ------
    // Get the available templates ans open Uploads page
    public function upload(){
        $template_urls = Storage::files("certificate_templates");
        $templates = [];

        foreach($template_urls as $temp_url){
            $name = explode("/", $temp_url);
            $name = explode(".", $name[1]);
            array_push($templates, $name[0]);
        }

        return view('pages.dashboard.upload')->with("templates", $templates);
    }

    // Download the Default Certificate Details format file => type : csv 
    public function downloadCsv(){
        return Storage::disk("local")->download("certificate_details.csv");
    }

    // Upload Certificate Details
    public function upload_certificate_details(Request $request){
        $status = '';
        $count = 0;

        // Get the available certificate templates
        $template_urls = Storage::files("certificate_templates");
        $templates = [];
        foreach($template_urls as $temp_url){
            $name = explode("/", $temp_url);
            $name = explode(".", $name[1]);
            array_push($templates, $name[0]);
        }
        // End

        $validate = $request->validate([
            "client" => "required",
            "issued_by" => "required",
            "activity" => "required",
            "template_name" => "required",
        ]);

        // Check if the uploaded filename is certificate_details 
        $filename = $request->file('certificate_details')->getClientOriginalName();
        if($filename != "certificate_details.csv"){
            return view('pages.dashboard.upload')->with('info', "Please download and use the predefined CSV structure below")->with("templates", $templates);
        }
        // End

        if($request->template == "not_selected"){
            return view('pages.dashboard.upload')->with('info', "Please Select a Template")->with("templates", $templates);
        }

        // Get temporary path/file name
        $filename = $request->file('certificate_details')->getPathName();

        // create an array from uploaded csv file data 
        $csvAsArray = array_map('str_getcsv', file($filename));

        if($csvAsArray[0][0] == 'Name' && $csvAsArray[0][1] == 'Gender' && $csvAsArray[0][2] == 'Email' && $csvAsArray[0][3] == 'Mobile Number' && $csvAsArray[0][4] == 'College' && $csvAsArray[0][5] == 'Track' && $csvAsArray[0][6] == 'Start Date' && $csvAsArray[0][7] == 'End Date' && $csvAsArray[0][8] == 'Issued Date' && $csvAsArray[0][9] == 'Percentage'){
            array_shift($csvAsArray);
            foreach($csvAsArray as $csv_data){

                if(empty($csv_data[2])){
                    return view('pages.dashboard.upload')->with("info", "Some email fields are empty. Email is mandatary");
                }

                // Replace any of the field to Null if it is empty
                for($i = 0; $i < sizeof($csv_data); $i++){
                    if(empty($csv_data[$i])){
                        $csv_data[$i] = Null;
                    }
                }

                $client = ucwords(strtolower($request->client));
                $issued_by = ucwords(strtolower($request->issued_by));
                $email = $csv_data['2'];
                $activity = ucwords(strtolower($request->activity));

                // Check if record already exists in the database
                $query_values = ["client" => $client, "issued_by" => $issued_by, "email" => $email, "activity" => $activity];
                $check =  CertificateDetails::where($query_values)->get()->count();
                
                // Add the data only if the record doesn't exist in the database
                if($check == 0){
                    $name = ucwords(strtolower($csv_data['0']));

                    $verification_id = "";
                    $check_verification_id = 1;

                    // Check if the verification id has already been used
                    while($check_verification_id != 0){
                        $verification_id = $this->getToken(8);
                        $check_verification_id = CertificateDetails::where("verification_id", $verification_id)->get()->count();
                    }
                    
                    $gender = ucwords(strtolower($csv_data['1']));
                    $mobile_number = $csv_data['3'];
                    $college = ucwords(strtolower($csv_data['4']));
                    $track = ucwords(strtolower($csv_data['5']));
                    $start_date = $csv_data['6'];
                    $end_date = $csv_data['7'];
                    $issued_date = $csv_data['8'];
                    $percentage = $csv_data['9'];

                    // Check if % is present in the percentage string
                    $symbol = substr($percentage, -1);
                    if($symbol != '%'){
                        $percentage = $percentage."%";
                    }

                    $template_name = $request->template_name;

                    $query = ['client'=>$client, 'activity'=>$activity, 'verification_id'=>$verification_id, 'name'=>$name, 'gender'=>$gender, 'email'=>$email, 'mobile_number'=>$mobile_number, 'college'=>$college, 'track'=>$track, 'start_date'=>$start_date, 'end_date'=>$end_date, 'issued_date'=>$issued_date, 'percentage'=>$percentage, 'template'=>$template_name, "issued_by"=>$issued_by];

                    $status = CertificateDetails::insert($query);

                    if($status == 1){
                        $count += 1;
                    }
                }
            }
        }
        else{
            return view('pages.dashboard.upload')->with('info', "Please download and use the predefined CSV structure below")->with("templates", $templates);
        }
        return view('pages.dashboard.upload')->with('success', "Successfully inserted <strong>".$count."rows</strong>")->with("templates", $templates);
    }

    public function upload_font(Request $request){

        // Get the available certificate templates
        $template_urls = Storage::files("certificate_templates");
        $templates = [];
        foreach($template_urls as $temp_url){
            $name = explode("/", $temp_url);
            $name = explode(".", $name[1]);
            array_push($templates, $name[0]);
        }
        // End

        $request->validate([
            "new_font_name" => "required",
        ]);

        $user_given_name = Str::of($request->new_font_name)->lower()->studly();
        $ext = Str::of($request->file('new_font')->getClientOriginalExtension())->lower();

        if($ext != "ttf"){
            return view('pages.dashboard.upload')->with('info',"Font should be of type ttf")->with("templates", $templates); 
        }

        $filename = $user_given_name.'.'.$ext;

        $exists = Storage::disk("fonts")->exists($filename);

        if($exists){
            return view('pages.dashboard.upload')->with('info',"File Exists")->with("templates", $templates);  
        }
        else{
            Storage::disk('fonts')->put($filename,$request->file('new_font')->get());
            return view('pages.dashboard.upload')->with('success',"Font Uploaded Successfully")->with("templates", $templates);  
        }        
    }

    public function upload_logo(Request $request){

        // Get the available certificate templates
        $template_urls = Storage::files("certificate_templates");
        $templates = [];
        foreach($template_urls as $temp_url){
            $name = explode("/", $temp_url);
            $name = explode(".", $name[1]);
            array_push($templates, $name[0]);
        }
        // End

        $request->validate([
            'new_logo' => 'required|image|mimes:png|dimensions:max_width=500',
        ]);

        $user_given_name = Str::of($request->new_logo_name)->lower()->studly();
        $ext = Str::of($request->file('new_logo')->getClientOriginalExtension())->lower();
        $filename = $user_given_name.'.'.$ext;

        $exists = Storage::disk('logos')->exists($filename);
        if($exists){
            return view('pages.dashboard.upload')->with('info',"File Exists")->with("templates", $templates);      
        }
        else{
            Storage::disk("logos")->put($filename, $request->file("new_logo")->get());
            return view('pages.dashboard.upload')->with('success', "Logo Uploaded Successfully")->with("templates", $templates);  
        }

    }

    public function upload_sign(Request $request){

        // Get the available certificate templates
        $template_urls = Storage::files("certificate_templates");
        $templates = [];
        foreach($template_urls as $temp_url){
            $name = explode("/", $temp_url);
            $name = explode(".", $name[1]);
            array_push($templates, $name[0]);
        }
        // End

        $request->validate([
            'new_sign' => 'required|image|mimes:png|dimensions:max_width=500',
        ]);

        $user_given_name = Str::of($request->new_sign_name)->lower()->studly();
        $ext = Str::of($request->file('new_sign')->getClientOriginalExtension())->lower();
        $filename = $user_given_name.'.'.$ext;

        $exists = Storage::disk('signatures')->exists($filename);
        if($exists){
            return view('pages.dashboard.upload')->with('info', "File Exists")->with("templates", $templates);      
        }
        else{
            Storage::disk("signatures")->put($filename, $request->file("new_sign")->get());
            return view('pages.dashboard.upload')->with('success', "Sign Uploaded Successfully")->with("templates", $templates);   
        }
    }

    // Open the database
    public function database(){
    // public function database(){
        // $records = CertificateDetails::all()->simplePaginate(10);
        $records = DB::table("certificate_details")->simplePaginate(30);
        return view('pages.dashboard.database')->with('records', $records)->with("links", "show");
    }

    // Search database for a name
    public function search(Request $request){
        if(empty($request->search_term)){
            $records = DB::table("certificate_details")->simplePaginate(30);
            return view('pages.dashboard.database')->with('records', $records)->with("links", "show");
        }
        $records = CertificateDetails::where("name", "LIKE", "%{$request->search_term}%")->get();
        return view('pages.dashboard.database')->with('records', $records)->with("search_term", $request->search_term)->with("links", "hide");
    }

    // Edit and Update the record in the database
    public function edit_record(Request $request, $verification_id){

        // Check if the option is to edit  or update
        if($request->edit_option == "edit"){
            // Get the available certificate templates
            $template_urls = Storage::files("certificate_templates");
            $templates = [];
            foreach($template_urls as $temp_url){
                $name = explode("/", $temp_url);
                $name = explode(".", $name[1]);
                array_push($templates, $name[0]);
            }
            // End

            $record = CertificateDetails::where('verification_id', $verification_id)->get();

            return view('pages.dashboard.edit_record')->with('record', $record[0])->with("templates", $templates);
        }
        else if($request->edit_option == "update"){

            //Values to modify 
            $query = ['client'=>$request->client, 'activity'=>$request->activity, 'name'=>$request->name, 'gender'=>$request->gender, 'email'=>$request->email, 'mobile_number'=>$request->mobile_number, 'college'=>$request->college, 'track'=>$request->track, 'start_date'=>$request->start_date, 'end_date'=>$request->end_date, 'issued_date'=>$request->issued_date, 'percentage'=>$request->percentage, 'template'=>$request->template_name];

            $status = DB::table("certificate_details")->where("verification_id", $verification_id)->update($query);

            $records = CertificateDetails::all();

            // If status = 1
            if($status){
                return view("pages.dashboard.database")->with("success", "Record Updated Successfully")->with('records', $records);
            }
            // If status = 0
            else{
                return view("pages.dashboard.database")->with("info", "Unable to update record")->with('records', $records);
            }
        }

    }

    // Delete a record in the database
    public function delete_record(Request $request, $verification_id){
        // Check if delete ic confirmed
        if($request->delete_option == "delete"){
            return view('pages.dashboard.delete_record')->with("verification_id", $verification_id);
        }
        else if($request->delete_option == "confirm_delete"){
            DB::table("certificate_details")->where("verification_id", $verification_id)->delete();
            $records = CertificateDetails::all();
            return view("pages.dashboard.database")->with("success", "Record deleted Successfully")->with('records', $records);
        }
    }

    // Show the files present in the Storage
    public function files(){
        $certificate_designs = Storage::files('certificate_designs');
        $certificate_templates = Storage::files('certificate_templates');
        $fonts = Storage::files('fonts');
        $logos = Storage::files('logos');
        $signs = Storage::files('signatures');

        return view('pages.dashboard.files')
                                        ->with("certificate_designs", $certificate_designs)
                                        ->with("certificate_templates", $certificate_templates)
                                        ->with("fonts", $fonts)
                                        ->with("logos", $logos)
                                        ->with("signs", $signs);
    }

    // Delete the files such as logo, signatures, fonts from the storage 
    public function delete_file(Request $request){
        $filename = $request->filename;
        $location = $request->delete;

        Storage::disk($location)->delete($filename);

        return $this->files();
    }

    // Edit or delete the template and everything related to it
    public function view_delete_template(Request $request){
        if($request->template_option == "delete"){
            return view("pages.dashboard.delete_template")->with("template_name", $request->template_name);
        }
        else if($request->template_option == "confirm_delete"){
            $template_name = $request->template_name;

            $count = explode("_", $template_name);

            if(sizeof($count) == 3){
                Storage::disk("certificate_templates")->delete($request->template_name.".json");
                CertificateTemplates::where("template_name", $template_name)->delete();
            }
            else{
                Storage::disk("certificate_designs")->delete($request->template_name.".jpg");
                Storage::disk("certificate_templates")->delete($request->template_name.".json");
                CertificateTemplates::where("template_name", $template_name)->delete();
            }

            return $this->files();
        }
        else if($request->template_option == "view"){
            $template = new Template();

            // Get Default user data
            $user_data = json_decode(Storage::disk("default_conf")->get("user.json"));

            $original_template_name = $request->template_name;

            $template_name = explode("_", $original_template_name);

            if(sizeof($template_name) == 3){
                $template_data = json_decode(Storage::disk("certificate_templates")->get($original_template_name.".json"));
                
                $method = $template_name[1]."_".$template_name[2];
                $img = $template->$method($template_data, $user_data);
                
                return view("pages.dashboard.view_template")
                                                ->with("img", $img);
            }
            else{
                $template_data = json_decode(Storage::disk("certificate_templates")->get($original_template_name.".json"));
                
                $img = $template->template($template_data, $user_data);
                
                return view("pages.dashboard.view_template")
                                                ->with("img", $img);
            }      
        }
    }

    public function get_names(){
        $certificates = Storage::files('certificate_designs');
        $fonts = Storage::files('fonts');

        $certificate_names = [];
        $font_names = [];

        foreach($certificates as $c){
            $values = explode("/", $c);
            $name = explode(".", end($values));
            $name = $name[0];
            array_push($certificate_names, $name);
        }

        foreach($fonts as $f){
            $values = explode("/", $f);
            $name = explode(".", end($values));
            $name = $name[0];
            array_push($font_names, $name);
        }

        $data = [
            "certificates" => $certificate_names,
            "fonts" => $font_names
        ];

        return $data;
    }

    public function template_2(){
        $file = json_decode(Storage::disk("default_conf")->get("template_2.json"));
        // Get Default user data
        $user_data = json_decode(Storage::disk("default_conf")->get("user.json"));

        $template = new Template();
        $img = $template->template_2($file, $user_data);

        return view("pages.dashboard.template")->with("img", $img);
    }

    // Generates a random token
    function getToken($length){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdfghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet);
    
        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }
    
        return $token;
    }


}
