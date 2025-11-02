<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('create_placeholder_image')) {
    function create_placeholder_image()
    {
        if (!is_dir('img')) {
            mkdir('img', 0755, TRUE);
        }

        if (!file_exists('img/xample.jpg')) {
            // Create a placeholder image
            $image = imagecreatetruecolor(150, 150);
            $bg_color = imagecolorallocate($image, 200, 200, 200);
            imagefill($image, 0, 0, $bg_color);
            imagejpeg($image, 'img/xample.jpg');
            imagedestroy($image);
        }
    }
}
