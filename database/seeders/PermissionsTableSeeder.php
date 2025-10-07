<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\Outil;
use App\Models\Permission;
use Illuminate\Support\Arr;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $permissions = [
            // permissions demande
            array("name" => "liste-demande", "guard_name" => "web", "display_name" => "Voir liste des demande"),
            array("name" => "liste-demandedepartement", "guard_name" => "web", "display_name" => "Voir liste des demande du departement"),
            array("name" => "liste-mesdemande", "guard_name" => "web", "display_name" => "Voir liste de mes demande"),
            array("name" => "creation-demande", "guard_name" => "web", "display_name" => "Créer une demande"),
            array("name" => "modification-demande", "guard_name" => "web", "display_name" => "Modifier demande"),
            array("name" => "suppression-demande", "guard_name" => "web", "display_name" => "Supprimer demande"),


            // antennes
            array("name" => "liste-antenne", "guard_name" => "web", "display_name" => "Voir liste des antennes"),
            array("name" => "creation-antenne", "guard_name" => "web", "display_name" => "Créer une antenne"),
            array("name" => "modification-antenne", "guard_name" => "web", "display_name" => "Modifier antenne"),
            array("name" => "suppression-antenne", "guard_name" => "web", "display_name" => "Supprimer antenne"),


            //users
            array("name" => "liste-user", "guard_name" => "web", "display_name" => "Voir liste des utilisateurs"),
            array("name" => "creation-user", "guard_name" => "web", "display_name" => "Créer un utilisateur"),
            array("name" => "modification-user", "guard_name" => "web", "display_name" => "Modifier utilisateur"),
            array("name" => "suppression-user", "guard_name" => "web", "display_name" => "Supprimer utilisateur"),


            //roles
            array("name" => "liste-role", "guard_name" => "web", "display_name" => "Voir liste des roles"),
            array("name" => "creation-role", "guard_name" => "web", "display_name" => "Créer un role"),
            array("name" => "modification-role", "guard_name" => "web", "display_name" => "Modifier role"),
            array("name" => "suppression-role", "guard_name" => "web", "display_name" => "Supprimer role"),

            //plannings
            array("name" => "liste-planning", "guard_name" => "web", "display_name" => "Voir liste des plannings"),
            array("name" => "creation-planning", "guard_name" => "web", "display_name" => "Créer un planning"),
            array("name" => "modification-planning", "guard_name" => "web", "display_name" => "Modifier planning"),
            array("name" => "suppression-planning", "guard_name" => "web", "display_name" => "Supprimer planning"),


            //fichevisites
            array("name" => "liste-fichevisite", "guard_name" => "web", "display_name" => "Voir liste des fichevisites"),
            array("name" => "creation-fichevisite", "guard_name" => "web", "display_name" => "Créer une fichevisite"),
            array("name" => "modification-fichevisite", "guard_name" => "web", "display_name" => "Modifier fichevisite"),
            array("name" => "suppression-fichevisite", "guard_name" => "web", "display_name" => "Supprimer fichevisite"),

            //visites
            array("name" => "liste-visite", "guard_name" => "web", "display_name" => "Voir liste des visites"),
            array("name" => "creation-visite", "guard_name" => "web", "display_name" => "Créer une visite"),
            array("name" => "modification-visite", "guard_name" => "web", "display_name" => "Modifier visite"),
            array("name" => "suppression-visite", "guard_name" => "web", "display_name" => "Supprimer visite"),

            //zones
            array("name" => "liste-zone", "guard_name" => "web", "display_name" => "Voir liste des zones"),
            array("name" => "creation-zone", "guard_name" => "web", "display_name" => "Créer une zone"),
            array("name" => "modification-zone", "guard_name" => "web", "display_name" => "Modifier zone"),
            array("name" => "suppression-zone", "guard_name" => "web", "display_name" => "Supprimer zone"),

            //clients
            array("name" => "liste-client", "guard_name" => "web", "display_name" => "Voir liste des clients"),
            array("name" => "creation-client", "guard_name" => "web", "display_name" => "Créer un client"),
            array("name" => "modification-client", "guard_name" => "web", "display_name" => "Modifier client"),
            array("name" => "suppression-client", "guard_name" => "web", "display_name" => "Supprimer client"),

            //pointdeventes
            array("name" => "liste-pointdevente", "guard_name" => "web", "display_name" => "Voir liste des pointdeventes"),
            array("name" => "creation-pointdevente", "guard_name" => "web", "display_name" => "Créer un pointdevente"),
            array("name" => "modification-pointdevente", "guard_name" => "web", "display_name" => "Modifier pointdevente"),
            array("name" => "suppression-pointdevente", "guard_name" => "web", "display_name" => "Supprimer pointdevente"),


            //produits
            array("name" => "liste-typetier", "guard_name" => "web", "display_name" => "Voir liste des typetiers"),
            array("name" => "creation-typetier", "guard_name" => "web", "display_name" => "Créer un typetier"),
            array("name" => "modification-typetier", "guard_name" => "web", "display_name" => "Modifier typetier"),
            array("name" => "suppression-typetier", "guard_name" => "web", "display_name" => "Supprimer typetier"),

            //equipements

            //produits
            array("name" => "liste-tier", "guard_name" => "web", "display_name" => "Voir liste des tiers"),
            array("name" => "creation-tier", "guard_name" => "web", "display_name" => "Créer un tier"),
            array("name" => "modification-tier", "guard_name" => "web", "display_name" => "Modifier tier"),
            array("name" => "suppression-tier", "guard_name" => "web", "display_name" => "Supprimer tier"),

            //equipements
            array("name" => "liste-article", "guard_name" => "web", "display_name" => "Voir liste des articles"),
            array("name" => "creation-article", "guard_name" => "web", "display_name" => "Créer un article"),
            array("name" => "modification-article", "guard_name" => "web", "display_name" => "Modifier article"),
            array("name" => "suppression-article", "guard_name" => "web", "display_name" => "Supprimer article"),

            //categories
            array("name" => "liste-phasedepot", "guard_name" => "web", "display_name" => "Voir liste des phasedepots"),
            array("name" => "creation-phasedepot", "guard_name" => "web", "display_name" => "Créer une phasedepot"),
            array("name" => "modification-phasedepot", "guard_name" => "web", "display_name" => "Modifier phasedepot"),
            array("name" => "suppression-phasedepot", "guard_name" => "web", "display_name" => "Supprimer phasedepot"),

            // typepointdeventes
            array("name" => "liste-programmelivraison", "guard_name" => "web", "display_name" => "Voir liste des programmelivraisons"),
            array("name" => "creation-programmelivraison", "guard_name" => "web", "display_name" => "Créer un programmelivraison"),
            array("name" => "modification-programmelivraison", "guard_name" => "web", "display_name" => "Modifier programmelivraison"),
            array("name" => "suppression-programmelivraison", "guard_name" => "web", "display_name" => "Supprimer programmelivraison"),

            // categoriepointdeventes
            array("name" => "liste-commande", "guard_name" => "web", "display_name" => "Voir liste des commandes"),
            array("name" => "creation-commande", "guard_name" => "web", "display_name" => "Créer un commande"),
            array("name" => "modification-commande", "guard_name" => "web", "display_name" => "Modifier commande"),
            array("name" => "suppression-commande", "guard_name" => "web", "display_name" => "Supprimer commande"),

            //unites
            array("name" => "liste-personnel", "guard_name" => "web", "display_name" => "Voir liste des personnels"),
            array("name" => "creation-personnel", "guard_name" => "web", "display_name" => "Créer une personnel"),
            array("name" => "modification-personnel", "guard_name" => "web", "display_name" => "Modifier personnel"),
            array("name" => "suppression-personnel", "guard_name" => "web", "display_name" => "Supprimer personnel"),

            //voitures
            array("name" => "liste-equipegestion", "guard_name" => "web", "display_name" => "Voir liste des equipegestions"),
            array("name" => "creation-equipegestion", "guard_name" => "web", "display_name" => "Créer une equipegestion"),
            array("name" => "modification-equipegestion", "guard_name" => "web", "display_name" => "Modifier equipegestion"),
            array("name" => "suppression-equipegestion", "guard_name" => "web", "display_name" => "Supprimer equipegestion"),

            //antennes
            array("name" => "liste-typelivraison", "guard_name" => "web", "display_name" => "Voir liste des typelivraisons"),
            array("name" => "creation-typelivraison", "guard_name" => "web", "display_name" => "Créer une typelivraison"),
            array("name" => "modification-typelivraison", "guard_name" => "web", "display_name" => "Modifier typelivraison"),
            array("name" => "suppression-typelivraison", "guard_name" => "web", "display_name" => "Supprimer typelivraison"),


            //antennes
            array("name" => "liste-typeclient", "guard_name" => "web", "display_name" => "Voir liste des typeclients"),
            array("name" => "creation-typeclient", "guard_name" => "web", "display_name" => "Créer une typeclient"),
            array("name" => "modification-typeclient", "guard_name" => "web", "display_name" => "Modifier typeclient"),
            array("name" => "suppression-typeclient", "guard_name" => "web", "display_name" => "Supprimer typeclient"),

            //antennes
            array("name" => "liste-categorieclient", "guard_name" => "web", "display_name" => "Voir liste des categorieclients"),
            array("name" => "creation-categorieclient", "guard_name" => "web", "display_name" => "Créer une categorieclient"),
            array("name" => "modification-categorieclient", "guard_name" => "web", "display_name" => "Modifier categorieclient"),
            array("name" => "suppression-categorieclient", "guard_name" => "web", "display_name" => "Supprimer categorieclient"),


            //antennes
            array("name" => "liste-bailleur", "guard_name" => "web", "display_name" => "Voir liste des bailleurs"),
            array("name" => "creation-bailleur", "guard_name" => "web", "display_name" => "Créer une bailleur"),
            array("name" => "modification-bailleur", "guard_name" => "web", "display_name" => "Modifier bailleur"),
            array("name" => "suppression-bailleur", "guard_name" => "web", "display_name" => "Supprimer bailleur"),


            //antennes
            array("name" => "liste-categorie", "guard_name" => "web", "display_name" => "Voir liste des categories"),
            array("name" => "creation-categorie", "guard_name" => "web", "display_name" => "Créer une categorie"),
            array("name" => "modification-categorie", "guard_name" => "web", "display_name" => "Modifier categorie"),
            array("name" => "suppression-categorie", "guard_name" => "web", "display_name" => "Supprimer categorie"),

            // prospect
            array("name" => "liste-campagne", "guard_name" => "web", "display_name" => "Voir liste des campagnes"),
            array("name" => "creation-campagne", "guard_name" => "web", "display_name" => "Créer une campagne"),
            array("name" => "modification-campagne", "guard_name" => "web", "display_name" => "Modifier campagne"),
            array("name" => "suppression-campagne", "guard_name" => "web", "display_name" => "Supprimer campagne"),

              // prospect
            array("name" => "liste-unite", "guard_name" => "web", "display_name" => "Voir liste des unites"),
            array("name" => "creation-unite", "guard_name" => "web", "display_name" => "Créer une unite"),
            array("name" => "modification-unite", "guard_name" => "web", "display_name" => "Modifier unite"),
            array("name" => "suppression-unite", "guard_name" => "web", "display_name" => "Supprimer unite"),

            // categorietarifaire

            array("name" => "liste-programme", "guard_name" => "web", "display_name" => "Voir liste des programmes"),
            array("name" => "creation-programme", "guard_name" => "web", "display_name" => "Créer une programme"),
            array("name" => "modification-programme", "guard_name" => "web", "display_name" => "Modifier programme"),
            array("name" => "suppression-programme", "guard_name" => "web", "display_name" => "Supprimer programme"),

            array("name" => "liste-province", "guard_name" => "web", "display_name" => "Voir  les  documentspecification"),
            array("name" => "creation-province", "guard_name" => "web", "display_name" => "Créer un documentspecification"),
            array("name" => "modification-province", "guard_name" => "web", "display_name" => "Modifier documentspecification"),
            array("name" => "suppression-province", "guard_name" => "web", "display_name" => "Supprimer documentspecification"),

            array("name" => "liste-typemarche", "guard_name" => "web", "display_name" => "Voir  les  types de marche"),
            array("name" => "creation-typemarche", "guard_name" => "web", "display_name" => "Créer un type de marche"),
            array("name" => "modification-typemarche", "guard_name" => "web", "display_name" => "Modifier type de marche"),
            array("name" => "suppression-typemarche", "guard_name" => "web", "display_name" => "Supprimer type de marche"),

            array("name" => "liste-fournisseur", "guard_name" => "web", "display_name" => "Voir  les  types de fournisseur"),
            array("name" => "creation-fournisseur", "guard_name" => "web", "display_name" => "Créer un type de fournisseur"),
            array("name" => "modification-fournisseur", "guard_name" => "web", "display_name" => "Modifier type de fournisseur"),
            array("name" => "suppression-fournisseur", "guard_name" => "web", "display_name" => "Supprimer type de fournisseur"),

            array("name" => "liste-fabricant", "guard_name" => "web", "display_name" => "Voir  les  types de fabricant"),
            array("name" => "creation-fabricant", "guard_name" => "web", "display_name" => "Créer un type de fabricant"),
            array("name" => "modification-fabricant", "guard_name" => "web", "display_name" => "Modifier type de fabricant"),
            array("name" => "suppression-fabricant", "guard_name" => "web", "display_name" => "Supprimer type de fabricant"),


            array("name" => "liste-equipegestionclient", "guard_name" => "web", "display_name" => "Voir  les  Equipes G client"),
            array("name" => "creation-equipegestionclient", "guard_name" => "web", "display_name" => "Créer une Equipe G client"),
            array("name" => "modification-equipegestionclient", "guard_name" => "web", "display_name" => "Modifier Equipe G client"),
            array("name" => "suppression-equipegestionclient", "guard_name" => "web", "display_name" => "Supprimer Equipe G client"),


            //map
            array("name" => "voir-map", "guard_name" => "web", "display_name" => "Voir  la map"),


            //dashboard
            array("name" => "voir-dashboard", "guard_name" => "web", "display_name" => "Voir  le dashboard"),

            //performance
            array("name" => "voir-performance", "guard_name" => "web", "display_name" => "Voir  les  performances"),

            //module-admin
            array("name" => "voir-module-admin", "guard_name" => "web", "display_name" => "Voir  les  modules admin"),

            //module-planning
            array("name" => "voir-module-planning", "guard_name" => "web", "display_name" => "Voir  les  modules planning"),

            //module-parametrage
            array("name" => "voir-module-parametrage", "guard_name" => "web", "display_name" => "Voir  les  modules parametrage"),
            array("name" => "voir-module-donneebase", "guard_name" => "web", "display_name" => "Voir  les  modules donnees de base"),

            array("name" => "voir-preference", "guard_name" => "web", "display_name" => "Voir  les  preferences"),

            //liste-bl

            array("name" => "liste-bl", "guard_name" => "web", "display_name" => "Voir  les  bl"),
            array("name" => "creation-bl", "guard_name" => "web", "display_name" => "Créer un bl"),
            array("name" => "modification-bl", "guard_name" => "web", "display_name" => "Modifier bl"),
            array("name" => "suppression-bl", "guard_name" => "web", "display_name" => "Supprimer bl"),

            array("name" => "liste-suivimarche", "guard_name" => "web", "display_name" => "Voir  les  marchés"),

            array("name" => "liste-axe", "guard_name" => "web", "display_name" => "Voir  les  axe"),
            array("name" => "creation-axe", "guard_name" => "web", "display_name" => "Créer un axe"),
            array("name" => "modification-axe", "guard_name" => "web", "display_name" => "Modifier axe"),
            array("name" => "suppression-axe", "guard_name" => "web", "display_name" => "Supprimer axe"),

            array("name" => "liste-tonnage", "guard_name" => "web", "display_name" => "Voir  les  tonnage"),
            array("name" => "creation-tonnage", "guard_name" => "web", "display_name" => "Créer un tonnage"),
            array("name" => "modification-tonnage", "guard_name" => "web", "display_name" => "Modifier tonnage"),
            array("name" => "suppression-tonnage", "guard_name" => "web", "display_name" => "Supprimer tonnage"),

            array("name" => "liste-offretransport", "guard_name" => "web", "display_name" => "Voir  les  offretransport"),
            array("name" => "creation-offretransport", "guard_name" => "web", "display_name" => "Créer un offretransport"),
            array("name" => "modification-offretransport", "guard_name" => "web", "display_name" => "Modifier offretransport"),
            array("name" => "suppression-offretransport", "guard_name" => "web", "display_name" => "Supprimer offretransport"),

            array("name" => "liste-annuairetransporteur", "guard_name" => "web", "display_name" => "Voir  les  annuairetransporteur"),
            array("name" => "creation-annuairetransporteur", "guard_name" => "web", "display_name" => "Créer un annuairetransporteur"),
            array("name" => "modification-annuairetransporteur", "guard_name" => "web", "display_name" => "Modifier annuairetransporteur"),
            array("name" => "suppression-annuairetransporteur", "guard_name" => "web", "display_name" => "Supprimer annuairetransporteur"),

            array("name" => "liste-documentspecification", "guard_name" => "web", "display_name" => "Voir  les  documentspecification"),
            array("name" => "creation-documentspecification", "guard_name" => "web", "display_name" => "Créer un documentspecification"),
            array("name" => "modification-documentspecification", "guard_name" => "web", "display_name" => "Modifier documentspecification"),
            array("name" => "suppression-documentspecification", "guard_name" => "web", "display_name" => "Supprimer documentspecification"),


            array("name" => "liste-report", "guard_name" => "web", "display_name" => "Voir  les  report"),



            // validation

            array("name" => "liste-validation", "guard_name" => "web", "display_name" => "Valider demande"),


            // liste-modepaiement
            array("name" => "liste-modepaiement", "guard_name" => "web", "display_name" => "Voir liste des modepaiement"),
        ];

        foreach ($permissions as $permission) {
            $activer = 1;
            if (isset($permission['activer'])) {
                $activer = $permission['activer'];
            }
            $newitem = Permission::where('name', $permission['name'])->first();
            if (!isset($newitem)) {
                $newitem = new Permission();
            }
            $newitem->name = $permission['name'];
            $newitem->guard_name = $permission['guard_name'];
            $newitem->display_name = $permission['display_name'];
            $newitem->save();
        }
    }
}
