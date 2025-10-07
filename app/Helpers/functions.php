<?php
/****ICI SE TROUVE TOUTES MES FONCTIONS GLOBALES ACCESSIBLE DE PARTOUT****/

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

define('KEY', env('APP_KEY'));

//---Fonction qui crée le matricule---//
function faireMatricule($alias, $maxi, $inclureAnnee=null) 
{
      if($inclureAnnee == null){
         $annee = '';
      }else{
         $annee = substr(date('Y'), 2, 2);
      }
      $alias = $alias.'-';
      if ($maxi < 10) {
         $matri = $alias . '' . $annee . '000' . $maxi;
      } elseif ($maxi < 100) {
         $matri = $alias . '' . $annee . '00' . $maxi;
      } elseif ($maxi < 1000) {
         $matri = $alias . '' . $annee . '0' . $maxi;
      } else {
         $matri = $alias . '' . $annee . '' . $maxi;
      }
      return $matri;
}

//---Fonction qui transforme la date en enformat francaise---//
function Date_en_francais($datebi) 
{
   $jour = substr($datebi, 8, 2);
   $mois = substr($datebi, 5, 2);
   $an = substr($datebi, 0, 4);
   $madate = $jour . '-' . $mois . '-' . $an;
   return $madate;
}

//---Fonction qui formate le prix---//
function Prix_en_monetaire($nbre) 
{
   $rslt = "";
   $position = strpos($nbre, '.');
   if ($position === false) 
   {
       //---C'est un entier---//
       //Cas 1 000 000 000 à 9 999 000
       if (strlen($nbre) >= 9) {
           $c = substr($nbre, -3, 3);
           $b = substr($nbre, -6, 3);
           $d = substr($nbre, -9, 3);
           $a = substr($nbre, 0, strlen($nbre) - 9);
           $rslt = $a . ' ' . $d . ' ' . $b . ' ' . $c;
       } //Cas 100 000 000 à 9 999 000
       elseif (strlen($nbre) >= 7 && strlen($nbre) < 9) {
           $c = substr($nbre, -3, 3);
           $b = substr($nbre, -6, 3);
           $a = substr($nbre, 0, strlen($nbre) - 6);
           $rslt = $a . ' ' . $b . ' ' . $c;
       } //Cas 100 000 à 999 000
       elseif (strlen($nbre) >= 6 && strlen($nbre) < 7) {
           $a = substr($nbre, 0, 3);
           $b = substr($nbre, 3);
           $rslt = $a . ' ' . $b;
           //Cas 0 à 99 000
       } elseif (strlen($nbre) < 6) {
           if (strlen($nbre) > 3) {
               $a = substr($nbre, 0, strlen($nbre) - 3);
               $b = substr($nbre, -3, 3);
               $rslt = $a . ' ' . $b;
           } else {
               $rslt = $nbre;
           }
       }
   } else {
       //---C'est un décimal---//
       $partieEntiere = substr($nbre, 0, $position);
       $partieDecimale = substr($nbre, $position, strlen($nbre));
       //Cas 1 000 000 000 à 9 999 000
       if (strlen($partieEntiere) >= 9) {
           $c = substr($partieEntiere, -3, 3);
           $b = substr($partieEntiere, -6, 3);
           $d = substr($partieEntiere, -9, 3);
           $a = substr($partieEntiere, 0, strlen($partieEntiere) - 9);
           $rslt = $a . ' ' . $d . ' ' . $b . ' ' . $c;
       } //Cas 100 000 000 à 9 999 000
       elseif (strlen($partieEntiere) >= 7 && strlen($partieEntiere) < 9) {
           $c = substr($partieEntiere, -3, 3);
           $b = substr($partieEntiere, -6, 3);
           $a = substr($partieEntiere, 0, strlen($partieEntiere) - 6);
           $rslt = $a . ' ' . $b . ' ' . $c;
       } //Cas 100 000 à 999 000
       elseif (strlen($partieEntiere) >= 6 && strlen($partieEntiere) < 7) {
           $a = substr($partieEntiere, 0, 3);
           $b = substr($partieEntiere, 3);
           $rslt = $a . ' ' . $b;
           //Cas 0 à 99 000
       } elseif (strlen($partieEntiere) < 6) {
           if (strlen($partieEntiere) > 3) {
               $a = substr($partieEntiere, 0, strlen($partieEntiere) - 3);
               $b = substr($partieEntiere, -3, 3);
               $rslt = $a . ' ' . $b;
           } else {
               $rslt = $partieEntiere;
           }
       }
       if ($partieDecimale == '.0' || $partieDecimale == '.00' || $partieDecimale == '.000') {
           $partieDecimale = '';
       }
       $rslt = $rslt . '' . $partieDecimale;
   }
   return ($rslt);
}

//---Fonction qui donne le mois en lettres---//
function Convertir_mois_en_lettres($mois) 
{
   if ($mois == 1 || $mois == '01') {
       $moisLettre = 'Janvier';
   }
   if ($mois == 2 || $mois == '02') {
       $moisLettre = 'Février';
   }
   if ($mois == 3 || $mois == '03') {
       $moisLettre = 'Mars';
   }
   if ($mois == 4 || $mois == '04') {
       $moisLettre = 'Avril';
   }
   if ($mois == 5 || $mois == '05') {
       $moisLettre = 'Mai';
   }
   if ($mois == 6 || $mois == '06') {
       $moisLettre = 'Juin';
   }
   if ($mois == 7 || $mois == '07') {
       $moisLettre = 'Juillet';
   }
   if ($mois == 8 || $mois == '08') {
       $moisLettre = 'Août';
   }
   if ($mois == 9 || $mois == '09') {
       $moisLettre = 'Septembre';
   }
   if ($mois == 10) {
       $moisLettre = 'Octobre';
   }
   if ($mois == 11) {
       $moisLettre = 'Novembre';
   }
   if ($mois == 12) {
       $moisLettre = 'Décembre';
   }
   if ($mois <= 0 || $mois >= 13) {
       $moisLettre = 'Neant';
   }
   return $moisLettre;
}

if (!function_exists('getColorForStatus'))
{
    /**
     * Retour la couleur en fonction du statut
     *
     * @param int $status
     * @return string
     */
    function getColorForStatus($status)
    {
        $retour = null;
        if ($status==0)
        {
            $retour = "danger";
        }
        else if ($status==1)
        {
            $retour = "warning";
        }
        else if ($status==2)
        {
            $retour = "success";
        }
        return $retour;
    }
}

if (!function_exists('isColumnInTable'))
{
    /**
     * Verifie si une column est present dans une table
     *
     * @param Illuminate\Database\Eloquent\Model|string $model
     * @param string $column
     * @return boolean
     */
    function isColumnInTable($model, string $column)
    {
        if ($model instanceof Model)
        {
            return Schema::hasColumn($model->getTable(), $column);
        }

        try
        {
            if (class_exists($model))
            {
                return Schema::hasColumn((new $model())->getTable(), $column);
            }

            return Schema::hasColumn($model, $column);
        } catch (\Throwable $th) {}

        return false;
    }
}

if (!function_exists('storeUploadFile'))
{
    /**
     * Permet d'enregistrer des ficher
     *
     * @param UploadedFile $file
     * @param string $name
     * @return void
     */
    function storeUploadFile(?UploadedFile $file, string $name = null)
    {
        if (!is_null($file) && $file->isValid())
        {
            $directory = 'uploads/' . Carbon::now()->format('Y-m-d');
            $filename = generateFilename($file);

            $path = $file->storeAs(
                $directory,
                $filename,
                'public'
            );

            return [
                'originalName' => $file->getClientOriginalName(),
                'extension' => $file->extension(),
                'location' => $directory . '/' . $filename,
                'url' => Storage::disk('public')->url($path),
                'name' => $name
            ];
        }

        return null;
    }
}

if (!function_exists('deleteUploadedFile'))
{
    /**
     * Permet de supprimer des fichiers si la location est
     * specifiee
     *
     * @param string $path
     * @return void
     */
    function deleteUploadedFile(string $path)
    {
        Storage::disk('public')->delete($path);
    }
}

if (!function_exists('generateFilename'))
{
    /**
     * Genere un nom pour le fichier
     *
     * @param UploadedFile $file
     * @return string
     */
    function generateFilename(UploadedFile $file): string
    {
        return Str::uuid() . '.' . $file->getClientOriginalExtension();
    }
}

if (!function_exists('randomString'))
{
    /**
     * Permet de degener des chaines de caractere random
     *
     * @param integer $length
     * @return string
     */
    function randomString(int $length = 7): string
    {
        $randomString = bin2hex(random_bytes(32));
        return substr($randomString, 0, $length);
    }
}

if (!function_exists('randomNumber'))
{
    /**
     * Permet de degener un nombre random
     *
     * @param integer $length
     * @return string
     */
    function randomNumber(int $length = 5): string
    {
        $length = $length >= 56 ? 54 : $length;

        $str = strval(random_int(0, PHP_INT_MAX)) . strval(rand() ** 2) . strval(random_int(0, rand() ** 2));
        return substr($str, 0, $length);
    }
}

if (!function_exists('formatNumber'))
{
    /**
     * Permet de degener des chaines de caractere random
     *
     * @param integer $length
     * @return string
     */
    function formatNumber($value, string $decSeparator = '.', string $thousandSeparator = ' ')
    {
        $value = is_string($value) ? intval($value) : intval($value);

        return number_format($value, 0, $decSeparator, $thousandSeparator);
    }
}

if (!function_exists('formatDate'))
{
    /**
     * Permet de degener des chaines de caractere random
     *
     * @param integer $length
     * @return string
     */
    function formatDate($value, string $format = 'd/m/Y')
    {
        if (!isset($value))
            return $value;
        return Carbon::parse($value)->format($format);
    }
}

if (!function_exists('trackingFields'))
{
    /**
     * Permet de generer les columns
     * created_by
     * updated_by
     *
     * @param Blueprint $table
     * @param string $column
     * @param string $table
     * @return void
     */
    function trackingFields(Blueprint $table, string $column = 'id', string $tableName = 'users')
    {
        $table->unsignedBigInteger('created_by')->nullable();
        $table->unsignedBigInteger('updated_by')->nullable();
        $table->unsignedBigInteger('deleted_by')->nullable();

        $table->foreign('created_by')->references($column)->on($tableName)->onDelete('set null');
        $table->foreign('updated_by')->references($column)->on($tableName)->onDelete('set null');
        $table->foreign('deleted_by')->references($column)->on($tableName)->onDelete('set null');
    }
}

if (!function_exists('CSVToArray'))
{
    /**
     * Permet de recuperer les données d'un fichier CSV
     *
     * @param UploadedFile $file
     * @return array|null
     */
    function CSVToArray(UploadedFile $file): ?array
    {
        if ($file->isValid())
        {
            $resource = fopen($file->getRealPath(), 'r');
            $header =  explode(';', fgetcsv($resource)[0]);

            $extracted = [];
            while ($row = fgetcsv($resource))
            {
                $row = explode(';', $row[0]);

                $data = [];
                for ($i = 0; $i < count($header); $i++)
                {
                    $data[$header[$i]] = $row[$i];
                }
                $extracted[] = $data;
            }

            return $extracted;
        }

        return null;
    }
}

if (!function_exists('discoverClassIn'))
{
    /**
     * Permt de recuperer les classes save dans un dossier
     *
     * @return array
     */
    function discoverClassIn(string $path, string $namespace = null, bool $camelCase = true)
    {
        $discovered = [];
        foreach (glob($path) as $file) {
            $basename  = basename($file, '.php');
            $className = $namespace ? $namespace . '\\' . $basename : $basename;

            $formattage = $camelCase ? 'camel' : 'studly';
            if (class_exists($className))
            {
                $discovered[Str::$formattage($basename)] = $className;
            }
        }

        return $discovered;
    }
}

if (!function_exists('getDefaultRoutes'))
{
    /**
     * Permet d'ajouter par defaut les routes
     * save
     * delete
     * import
     *
     * @param string $route
     * @param string $controller
     * @return void
     */
    function getDefaultRoutes(string $route, string $controller, bool $withQrCodeRoute = false)
    {
        Route::post("{$route}/import", $controller . '@import')->name("{$route}.import");
        Route::get("{$route}/export", $controller . '@export')->name("{$route}.import");
        //
        Route::delete("$route/{id}", $controller . '@delete')->name("{$route}.delete")->where('id', '[1-9]+');
        Route::post("$route", $controller . '@save')->name("{$route}.save");
        Route::get("$route/{id?}", $controller . '@get')->name("{$route}.get")->where('id', '\d+');

        if ($withQrCodeRoute)
        {
            Route::get("$route/qrcode/{id?}", $controller . '@getQrCode')->name("{$route}.qrcode")->where('id', '\d');
        }
    }
}

if (!function_exists('getModelDefaultRoutes'))
{
    /**
     * Permet d'ajouter par defaut les routes
     * save
     * delete
     * import
     *
     * @param string $route
     * @param string $controller
     * @return void
     */
    function getModelDefaultRoutes(string $model, string $route = null, string $controller = null)
    {
        if (!is_null($model))
        {
            $splited = explode('\\', $model);
            $model = $splited[count($splited) - 1];

            $controller = $controller ?: "{$model}Controller";
            //$route = Str::kebab($model);
            $route = strtolower($route ?: $model);
        }

        getDefaultRoutes($route, $controller);
    }
}

if (!function_exists('getSyncableArray'))
{

    /**
     * Permet de creer des matrix sous form
     * [
     *      $key => $arr
     * ]
     *
     * @param array|Illuminate\Support\Collection $arr
     * @param string $key
     * @return void
     */
    function getSyncableArray($arr, string $key)
    {
        if (($arr instanceof Collection))
        {
            $arr = $arr->toArray();
        }

        if (
            is_array($arr) &&
            count($arr) &&
            !is_null($key) &&
            !empty($key)
        )
        {
            $sync = [];
            foreach ($arr as $row)
            {
                $cleaned = [];
                foreach ($row as $k => $v)
                {
                    if (!is_null($v) && is_scalar($v))
                    {
                        $cleaned[$k] = $v;
                    }
                }

                $sync[$row[$key]] = $cleaned;
            }

            return $sync;
        }

        return [];
    }
}

if (!function_exists('sanitizeData'))
{
    /**
     * Permet de nettoyer les données
     *
     * @param [type] $data
     * @return void
     */
    function sanitizeData($data)
    {
        if ($data instanceof Collection)
        {
            $data = $data->toArray();
        }

        if (is_array($data) && count($data))
        {
            $cleaned = [];
            foreach ($data as $key => $value)
            {
                if (!is_scalar($value))
                {
                    $value = sanitizeData($value);
                }
                else if (is_string($value))
                {
                    $value = strtolower(trim($value));
                }

                $cleaned[$key] = $value;
            }

            return $cleaned;
        }

        return [];
    }
}

if (!function_exists('getGraphQLResponse'))
{
    /**
     * Permet de faire un query graphql
     *
     * @param string $queryName
     * @param string $fields
     * @param array $args
     * @return Illimunate/Http/Response
     */
    function getGraphQLResponse(string $queryName, string $fields, array $args = [])
    {
        $argsQuery = '';
        $query = "query={:queryName :args {:fields}}";
        if (count($args))
        {
            $argsQuery = array_reduce(array_keys($args), function ($acc, $key) use ($args)
            {
                return $acc . "{$key}:{$args[$key]}";
            }, '');

            if (strlen($argsQuery))
            {
                $argsQuery = "({$argsQuery})";
            }
        }

        $query = str_ireplace(':queryName', $queryName, $query);
        $query = str_ireplace(':args', $argsQuery, $query);
        $query = str_ireplace(':fields', $fields, $query);

        return redirect("graphql?{$query}");
    }
}

if (!function_exists('parseArray'))
{
    /**
     * Permet de parser tableau sous forme de string en
     * php array
     *
     * @param array $data
     * @return string|array $attrs
     */
    function parseArray($data, $attrs = null): array
    {
        try
        {
            $data = is_array($data) ? $data : json_decode($data, true);

            return is_null($attrs) ? $data : collectionWithOnly($data, $attrs);
        }
        catch (\Throwable $th)
        {
            return [];
        }
    }
}

if (!function_exists('arrayWithOnly'))
{
    /**
     * Permet de recuperer dans un tableau
     * seulement les attributs d'un model
     *
     * Si $source est une chaine alors
     * elle sera considere comme un mot de model
     * et recuperera les champs au niveau de la table
     *
     * @param array|Illuminate\Support\Collection; $data
     * @param string|array $source
     * @return array
     */
    function arrayWithOnly($data, $source): array
    {
        if (!is_null($source))
        {
            if ($data instanceof Collection)
            {
                $data = $data->toArray();
            }

            $attrs = [];
            if (is_string($source) && class_exists($source))
            {
                $attrs =  Schema::getColumnListing((new $source())->getTable());
            }
            elseif (is_array($source))
            {
                $attrs = $source;
            }

            return getOnly($data, $attrs);
        }

        return [];
    }
}

if (!function_exists('collectionWithOnly'))
{
    /**
     * Permet de recuperer dans un tableau
     * seulement les attributs d'un model
     *
     * Si $source est une chaine alors
     * elle sera considere comme un nom de model
     * et tentera de recuperer les champs au niveau de la table
     *
     * @param array|Illuminate\Support\Collection; $data
     * @param string|array $source
     * @return array
     */
    function collectionWithOnly($data, $source): array
    {
        $cleaned = [];
        if (!is_null($source))
        {
            if ($data instanceof Collection)
            {
                $data = $data->toArray();
            }

            $attrs = [];
            if (is_string($source) && class_exists($source))
            {
                $attrs =  Schema::getColumnListing((new $source())->getTable());
            }
            elseif (is_array($source))
            {
                $attrs = $source;
            }

            foreach ($data as $item)
            {
                $cleaned[] = getOnly($item, $attrs);
            }
        }

        return $cleaned;
    }
}

if (!function_exists('getOnly'))
{
    /**
     * Permet de recuperer seulement
     * les attrs passé en parametre
     *
     * @param array $data
     * @param array $attrs
     * @return void
     */
    function getOnly(array $data, array $attrs = [])
    {
        return array_reduce(array_keys($data), function ($acc, $key) use ($attrs, $data)
        {
            if (in_array($key, $attrs))
            {
                $acc[$key] = $data[$key];
            }
            return $acc;
        }, []);
    }
}