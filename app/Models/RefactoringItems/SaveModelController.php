<?php

namespace App\Models\RefactoringItems;


// use App\Models\Outil;
use App\Models\Outil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class SaveModelController extends Controller
{

    protected $queryName;
    protected $model;

    protected   $job;

 

    public function statut(Request $request)
    {
        $errors = null;
        $data = 0;

        try {
            $item = app($this->model)::find($request->id);
            if ($item != null) {
                $item->status = $request->status;
                $item->save();
            } else {
                $errors = "Cette donnée n'existe pas";
            }

            if (!isset($errors) && $item->save()) {
                $data = 1;
            }
        } catch (\Exception $e) {
            $errors = "Vérifier les données fournies";
        }
        return response('{"data":' . $data . ', "errors": "' . $errors . '" }')->header('Content-Type', 'application/json');
    }

    public function deleteOld($id)
    { }


    public function sendNotifImport($userId, $filename)
    {
        $extension = pathinfo($filename->getClientOriginalName(), PATHINFO_EXTENSION);

        $queryName = Outil::getQueryNameOfModel(app($this->model)->getTable());
        $generateLink = substr($queryName, 0, (strlen($queryName) - 1));


        $from = public_path('uploads') . "/{$queryName}/{$userId}/";
        $to = "upload.{$extension}";
        $file = $filename->move($from, $to);
        $this->dispatch((new $this->job($this->model, $generateLink, $file, $userId, $from . $to)));
    }
}
