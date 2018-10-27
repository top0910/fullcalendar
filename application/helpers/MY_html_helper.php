<?php

defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('_compress')) {

    function _compress($source, $destination, $quality) {

        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);

        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source);

        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source);

        elseif ($info['mime'] == 'image/jpg')
            $image = imagecreatefromjpg($source);

        imagejpeg($image, $destination, $quality);

        return $destination;
    }

}
if (!function_exists('_redirect')) {

    function _redirect($path = false) {
        return redirect(base_url($path));
    }

}
if (!function_exists('_redirect_pre')) {

    function _redirect_pre() {
        return redirect($_SERVER['HTTP_REFERER']);
    }

}
