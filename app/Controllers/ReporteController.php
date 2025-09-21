<?php

namespace App\Controllers;

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;

class ReporteController extends BaseController
{
    // Mostrar formulario para seleccionar publisher
    public function formOpciones()
    {
        $cn = \Config\Database::connect();
        $publishers = $cn->query("SELECT id, publisher_name FROM publisher ORDER BY publisher_name")->getResultArray();

        return view('reportes/select_publisher', ['publishers' => $publishers]);
    }

    // Generar PDF filtrado por publisher_id recibido vía POST
   public function generarPorPublisher()
{
    $publisherId = $this->request->getPost('publisher_id');

    if (!$publisherId) {
        return redirect()->to(site_url('reportes/formulario'))->with('error', 'Debe seleccionar una editorial');
    }

    $db = \Config\Database::connect();

    // Consulta filtrando por publisher_id
    $sql = "
        SELECT 
            SH.id,
            SH.superhero_name,
            SH.full_name,
            PB.publisher_name,
            AL.alignment
        FROM superhero SH
        LEFT JOIN publisher PB ON SH.publisher_id = PB.id
        LEFT JOIN alignment AL ON SH.alignment_id = AL.id
        WHERE PB.id = ?
        ORDER BY SH.superhero_name
        LIMIT 100
    ";

    $query = $db->query($sql, [$publisherId]);
    $rows = $query->getResultArray();

    $data = [
        'rows' => $rows,
        'estilos' => view('reportes/estilos'),
    ];

    // Cargar la vista con el HTML para PDF
    $html = view('reportes/reporte_pdf', $data); // Usa el nombre correcto de tu vista

    try {
        $html2pdf = new \Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'es', true, 'UTF-8', [10, 10, 10, 10]);
        $html2pdf->writeHTML($html);

        $this->response->setHeader('Content-Type', 'application/pdf');
        $html2pdf->output('Reporte-superheroes.pdf', 'I');
        exit;
    } catch (Html2PdfException $e) {
        return 'Error al generar PDF: ' . $e->getMessage();
    }
}


    // Método existente, ejemplo base
    public function getReport1()
    {
        return view('reportes/reporte1');
    }

    // Método ejemplo que genera PDF filtrado por publisher_name vía GET
    public function getReport3()
    {
        $cn = \Config\Database::connect();

        $publisherName = $this->request->getGet('publisher_name') ?? '';

        $sql = "
            SELECT 
                SH.id,
                SH.superhero_name,
                SH.full_name,
                PB.publisher_name,
                AL.alignment
            FROM superhero SH
            LEFT JOIN publisher PB ON SH.publisher_id = PB.id
            LEFT JOIN alignment AL ON SH.alignment_id = AL.id
            WHERE PB.publisher_name LIKE ?
            ORDER BY PB.publisher_name
            LIMIT 100;
        ";

        $param = '%' . $publisherName . '%';

        $rows = $cn->query($sql, [$param]);

        $data = [
            "rows" => $rows->getResultArray(),
            "estilos" => view('reportes/estilos'),
            "publisher_name" => $publisherName
        ];

        $html = view('reportes/reporte3', $data);

        try {
            $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', [10, 10, 10, 10]);
            $html2pdf->writeHTML($html);

            $this->response->setHeader('Content-Type', 'application/pdf');
            $html2pdf->output('Reporte-superhero.pdf', 'I');
            exit;
        } catch (Html2PdfException $e) {
            return "Error generando el PDF: " . $e->getMessage();
        }
    }
    // Buscar por nombre y generar PDF
    public function buscarSuperheroPdf()
    {
        $nombre = $this->request->getGet('nombre') ?? '';

        if (trim($nombre) === '') {
            return 'Debe ingresar un nombre de superhéroe';
        }

        $db = \Config\Database::connect();

        $sql = "
            SELECT 
                SH.id,
                SH.superhero_name,
                SH.full_name,
                PB.publisher_name,
                AL.alignment,
                AT.attribute_name,
                HA.attribute_value
            FROM superhero SH
            LEFT JOIN publisher PB ON SH.publisher_id = PB.id
            LEFT JOIN alignment AL ON SH.alignment_id = AL.id
            LEFT JOIN hero_attribute HA ON SH.id = HA.hero_id
            LEFT JOIN attribute AT ON HA.attribute_id = AT.id
            WHERE SH.superhero_name LIKE ?
            ORDER BY SH.superhero_name
        ";

        $rows = $db->query($sql, ['%' . $nombre . '%'])->getResultArray();

        if (empty($rows)) {
            return "No se encontró ningún superhéroe con el nombre: " . esc($nombre);
        }

        $data = [
            "rows"   => $rows,
            "nombre" => $nombre,
            "estilos" => view('reportes/estilos')
        ];

        $html = view('reportes/reporte_superhero', $data);

        try {
            $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', [10, 10, 10, 10]);
            $html2pdf->writeHTML($html);

            $this->response->setHeader('Content-Type', 'application/pdf');
            $html2pdf->output("Superheroe_{$nombre}.pdf", 'I');
            exit;
        } catch (Html2PdfException $e) {
            return "Error generando PDF: " . $e->getMessage();
        }
    }

    // Mostrar formulario de búsqueda de superhéroe
public function formularioBuscar()
{
    return view('reportes/buscar_superhero');
}
// Devolver coincidencias para autocompletar
public function autocomplete()
{
    $term = $this->request->getGet('term') ?? '';

    $db = \Config\Database::connect();

    $sql = "
        SELECT superhero_name 
        FROM superhero 
        WHERE superhero_name LIKE ? 
        ORDER BY superhero_name 
        LIMIT 10
    ";

    $results = $db->query($sql, ['%' . $term . '%'])->getResultArray();

    $names = [];
    foreach ($results as $row) {
        $names[] = $row['superhero_name'];
    }

    return $this->response->setJSON($names);
}

}
