<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BaubuddyApiService;
use Knp\Snappy\Pdf;

class PdfController extends Controller
{
    private $apiService;
    private $pdf;

    public function __construct(BaubuddyApiService $apiService, Pdf $pdf)
    {
        $this->apiService = $apiService;
        $this->pdf = $pdf;

        $this->pdf->setBinary(env('WKHTMLTOPDF_BINARY', '/usr/bin/wkhtmltopdf'));
    }

    public function generatePdf()
    {
        $tasks = $this->apiService->getTasks();

        if (!$tasks) {
            return response()->json(["error" => "Failed to get API data!"], 500);
        }
        // return $tasks;
        $html = view('pdf.tasks', ['tasks' => $tasks])->render();
        // return $html;
        $pdfContent = $this->pdf->getOutputFromHtml($html);

        return response()->streamDownload(function () use ($pdfContent) {
            echo $pdfContent;
        }, 'tasks.pdf', ['Content-Type' => 'application/pdf']);
    }
}
