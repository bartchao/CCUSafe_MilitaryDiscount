<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use Dompdf\Dompdf;
class Pdf
{
    function createPDF($html, $filename='', $download=TRUE, $paper='A4', $orientation='portrait'){
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->render();
        if($download)
            $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
        else
            $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
    }
}
?>