<?php 

namespace App;

use Illuminate\Http\Request;

// Storage
use Illuminate\Support\Facades\Storage;

// String Functions
use Illuminate\Support\Str;

// Intervention
use Image;


class Template{

    // Other Templates
    public function template($data, $user_data){
        $template_design = $data->template_design;
        $text_align  = $data->text_align;
        $default_line_height = (int) $data->line_height == null ? 100 : $data->line_height;
        $large = (int)  $data->large == null ? 90 : $data->large;
        $medium = (int)  $data->medium == null ? 55 : $data->medium;
        $small = (int)  $data->small == null ? 40 : $data->small;
        $margin_top = (int)  $data->margin_top == null ? 0 : $data->margin_top;
        $margin_bottom = (int)  $data->margin_bottom == null ? 0 : $data->margin_bottom;
        $margin_left = (int)  $data->margin_left == null ? 0 : $data->margin_left;
        $margin_right = (int)  $data->margin_right == null ? 0 : $data->margin_right;

        // ----- Find and Replace -----

        $replace = ["activity", "verification_id", "name", "gender", "email", "mobile_number", "college", "track", "start_date", "end_date", "issued_date", "percentage"];

        foreach($data as $k => $v){
            foreach($replace as $r){
                $contains = Str::of($data->$k)->contains("@".$r);
                if($contains){
                    $data->$k = Str::of($data->$k)->replaceFirst("@".$r, $user_data->$r);
                }
            }
        }

        // ------ End --------

        $lines = [];
        $sizes = [];
        $fonts = [];
        $colors = [];
        $margin_tops = [];

        for($i = 1; $i < 11; $i++){
            $line = "line_".$i;
            $size = "size_".$i;
            $font = "font_".$i;
            $color = "color_".$i;
            $line_margin_top = "margin_top_".$i;

            $lines[$i-1] = (string)$data->$line;   
            $sizes[$i-1] = (string) $data->$size;   
            $fonts[$i-1] = (string)$data->$font;   
            $colors[$i-1] = (string)$data->$color == null ? "#000000" : $data->$color;   
            $margin_tops[$i-1] = (int) $data->$line_margin_top == null ? 0 : $data->$line_margin_top;   
        }

        foreach($sizes as $k=>$v){
            if($v == "large"){
                 $sizes[$k] = $large;
            }
            if($v == "medium"){
                $sizes[$k] = $medium;
           }
           if($v == "small"){
                $sizes[$k] = $small;
            }
        } 
        
        // Set Margin top of every line relative to other lines

        $values = [];
        for($i = 0; $i < sizeof($margin_tops); $i++){
            $values[$i] = $margin_tops[$i]; 
        }
        
        $keys = [];

        foreach($margin_tops as $mt){
            if($mt != 0){
                $key = array_search($mt, $margin_tops);
                array_push($keys, $key);
            }
        }

        foreach($keys as $key){
            for($i = $key+1; $i < sizeof($margin_tops); $i++){
                $margin_tops[$i] =  $margin_tops[$i] + $values[$key];
            }
        }

        // End Margins

        $img = Image::make($template_design);

        $default_x = 0;
        $default_y = $img->height()/2;

        if($text_align == "left"){
            $default_x = 300;
            $default_align = "left";
        }
        else if($text_align == "center"){
            $default_x = $img->width()/2;
            $default_align = "center";
        }
        else if($text_align == "right"){
            $default_x = $img->width()-300;
            $default_align = "right";
        }

        for($i = 0; $i < 5; $i++){
            $line_height = $default_line_height * $i;

            if(!empty($lines[$i])){
                $img->text($lines[$i], $default_x + $margin_left - $margin_right, $default_y + $margin_top - $margin_bottom + $line_height + $margin_tops[$i], function($font) use($i, $fonts, $sizes, $colors, $default_align){
                    $font->file("fonts/".$fonts[$i].".ttf");
                    $font->size((int)$sizes[$i]);
                    $font->color($colors[$i]);
                    $font->align($default_align);
                    $font->valign('middle');
                });
            }

        }

        $img->encode("data-url"); 
        return $img;
    }


    // ----- Default Templates -----

    // Default Template 1
    public function template_1($data, $user_data){

        $line_height = 140;

        $img = Image::make("default_conf/assets/designs/template_1.jpg");

        // Logo - 1
        $logo_1 = Image::make($data->logo_1)->resize(400, null, function($constraint){
            $constraint->aspectRatio();
        });
        $img->insert($logo_1, "top-left", 1310, 200);
        // Logo - 2
        $logo_2 = Image::make($data->logo_2)->resize(400, null, function($constraint){
            $constraint->aspectRatio();
        });
        $img->insert($logo_2, "top-left", 1800, 200);

        // Title
        $img->text($data->title, 1752, 769, function($font){
            $font->file("fonts/Niconne.ttf");
            $font->size(180);
            $font->align('center');
            $font->valign('middle');
            $font->color("#335066");
        });


        // ----- Find and Replace -----
        
        $replace = ["activity", "verification_id", "name", "gender", "email", "mobile_number", "college", "track", "start_date", "end_date", "issued_date", "percentage"];
        
        foreach($data as $k => $v){
            foreach($replace as $r){
                $contains = Str::of($data->$k)->contains("@".$r);
                if($contains){
                    $data->$k = Str::of($data->$k)->replaceFirst("@".$r, $user_data->$r);
                }
            }
        }

        // ------ End --------

        // Line - 1
        if(!empty($data->line_1)){
            $img->text($data->line_1, 1750, 1040, function($font){
                $font->file("fonts/CalibriRegular.ttf");
                $font->size(84);
                $font->align('center');
                $font->valign('middle');
            });
        }

        // Line - 2
        if(!empty($data->line_2)){
            $img->text($data->line_2, 1750, 1200, function($font){
                $font->file("fonts/CourgetteRegular.ttf");
                $font->size(120);
                $font->align('center');
                $font->valign('middle');
                $font->color("#D39A27");
            });
        }

        // Line - 3
        if(!empty($data->line_3)){
            $img->text($data->line_3, 1750, 1380, function($font){
                $font->file("fonts/CalibriRegular.ttf");
                $font->size(75);
                $font->align('center');
                $font->valign('middle');
            });
        }
 
        // Line - 4
        if(!empty($data->line_4)){
            $img->text($data->line_4, 1750, 1380 + $line_height, function($font){
                $font->file("fonts/CalibriRegular.ttf");
                $font->size(75);
                $font->align('center');
                $font->valign('middle');
            });
        }

        // Line - 5
        if(!empty($data->line_5)){
            $img->text($data->line_5, 1750, 1380 + $line_height*2, function($font){
                $font->file("fonts/CalibriRegular.ttf");
                $font->size(75);
                $font->align('center');
                $font->valign('middle');
            });
        }

        // Line - 6
        if(!empty($data->line_6)){
            $img->text($data->line_6, 1750, 1380 + $line_height*3, function($font){
                $font->file("fonts/CalibriRegular.ttf");
                $font->size(75);
                $font->align('center');
                $font->valign('middle');
            });
        }


        // Sign - 1
        $sign_1 = Image::make($data->sign_1)->resize(500, null, function($constraint){
            $constraint->aspectRatio();
        });
        $img->insert($sign_1, "bottom-left" , 600, 220);

        // Sign - 2
        $sign_2 = Image::make($data->sign_2)->resize(500, null, function($constraint){
            $constraint->aspectRatio();
        });
        $img->insert($sign_2, "bottom-right" , 670, 275);

        // Sign Name - 1
        if(!empty($data->sign_name_1)){
            $img->text($data->sign_name_1, 850, 1380 + $line_height*3 + 285, function($font){
                $font->file("fonts/CalibriBold.ttf");
                $font->size(65);
                $font->align('center');
                $font->valign('middle');
            });
        }


        // Sign Info - 1
        if(!empty($data->sign_info_1)){
            $img->text($data->sign_info_1, 850, 1380 + $line_height*3 + 350, function($font){
                $font->file("fonts/MontserratRegular.ttf");
                $font->size(52);
                $font->align('center');
                $font->valign('middle');
            });
        }


        // Sign Name - 2
        if(!empty($data->sign_name_2)){
            $img->text($data->sign_name_2, 2590, 1380 + $line_height*3 + 285, function($font){
                $font->file("fonts/CalibriBold.ttf");
                $font->size(65);
                $font->align('center');
                $font->valign('middle');
            });
        }


        // Sign Info - 2
        if(!empty($data->sign_info_2)){
            $img->text($data->sign_info_2, 2590, 1380 + $line_height*3 + 350, function($font){
                $font->file("fonts/MontserratRegular.ttf");
                $font->size(52);
                $font->align('center');
                $font->valign('middle');
            });
        }


        // Info - 1
        if(!empty($data->info_1)){
            $img->text($data->info_1, 480, 1380 + $line_height*3 + 480, function($font){
                $font->file("fonts/MontserratRegular.ttf");
                $font->size(42);
                $font->align('center');
                $font->valign('middle');
            });
        }


        // Info - 2
        if(!empty($data->info_2)){
            $img->text($data->info_2, 2700, 1380 + $line_height*3 + 480, function($font){
                $font->file("fonts/MontserratRegular.ttf");
                $font->size(42);
                $font->align('center');
                $font->valign('middle');
            });
        }


        $img->encode("data-url"); 
        return $img;
    }

    // Default Template 2
    public function template_2($data, $user_data){

        $line_height = 140;

        // $img = Image::make("default_conf/assets/images/template_2.jpg");
        $img = Image::make("default_conf/assets/designs/template_2.jpg");

        $width = $img->width();
        $height = $img->height();

        // Main Logo
        $main_logo = Image::make($data->main_logo)->resize(1600, null, function($constraint){
            $constraint->aspectRatio();
        });
        $img->insert($main_logo, "top-left", 100, -400);

        // Logo - 1
        $logo_1 = Image::make($data->logo_1)->resize(400, null, function($constraint){
            $constraint->aspectRatio();
        });
        $img->insert($logo_1, "top-right", 1090, 270);
        
        // Logo - 2
        $logo_2 = Image::make($data->logo_2)->resize(400, null, function($constraint){
            $constraint->aspectRatio();
        });
        $img->insert($logo_2, "top-right", 650, 270);
        
        // Logo 3
        $logo_3 = Image::make($data->logo_3)->resize(400, null, function($constraint){
            $constraint->aspectRatio();
        });
        $img->insert($logo_3, "top-right", 200, 270);

        // Title
        $title = Str::of($data->title)->upper();
        $img->text($title, $width-490, 1125, function($font){
            $font->file("fonts/MontserratBold.ttf");
            $font->size(150);
            $font->align('right');
            $font->valign('middle');
            $font->color("#fff");
        });


        // ----- Find and Replace -----
        
        $replace = ["activity", "verification_id", "name", "gender", "email", "mobile_number", "college", "track", "start_date", "end_date", "issued_date", "percentage"];
        
        foreach($data as $k => $v){
            foreach($replace as $r){
                $contains = Str::of($data->$k)->contains("@".$r);
                if($contains){
                    $data->$k = Str::of($data->$k)->replaceFirst("@".$r, $user_data->$r);
                }
            }
        }

        // ------ End --------

        // Line - 1
        if(!empty($data->line_1)){
            $img->text($data->line_1, $width-310, 1400, function($font){
                $font->file("fonts/MontserratSemiBold.ttf");
                $font->size(100);
                $font->align('right');
                $font->valign('middle');
            });
        }

        // Line - 2
        if(!empty($data->line_2)){
            $img->text($data->line_2, $width-310, 1730, function($font){
                $font->file("fonts/MontserratBold.ttf");
                $font->size(150);
                $font->align('right');
                $font->valign('middle');
                $font->color("#000");
            });
        }
        
        // Line - 3
        if(!empty($data->line_3)){
            $img->text($data->line_3, $width-300, 2090, function($font){
                $font->file("fonts/MontserratSemiBold.ttf");
                $font->size(94);
                $font->align('right');
                $font->valign('middle');
                $font->color("#000");
            });
        }
        
        // Line - 4
        if(!empty($data->line_4)){
            $img->text($data->line_4, $width-300, 2090 + $line_height, function($font){
                $font->file("fonts/MontserratSemiBold.ttf");
                $font->size(94);
                $font->align('right');
                $font->valign('middle');
                $font->color("#000");
            });
        }
        // Line - 5
        if(!empty($data->line_5)){
            $img->text($data->line_5, $width-300, 2090 + $line_height*2, function($font){
                $font->file("fonts/MontserratSemiBold.ttf");
                $font->size(94);
                $font->align('right');
                $font->valign('middle');
                $font->color("#000");
            });
        }
        // Line - 6
        if(!empty($data->line_6)){
            $img->text($data->line_6, $width-300, 2090 + $line_height*3, function($font){
                $font->file("fonts/MontserratSemiBold.ttf");
                $font->size(94);
                $font->align('right');
                $font->valign('middle');
                $font->color("#000");
            });
        }
        // Line - 7
        if(!empty($data->line_7)){
            $img->text($data->line_7, $width-300, 2090 + $line_height*4, function($font){
                $font->file("fonts/MontserratSemiBold.ttf");
                $font->size(94);
                $font->align('right');
                $font->valign('middle');
                $font->color("#000");
            });
        }


        // Sign - 1
        $sign_1 = Image::make($data->sign_1)->resize(600, null, function($constraint){
            $constraint->aspectRatio();
        });
        $img->insert($sign_1, "bottom-left" ,1450, 500);

        // Sign - 2
        $sign_2 = Image::make($data->sign_2)->resize(500, null, function($constraint){
            $constraint->aspectRatio();
        });
        $img->insert($sign_2, "bottom-left" , 2500, 550);

        // Sign - 3
        $sign_3 = Image::make($data->sign_3)->resize(500, null, function($constraint){
            $constraint->aspectRatio();
        });
        $img->insert($sign_3, "bottom-right" , 1150, 550);

        // Sign - 4
        $sign_4 = Image::make($data->sign_4)->resize(500, null, function($constraint){
            $constraint->aspectRatio();
        });
        $img->insert($sign_4, "bottom-right" , 300, 550);

        // Sign Name - 1
        if(!empty($data->sign_name_1)){
            $img->text($data->sign_name_1, 1720, $height-560, function($font){
                $font->file("fonts/MontserratBold.ttf");
                $font->size(60);
                $font->align('center');
                $font->valign('middle');
                $font->color("#000");
            });
        }
        
        // Sign Info - 1
        if(!empty($data->sign_info_1)){
            $img->text($data->sign_info_1, 1720, $height-480, function($font){
                $font->file("fonts/MontserratSemiBold.ttf");
                $font->size(55);
                $font->align('center');
                $font->valign('middle');
                $font->color("#000");
            });
        }

        // Sign Name - 2
        if(!empty($data->sign_name_2)){
            $img->text($data->sign_name_2, 2740, $height-560, function($font){
                $font->file("fonts/MontserratBold.ttf");
                $font->size(60);
                $font->align('center');
                $font->valign('middle');
                $font->color("#000");
            });
        }
        
        // Sign Info - 2
        if(!empty($data->sign_info_2)){
            $img->text($data->sign_info_2, 2740, $height-480, function($font){
                $font->file("fonts/MontserratSemiBold.ttf");
                $font->size(55);
                $font->align('center');
                $font->valign('middle');
                $font->color("#000");
            });
        }

        // Sign Name - 3
        if(!empty($data->sign_name_3)){
            $img->text($data->sign_name_3, 3565, $height-560, function($font){
                $font->file("fonts/MontserratBold.ttf");
                $font->size(60);
                $font->align('center');
                $font->valign('middle');
                $font->color("#000");
            });
        }
        
        // Sign Info - 3
        if(!empty($data->sign_info_3)){
            $img->text($data->sign_info_3, 3565, $height-480, function($font){
                $font->file("fonts/MontserratSemiBold.ttf");
                $font->size(55);
                $font->align('center');
                $font->valign('middle');
                $font->color("#000");
            });
        }

        // Sign Name - 4
        if(!empty($data->sign_name_4)){
            $img->text($data->sign_name_4, 4380, $height-560, function($font){
                $font->file("fonts/MontserratBold.ttf");
                $font->size(60);
                $font->align('center');
                $font->valign('middle');
                $font->color("#000");
            });
        }
        
        // Sign Info - 4
        if(!empty($data->sign_info_4)){
            $img->text($data->sign_info_4, 4380, $height-480, function($font){
                $font->file("fonts/MontserratSemiBold.ttf");
                $font->size(55);
                $font->align('center');
                $font->valign('middle');
                $font->color("#000");
            });
        }


        $img->encode("data-url"); 
        return $img;
    }


    // Default Template 3
    public function template_3($data, $user_data){

        $line_height = 40;
        $y_offset = 220;

        $img = Image::make("default_conf/assets/designs/template_3.jpg");

        $width =  $img->width();
        $height = $img->height();


        // Logo
        if(!empty($data->logo)){
            $logo = Image::make($data->logo)->resize(150, null, function($constraint){
                $constraint->aspectRatio();
            });
            $img->insert($logo, "top-left", 50, 40);
        }

        // Title
        $title = Str::of($data->title)->upper();
        $img->text($title, 385, 120, function($font){
            $font->file("fonts/MontserratBold.ttf");
            $font->size(34);
            $font->align('left');
            $font->valign('middle');
            $font->color("#335066");
        });
        
        
        // ----- Find and Replace -----
        
        $replace = ["activity", "verification_id", "name", "gender", "email", "mobile_number", "college", "track", "start_date", "end_date", "issued_date", "percentage"];
        
        foreach($data as $k => $v){
            foreach($replace as $r){
                $contains = Str::of($data->$k)->contains("@".$r);
                if($contains){
                    $data->$k = Str::of($data->$k)->replaceFirst("@".$r, $user_data->$r);
                }
            }
        }
        
        // ------ End --------
        
        // Line - 1
        if(!empty($data->line_1)){
            $img->text($data->line_1, 385, $y_offset, function($font){
                $font->file("fonts/MontserratSemiBold.ttf");
                $font->size(20);
                $font->align('left');
                $font->valign('middle');
                $font->color("#335066");
            });
        }

        // Line - 2
        $name = Str::of($data->line_2)->upper();
        if(!empty($data->line_2)){
            $img->text($name, 385, $y_offset + $line_height +20, function($font){
                $font->file("fonts/MontserratBold.ttf");
                $font->size(30);
                $font->align('left');
                $font->valign('middle');
                $font->color("#F14C38");
            });
        }

        // Line - 3
        if(!empty($data->line_3)){
            $img->text($data->line_3, 385, $y_offset + ($line_height*2) +30, function($font){
                $font->file("fonts/MontserratSemiBold.ttf");
                $font->size(20);
                $font->align('left');
                $font->valign('middle');
                $font->color("#335066");
            });
        }

        // Line - 4
        if(!empty($data->line_4)){
            $img->text($data->line_4, 385, $y_offset + ($line_height*3) +30, function($font){
                $font->file("fonts/MontserratSemiBold.ttf");
                $font->size(20);
                $font->align('left');
                $font->valign('middle');
                $font->color("#335066");
            });
        }
        // Line - 5
        if(!empty($data->line_5)){
            $img->text($data->line_5, 385, $y_offset + ($line_height*4) +30, function($font){
                $font->file("fonts/MontserratSemiBold.ttf");
                $font->size(20);
                $font->align('left');
                $font->valign('middle');
                $font->color("#335066");
            });
        }
        // Line - 6
        if(!empty($data->line_6)){
            $img->text($data->line_6, 385, $y_offset + ($line_height*5) +30, function($font){
                $font->file("fonts/MontserratSemiBold.ttf");
                $font->size(20);
                $font->align('left');
                $font->valign('middle');
                $font->color("#335066");
            });
        }

        // Sign - 1
        if(!empty($data->sign_1)){
            $sign_1 = Image::make($data->sign_1)->resize(200, null, function($constraint){
                $constraint->aspectRatio();
            });
            $img->insert($sign_1, "bottom-left" , 390, 70);
        }

        // Sign - 2
        if(!empty($data->sign_2)){
            $sign_2 = Image::make($data->sign_2)->resize(200, null, function($constraint){
                $constraint->aspectRatio();
            });
            $img->insert($sign_2, "bottom-right" , 120, 90);
        }

        // Sign Name - 1
        $name = Str::of($data->sign_name_1)->upper();
        if(!empty($data->sign_name_1)){
            $img->text($name, 385, $height-110, function($font){
                $font->file("fonts/MontserratBold.ttf");
                $font->size(20);
                $font->align('left');
                $font->valign('middle');
                $font->color("F14C38");
            });
        }


        // Sign Info - 1
        if(!empty($data->sign_info_1)){
            $img->text($data->sign_info_1, 385, $height-80, function($font){
                $font->file("fonts/MontserratRegular.ttf");
                $font->size(13);
                $font->align('left');
                $font->valign('middle');
            });
        }


        // Sign Name - 2
        $name = Str::of($data->sign_name_2)->upper();
        if(!empty($data->sign_name_2)){
            $img->text($name, 385+335, $height-110, function($font){
                $font->file("fonts/MontserratBold.ttf");
                $font->size(20);
                $font->align('left');
                $font->valign('middle');
                $font->color("F14C38");
            });
        }


        // Sign Info - 2
        if(!empty($data->sign_info_2)){
            $img->text($data->sign_info_2, 385+335, $height-80, function($font){
                $font->file("fonts/MontserratRegular.ttf");
                $font->size(13);
                $font->align('left');
                $font->valign('middle');
            });
        }

        $img->encode("data-url"); 
        return $img;
    }

}