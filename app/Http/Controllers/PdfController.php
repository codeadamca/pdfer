<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Browsershot\Browsershot;

class PdfController extends Controller
{

    public function urlToPdf(Request $request)
    {

        try {
            //$pdf = Browsershot::html('<h1>Hello world!!</h1>')
            $pdf = Browsershot::url($request->url)
                ->showBackground()
                ->noSandbox()
                ->format('A4')
                ->pdf();
        } catch (\Exception $e) {
            Log::error('Browsershot error: ' . $e->getMessage());
            Log::error($e->getTraceAsString()); // Full stack trace
            throw $e; // Re-throw to see the error in the browser
        }

        return response($pdf, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Custom Clinical Development Report-'. date("Y-m-d") .'.pdf"');

    }
        
    


}
