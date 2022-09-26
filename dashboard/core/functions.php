<?php
function resize_image($filename,$max_size=700)
{
    $ext = explode (".",$filename);
    $ext = strtolower(end($ext));
    if(file_exists($filename))
    {
        switch ($ext) {
            case 'png':
                $image = imagecreatefrompng($filename);
                break;
            case 'gif':
                $image = imagecreatefromgif($filename);
                break;
            case 'webp':
                $image = imagecreatefromwebp($filename);
                break;
            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($filename);
                break;
            default:
                $image = imagecreatefromjpeg($filename);
                break;
        }
        $src_w = imagesx($image);
        $src_h = imagesy($image);

        if ($src_w > $src_h)
        {
            $dst_w = $max_size;
            $dst_h = ($src_h / $src_w)* $max_size;
        }else{
            $dst_w = ($src_w / $src_h)* $max_size;
            $dst_h = $max_size;
        }

        $dst_image = imagecreatetruecolor($dst_w,$dst_h);
        imagecopyresampled($dst_image,$image,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
        
        imagedestroy($image);
        imagejpeg($dst_image,$filename,90);

        switch ($ext) {
            case 'png':
                imagepng($dst_image,$filename);
                break;
            case 'gif':
                imagegif($dst_image,$filename);
                break;
            case 'webp':
                imagewebp($dst_image,$filename);
                break;
            case 'jpg':
            case 'jpeg':
                imagejpeg($dst_image,$filename,90);
                break;
            default:
                imagejpeg($dst_image,$filename,90);
                break;
        }

        imagedestroy($dst_image);
    }

    return $filename;
}
