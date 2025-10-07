<?php

namespace App\Models;

use Carbon\Carbon;
use Doctrine\DBAL\Query;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;
use Spatie\Permission\Models\Permission;
use stdClass;

class QueryModel extends Model
{

    public static function joined($query, $table)
    {
        $joins = $query->getQuery()->joins;
        if ($joins == null) {
            return false;
        }
        foreach ($joins as $join) {
            if ($join->table == $table) {
                return true;
            }
        }
        return false;
    }
    public static function getQueryPlanninghebdomadaire($args)
    {
        $query = User::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    // getQueryChauffeur

    public static function getQueryChauffeur($args)
    {
        $query = Chauffeur::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        // estinterne
        if (isset($args['estinterne'])) {
            $query = $query->where('estinterne', $args['estinterne']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }



    // getQueryVehicule

    public static function getQueryVehicule($args)
    {
        $query = Vehicule::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        // estinterne
        if (isset($args['estinterne'])) {
            $query = $query->where('estinterne', $args['estinterne']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryParking
    public static function getQueryParking($args)
    {
        $query = Parking::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        // fournisseur_id
        if (isset($args['fournisseur_id'])) {
            $query = $query->where('fournisseur_id', $args['fournisseur_id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryAxetonnage

    public static function getQueryAxetonnage($args)
    {
        $query = Axetonnage::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryTypevehicule

    public static function getQueryTypevehicule($args)
    {
        $query = Typevehicule::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }
    // getQueryFichecritere

    public static function getQueryFichecritere($args)
    {
        $query = Fichecritere::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    // getQueryTonnage

    public static function getQueryTonnage($args)
    {
        $query = Tonnage::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    // getQueryWorkflow

    public static function getQueryWorkflow($args)
    {
        $query = Workflow::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryDetailtypemarchedetail

    public static function getQueryDetailtypemarchedetail($args)
    {
        $query = Detailtypemarchedetail::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryFicheevaluation

    public static function getQueryFicheevaluation($args)
    {
        $query = Ficheevaluation::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        // annee
        if (isset($args['annee'])) {
            $query = $query->where('annee', $args['annee']);
        }

        if (isset($args['TSSCOD_0_0'])) {
            $tlscode =  $args['TSSCOD_0_0'];
            $cat = '';
            if ($tlscode ===  'MED') {
                $cat = 1;
            }
            if ($tlscode === 'BES') {
                $cat = 2;
            }
            $query = $query->where('TSSCOD_0_0', $cat);
        }

        // isactive
        if (isset($args['isactive'])) {
            $query = $query->where('isactive', $args['isactive']);
        }



        $query = $query->orderBy('id', 'DESC');
        return $query;
    }



    // getQueryEvaluationsfournisseur

    public static function getQueryEvaluationsfournisseur($args)
    {
        $query = Evaluationsfournisseur::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        // fournisseur_id
        if (isset($args['fournisseur_id'])) {
            $query = $query->where('fournisseur_id', $args['fournisseur_id']);
        }

        // annee
        if (isset($args['annee'])) {
            $query = $query->where('annee', $args['annee']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryStatutamm

    public static function getQueryStatutamm($args)
    {
        $query = Statutamm::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }

        // codeproduit
        if (isset($args['codeproduit'])) {
            $query = $query->where('codeproduit', $args['codeproduit']);
        }

        // fournisseur_id
        if (isset($args['fournisseur_id'])) {
            $query = $query->where('fournisseur_id', $args['fournisseur_id']);
        }

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }
    // getQuerySoumission

    public static function getQuerySoumission($args)
    {
        $query = Soumission::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['fournisseur_id'])) {
            $query = $query->where('fournisseur_id', $args['fournisseur_id']);
        }
        if (isset($args['ao_id'])) {
            $query = $query->where('ao_id', $args['ao_id']);
        }
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryEchelleevaluation

    public static function getQueryEchelleevaluation($args)
    {
        $query = Echelleevaluation::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryCritere

    public static function getQueryCritere($args)
    {
        $query = Critere::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryDocumentspecification

    public static function getQueryDocumentspecification($args)
    {
        $query = Documentspecification::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryRemisedureedevie

    public static function getQueryRemisedureedevie($args)
    {
        $query = Remisedureedevie::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }

        if (isset($args['article_id'])) {
            $article = Article::find($args['article_id']);
            if (isset($article)) {
                $query = $query->where('typeduree', $article->COURTEDUREE_0);
            }
        }
        $query = $query->orderBy('typeduree', 'DESC');
        return $query;
    }

    // getQueryArticleremisedureedevie

    public static function getQueryArticleremisedureedevie($args)
    {
        $query = Articleremisedureedevie::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    // getQueryScorefournisseur
    public static function getQueryScorefournisseur($args)
    {
        $query = Scorefournisseur::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryDadocumentspecification

    public static function getQueryDadocumentspecification($args)
    {
        $query = Dadocumentspecification::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryMesure

    public static function getQueryMesure($args)
    {
        $query = Mesure::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }
    // getQuerySoumissionarticle

    public static function getQuerySoumissionarticle($args)
    {
        $query = Soumissionarticle::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }

        // soumission_id
        if (isset($args['soumission_id'])) {
            $query = $query->where('soumission_id', $args['soumission_id']);
        }

        // isselected
        if (isset($args['isselected'])) {
            $query = $query->where('isselected', $args['isselected']);
        }

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQuerySoumissionarticle


    // getQueryPrequalification

    public static function getQueryPrequalification($args)
    {
        $query = Prequalification::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }

        // anneeexpiration
        if (isset($args['anneeexpiration'])) {
            $query = $query->where('anneeexpiration', $args['anneeexpiration']);
        }

        // anneeexpiration
        if (isset($args['anneeprequalification'])) {
            $query = $query->where('anneeprequalification', $args['anneeprequalification']);
        }

        // fournisseur_id
        if (isset($args['fournisseur_id'])) {
            $query = $query->where('fournisseur_id', $args['fournisseur_id']);
        }
        // pays_id
        if (isset($args['pays_id'])) {
            $query = $query->where('pays_id', $args['pays_id']);
        }

        if (isset($args['article_id'])) {
            $query = $query->where('article_id', $args['article_id']);
        }



        // statut
        if (isset($args['statut'])) {
            $query = $query->where('statut', $args['statut']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryAttachement

    public static function getQueryAttachement($args)
    {
        $query = Attachement::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryFournisseurattachement

    public static function getQueryFournisseurattachement($args)
    {
        $query =  Fournisseurattachement::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryDossierfournisseur

    public static function getQueryDossierfournisseur($args)
    {
        $query =  Dossierfournisseur::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryFichierfournisseur($args)
    {
        $query =  Fichierfournisseur::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }
    // getQueryFournisseur

    public static function getQueryFournisseur($args)
    {
        $query = Fournisseur::query();

        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }

        if (isset($args['nom'])) {
            $query = $query->where('nom', Outil::getOperateurLikeDB(), '%' . $args['nom'] . '%');
        }

        if (isset($args['TSSCOD_0_0_id']) || isset($args['TSSCOD_0_0'])) {
            $tlscode = isset($args['TSSCOD_0_0_id']) ? $args['TSSCOD_0_0_id'] : $args['TSSCOD_0_0'];

            if ($tlscode == 1) {
                $query = $query->where('TSSCOD_0_0', 'MED');
            }

            if ($tlscode == 2) {
                // BES doit inclure aussi TRANS
                $query = $query->whereIn('TSSCOD_0_0', ['BES', 'TRANS']);
            }

            if ($tlscode == 3) {
                $query = $query->where('TSSCOD_0_0', 'TRANS');
            }
            if ($tlscode == 4) {
                $cat = 'TRANSITAIRE';
                $query = $query->where('TSSCOD_0_0', $cat);
            }
            if ($tlscode == 5) {
                $cat = 'EXPERT';
                $query = $query->where('TSSCOD_0_0', $cat);
            }
            if ($tlscode == 6) {
                $cat = 'PREST';
                $query = $query->where('TSSCOD_0_0', $cat);
            }

        }
        
        // 🔥 typefournisseur && categoriefournisseur
        if (isset($args['typefournisseur'])) {
            $cat = null;
            // règle pour typefournisseur
            if (strpos($args['typefournisseur'], 'MED') === 0) {
                $cat = 'MED';
            } else {
                $cat = 'BES';
            }
            $query = $query->where('TSSCOD_0_0', $cat);
        }

        // 🔥 typefournisseur && categoriefournisseur
        if (isset($args['categoriefournisseur'])) {
            $fourcat = null;

            // règle pour categoriefournisseur
            if ($args['categoriefournisseur'] === 'AON') {
                $fourcat = 'FLOC';
            } elseif ($args['categoriefournisseur'] === 'AOI') {
                $fourcat = 'FETR';
            }

            if ($fourcat) {
                // si categoriefournisseur est une relation -> whereHas
                $query = $query->whereHas('categoriefournisseur', function ($q) use ($fourcat) {
                    $q->where('designation', $fourcat);
                });
            }
        }

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }




    public static function getQueryFabricant($args)
    {
        $query =  Fabricant::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }
    // getQueryTypeattachement

    public static function getQueryTypeattachement($args)
    {
        $query =  Typeattachement::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryAofournisseur

    public static function getQueryAofournisseur($args)
    {
        $query =  Aofournisseur::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }
    // getQueryTypeao

    public static function getQueryTypeao($args)
    {
        $query =  Typeao::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryTypeprocedure

    public static function getQueryTypeprocedure($args)
    {
        $query =  Typeprocedure::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryParcourmarche($args)
    {
        $query =  Parcourmarche::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryTypemarchedetail($args)
    {
        $query =  Typemarchedetail::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryHistoriqueaffectation

    public static function getQueryHistoriqueaffectation($args)
    {
        $query =  Historiqueaffectation::query();

        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['date'])) {
            $query = $query->where('date', Outil::getOperateurLikeDB(), '%' . $args['date'] . '%');
        }

        if (isset($args['antenne_id'])) {
            $query = $query->where('antenne_id', $args['antenne_id']);
        }

        if (isset($args['user_id'])) {
            $query = $query->where('user_id', $args['user_id']);
        }


        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryTypecondition

    public static function getQueryTypecondition($args)
    {
        $query =  Typecondition::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }
    // getQueryPays

    public static function getQueryPays($args)
    {
        $query =  Pays::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }
    // getQueryTypefournisseur

    public static function getQueryTypefournisseur($args)
    {
        $query =  Typefournisseur::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryAo

    public static function getQueryAo($args)
    {
        $query =  Ao::query();
        // dd($query->get());
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['date'])) {
            $query = $query->where('date', Outil::getOperateurLikeDB(), '%' . $args['date'] . '%');
        }
        if (isset($args['reference'])) {
            $query = $query->where('reference', Outil::getOperateurLikeDB(), '%' . $args['reference'] . '%');
        }
        if (isset($args['typeao_id'])) {
            $query = $query->where('typeao_id', $args['typeao_id']);
        }
        if (isset($args['typeprocedure_id'])) {
            $query = $query->where('typeprocedure_id', $args['typeprocedure_id']);
        }
        if (isset($args['fournisseur_id'])) {
            $fournisseur  = Fournisseur::find($args['fournisseur_id']);
            if (isset($fournisseur) && isset($fournisseur->TSSCOD_0_0)) {
                $query = $query->join('das', 'das.id', 'aos.da_id')
                    ->where('das.TSSCOD_0_0', Outil::getOperateurLikeDB(), '%' . $fournisseur->TSSCOD_0_0 . '%')
                    ->selectRaw('aos.*');
            }

            if (isset($args['soumission'])) {
                $query = $query
                    ->join('soumissions', 'soumissions.ao_id', 'aos.id')
                    ->where('soumissions.fournisseur_id', $args['fournisseur_id'])
                    ->selectRaw('aos.*');
            }
        }
        if (isset($args['datepublication'])) {
            $query = $query->where('datepublication', Outil::getOperateurLikeDB(), '%' . $args['datepublication'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryAoarticle

    public static function getQueryAoarticle($args)
    {
        $query =  Aoarticle::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['margevaleur'])) {
            $query = $query->where('margevaleur', Outil::getOperateurLikeDB(), '%' . $args['margevaleur'] . '%');
        }
        if (isset($args['margepourcentage'])) {
            $query = $query->where('margepourcentage', Outil::getOperateurLikeDB(), '%' . $args['margepourcentage'] . '%');
        }
        if (isset($args['ao_id'])) {
            $query = $query->where('ao_id', $args['ao_id']);
        }
        if (isset($args['article_id'])) {
            $query = $query->where('article_id', $args['article_id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }
    // getQueryDetailcommande

    public static function getQueryDetailcommande($args)
    {
        $query =  Detailcommande::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['commande_id'])) {
            $query = $query->where('commande_id', $args['commande_id']);
        }
        if (isset($args['article_id'])) {
            $query = $query->where('article_id', $args['article_id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }
    // getQueryTypeclient

    public static function getQueryTypeclient($root, $args)
    {
        $query = Typeclient::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        if (isset($args['description'])) {
            $query = $query->where('description', Outil::getOperateurLikeDB(), '%' . $args['description'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');

        return $query;
    }

    // getQueryProgramme

    public static function getQueryProgramme($agrs)
    {
        $query =  Programme::query();
        $query = $query->orderBy('id', 'DESC');

        return $query;
    }

    // getQueryCategorieclient

    public static function getQueryCategorieclient($root, $args)
    {
        $query = Categorieclient::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        if (isset($args['description'])) {
            $query = $query->where('description', Outil::getOperateurLikeDB(), '%' . $args['description'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');

        return $query;
    }

    // getQueryTypelivraison


    // getQueryEquipegestion

    public static function getQueryEquipegestion($args)
    {
        $query = Equipegestion::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        if (isset($args['description'])) {
            $query = $query->where('description', Outil::getOperateurLikeDB(), '%' . $args['description'] . '%');
        }
        // dd($query->toSql(), "query", $query->get());

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryBailleurprogramme

    public static function getQueryBailleurprogramme($args)
    {
        $query = Bailleurprogramme::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    // getQueryBailleur

    public static function getQueryBailleur($args)
    {
        $query = Bailleur::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        if (isset($args['description'])) {
            $query = $query->where('description', Outil::getOperateurLikeDB(), '%' . $args['description'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    // getQueryClienttypeclient

    public static function getQueryClienttypeclient($args)
    {
        $query = Clienttypeclient::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['client_id'])) {
            $query = $query->where('client_id', $args['client_id']);
        }
        if (isset($args['typeclient_id'])) {
            $query = $query->where('typeclient_id', $args['typeclient_id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryCampagne

    public static function getQueryCampagne($args)
    {
        $query = Campagne::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        if (isset($args['description'])) {
            $query = $query->where('description', Outil::getOperateurLikeDB(), '%' . $args['description'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }




    // getQueryEquipegestionpersonnel
    public static function getQueryEquipegestionpersonnel($args)
    {
        $query = Equipegestionpersonnel::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['equipegestion_id'])) {
            $query = $query->where('equipegestion_id', $args['equipegestion_id']);
        }
        if (isset($args['personnel_id'])) {
            $query = $query->where('personnel_id', $args['personnel_id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }





    public static function getQueryTypelivraison($args)
    {
        $query = Typelivraison::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        if (isset($args['description'])) {
            $query = $query->where('description', Outil::getOperateurLikeDB(), '%' . $args['description'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');

        return $query;
    }

    // getQueryArticle

    public static function getQueryArticle($args)
    {
        $query = Article::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['id']) && isset($args['moismin']) && isset($args['moismax'])) {
            // On stocke dans une propriété dynamique pour l’utiliser plus tard
            $query->get()->each(function ($article) use ($args) {
                $article->moismin = $args['moismin'];
                $article->moismax = $args['moismax'];
            });
        }


        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }

        if (isset($args['description'])) {
            $query = $query->where('description', Outil::getOperateurLikeDB(), '%' . $args['description'] . '%');
        }

        if (isset($args['prix'])) {
            $query = $query->where('prix', Outil::getOperateurLikeDB(), '%' . $args['prix'] . '%');
        }

        if (isset($args['quantite'])) {
            $query = $query->where('quantite', Outil::getOperateurLikeDB(), '%' . $args['quantite'] . '%');
        }

        if (isset($args['categorie_id'])) {
            $query = $query->where('categorie_id', $args['categorie_id']);
        }
        if (isset($args['COURTEDUREE_0'])) {
            $query = $query->where('COURTEDUREE_0', $args['COURTEDUREE_0']);
        }
        if (isset($args['COURTEDUREE_0_id'])) {
            $query = $query->where('COURTEDUREE_0', $args['COURTEDUREE_0_id']);
        }

        if (isset($args['TCLCOD_0_id']) || isset($args['TCLCOD_0'])) {
            $tlscode = isset($args['TCLCOD_0_id']) ? $args['TCLCOD_0_id'] : $args['TCLCOD_0'];
            $cat = '';
            if ($tlscode == 1) {
                $cat = 'MEDIC';
            }
            if ($tlscode == 2) {
                $cat = 'BIENS';
            }
            if ($tlscode == 3) {
                $cat = 'SERV';
            }
            $categorie = Categorie::where('designation', $cat)->first();
            if (isset($categorie)) {
                $query = $query->where('categorie_id', $categorie->id);
            }
        }

        // code 
        if (isset($args['code'])) {
            $query = $query->where('code', Outil::getOperateurLikeDB(), '%' . $args['code'] . '%');
        }





        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    public static function getQueryDa($args)
    {
        $query = Da::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }

        $query = $query->orderBy('id', 'DESC');

        return $query;
    }

    public static function getQueryDetailsda($args)
    {
        $query = Detailsda::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['da_id'])) {
            $query = $query->where('da_id', $args['da_id']);
        }

        $query = $query->orderBy('id', 'DESC');

        return $query;
    }

    public static function getQueryDaofournisseur($args)
    {
        $query = Daofournisseur::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['da_id'])) {
            $query = $query->where('da_id', $args['da_id']);
        }

        $query = $query->orderBy('id', 'DESC');

        return $query;
    }

    //getQueryCommande
    public static function getQueryCommande($args)
    {
        $query = Commande::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['datecommande'])) {
            $query = $query->where('datecommande', Outil::getOperateurLikeDB(), '%' . $args['datecommande'] . '%');
        }

        if (isset($args['datereception'])) {
            $query = $query->where('datereception', Outil::getOperateurLikeDB(), '%' . $args['datereception'] . '%');
        }

        if (isset($args['statut'])) {
            $query = $query->where('statut', $args['statut']);
        }

        if (isset($args['client_id'])) {
            $query = $query->where('client_id', $args['client_id']);
        }
        // campagne_id
        if (isset($args['campagne_id'])) {
            $query = $query->where('campagne_id', $args['campagne_id']);
        }

        // bailleur_id  filtre les commandde dont la campagne a sur son programme (bailleurprogrmmae) le bailleur bailleur_id

        if (isset($args['bailleur_id'])) {
            $query = $query->whereHas('campagne.programme.bailleurprogrammes', function ($q) use ($args) {
                $q->where('bailleurprogrammes.bailleur_id', $args['bailleur_id']);
            });
        }


        if (isset($args['typelivraison_id'])) {
            $query = $query->where('typelivraison_id', $args['typelivraison_id']);
        }

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    // getQueryPhasedepot

    public static function getQueryPhasedepot($args)
    {
        $query = Phasedepot::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        // datedeb
        if (isset($args['datedeb'])) {
            $query = $query->where('datedeb', Outil::getOperateurLikeDB(), '%' . $args['datedeb'] . '%');
        }

        // datefin
        if (isset($args['datefin'])) {
            $query = $query->where('datefin', Outil::getOperateurLikeDB(), '%' . $args['datefin'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');

        return $query;
    }

    // getQueryPersonnel

    public static function getQueryPersonnel($args)
    {
        $query = Personnel::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['nom'])) {
            $query = $query->where('nom', Outil::getOperateurLikeDB(), '%' . $args['nom'] . '%');
        }
        if (isset($args['prenom'])) {
            $query = $query->where('prenom', Outil::getOperateurLikeDB(), '%' . $args['prenom'] . '%');
        }
        if (isset($args['poste'])) {
            $query = $query->where('poste', Outil::getOperateurLikeDB(), '%' . $args['poste'] . '%');
        }
        if (isset($args['telephone'])) {
            $query = $query->where('telephone', Outil::getOperateurLikeDB(), '%' . $args['telephone'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');

        return $query;
    }

    public static function getQueryHistogrammehebdommadaire($root, $args)
    {
        $query = User::query();

        // $query = $query->whereHas('Role', function ($query) {
        //     $query->where('isplanning', 1);
        // });

        if (isset($args['date'])  && !isset($args['datefin'])) {
            $query->whereHas('visites', function ($query) use ($args) {
                $query->where('date', Outil::getOperateurLikeDB(), '%' . $args['date'] . '%');
            });
        }

        if (isset($args['date']) && isset($args['datefin'])) {
            $query->whereHas('visites', function ($query) use ($args) {
                $query->whereBetween('date', [$args['date'], $args['datefin']]);
            });
        }

        //  order par user qui a plus de visite
        $query = $query->withCount(['visites' => function ($query) use ($args) {
            if (isset($args['date'])  && !isset($args['datefin'])) {
                $query->where('date', Outil::getOperateurLikeDB(), '%' . $args['date'] . '%');
            }

            if (isset($args['date']) && isset($args['datefin'])) {
                $query->whereBetween('date', [$args['date'], $args['datefin']]);
            }
        }])->orderBy('visites_count', 'desc');
        return $query;
    }

    public static function getQueryUnite($agrs)
    {
        $query = Unite::query();
        if (isset($agrs['id'])) {
            $query = $query->where('id', $agrs['id']);
        }
        if (isset($agrs['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $agrs['designation'] . '%');
        }

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    public static function getQueryProvince($agrs)
    {
        $query = Province::query();
        if (isset($agrs['id'])) {
            $query = $query->where('id', $agrs['id']);
        }
        if (isset($agrs['province'])) {
            $query = $query->where('province', Outil::getOperateurLikeDB(), '%' . $agrs['province'] . '%');
        }

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryAxe($agrs)
    {
        $query = Axe::query();
        if (isset($agrs['id'])) {
            $query = $query->where('id', $agrs['id']);
        }
        if (isset($agrs['province_id'])) {
            $query = $query->where('province_id', $agrs['province_id']);
        }


        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryTypemarche($agrs)
    {
        $query = Typemarche::query();
        if (isset($agrs['id'])) {
            $query = $query->where('id', $agrs['id']);
        }
        if (isset($agrs['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $agrs['designation'] . '%');
        }

        if (isset($agrs['code'])) {
            $query = $query->where('code', $agrs['code']);
        }



        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    //  $query = QueryModel::getQueryCashflow($args);
    // 

    public static function getQueryCashflow($args)
    {
        $query = Visite::selectRaw('
        EXTRACT(WEEK FROM created_at)::integer AS week,
        DATE_TRUNC(\'week\', created_at)::date AS date_debut,
        (DATE_TRUNC(\'week\', created_at) + INTERVAL \'6 days\')::date AS date_fin,
        SUM(montantencaissement) AS total_encaissements,
        COUNT(*) AS count
    ')
            ->groupBy(DB::raw('EXTRACT(WEEK FROM created_at), DATE_TRUNC(\'week\', created_at)'))
            ->orderBy('date_debut', 'desc');

        // Si l'utilisateur fournit une période
        if (isset($args['date'])) {
            $query->whereDate('created_at', '>=', $args['date']);
        }

        if (isset($args['datefin'])) {
            $query->whereDate('created_at', '<=', $args['datefin']);
        }

        // Si aucune date n'est fournie, on filtre sur le dernier mois où il y a eu des encaissements
        if (!isset($args['date']) && !isset($args['datefin'])) {
            $lastMonth = Visite::where('montantencaissement', '>', 0)
                ->selectRaw("DATE_TRUNC('month', created_at) AS month")
                ->orderByRaw("month DESC")
                ->limit(1)
                ->first();

            if ($lastMonth) {
                $start = Carbon::parse($lastMonth->month)->startOfMonth();
                $end = Carbon::parse($lastMonth->month)->endOfMonth();
                $query->whereBetween('created_at', [$start, $end]);
            } else {
                // Aucune donnée disponible => renvoie une requête vide
                $query->whereRaw('1=0');
            }
        }

        return $query;
    }


    public static function getOderDynamic($query, $args, $model)
    {

        $table_name  = $model->table;
        if (isset($args['order'])) {
            $order  = explode(',', $args['order']);

            if (isset($order)) {
                foreach ($order as $key => $val) {

                    if (isset($val) && !empty($val)) {
                        $direction = 'DESC';

                        if (isset($args['direction'])) {
                            $direction  = $args['direction'];
                        }

                        if (Schema::hasColumn($table_name, $val . "_id")) {
                            $table_foreign      = $val . 's';
                            $idForeign          = $val . "_id";
                            $collumnForeign     = 'id';

                            if (Schema::hasTable($table_foreign)) {
                                if (Schema::hasColumn($table_foreign, "designation")) {
                                    $collumnForeign = 'designation';
                                } else {
                                    if ($table_foreign == 'clients') {
                                        $collumnForeign = 'raison_sociale';
                                    }
                                }
                                if (!self::joined($query, $table_foreign)) {
                                    $query          = $query->join($table_foreign, $table_foreign . '.id', $table_name . '.' . $idForeign);
                                }

                                $query->orderBy($table_foreign . '.' . $collumnForeign, $direction);
                            }
                        } else if (Schema::hasColumn($table_name, $val)) {
                            $query->orderBy($table_name . '.' . $val, $direction);
                        }
                    }
                }
            }
        } else {
            $query->orderBy($table_name . '.id', 'desc');
        }

        return $query;
    }


    //********************************************************************************** */
    public static function getQueryPlanning($args)
    {
        $query = Planning::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['user_id'])) {
            $query = $query->whereHas('users', function ($q) use ($args) {
                $q->where('users.id', $args['user_id']);
            });
        }

        if (isset($args['date'])) {
            $query = $query->where('date', Outil::getOperateurLikeDB(), '%' . $args['date'] . '%');
        }
        if (isset($args['datesemaine'])) {
            $query = $query->where('datesemaine', Outil::getOperateurLikeDB(), '%' . $args['datesemaine'] . '%');
        }
        if (isset($args['status'])) {
            $query = $query->where('status', $args['status']);
        }
        if (isset($args['commentaire'])) {
            $query = $query->where('commentaire', Outil::getOperateurLikeDB(), '%' . $args['commentaire'] . '%');
        }
        if (isset($args['address'])) {
            $query = $query->where('address', Outil::getOperateurLikeDB(), '%' . $args['address'] . '%');
        }
        if (isset($args['budget'])) {
            $query = $query->where('budget', $args['budget']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryEquipement($args)
    {
        $query = Equipement::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        if (isset($args['description'])) {
            $query = $query->where('description', Outil::getOperateurLikeDB(), '%' . $args['description'] . '%');
        }
        if (isset($args['image'])) {
            $query = $query->where('image', Outil::getOperateurLikeDB(), '%' . $args['image'] . '%');
        }
        if (isset($args['est_activer'])) {
            $query = $query->where('est_activer', $args['est_activer']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryCategorie($agrs)
    {
        $query = Categorie::query();
        if (isset($agrs['id'])) {
            $query = $query->where('id', $agrs['id']);
        }
        if (isset($agrs['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $agrs['designation'] . '%');
        }

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryCategoriefournisseur($agrs)
    {
        $query = Categoriefournisseur::query();
        if (isset($agrs['id'])) {
            $query = $query->where('id', $agrs['id']);
        }
        if (isset($agrs['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $agrs['designation'] . '%');
        }

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }



    // getQueryHistogrammebestcom

    public static function getQueryHistogramme($args)
    {
        $query = Detaillivraison::query();
        $query = $query->with('produit')->select('produit_id')
            ->selectRaw('SUM(quantite) as quantite_totale')
            ->selectRaw('SUM(quantite * prix) as chiffre_affaires')
            ->groupBy('produit_id');

        $orderDirection = 'desc';
        if (isset($args['order'])) {
            $orderDirection = strtolower(trim($args['order'], '"\''));
            if (!in_array($orderDirection, ['asc', 'desc'])) {
                $orderDirection = 'desc'; // fallback to default
            }
        }


        if (isset($args['date']) && isset($args['datefin'])) {
            $query = $query->whereHas('visite', function ($q) use ($args) {
                $q->whereBetween('date', [$args['date'], $args['datefin']]);
            });
        }

        if (isset($args['date']) && !isset($args['datefin'])) {
            $query = $query->whereHas('visite', function ($q) use ($args) {
                $q->where('date', Outil::getOperateurLikeDB(), '%' . $args['date'] . '%');
            });
        }


        if (isset($args['commercial_id'])) {
            $query = $query->whereHas('visite', function ($q) use ($args) {
                $q->where('commercial_id', $args['commercial_id']);
            });
        }

        $query = $query->orderBy('quantite_totale', $orderDirection);

        return $query;
    }

    // getQueryPlanninguser

    public static function getQueryPlanninguser($args)
    {
        $query = Planninguser::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['planning_id'])) {
            $query = $query->where('planning_id', $args['planning_id']);
        }
        if (isset($args['user_id'])) {
            $query = $query->where('user_id', $args['user_id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryTypepointdevente

    public static function getQueryTypepointdevente($agrs)
    {
        $query = Typepointdevente::query();
        if (isset($agrs['id'])) {
            $query = $query->where('id', $agrs['id']);
        }
        if (isset($agrs['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $agrs['designation'] . '%');
        }
        if (isset($agrs['description'])) {
            $query = $query->where('description', Outil::getOperateurLikeDB(), '%' . $agrs['description'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryCategoriepointdevente($agrs)
    {
        $query = Categoriepointdevente::query();
        if (isset($agrs['id'])) {
            $query = $query->where('id', $agrs['id']);
        }
        if (isset($agrs['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $agrs['designation'] . '%');
        }
        if (isset($agrs['description'])) {
            $query = $query->where('description', Outil::getOperateurLikeDB(), '%' . $agrs['description'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryPreference($args)
    {
        $query = Preference::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['nbreutilisateur'])) {
            $query = $query->where('nbreutilisateur', Outil::getOperateurLikeDB(), '%' . $args['nbreutilisateur'] . '%');
        }
        if (isset($args['ninea'])) {
            $query = $query->where('ninea', Outil::getOperateurLikeDB(), '%' . $args['ninea'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryDemande($args)
    {
        $query = Demande::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['commercial_id'])) {
            $query = $query->where('commercial_id', $args['commercial_id']);
        }
        if (isset($args['pointdevente_id'])) {
            $query = $query->where('pointdevente_id', $args['pointdevente_id']);
        }
        if (isset($args['date'])) {
            $query = $query->where('date', Outil::getOperateurLikeDB(), '%' . $args['date'] . '%');
        }
        if (isset($args['etat'])) {
            $query = $query->where('etat', $args['etat']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryHistogrammebestproduit($args)
    {
        $query = Produit::query();

        $query = $query->leftJoin('detaillivraisons', 'produits.id', '=', 'detaillivraisons.produit_id')
            ->selectRaw('produits.*, COALESCE(SUM(detaillivraisons.quantite), 0) as total_quantite')
            ->groupBy('produits.id', 'produits.*')
            ->orderBy('total_quantite', 'desc');
        // limite 10
        $query = $query->limit(10);
        return $query;
    }


    public static function getQueryProduit($args)
    {
        $query = Produit::query();
        // $query = $query->where('isdisplay', 1);
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }

        if (isset($args['description'])) {
            $query = $query->where('description', Outil::getOperateurLikeDB(), '%' . $args['description'] . '%');
        }

        if (isset($args['code'])) {
            $query = $query->where('code', Outil::getOperateurLikeDB(), '%' . $args['code'] . '%');
        }

        if (isset($args['categorie_id'])) {
            $query = $query->where('categorie_id', $args['categorie_id']);
        }

        if (isset($args['prix'])) {
            $query = $query->where('prix', $args['prix']);
        }


        if (isset($args['est_activer'])) {
            $query = $query->where('est_activer', $args['est_activer']);
        }

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryUserzone
    public static function getQueryUserzone($args)
    {
        $query = Userzone::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }

        // zone_id
        if (isset($args['zone_id'])) {
            $query = $query->where('zone_id', $args['zone_id']);
        }
        // user_id
        if (isset($args['user_id'])) {
            $query = $query->where('user_id', $args['user_id']);
        }
        // date
        if (isset($args['date'])) {
            $query = $query->where('date', Outil::getOperateurLikeDB(), '%' . $args['date'] . '%');
        }





        $query = $query->orderBy('id', 'DESC');
        return $query;
    }




    public static function getQueryCategorietarifaire($agrs)
    {
        $query = Categorietarifaire::query();
        if (isset($agrs['id'])) {
            $query = $query->where('id', $agrs['id']);
        }
        if (isset($agrs['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $agrs['designation'] . '%');
        }
        if (isset($agrs['description'])) {
            $query = $query->where('description', Outil::getOperateurLikeDB(), '%' . $agrs['description'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }
    // getQueryPlanningequipement
    public static function getQueryPlanningequipement($args)
    {
        $query = Planningequipement::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['planning_id'])) {
            $query = $query->where('planning_id', $args['planning_id']);
        }
        if (isset($args['equipement_id'])) {
            $query = $query->where('equipement_id', $args['equipement_id']);
        }
        if (isset($args['quantite'])) {
            $query = $query->where('quantite', $args['quantite']);
        }
        // commercial_id

        // if (isset($args['commercial_id'])) {
        //     $query = $query->whereHas('planning', function ($query) use ($args) {
        //         $query->where('user_id', $args['commercial_id']);
        //     });
        // }

        if (isset($args['commercial_id'])) {
            $query = $query->whereHas('planning.users', function ($q) use ($args) {
                $q->where('users.id', $args['commercial_id']);
            });
        }


        if (isset($args['date'])  && !isset($args['datefin'])) {
            $query = $query->whereHas('planning', function ($query) use ($args) {
                $query->where('date', Outil::getOperateurLikeDB(), '%' . $args['date'] . '%');
            });
        }

        if (!isset($args['date'])  && !isset($args['datefin'])) {
            $query = $query->whereHas('planning', function ($query) use ($args) {
                $query->where('date', '=', Carbon::now());
            });
        }

        // date datedeb

        if (isset($args['date']) && isset($args['datefin'])) {
            $query = $query->whereHas('planning', function ($query) use ($args) {
                $query->whereBetween('date', [$args['date'], $args['datefin']]);
            });
        }
        if (isset($args['visite_id'])) {
            $query = $query->where('visite_id', $args['visite_id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryPlanningproduit($args)
    {
        $query = Planningproduit::query();

        if (isset($args['client_id'])) {
            $client = Client::find($args['client_id']);
            if ($client) {
                $categorietarifaire = Categorietarifaire::find($client->categorietarifaire_id);
                if ($categorietarifaire) {
                    $query = $query->whereHas('produit.categorietarifaireproduits', function ($q) use ($categorietarifaire) {
                        $q->where('categorietarifaireproduits.categorietarifaire_id', $categorietarifaire->id);
                    });

                    $query = $query->leftJoin('categorietarifaireproduits', function ($join) use ($categorietarifaire) {
                        $join->on('categorietarifaireproduits.produit_id', '=', 'planningproduits.produit_id')
                            ->where('categorietarifaireproduits.categorietarifaire_id', $categorietarifaire->id);
                    })->select('planningproduits.*', 'categorietarifaireproduits.prix as prix_tarifaire');
                }
            }
        }

        if (isset($args['unite_id'])) {
            $query = $query->whereHas('produit.categorietarifaireproduits', function ($q) use ($args) {
                $q->where('categorietarifaireproduits.unite_id', $args['unite_id']);
            });
        }

        if (isset($args['id'])) {
            $query = $query->where('planningproduits.id', $args['id']);
        }
        if (isset($args['planning_id'])) {
            $query = $query->where('planningproduits.planning_id', $args['planning_id']);
        }
        if (isset($args['produit_id'])) {
            $query = $query->where('planningproduits.produit_id', $args['produit_id']);
        }

        if (isset($args['visite_id'])) {
            $visite = Visite::find($args['visite_id']);
            $query = $query->where('planningproduits.planning_id', $visite->planning_id);
        }

        if (isset($args['commercial_id'])) {
            $query = $query->whereHas('planning.users', function ($q) use ($args) {
                $q->where('users.id', $args['commercial_id']);
            });
        }

        if (isset($args['date']) && !isset($args['datefin'])) {
            $query = $query->whereHas('planning', function ($query) use ($args) {
                $query->where('date', Outil::getOperateurLikeDB(), '%' . $args['date'] . '%');
            });
        }

        if (!isset($args['date']) && !isset($args['datefin'])) {
            $query = $query->whereHas('planning', function ($query) use ($args) {
                $query->where('date', '=', Carbon::now());
            });
        }

        if (isset($args['date']) && isset($args['datefin'])) {
            $query = $query->whereHas('planning', function ($query) use ($args) {
                $query->whereBetween('date', [$args['date'], $args['datefin']]);
            });
        }

        $query = $query->orderBy('planningproduits.id', 'DESC');
        return $query;
    }

    public static function getQueryTypeencaissement($agrs)
    {
        $query = Typeencaissement::query();
        if (isset($agrs['id'])) {
            $query = $query->where('id', $agrs['id']);
        }
        if (isset($agrs['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $agrs['designation'] . '%');
        }
        if (isset($agrs['code'])) {
            $query = $query->where('code', Outil::getOperateurLikeDB(), '%' . $agrs['code'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryModepaiement($args)
    {
        $query = Modepaiement::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        if (isset($args['desc'])) {
            $query = $query->where('desc', Outil::getOperateurLikeDB(), '%' . $args['desc'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryAntenne

    public static function getQueryAntenne($agrs)
    {
        $query = Antenne::query();
        if (isset($agrs['id'])) {
            $query = $query->where('id', $agrs['id']);
        }
        if (isset($agrs['designation'])) {
            $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $agrs['designation'] . '%');
        }
        if (isset($agrs['code'])) {
            $query = $query->where('code', Outil::getOperateurLikeDB(), '%' . $agrs['code'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    public static function getQueryDocumentdao($agrs)
    {
        $query = Documentdao::query();
        if (isset($agrs['id'])) {
            $query = $query->where('id', $agrs['id']);
        }

        if (isset($agrs['da_id'])) {
            $query = $query->where('da_id', $agrs['da_id']);
        }


        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryHistogrammebestclient($args)
    {
        $query = Pointdevente::query();

        $query = $query->leftJoin('visites', 'pointdeventes.id', '=', 'visites.pointdevente_id')
            ->leftJoin('detaillivraisons', 'visites.id', '=', 'detaillivraisons.visite_id')
            ->selectRaw('pointdeventes.*, COALESCE(SUM(detaillivraisons.quantite), 0) as total_quantite')
            ->selectRaw('pointdeventes.*, COALESCE(SUM(detaillivraisons.quantite * detaillivraisons.prix), 0) as ca')
            ->groupBy('pointdeventes.id')
            ->orderBy('total_quantite', 'desc');
        // limite 10


        if (isset($args['date']) && !isset($args['datefin'])) {
            $query->whereDate('visites.date', $args['date']);
        }

        if (isset($args['date']) && isset($args['datefin'])) {
            $query->whereBetween('visites.date', [$args['date'], $args['datefin']]);
        }
        $query = $query->limit(10);

        return $query;
    }


    public static function getQueryEncaissement($args)
    {
        $query = Encaissement::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['numfacture'])) {
            $query = $query->where('numfacture', Outil::getOperateurLikeDB(), '%' . $args['numfacture'] . '%');
        }
        if (isset($args['montantaregle'])) {
            $query = $query->where('montantaregle', $args['montantaregle']);
        }
        if (isset($args['montantrecouv'])) {
            $query = $query->where('montantrecouv', $args['montantrecouv']);
        }
        if (isset($args['montantregl'])) {
            $query = $query->where('montantregl', $args['montantregl']);
        }
        if (isset($args['typeencaissement_id'])) {
            $query = $query->where('typeencaissement_id', $args['typeencaissement_id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryDetailmateriel($args)
    {
        $query = Detailmateriel::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['equipement_id'])) {
            $query = $query->where('equipement_id', $args['equipement_id']);
        }
        if (isset($args['type'])) {
            $query = $query->where('type', $args['type']);
        }
        if (isset($args['quantite'])) {
            $query = $query->where('quantite', $args['quantite']);
        }
        if (isset($args['visite_id'])) {
            $query = $query->where('visite_id', $args['visite_id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryPlanningzone($args)
    {
        $query = Planningzone::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['planning_id'])) {
            $query = $query->where('planning_id', $args['planning_id']);
        }
        if (isset($args['zone_id'])) {
            $query = $query->where('zone_id', $args['zone_id']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryDetaillivraison($args)
    {
        $query = Detaillivraison::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        // if (isset($args['planning_id'])) {
        //     $query = $query->where('planning_id', $args['planning_id']);
        // }
        if (isset($args['produit_id'])) {
            $query = $query->where('produit_id', $args['produit_id']);
        }
        if (isset($args['quantite'])) {
            $query = $query->where('quantite', $args['quantite']);
        }
        if (isset($args['est_activer'])) {
            $query = $query->where('est_activer', $args['est_activer']);
        }
        $query = $query->orderBy('quantite', 'DESC');
        return $query;
    }
    // getQueryBl

    public static function getQueryBl($root, $args)
    {
        $query = Bl::query();

        $user = Auth::user();
        // dd($query->get());
        // if (isset($user) && isset($user->role_id)) {
        //     $role = Role::find($user->role_id);
        //     if (isset($role) && isset($role->ischantenne) && $role->ischantenne == 1) {
        //         $query = $query->whereHas('commercial', function ($query) use ($user) {
        //             $query->where('antenne_id', $user->antenne_id);
        //         });
        //     }
        // }




        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }


        if (isset($args['date'])  && !isset($args['datefin'])) {
            $query = $query->where('date', Outil::getOperateurLikeDB(), '%' . $args['date'] . '%');
        }

        if (isset($args['date']) && isset($args['datefin'])) {
            $query = $query->whereBetween('date', [$args['date'], $args['datefin']]);
        }

        // issend

        if (isset($args['issend'])) {
            $query = $query->where('issend', $args['issend']);
        }


        if (isset($args['commercial_id'])) {
            $query = $query->where('commercial_id', $args['commercial_id']);
        }


        if (isset($args['antenne_id'])) {
            $query = $query->whereHas('commercial', function ($query) use ($args) {
                $query->where('antenne_id', $args['antenne_id']);
            });
        }



        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    // getQueryDetailbl

    public static function getQueryDetailbl($args)
    {
        $query = Detailbl::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['bl_id'])) {
            $query = $query->where('bl_id', $args['bl_id']);
        }
        if (isset($args['date'])) {
            $query = $query->where('date', Outil::getOperateurLikeDB(), '%' . $args['date'] . '%');
        }
        if (isset($args['produit_id'])) {
            $query = $query->where('produit_id', $args['produit_id']);
        }
        if (isset($args['commercial_id'])) {
            $query = $query->where('commercial_id', $args['commercial_id']);
        }
        if (isset($args['pointdevente_id'])) {
            $query = $query->where('pointdevente_id', $args['pointdevente_id']);
        }
        if (isset($args['quantite'])) {
            $query = $query->where('quantite', $args['quantite']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    public static function getQueryVisite($root, $args)
    {
        $query = Visite::query();

        $user = Auth::user();


        if (isset($args['commercial_id'])) {
            $query = $query->whereHas('commercial', function ($query) use ($args) {
                $query->where('id', $args['commercial_id']);
            });
        }

        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }

        if (isset($args['pointdevente_id'])) {
            $query = $query->whereHas('pointdevente', function ($query) use ($args) {
                $query->where('id', $args['pointdevente_id']);
            });
        }
        if (isset($args['zone_id'])) {
            $query = $query->whereHas('pointdevente', function ($query) use ($args) {
                $query->where('zone_id', $args['zone_id']);
            });
        }

        if (isset($args['antenne_id'])) {
            $query = $query->whereHas('pointdevente', function ($query) use ($args) {
                $query->whereHas('zone', function ($query) use ($args) {
                    $query->where('antenne_id', $args['antenne_id']);
                });
            });
        }





        if (isset($args['voiture_id'])) {
            $plannings = Planning::where('voiture_id', $args['voiture_id'])->get();

            if ($plannings) {
                $query = $query->whereIn('planning_id', collect($plannings)->pluck('id')->toArray());
            }
        }


        if (isset($args['date'])  && !isset($args['datefin'])) {
            $query = $query->where('date', Outil::getOperateurLikeDB(), '%' . $args['date'] . '%');
        }

        if (isset($args['date']) && isset($args['datefin'])) {
            $query = $query->whereBetween('date', [$args['date'], $args['datefin']]);
        }



        if (isset($args['commentaire'])) {
            $query = $query->where('commentaire', Outil::getOperateurLikeDB(), '%' . $args['commentaire'] . '%');
        }
        if (isset($args['est_activer'])) {
            $query = $query->where('est_activer', $args['est_activer']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    public static function getQueryZoneplannifier($args)
    {
        $query = Planningzone::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['planning_id'])) {
            $query = $query->where('planning_id', $args['planning_id']);
        }
        if (isset($args['zone_id'])) {
            $query = $query->where('zone_id', $args['zone_id']);
        }
        if (isset($args['user_id'])) {
            $query = $query->whereHas('planning.users', function ($q) use ($args) {
                $q->where('users.id', $args['user_id'])
                    ->where('date', '=', Carbon::now());
            });
        }


        //datedebutsemaine
        if (isset($args['datedebut'])) {
            $query = $query->whereHas('planning', function ($query) use ($args) {
                $query->where('datesemaine', $args['datedebut']);
            });
        }

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    public static function getQueryVoiture($args)
    {
        $query = Voiture::query();
        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['matricule'])) {
            $query = $query->where('matricule', Outil::getOperateurLikeDB(), '%' . $args['matricule'] . '%');
        }
        if (isset($args['marque'])) {
            $query = $query->where('marque', Outil::getOperateurLikeDB(), '%' . $args['marque'] . '%');
        }
        if (isset($args['est_activer'])) {
            $query = $query->where('est_activer', $args['est_activer']);
        }
        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryProspect($args)
    {
        $query = Pointdevente::query();
        // les point dont l'etat = 0

        $query = $query->where('etat', 0);

        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['refactid'])) {
            // Récupérer le point de vente avec l'ID donné
            $pointDeVente = Pointdevente::findOrFail($args['refactid']);

            // Charger la relation visites
            $visites = $pointDeVente->visites();

            // Compter le nombre de détails de matériel associés à chaque visite
            $visites->withCount('detailmateriels')
                // Compter le nombre de détails de livraison associés à chaque visite
                ->withCount('detaillivraisons')
                // Compter le nombre de règlements associés à chaque visite (typeencaissement_id = 1)
                ->withCount(['encaissements as reglements_count' => function ($query) {
                    $query->where('typeencaissement_id', 1);
                }])
                // Compter le nombre de recouvrements associés à chaque visite (typeencaissement_id = 2)
                ->withCount(['encaissements as recouvrements_count' => function ($query) {
                    $query->where('typeencaissement_id', 2);
                }]);

            // Récupérer les données
            $query = $visites;
        }


        if (isset($args['ids_zone'])) {
            $query = $query->whereIn('zone_id', $args['ids_zone']);
        }

        if (isset($args['client_id'])) {
            $query = $query->where('client_id', $args['client_id']);
        }

        if (isset($args['numbcpttier'])) {
            $query = $query->where('numbcpttier', $args['numbcpttier']);
        }

        if (isset($args['zone_id'])) {
            $query = $query->where('zone_id', $args['zone_id']);
        }


        if (isset($args['description'])) {
            $query = $query = $query->where('description', Outil::getOperateurLikeDB(), '%' . $args['description'] . '%');
        }

        if (isset($args['intitule'])) {
            $query = $query = $query->where('intitule', Outil::getOperateurLikeDB(), '%' . $args['intitule'] . '%');
        }

        if (isset($args['designation'])) {
            $query = $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }


        if (isset($args['email'])) {
            $query = $query = $query->where('email', Outil::getOperateurLikeDB(), '%' . $args['email'] . '%');
        }

        if (isset($args['address'])) {
            $query = $query = $query->where('address', Outil::getOperateurLikeDB(), '%' . $args['address'] . '%');
        }


        if (isset($args['telephone'])) {
            $query = $query = $query->where('telephone', Outil::getOperateurLikeDB(), '%' . $args['telephone'] . '%');
        }

        if (isset($args['gps'])) {
            $query = $query = $query->where('gps', Outil::getOperateurLikeDB(), '%' . $args['gps'] . '%');
        }
        if (isset($args['images'])) {
            $query = $query = $query->where('image', Outil::getOperateurLikeDB(), '%' . $args['image'] . '%');
        }

        // estdivers

        if (isset($args['estdivers'])) {
            $query = $query->where('estdivers', $args['estdivers']);
        }


        if (isset($args['est_activer'])) {
            $query = $query = $query->where('est_activer', $args['est_activer']);
        }









        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    public static function getQueryPointdevente($args)
    {
        $query = Pointdevente::query();


        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['refactid'])) {
            // Récupérer le point de vente avec l'ID donné
            $pointDeVente = Pointdevente::findOrFail($args['refactid']);

            // Charger la relation visites
            $visites = $pointDeVente->visites();

            // Compter le nombre de détails de matériel associés à chaque visite
            $visites->withCount('detailmateriels')
                // Compter le nombre de détails de livraison associés à chaque visite
                ->withCount('detaillivraisons')
                // Compter le nombre de règlements associés à chaque visite (typeencaissement_id = 1)
                ->withCount(['encaissements as reglements_count' => function ($query) {
                    $query->where('typeencaissement_id', 1);
                }])
                // Compter le nombre de recouvrements associés à chaque visite (typeencaissement_id = 2)
                ->withCount(['encaissements as recouvrements_count' => function ($query) {
                    $query->where('typeencaissement_id', 2);
                }]);

            // Récupérer les données
            $query = $visites;
        }


        if (isset($args['ids_zone'])) {
            $query = $query->whereIn('zone_id', $args['ids_zone']);
        }

        if (isset($args['client_id'])) {
            $query = $query->where('client_id', $args['client_id']);
        }

        if (isset($args['numbcpttier'])) {
            $query = $query->where('numbcpttier', $args['numbcpttier']);
        }

        if (isset($args['zone_id'])) {
            $query = $query->where('zone_id', $args['zone_id']);
        }


        if (isset($args['description'])) {
            $query = $query = $query->where('description', Outil::getOperateurLikeDB(), '%' . $args['description'] . '%');
        }

        if (isset($args['intitule'])) {
            $query = $query = $query->where('intitule', Outil::getOperateurLikeDB(), '%' . $args['intitule'] . '%');
        }

        if (isset($args['designation'])) {
            $query = $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }


        if (isset($args['email'])) {
            $query = $query = $query->where('email', Outil::getOperateurLikeDB(), '%' . $args['email'] . '%');
        }

        if (isset($args['address'])) {
            $query = $query = $query->where('address', Outil::getOperateurLikeDB(), '%' . $args['address'] . '%');
        }


        if (isset($args['telephone'])) {
            $query = $query = $query->where('telephone', Outil::getOperateurLikeDB(), '%' . $args['telephone'] . '%');
        }

        if (isset($args['gps'])) {
            $query = $query = $query->where('gps', Outil::getOperateurLikeDB(), '%' . $args['gps'] . '%');
        }
        if (isset($args['images'])) {
            $query = $query = $query->where('image', Outil::getOperateurLikeDB(), '%' . $args['image'] . '%');
        }

        // estdivers

        if (isset($args['estdivers'])) {
            $query = $query->where('estdivers', $args['estdivers']);
        }


        if (isset($args['est_activer'])) {
            $query = $query = $query->where('est_activer', $args['est_activer']);
        }









        $query = $query->orderBy('id', 'DESC');
        return $query;
    }


    public static function getQueryZone($args)
    {
        $query = Zone::query();

        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['pointdevente_id'])) {
            $query = $query->where('pointdevente_id', $args['pointdevente_id']);
        }


        if (isset($args['descriptions'])) {
            $query = $query = $query->where('descriptions', Outil::getOperateurLikeDB(), '%' . $args['descriptions'] . '%');
        }

        if (isset($args['designation'])) {
            $query = $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }




        if (isset($args['est_activer'])) {
            $query = $query = $query->where('est_activer', $args['est_activer']);
        }









        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryClient($args)
    {

        $query = Client::query();

        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }

        if (isset($args['typeclient_id'])) {
            $query = $query
                ->join('clienttypeclients', 'clienttypeclients.client_id', 'clients.id')
                ->join('typeclients', 'typeclients.id', 'clienttypeclients.typeclient_id')
                ->where('typeclients.id', $args['typeclient_id'])
                ->selectRaw('clients.*');
        }


        $cat = Categorieclient::where('designation', 'INT')->first();
        if (isset($cat)) {
            $query = $query->where('categorieclient_id', '!=', $cat->id);
        }

        // designation

        if (isset($args['designation'])) {
            $query = $query = $query->where('designation', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }
        // telfixe

        if (isset($args['telfixe'])) {
            $query = $query = $query->where('telfixe', Outil::getOperateurLikeDB(), '%' . $args['telfixe'] . '%');
        }

        // telmobile

        if (isset($args['telmobile'])) {
            $query = $query = $query->where('telmobile', Outil::getOperateurLikeDB(), '%' . $args['telmobile'] . '%');
        }

        // region

        if (isset($args['region'])) {
            $query = $query = $query->where('region', Outil::getOperateurLikeDB(), '%' . $args['region'] . '%');
        }

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryZonepointdevente($args)
    {
        $query = Zonepointdevente::query();

        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }

        if (isset($args['zone_id'])) {
            $query = $query = $query->where('zone_id',  $args['zone_id']);
        }

        if (isset($args['pointdevente_id'])) {
            $query = $query = $query->where('pointdevente_id',  $args['pointdevente_id']);
        }

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryPermission($args)
    {
        $query = Permission::query();

        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }

        if (isset($args['name'])) {
            $query = $query = $query->where('name', Outil::getOperateurLikeDB(), '%' . $args['name'] . '%');
        }

        if (isset($args['display_name'])) {
            $query = $query = $query->where('display_name', Outil::getOperateurLikeDB(), '%' . $args['display_name'] . '%');
        }

        if (isset($args['designation'])) {
            $query = $query = $query->where('display_name', Outil::getOperateurLikeDB(), '%' . $args['designation'] . '%');
        }

        if (isset($args['activer'])) {
            $query = $query = $query->where('activer', $args['activer']);
        }
        if (isset($args['search'])) {
            $motRecherche  = $args['search'];
            $query->where(function ($query) use ($motRecherche) {
                return $query->where('name', Outil::getOperateurLikeDB(), '%' . $motRecherche . '%')
                    ->orWhere('display_name', Outil::getOperateurLikeDB(), '%' . $motRecherche . '%');
            });
        }

        $query = $query->orderBy('id', 'DESC');
        return $query;
    }

    public static function getQueryUser($args)
    {



        $query = User::query();

        $user = Auth::user();

        // compteclient $query dont les compteclient sont pas null

        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['role_id'])) {
            $query = $query->where('role_id', $args['role_id']);
        }
        if (isset($args['name'])) {
            $query = $query->where('name', Outil::getOperateurLikeDB(), '%' . $args['name'] . '%');
        }
        if (isset($args['email'])) {
            $query = $query->where('email', Outil::getOperateurLikeDB(), '%' . $args['email'] . '%');
        }
        if (isset($args['password'])) {
            $query = $query->where('password', Outil::getOperateurLikeDB(), '%' . $args['password'] . '%');
        }
        if (isset($args['search'])) {
            $query = $query->where('name', Outil::getOperateurLikeDB(), '%' . $args['search'] . '%')
                ->orWhere('email', Outil::getOperateurLikeDB(), '%' . $args['search'] . '%');
        }
        $query = $query->orderBy('id', 'DESC');

        return $query;
    }



    public static function getQueryRole($args)
    {
        $query = Role::query();

        if (isset($args['id'])) {
            $query = $query->where('id', $args['id']);
        }
        if (isset($args['name'])) {
            $query = $query->where('name', 'like', '%' . $args['name'] . '%');
        }
        if (isset($args['connected_user'])) {
            $user = Auth::user();
            $roleId = $user->roles->first()->id;
            $roles  = Role::find($roleId);
            if (isset($roles) && isset($roles->name) && $roles->name !== 'super-admin') {
                $query = $query->where('id', $roleId);
            }
        }


        $query = $query->orderBy('id', 'DESC');
        return $query;
    }
}
