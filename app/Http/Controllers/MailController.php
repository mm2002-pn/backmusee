<?php

namespace App\Http\Controllers;

use App\Models\Outil;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Laravel\Sanctum\HasApiTokens;

class MailController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, HasApiTokens, ResponseTrait;

    public function sendmail(Request $request)
    {
        // dd($request->all());
        try {
            // Valider les entrées
            $validator = Validator::make($request->all(), [
                "to" => "required|email",
                "objet" => "required",
                "email" => "required|email",
                "message" => "required",
                "documents" => "nullable|file|mimes:pdf,doc,docx,txt|max:2048",
            ]);
            // dd($request->all());

            if ($validator->fails()) {
                return $this->sendError('Erreur de validation', $validator->errors(), 422);
            }

            // Récupérer les entrées
            $to = $request->input("to");
            $message = $request->input("message");
            $from = $request->input("email");
            $name = $request->input("nom");

            // Gérer l'objet (sujet de l'e-mail)
            $objet = $request->input("objet");

            // Si l'objet est une chaîne JSON, le décoder
            if (is_string($objet)) {
                $objet = json_decode($objet, true);
            }

            // Vérifier que l'objet est bien un tableau avec une clé "label"
            if (!is_array($objet) || !isset($objet["label"])) {
                return $this->sendError('Erreur de format', ['objet' => 'Le champ "objet" doit être un tableau avec une clé "label".'], 422);
            }

            $subject = $objet["label"];

            // Gérer la pièce jointe
            if ($request->hasFile('documents')) {
                $file = $request->file('documents');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads', $filename, 'public');
                $filePath = 'storage/uploads/' . $filename;
            } else {
                $filePath = null;
            }

            // Envoyer l'e-mail avec le fichier attaché
            $res = Outil::envoiEmail(
                $to,
                $subject,
                $message,
                $from,
                $name,
                $request->all(),
                $filePath
            );

            // Retourner une réponse avec un message de succès
            return response()->json(['message' => 'Email envoyé avec succès', 'data' => $res]);
        } catch (\Exception $e) {
            dd($e);
            return $this->sendError('Erreur', $e->getMessage(), 500);
        }
    }
}
