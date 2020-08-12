<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Storage
use Illuminate\Support\Facades\Storage;

class CertificateDetails extends Model
{
    protected $table = 'certificate_details';
    
    // public function generate_certificate($data){
    //     ob_start();
    //     $data = json_decode($data);

    //     $certificate_design = $data->certificate_design;
    //     $image = imagecreatefromjpeg('certificate_designs/'.$certificate_design.'.jpeg');

    //     $black = imagecolorallocate($image, 0, 0, 0);
    //     $white = imagecolorallocate($image, 255, 255, 255);
    //     $CalibriRegular = "fonts/CalibriRegular.ttf";

    //     // Predefined Values
    //     $text_align = $data->text_align;

    //     $font_large = intval(($data->font_large == null ? 90 : $data->font_large));
    //     $font_medium = intval(($data->font_medium == null ? 55 : $data->font_medium));
    //     $font_small = intval(($data->font_small == null ? 40 : $data->font_small));

    //     $line_height = intval(($data->line_height == null ? 100 : $data->line_height));

    //     // $position_x = intval(($data->position_x == null ? 200 : $data->position_x));
    //     // $position_y = intval(($data->position_y == null ? 200 : $data->position_y));

    //     $main_margin_top = intval(($data->main_margin_top == null ? 200 : $data->main_margin_top));
    //     $main_margin_left = intval(($data->main_margin_left == null ? 0 : $data->main_margin_left));
    //     $main_margin_right = intval(($data->main_margin_right == null ? 0 : $data->main_margin_right));

    //     $text = [];
    //     $size = [];
    //     $font_family = [];
    //     $margin_top =  [];
    //     $red = [];
    //     $green = [];
    //     $blue = [];

    //     for($i=1; $i<=5; $i++){
    //         $val = "line".$i."_text";
    //         $t = ($data->$val == null ? "This is just some random text for Line ".$i : $data->$val);
    //         array_push($text, $t);

    //         $val = "line".$i."_size";
    //         $s = ($data->$val == "not-selected" ? $font_medium : $data->$val);
    //         if($s == "large"){
    //             $s = $font_large;
    //         }
    //         else if($s == "medium"){
    //             $s = $font_medium;
    //         }
    //         else if($s == "small"){
    //             $s = $font_small;
    //         }
    //         array_push($size, $s);

    //         $val = "line".$i."_font_family";
    //         $f = ($data->$val == "not-selected" ? $CalibriRegular : 'fonts/'.$data->$val.'.ttf');
    //         array_push($font_family, $f);

    //         $val = "line".$i."_margin_top";
    //         $m_t = intval(($data->$val == null ? 0 : $data->$val));
    //         array_push($margin_top, $m_t);

    //         $val = "line".$i."_red";
    //         $r = intval(($data->$val == null ? 0 : $data->$val));
    //         array_push($red, $r);

    //         $val = "line".$i."_green";
    //         $g = intval(($data->$val == null ? 0 : $data->$val));
    //         array_push($green, $g);

    //         $val = "line".$i."_blue";
    //         $b = intval(($data->$val == null ? 0 : $data->$val));
    //         array_push($blue, $b);
    //     }

        // $values = [];
        // for($i = 0; $i < sizeof($margin_top); $i++){
        //     $values[$i] = $margin_top[$i]; 
        // }
        
        // $keys = [];

        // foreach($margin_top as $mt){
        //     if($mt != 0){
        //         $key = array_search($mt, $margin_top);
        //         array_push($keys, $key);
        //     }
        // }

        // foreach($keys as $key){
        //     for($i = $key+1; $i < sizeof($margin_top); $i++){
        //         $margin_top[$i] =  $margin_top[$i] + $values[$key];
        //     }
        // }

    //     $line_heights = [];

    //     $colours = [];

    //     for($i=0; $i<5; $i++){
    //         $line_heights[$i] = $line_height*$i;
    //         $colours[$i] = imagecolorallocate($image, $red[$i], $green[$i], $blue[$i]);
    //     }

    //     // Alignment
    //     if($text_align == "left"){
    //         $left_offset = 200;
    //         for($i=0; $i<5; $i++){
    //             imagettftext($image, $size[$i], 0, $left_offset + $main_margin_left - $main_margin_right,  $main_margin_top + $margin_top[$i] + $line_heights[$i], $colours[$i], $font_family[$i], $text[$i]);
    //         }
    //     }
    //     else if($text_align == "center"){
    //         $x_offset = [];
    //         for($i=0; $i<5; $i++){
    //             array_push($x_offset, $this->coords($image, $size[$i], $font_family[$i], $text[$i]));
    //         }
    //         for($i=0; $i<5; $i++){
    //             imagettftext($image, $size[$i], 0, $main_margin_left + $x_offset[$i] - $main_margin_right,  $main_margin_top + $margin_top[$i] + $line_heights[$i], $colours[$i], $font_family[$i], $text[$i]);
    //         }
    //     }
    //     else if($text_align == "right"){
    //         $right_offset = 200;
    //         $x_offset = [];
    //         for($i=0; $i<5; $i++){
    //             $offset = ($this->coords($image, $size[$i], $font_family[$i], $text[$i])*2);
    //             array_push($x_offset, $offset);
    //         }
    //         for($i=0; $i<5; $i++){
    //             imagettftext($image, $size[$i], 0, $main_margin_left + $x_offset[$i] - $main_margin_right - $right_offset,  $main_margin_top + $margin_top[$i] + $line_heights[$i], $colours[$i], $font_family[$i], $text[$i]);
    //         }
    //     }

    //     // End Alignment

    //     imagejpeg($image, NULL, 100);
    
    //     $rawImageBytes = ob_get_clean();
    
    //     $img = 'data:image/jpeg;base64,'.base64_encode($rawImageBytes);

    //     // $information = [
    //     //     "img" => $img,
    //     //     "x_offset" => $x_offset
    //     // ];

    //     return $img;
        
    // }

    // function coords($image, $font_size, $font_family, $text){
    //     // Get image dimensions
    //     $image_width = imagesx($image);
    //     $image_height = imagesy($image);
    
    //     $text_bound = imageftbbox($font_size, 0, $font_family, $text);
    
    //     //Get the text upper, lower, left and right corner bounds
    //     $lower_left_x =  $text_bound[0]; 
    //     $lower_left_y =  $text_bound[1];
    //     $lower_right_x = $text_bound[2];
    //     $lower_right_y = $text_bound[3];
    //     $upper_right_x = $text_bound[4];
    //     $upper_right_y = $text_bound[5];
    //     $upper_left_x =  $text_bound[6];
    //     $upper_left_y =  $text_bound[7];
    
    
    //     //Get Text Width and text height
    //     $text_width =  $lower_right_x - $lower_left_x; //or  $upper_right_x - $upper_left_x
    //     $text_height = $lower_right_y - $upper_right_y; //or  $lower_left_y - $upper_left_y
    
    //     //Get the starting position for centering
    //     $start_x_offset = ($image_width - $text_width) / 2;
    //     $start_y_offset = ($image_height - $text_height) / 2;
    
    //     $temp_array = [];
    //     $temp_array[0] = $start_x_offset;
    //     // $temp_array[1] = $start_y_offset;
    //     // $temp_array[2] = ($image_width - $text_width);
    
    //     return $start_x_offset;
    // }

}
