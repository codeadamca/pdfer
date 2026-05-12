<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Browsershot\Browsershot;

class HtmlController extends Controller
{

    public function urlToHtml(Request $request)
    {
    
    	if(
        	!strpos($request->url, 'brevisrefero') and 
        	!strpos($request->url, 'rfpnavigator') and 
        	!strpos($request->url, 'biobudgetchamp') and 
        	!strpos($request->url, 'brickmmo') and 
        	!strpos($request->url, 'codeadam') and 
        	!strpos($request->url, 'lego') )
        {
    		abort(404, 'Invalid URL');
        }

    	$mx = isset($_GET['mx']) ? $_GET['mx'] : 0;
    	$my = isset($_GET['my']) ? $_GET['my'] : 0;
    
    	$mt = isset($_GET['mt']) ? $_GET['mt'] : ($my ? $my : 0);
    	$mr = isset($_GET['mr']) ? $_GET['mr'] : ($mx ? $mx : 0);
    	$mb = isset($_GET['mb']) ? $_GET['mb'] : ($my ? $my : 0);
    	$ml = isset($_GET['ml']) ? $_GET['ml'] : ($mx ? $mx : 0);
    
    
        try {
            //$pdf = Browsershot::html('<h1>Hello world!!</h1>')
            $html = Browsershot::url($request->url)
            	->margins($mt, $mr, $mb, $ml)
                ->showBackground()
                ->noSandbox()
                ->format('A4')
            	// ->setNodeBinary('/home/thomasadam83/.nvm/versions/node/v22.13.1/bin/node')
    			// ->setNpmBinary('/home/thomasadam83/.nvm/versions/node/v22.13.1/bin/npm')
            	->setOption('userDataDir', '/tmp/chrome-user-data') // Helps simulate a persistent user
            	->userAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36')
                ->delay(3000)
            	->bodyHtml();
        } catch (\Exception $e) {
            // Log::error('Browsershot error: ' . $e->getMessage());
            // Log::error($e->getTraceAsString()); // Full stack trace
            throw $e; // Re-throw to see the error in the browser
        }

        return response($html, 200)
            ->header('Content-Type', 'text/html');

    }
        
    


}
