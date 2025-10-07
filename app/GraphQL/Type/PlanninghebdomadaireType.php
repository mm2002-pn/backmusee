<?php

namespace App\GraphQL\Type;

use App\Models\Outil;
use App\Models\Planning;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Models\RefactoringItems\RefactGraphQLType;
use Carbon\Carbon;

class PlanninghebdomadaireType extends RefactGraphQLType
{
    protected $attributes = [
        'name' => 'Planninghebdomadaire',
        'description' => 'les plannings',
    ];
    public function fields(): array
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
            'user_id' => ['type' => Type::nonNull(Type::int())],
            'user' => ['type' => GraphQL::type('User')],
            'jours' => ['type' => Type::listOf(GraphQL::type('Jour'))],
            'jour_id' => ['type' => Type::int()],
            'etat_text' => ['type' => Type::string()],
            'etat_badge' => ['type' => Type::string()],

            'date_debut_semaine' => ['type' => Type::string()],
        ];
    }



    protected function resolveJoursField($root, $args)
    {
        // Définir la locale en français
        setlocale(LC_TIME, 'fr_FR.utf8');

        // Récupérer l'ID de l'utilisateur
        $user = User::find($root['id']);

        // Récupérer la date de début de semaine sélectionnée
        $selectedDate = request()->input('selectedDate');
        //dd($selectedDate);
        // Convertir la date de début de semaine en objet Carbon
        $startOfWeek = Carbon::parse($selectedDate)->startOfWeek();

        // Calculer la date de fin de semaine en ajoutant 6 jours à la date de début de semaine
        $endOfWeek = $startOfWeek->copy()->addDays(6);
        // dd($startOfWeek, $endOfWeek);
        // Récupérer les plannings de l'utilisateur pour la semaine sélectionnée
        $plannings = Planning::whereHas('users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->get();







        // dd($plannings);
        // Mapper des noms de jours en français
        $joursEnFrancais = [
            0 => 'Lundi',
            1 => 'Mardi',
            2 => 'Mercredi',
            3 => 'Jeudi',
            4 => 'Vendredi',
            5 => 'Samedi',
            6 => 'Dimanche',
        ];

        // Créer une liste de jours avec les plannings correspondants
        $jours = [];
        for ($i = 0; $i < 7; $i++) {
            $day = Carbon::parse($startOfWeek)->addDays($i);
            $jour = [
                'id' => $i,
                'name' => $joursEnFrancais[$i], // Utiliser le nom du jour en français
                'planning' => null,
            ];

            // Rechercher un planning correspondant pour ce jour
            foreach ($plannings as $planning) {
                if (Carbon::parse($planning->date)->dayOfWeek === ($i + 1) % 7) {
                    $jour['planning'] = $planning;
                    break;
                }
            }

            array_push($jours, $jour);
        }

        return $jours;
    }







    protected function resolveUserIdField($root)
    {
        return $root['id'];
    }

    protected function resolveUserField($root)
    {
        return User::find($root['id']);
    }
}
