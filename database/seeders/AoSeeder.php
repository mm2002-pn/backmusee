<?php

namespace Database\Seeders;

use App\Models\Detailsda;
use Illuminate\Database\Seeder;
use App\Models\Ao;
use App\Models\Typemarche;
use App\Models\Typeprocedure;
use App\Models\Article;
use App\Models\Aoarticle;
use App\Models\Aofournisseur;
use App\Models\Fournisseur;
use Carbon\Carbon;

class AoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nettoyer avant de reseeder
        Aoarticle::truncate();
        Aofournisseur::truncate();
        Ao::truncate();

        // Récupérer quelques types
        $typemarche1 = Typemarche::first();
        $typemarche2 = Typemarche::skip(1)->first();

        $procedure1 = Typeprocedure::first();
        $procedure2 = Typeprocedure::skip(1)->first();

        // Récupérer plus d’articles
        $articles = Article::take(50)->get();

        // Récupérer plus de fournisseurs
        $fournisseurs = Fournisseur::take(30)->get();

        /*
        |--------------------------------------------------------------------------
        | Premier AO
        |--------------------------------------------------------------------------
        */
        $ao1 = Ao::create([
            'reference'           => 'AO-2025-001',
            'designation'         => 'AO Fourniture Matériel Informatique',
            'statut'              => 0,
            'date'                => Carbon::now()->format('Y-m-d'),
            'typemarche_id'       => $typemarche1->id ?? null,
            'typeprocedure_id'    => $procedure1->id ?? null,
            'datepublication'     => Carbon::now()->subDays(7)->format('Y-m-d'),
            'isnotationfournisseur' => 1,
            'isnotationarticle'     => 1,
            'isnotationadministrative' => 0,
        ]);

        $articles = Detailsda::where('da_id',2)->get();

        foreach ($articles as $article) {
            if(isset($article) && isset($article->article_id)){

                $art = Article::find($article->article_id);
                Aoarticle::create([
                    'ao_id'          => $ao1->id,
                    'article_id'     => $art->id,
                    'margevaleur'    => $article->margevaleur ?? 0,
                    'margepourcentage' =>$article->margepourcentage ?? 0,
                    'targetprice'      =>$article->NETPRI_0,
                    'quantite'          =>$article->QTYSTU_0
                ]);
            }

        }

        foreach ($fournisseurs->take(10) as $fournisseur) {
            Aofournisseur::create([
                'ao_id'          => $ao1->id,
                'fournisseur_id' => $fournisseur->id,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Deuxième AO
        |--------------------------------------------------------------------------
        */
        $ao2 = Ao::create([
            'reference'           => 'AO-2025-002',
            'designation'         => 'AO Construction Bâtiment',
            'statut'              => 0,
            'date'                => Carbon::now()->subDays(5)->format('Y-m-d'),
            'typemarche_id'       => $typemarche2->id ?? null,
            'typeprocedure_id'    => $procedure1->id ?? null,
            'datepublication'     => Carbon::now()->subDays(3)->format('Y-m-d'),
            'isnotationfournisseur' => 1,
            'isnotationarticle'     => 1,
            'isnotationadministrative' => 0,
        ]);

        foreach ($articles->skip(10)->take(15) as $article) {
            Aoarticle::create([
                'ao_id'          => $ao2->id,
                'article_id'     => $article->id,
                'margevaleur'    => 0,
                'margepourcentage' => 0,
            ]);
        }

        foreach ($fournisseurs->skip(5)->take(12) as $fournisseur) {
            Aofournisseur::create([
                'ao_id'          => $ao2->id,
                'fournisseur_id' => $fournisseur->id,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Troisième AO
        |--------------------------------------------------------------------------
        */
        $ao3 = Ao::create([
            'reference'           => 'AO-2025-003',
            'designation'         => 'AO Prestation de Services',
            'statut'              => 0,
            'date'                => Carbon::now()->subDays(10)->format('Y-m-d'),
            'typemarche_id'       => $typemarche1->id ?? null,
            'typeprocedure_id'    => $procedure2->id ?? null,
            'datepublication'     => Carbon::now()->subDays(9)->format('Y-m-d'),
            'isnotationfournisseur' => 1,
            'isnotationarticle'     => 1,
            'isnotationadministrative' => 0,
        ]);

        foreach ($articles->skip(25)->take(10) as $article) {
            Aoarticle::create([
                'ao_id'          => $ao3->id,
                'article_id'     => $article->id,
                'margevaleur'    => 0,
                'margepourcentage' => 0,
            ]);
        }

        foreach ($fournisseurs->skip(10)->take(8) as $fournisseur) {
            Aofournisseur::create([
                'ao_id'          => $ao3->id,
                'fournisseur_id' => $fournisseur->id,
            ]);
        }
    }
}
