<?php

use Illuminate\Database\Seeder;
use App\Norme;
use App\NormesPhase;
use App\NormesPhaseStep;

class NormesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        



        /*
        *
        * EN50126 ******************************* 
        * 
        */
       
        $norme = new Norme();
        $norme->name = 'EN50126';
        $norme->save();

        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50126')->first()->id;
        $normePhase->name = 'Concept';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50126')->first()->id;
        $normePhase->name = 'System Definition & Operational Context';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50126')->first()->id;
        $normePhase->name = 'Risk Analysis & Evaluation';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50126')->first()->id;
        $normePhase->name = 'Specification of System Requirements';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50126')->first()->id;
        $normePhase->name = 'Architecture and Apportionment of System Requirements';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50126')->first()->id;
        $normePhase->name = 'Design SW';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50126')->first()->id;
        $normePhase->name = 'Design HW';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50126')->first()->id;
        $normePhase->name = 'Manufacture';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50126')->first()->id;
        $normePhase->name = 'Integration';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50126')->first()->id;
        $normePhase->name = 'System Validation';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50126')->first()->id;
        $normePhase->name = 'System Acceptance';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50126')->first()->id;
        $normePhase->name = 'Operation, Maintenance and Performance Monitoring';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50126')->first()->id;
        $normePhase->name = 'Decommissioning';
        $normePhase->save();

        /*
        *
        * EN50128 ******************************* 
        * 
        */
       
        $norme = new Norme();
        $norme->name = 'EN50128';
        $norme->save();

        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50128')->first()->id;
        $normePhase->name = 'Software Planning';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50128')->first()->id;
        $normePhase->name = 'Software Requirements Specification';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50128')->first()->id;
        $normePhase->name = 'Software Architecture & Design';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50128')->first()->id;
        $normePhase->name = 'Software Module Design';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50128')->first()->id;
        $normePhase->name = 'Software Coding';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50128')->first()->id;
        $normePhase->name = 'Software Module Test';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50128')->first()->id;
        $normePhase->name = 'Software Integration';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50128')->first()->id;
        $normePhase->name = 'Software/Hardware Integration';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50128')->first()->id;
        $normePhase->name = 'Software Validation';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50128')->first()->id;
        $normePhase->name = 'Software Assessement';
        $normePhase->save();
        $normePhase = new NormesPhase();
        $normePhase->norme_id = Norme::where('name','EN50128')->first()->id;
        $normePhase->name = 'Software Maintenance';
        $normePhase->save();



        $norme = new Norme();
        $norme->name = 'EN50129';
        $norme->save();

       

    }
}
