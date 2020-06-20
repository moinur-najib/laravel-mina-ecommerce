<?php
namespace App\Helpers;

class GravatarHelper 
{
    /*
     * Validate_gravatar
     * 
     * Check if the email has any gravatar image or not
     * 
     * @param string $email Email of the User
     * 
     * @return boolean true, if there is an image.false otherwise
     * 
     */

     public static function validate_gravatar($email) {
         $hash = md5($email);
         $url = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
         $headers = @get_headers($url);
         if(!preg_match("[200]", $headers[0])) {
             $has_valid_avatar = FALSE;
         } else {
             $has_valid_avatar = TRUE;
         }
         return $has_valid_avatar;
     } 

    /*
     * gravatar_image
     * 
     * Get the gravatar image from an email adress
     * 
     * @param string $email Email of the Email
     * @param iteger $size size of image
     * @param string $d     type of image if not gravatar image
     * @return string       gravatar image URL
     */

     public static function gravatar_image($email, $size=0, $d="") {
         $hash = md5($email);
         $image_url = 'http://www.gravatar.com/avatar/' . $hash . '?s='.$size.'&d='.$d;
         return $image_url;
     }
}
