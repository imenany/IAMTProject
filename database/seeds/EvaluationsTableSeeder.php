<?php

use Illuminate\Database\Seeder;
use App\Evaluation;

class EvaluationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $st = new Evaluation();
        $st->state = "Document analysé mais il n'y a pas d'observation ou des observations sont en cours de préparation" ;
        $st->save();

        $st = new Evaluation();
        $st->state = "Document pas examiné au stade actuel ou en cours d'examination" ;
        $st->save();

        $st = new Evaluation();
        $st->state = "Le document doit être revu, n'est pas conforme aux normes CENELEC ou peut contenir des points bloquants" ;
        $st->save();

        $st = new Evaluation();
        $st->state = "Document analysé, en attente de justifications, quelques points majeurs à adresser, quelques changements de fond à apporter" ;
        $st->save();

        $st = new Evaluation();
        $st->state = "Quelques observations mineures" ;
        $st->save();

        $st = new Evaluation();
        $st->state = "Plus d'observation ou le document ne nécessite pas d'examen particulier" ;
        $st->save();
    }
}



