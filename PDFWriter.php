<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21/06/17
 * Time: 08:41
 */

use Knp\Snappy\Pdf;

class PdfWriter
{
    private $binaryPath;

    public function __construct()
    {
        $this->binaryPath = __DIR__ . '/vendor/bin/wkhtmltopdf-amd64-osx';
    }

    public function write($template)
    {
        $generatedPdfFilename = sprintf('export-%s.pdf', time());

        $generatedPdfFilePath = __DIR__ . DIRECTORY_SEPARATOR . $generatedPdfFilename;

        $snappy = new Pdf($this->binaryPath);

        $snappy->generateFromHtml(file_get_contents($template), $generatedPdfFilePath);

        return $generatedPdfFilePath;
    }
}