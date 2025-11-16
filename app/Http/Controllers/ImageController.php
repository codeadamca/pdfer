<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Browsershot\Browsershot;

class ImageController extends Controller
{

    public function urlToImage(Request $request)
    {
    
    	if(
        	!strpos($request->url, 'brevisrefero') and 
        	!strpos($request->url, 'rfpnavigator') and 
        	!strpos($request->url, 'codeadam') )
        {
    		abort(404, 'Invalid URL');
        }

    	$mx = isset($_GET['mx']) ? $_GET['mx'] : 0;
    	$my = isset($_GET['my']) ? $_GET['my'] : 0;
    
    	$mt = isset($_GET['mt']) ? $_GET['mt'] : ($my ? $my : 0);
    	$mr = isset($_GET['mr']) ? $_GET['mr'] : ($mx ? $mx : 0);
    	$mb = isset($_GET['mb']) ? $_GET['mb'] : ($my ? $my : 0);
    	$ml = isset($_GET['ml']) ? $_GET['ml'] : ($mx ? $mx : 0);

    	$thumbnailWidth = isset($_GET['width']) ? $_GET['width'] : 1920;
    	$thumbnailHeight = isset($_GET['height']) ? $_GET['height'] : 1080;
    	
    	$windowWidth = 1920;
    	$windowHeight = round(1920 * ($thumbnailHeight / $thumbnailWidth));

        try {
            $image = Browsershot::url($request->url)
                ->showBackground()
                ->noSandbox()
                ->windowSize($windowWidth, $windowHeight)
                ->setOption('newHeadless', true)
                ->screenshot();
            
            // Resize to thumbnail dimensions
            $resizedImage = imagecreatefromstring($image);
            $thumbnail = imagecreatetruecolor($thumbnailWidth, $thumbnailHeight);
            imagecopyresampled($thumbnail, $resizedImage, 0, 0, 0, 0, $thumbnailWidth, $thumbnailHeight, imagesx($resizedImage), imagesy($resizedImage));
            
            ob_start();
            imagepng($thumbnail);
            $image = ob_get_clean();
            
            imagedestroy($resizedImage);
            imagedestroy($thumbnail);
            
            return response($image, 200)
                ->header('Content-Type', 'image/png')
                ->header('Content-Disposition', 'inline; filename="screenshot-'. date("Y-m-d") .'.png"');
            
        } catch (\Exception $e) {
            // Log::error('Browsershot error: ' . $e->getMessage());
            // Log::error($e->getTraceAsString()); // Full stack trace
            throw $e; // Re-throw to see the error in the browser
        }

    }

}
