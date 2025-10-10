<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         * Llenado de facultades
         */
        DB::table('facultades')->insert([
            [
               'codigo' => 'FQByF',
               'nombre' => 'Facultad de Química, Bioquímica y Farmacia', 
            ],
            [
               'codigo' => 'FCFMyN',
               'nombre' => 'Facultad de Ciencias Físico Matemáticas y Naturales', 
            ],
            [
               'codigo' => 'FICA',
               'nombre' => 'Facultad de Ingeniería y Ciencias Agropecuarias', 
            ],
            [
               'codigo' => 'FCEJS',
               'nombre' => 'Facultad de Ciencias Económicas, Jurídicas y Sociales', 
            ],
            [
               'codigo' => 'FCH',
               'nombre' => 'Facultad de Ciencias Humanas', 
            ],
            [
               'codigo' => 'FAPSI',
               'nombre' => 'Facultad de Psicología', 
            ],
            [
               'codigo' => 'FCS',
               'nombre' => 'Facultad de Ciencias de la Salud', 
            ],
            [
               'codigo' => 'FTU',
               'nombre' => 'Facultad de Turismo y Urbanismo', 
            ],
            [
               'codigo' => 'IPAU',
               'nombre' => 'Instituto Politécnico y Artístico Universitario', 
            ],
        ]);

        /**
         * Llenado de departamentos
         */
        DB::table('departamentos')->insert([
            [
                'facultad_codigo' => 'FQByF',
                'nombre' => 'Biología',
            ],
            [
                'facultad_codigo' => 'FQByF',
                'nombre' => 'Bioquímica',
            ],
            [
                'facultad_codigo' => 'FQByF',
                'nombre' => 'Farmacia',
            ],
            [
                'facultad_codigo' => 'FQByF',
                'nombre' => 'Química',
            ],
            [
                'facultad_codigo' => 'FCFMyN',
                'nombre' => 'Electrónica',
            ],
            [
                'facultad_codigo' => 'FCFMyN',
                'nombre' => 'Física',
            ],
            [
                'facultad_codigo' => 'FCFMyN',
                'nombre' => 'Geología',
            ],
            [
                'facultad_codigo' => 'FCFMyN',
                'nombre' => 'Informática',
            ],
            [
                'facultad_codigo' => 'FCFMyN',
                'nombre' => 'Matemática',
            ],
            [
                'facultad_codigo' => 'FCFMyN',
                'nombre' => 'Minería',
            ],
            [
                'facultad_codigo' => 'FICA',
                'nombre' => 'Ciencias Básicas',
            ],
            [
                'facultad_codigo' => 'FICA',
                'nombre' => 'Ingeniería',
            ],
            [
                'facultad_codigo' => 'FICA',
                'nombre' => 'Ciencias Agropecuarias',
            ],
            [
                'facultad_codigo' => 'FICA',
                'nombre' => 'Ingeniería de Procesos',
            ],
            [
                'facultad_codigo' => 'FCEJS',
                'nombre' => 'Ciencias Económicas',
            ],
            [
                'facultad_codigo' => 'FCEJS',
                'nombre' => 'Ciencias Sociales',
            ],
            [
                'facultad_codigo' => 'FCEJS',
                'nombre' => 'Ciencias Jurídicas y Políticas',
            ],
            [
                'facultad_codigo' => 'FCH',
                'nombre' => 'Educación y Formación Docente',
            ],
            [
                'facultad_codigo' => 'FCH',
                'nombre' => 'Comunicación',
            ],
            [
                'facultad_codigo' => 'FCH',
                'nombre' => 'Artes',
            ],
            [
                'facultad_codigo' => 'FAPSI',
                'nombre' => 'Formación Básica, General y Complementaria',
            ],
            [
                'facultad_codigo' => 'FAPSI',
                'nombre' => 'Formación Profesional',
            ],
            [
                'facultad_codigo' => 'FCS',
                'nombre' => 'Enfermería',
            ],
            [
                'facultad_codigo' => 'FCS',
                'nombre' => 'Fonoaudiología',
            ],
            [
                'facultad_codigo' => 'FCS',
                'nombre' => 'Kinesiología y Fisiatría',
            ],
            [
                'facultad_codigo' => 'FCS',
                'nombre' => 'Nutrición',
            ],
            [
                'facultad_codigo' => 'FTU',
                'nombre' => 'Turismo',
            ],
            [
                'facultad_codigo' => 'FTU',
                'nombre' => 'Aromáticas y Jardinería',
            ],
            [
                'facultad_codigo' => 'IPAU',
                'nombre' => '-',
            ],
        ]);

        /**
         * Llenado de carreras
         */
        DB::table('carreras')->insert([
            [
                'nombre' => 'Analista Químico',
                'facultad_codigo' => 'FQByF',
            ],
            [
                'nombre' => 'Ciclo de Complementación Curricular: Licenciatura en Educación Especial',
                'facultad_codigo' => 'FCH',
            ],
            [
                'nombre' => 'Farmacia',
                'facultad_codigo' => 'FQByF',
            ],
            [
                'nombre' => 'Ingeniería Electrónica con Orientación en Sistemas Digitales',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Ingeniería en Alimentos',
                'facultad_codigo' => 'FQByF',
            ],
            [
                'nombre' => 'Ingeniería en Computación',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Ingeniería en Informática',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Ingeniería en Minas',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Licenciatura en Análisis y Gestión de Datos',
                'facultad_codigo' => 'FCFMyN', // Doble dependencia (FCFMyN / FCEJS), se usa el primero
            ],
            [
                'nombre' => 'Licenciatura en Biología Molecular',
                'facultad_codigo' => 'FQByF',
            ],
            [
                'nombre' => 'Licenciatura en Bioquímica',
                'facultad_codigo' => 'FQByF',
            ],
            [
                'nombre' => 'Licenciatura en Biotecnología',
                'facultad_codigo' => 'FQByF',
            ],
            [
                'nombre' => 'Licenciatura en Ciencia y Tecnología de los Alimentos',
                'facultad_codigo' => 'FQByF',
            ],
            [
                'nombre' => 'Licenciatura en Ciencias Biológicas',
                'facultad_codigo' => 'FQByF',
            ],
            [
                'nombre' => 'Licenciatura en Ciencias de la Computación',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Licenciatura en Ciencias de la Educación',
                'facultad_codigo' => 'FCH',
            ],
            [
                'nombre' => 'Licenciatura en Ciencias Geológicas',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Licenciatura en Ciencias Matemáticas',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Licenciatura en Comunicación Social',
                'facultad_codigo' => 'FCH',
            ],
            [
                'nombre' => 'Licenciatura en Educación Inicial',
                'facultad_codigo' => 'FCH',
            ],
            [
                'nombre' => 'Licenciatura en Enfermería',
                'facultad_codigo' => 'FCS',
            ],
            [
                'nombre' => 'Licenciatura en Física',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Licenciatura en Fonoaudiología',
                'facultad_codigo' => 'FCS',
            ],
            [
                'nombre' => 'Licenciatura en Higiene y Seguridad - Ciclo de Complementación Curricular',
                'facultad_codigo' => 'FQByF',
            ],
            [
                'nombre' => 'Licenciatura en Kinesiología y Fisiatría',
                'facultad_codigo' => 'FCS',
            ],
            [
                'nombre' => 'Licenciatura en Matemática Aplicada',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Licenciatura en Nutrición',
                'facultad_codigo' => 'FCS',
            ],
            [
                'nombre' => 'Licenciatura en Periodismo',
                'facultad_codigo' => 'FCH',
            ],
            [
                'nombre' => 'Licenciatura en Producción de Radio y Televisión',
                'facultad_codigo' => 'FCH',
            ],
            [
                'nombre' => 'Licenciatura en Psicología',
                'facultad_codigo' => 'FAPSI',
            ],
            [
                'nombre' => 'Licenciatura en Psicomotricidad',
                'facultad_codigo' => 'FAPSI',
            ],
            [
                'nombre' => 'Licenciatura en Química',
                'facultad_codigo' => 'FQByF',
            ],
            [
                'nombre' => 'Profesorado de Educación Inicial',
                'facultad_codigo' => 'FCH',
            ],
            [
                'nombre' => 'Profesorado en Ciencias de la Computación',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Profesorado en Ciencias de la Educación',
                'facultad_codigo' => 'FCH',
            ],
            [
                'nombre' => 'Profesorado en Educación Especial',
                'facultad_codigo' => 'FCH',
            ],
            [
                'nombre' => 'Profesorado en Física',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Profesorado en Matemática',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Profesorado en Psicología',
                'facultad_codigo' => 'FAPSI',
            ],
            [
                'nombre' => 'Profesorado en Tecnología Electrónica',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Profesorado Universitario en Biología',
                'facultad_codigo' => 'FQByF',
            ],
            [
                'nombre' => 'Profesorado Universitario en Educación Primaria',
                'facultad_codigo' => 'FCH',
            ],
            [
                'nombre' => 'Profesorado Universitario en Letras',
                'facultad_codigo' => 'FCH',
            ],
            [
                'nombre' => 'Profesorado Universitario en Música Popular Latinoamericana',
                'facultad_codigo' => 'FCH',
            ],
            [
                'nombre' => 'Profesorado Universitario en Química',
                'facultad_codigo' => 'FQByF',
            ],
            [
                'nombre' => 'Profesorado Universitario en Teatro',
                'facultad_codigo' => 'FCH',
            ],
            [
                'nombre' => 'Tecnicatura en Administración y Gestión de Instituciones Universitarias',
                'facultad_codigo' => 'IPAU',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Administración y Gestión Judicial',
                'facultad_codigo' => 'IPAU',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Electrónica',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Energías Renovables',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Esterilización',
                'facultad_codigo' => 'FQByF',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Fotografía',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Gestión de Organizaciones Deportivas',
                'facultad_codigo' => 'IPAU',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Higiene y Seguridad en el trabajo',
                'facultad_codigo' => 'FQByF',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Laboratorios Biológicos',
                'facultad_codigo' => 'FQByF',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Minería',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Obras Viales',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Producción Musical',
                'facultad_codigo' => 'FCH',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Redes de Computadoras',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Secretariado Ejecutivo',
                'facultad_codigo' => 'IPAU',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Telecomunicaciones',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Teledetección y Sistemas de Información Geográfica (T-SIG)',
                'facultad_codigo' => 'FCFMyN',
            ],
            [
                'nombre' => 'Tecnicatura Universitaria en Web',
                'facultad_codigo' => 'FCFMyN',
            ],
        ]);
    }
}
