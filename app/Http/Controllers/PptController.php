<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Browsershot\Browsershot;

class PptController extends Controller
{

    public function urlToPpt(Request $request)
    {
    
    	set_time_limit(300);
    
    	if(
        	!strpos($request->url, 'brevisrefero') and 
        	!strpos($request->url, 'rfpnavigator') and 
        	!strpos($request->url, 'biobudgetchamp') and 
        	!strpos($request->url, 'brickmmo') and 
        	!strpos($request->url, 'codeadam') )
        {
    		abort(404, 'Invalid URL');
        }
    
	    $pdfPath = storage_path('app/temp/');
		$pptPath = storage_path('app/temp/');
    
    	$pdfFile = 'temp.pdf';
    	$pptFile = 'temp.pptx';
    
    	// if (file_exists($pdfPath.$pdfFile)) unlink($pdfPath.$pdfFile);
    	// if (file_exists($pptPath.$pptFile)) unlink($pptPath.$pptFile);

    	$mx = isset($_GET['mx']) ? $_GET['mx'] : 0;
    	$my = isset($_GET['my']) ? $_GET['my'] : 0;
    
    	$mt = isset($_GET['mt']) ? $_GET['mt'] : ($my ? $my : 0);
    	$mr = isset($_GET['mr']) ? $_GET['mr'] : ($mx ? $mx : 0);
    	$mb = isset($_GET['mb']) ? $_GET['mb'] : ($my ? $my : 0);
    	$ml = isset($_GET['ml']) ? $_GET['ml'] : ($mx ? $mx : 0);
    
    	$to = isset($_GET['to']) ? $_GET['to'] : 120;
    	$de = isset($_GET['de']) ? $_GET['de'] : 20;
    
    
        try {
            
            $pdf = Browsershot::url($request->url)
            // Browsershot::url($request->url)
            	->timeout($to)
            	->setDelay($de * 1000)
            	->margins($mt, $mr, $mb, $ml)
                ->showBackground()
                ->noSandbox()
    			// ->windowSize(1280, 720)
    			// ->setViewport(1280, 720)
                ->emulateMedia('print')
                ->setOption('preferCSSPageSize', true)
    			->scale(1)
                // ->format('A4')
            	// ->setNodeBinary('/home/thomasadam83/.nvm/versions/node/v22.13.1/bin/node')
    			// ->setNpmBinary('/home/thomasadam83/.nvm/versions/node/v22.13.1/bin/npm')
               	->save($pdfPath.$pdfFile);
                // ->pdf();
        
        	// . '--env:UserInstallation=file:///tmp/lo_profile '
        	/**/
       		$cmd = 'soffice --headless --infilter="impress_pdf_import" '    
     			. '--convert-to pptx --outdir '
     			. escapeshellarg($pptPath) . ' '
     			. escapeshellarg($pdfPath) . $pdfFile;
        
        	$cmd = 'soffice -env:UserInstallation=file:///tmp/libreoffice-profile '
            	. '--headless --infilter="impress_pdf_import" '
    			. '--convert-to pptx --outdir '
    			. escapeshellarg($pptPath) . ' '
    			. escapeshellarg($pdfPath) . $pdfFile;
        
            exec($cmd, $output, $returnVar);
            /**/
        	
        } catch (\Exception $e) {
            // Log::error('Browsershot error: ' . $e->getMessage());
            // Log::error($e->getTraceAsString()); // Full stack trace
            throw $e; // Re-throw to see the error in the browser
        }

    	return response()->download($pptPath.$pptFile);
    
    	/*
        return response($pdf, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Custom Clinical Development Report-'. date("Y-m-d") .'.pdf"');
        /**/

    }

}
