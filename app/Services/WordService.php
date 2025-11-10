<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\DocProtect;

class WordService {
    private $phpWord;
    private $fontstyle_title;
    private $fontstyle_header;
    private $fontstyle_text;
    private $ASUNTO_CERRADO = "Cerrado";
    
    public function __construct() {
        date_default_timezone_set('America/Argentina/San_Luis');
        $this->phpWord = new PhpWord();
        $this->phpWord->getSettings()->getDocumentProtection()->setEditing(DocProtect::READ_ONLY);
        /**
         * Estilo del título
         */
        $this->fontstyle_title = array('name' => 'Arial',
                'size' => 20, 
                'color' => '000000', 
                'bold' => true, 
                'fgColor' => 'yellow');
        /**
         * Estilo de encabezado
         */
        $this->fontstyle_header = array('name' => 'Arial',
                'size' => 12,
                'color' => '000000', 
                'bold' => true);
        /**
         * Estilo del texto
         */
        $this->fontstyle_text = array('name' => 'Arial',
                'size' => 12,
                'color' => '000000');
    }


    /**
     * Retorna la ruta a la nueva ficha de seguimiento para el alumno provisto
     */
    public function crear(string $apellido, string $nombre, int $cud, 
        string $apoyo = '', string $situacion ='', string $descripcion = '') {
        
        $apellidos = explode(' ', strtolower($apellido));
        $nombres = explode(' ', strtolower($nombre));

        $ruta = Storage::disk('local')->path('seguimientos') . '/';
        foreach($apellidos as $a) {
            $ruta = $ruta . $a . '_';
        }
        foreach($nombres as $n) {
            $ruta = $ruta . $n . '_';
        }
        $ruta = $ruta . $cud . '_' . date("Y-m-d_H-i-s") . '.docx';

        
        /**
         * Fecha y Título Principal
         */
        $section = $this->phpWord->addSection();
        $section->addText(
            strtoupper($apellido) . ' ' . strtoupper($nombre) . ' ' . date("d/m/Y"),
            $this->fontstyle_text
        );
        $section->addText(
            'Registro de historiales académicos',
            $this->fontstyle_title
        );
        $section->addTextBreak(3);

        
        /**
         * Primer párrafo explicativo
         */
        $section->addText(
            'En este archivo se registra información sobre:',
            $this->fontstyle_header
        );
        $section->addText(
            'Tipo de demanda, Apoyos y ajustes solicitados, Acciones realizadas por el ETAA, Articulaciones con docentes / Unidades Académicas (UA) / SAEBU / Programa de Ingreso Permanencia y Egreso (PIPE/ otros. Cambios en la demanda, Resultados académicos (si se reportan), Evaluación general del acompañamiento, Observaciones adicionales.',
            $this->fontstyle_text
        );
        $textRun = $section->addTextRun();
            $textRun->addText(
                'IMPORTANTE: ',
                $this->fontstyle_header
            );
            $textRun->addText(
                'Este documento no debe ser modificado manualmente. Toda modificación debe hacerse a través de la aplicación web.',
                $this->fontstyle_text
            );
        $section->addTextBreak(3);

        /**
         * Apoyo (opcional, llenado en formulario)
         */
        if($apoyo) {
            $textRun = $section->addTextRun();
            $textRun->addText(
                'Apoyo solicitado: ',
                $this->fontstyle_header
            );
            $textRun->addText(
                $apoyo,
                $this->fontstyle_text
            );
            $section->addTextBreak(1);
        }

        /**
         * Situación (opcional, llenado en formulario)
         */
        if($situacion) {
            $textRun = $section->addTextRun();
            $textRun->addText(
                'Situación: ',
                $this->fontstyle_header
            );
            $textRun->addText(
                $situacion,
                $this->fontstyle_text
            );
            $section->addTextBreak(1);
        }

        /**
         * Descripción (opcional, llenado en formulario)
         */
        if($descripcion) {
            $textRun = $section->addTextRun();
            $textRun->addText(
                'Descripción: ',
                $this->fontstyle_header
            );
            $textRun->addText(
                $descripcion,
                $this->fontstyle_text
            );
            $section->addTextBreak(1);
        }

        $textRun = $section->addTextRun();
        

        
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($this->phpWord, 'Word2007');
        $objWriter->save($ruta);
        return $ruta;
    }

    /**
     * Actualiza el archivo. Retorna bool dependiendo si la ficha está cerrada.
     */
    public function actualizarFicha(string $ruta, string $actualizacion, string $empleado){
        if($this->esFichaCerrada()) {
            return false;
        }
        $this->phpWord = \PhpOffice\PhpWord\IOFactory::load($ruta);
        $section = $this->phpWord->getSection(0);


        $textRun = $section->addTextRun();
        $textRun->addText(
            'Fecha:',
            $this->fontstyle_header
        );
        $textRun->addText(
            date("d/m/Y"),
            $this->fontstyle_text
        );

        $textRun = $section->addTextRun();
        $textRun->addText(
            'Modificado por: ',
            $this->fontstyle_header
        );
        $textRun->addText(
            $empleado,
            $this->fontstyle_text
        );
        $textRun = $section->addTextRun();
        $textRun->addText(
            'Asunto: ',
            $this->fontstyle_header
        );
        $textRun->addText(
            $actualizacion,
            $this->fontstyle_text
        );
        $section->addTextBreak(3);
        return true;
    }

    /**
     * Última actualización al archivo. Retorna bool dependiendo si la ficha está cerrada.
     */
    public function cerrarFicha(string $ruta, string $causa){
        if($this->esFichaCerrada()) {
            return;
        }
        $this->phpWord = \PhpOffice\PhpWord\IOFactory::load($ruta);
        $section = $this->phpWord->getSection(0);
        $section->addText(
            'CIERRE DE SEGUIMIENTO',
            $this->fontstyle_header
        );
        $textRun = $section->addTextRun();
        $textRun->addText(
            'Fecha: ',
            $this->fontstyle_header
        );
        $textRun->addText(
            date("d/m/Y"),
            $this->fontstyle_text
        );
        $textRun = $section->addTextRun();
        $textRun->addText(
            'Causa de cierre: ',
            $this->fontstyle_header
        );
        $textRun->addText(
            $causa,
            $this->fontstyle_text
        );

        $this->phpWord->getDocInfo()->setSubject($this->ASUNTO_CERRADO);


        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($this->phpWord, 'Word2007');
        $objWriter->save($ruta);
    }

    private function esFichaCerrada() {
        return $this->phpWord->getDocInfo()->getSubject() == $this->ASUNTO_CERRADO;
    }

    public static function getDocMetadata(string $ruta) {
        $doc = \PhpOffice\PhpWord\IOFactory::load($ruta);
        $docInfo = $doc->getDocInfo();
        return array('Título' => $docInfo->getTitle(),
            'Asunto/Tema' => $docInfo->getSubject(),
            'Autor/Creador' => $docInfo->getCreator(),
            'Compañía' => $docInfo->getCompany(),
            'Descripción' => $docInfo->getDescription(),
            'Palabras Clave/Etiquetas' => $docInfo->getKeywords(),
            'Categoría' => $docInfo->getCategory(),
            'Administrador' => $docInfo->getManager(),
            'Fecha de Creación' => $docInfo->getCreated(),
            'Fecha de Modificación' => $docInfo->getModified());
    }
}