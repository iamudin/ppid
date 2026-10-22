<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class TestCetak extends BaseCommand
{
    protected $group       = 'Testing';
    protected $name        = 'test:cetak';
    protected $description = 'Tests TCPDF and cetakpermohonan execution';

    public function run(array $params)
    {
        CLI::write('Testing TCPDF initialization...', 'yellow');
        
        tcpdf();
        
        if (!class_exists('TCPDF')) {
            CLI::error('TCPDF class not found!');
            return;
        }
        
        CLI::write('TCPDF loaded successfully. Creating TCPDF instance...', 'green');
        $obj_pdf = new \TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $obj_pdf->SetTitle('Cetak Permohonan Test');
        $obj_pdf->SetMargins(10, 5, 10);
        $obj_pdf->AddPage();
        
        CLI::write('Fetching permohonan id 513 from DB...', 'yellow');
        $db = new \App\Core\CI3DatabaseWrapper();
        $status_pegawai = $db->query("SELECT
            tbl_pemohon.id_pemohon,
            tbl_pemohon.nik,
            tbl_pemohon.email,
            tbl_pemohon.nama,
            tbl_pemohon.rincian,
            tbl_pemohon.`status`,
            tbl_pemohon.posted_date,
            tbl_pemohon.alamat,
            tbl_pemohon.phone,
            tbl_pemohon.replay,
            tbl_pemohon.foto,
            tbl_pemohon.pekerjaan,
            tbl_pemohon.tujuan,
            tbl_pemohon.id_skpd,
            tbl_pemohon.cara,
            tbl_pemohon.salinan,
            tbl_pemohon.cara2,
            tbl_skpd.skpd,
            tbl_jenis.jenis,
            tbl_pemohon.download,
            tbl_pemohon.pemenuhan,
            tbl_pemohon.ket,
            tbl_pemohon.status2,
            tbl_pemohon.register
            FROM tbl_pemohon
            LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_pemohon.id_skpd 
            LEFT JOIN tbl_jenis ON tbl_jenis.permalink = tbl_pemohon.jenis
            WHERE tbl_pemohon.id_pemohon = '513'");
            
        $data = ['status_pegawai' => $status_pegawai];
        
        CLI::write('Rendering view webadmin/permohonan/cetak...', 'yellow');
        $content = view('webadmin/permohonan/cetak', $data);
        CLI::write('View rendered successfully, content length: ' . strlen($content), 'green');
        
        CLI::write('Writing HTML to PDF...', 'yellow');
        $obj_pdf->writeHTML($content, true, true, true, true, '');
        
        $pdfData = $obj_pdf->Output('test.pdf', 'S');
        CLI::write('PDF Output generated successfully! Length: ' . strlen($pdfData) . ' bytes', 'green');
    }
}
