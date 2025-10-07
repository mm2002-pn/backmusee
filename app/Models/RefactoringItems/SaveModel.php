<?php

namespace App\Models\RefactoringItems;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaveModel extends Model
{
    public function created_at_user()
    {
        return $this->belongsTo(User::class);
    }

    public function updated_at_user()
    {
        return $this->belongsTo(User::class);
    }

    public function save(array $options = [])
    {

        // Code to listening which user setting data
        if (Auth::user()) {
            if (!isset($this->id)) {
                $this->created_at_user_id = Auth::user()->id;
            } else if (($this->wasChanged() || $this->isDirty())) {
                $this->updated_at_user_id = Auth::user()->id;

                //
                $tableDb = $this->getTable();
                $DataToPopageUpdatedAtUser = DB::select(DB::raw("SELECT distinct confrelid::regclass as parent FROM pg_constraint where contype='f' AND confdeltype = 'c' and conrelid='{$tableDb}'::regclass;"));
                foreach ($DataToPopageUpdatedAtUser as $oneTable) {
                    $foreignKeyTable = substr($oneTable->parent, 0, (strlen($oneTable->parent) - 1)) . '_id';
                    DB::table($oneTable->parent)->where('id', $this->$foreignKeyTable)->update(['updated_at_user_id' => $this->updated_at_user_id]);
                }
            }
        }

        // Code to save item into model
        $this->mergeAttributesFromClassCasts();

        $query = $this->newModelQuery();

        // If the "saving" event returns false we'll bail out of the save and return
        // false, indicating that the save failed. This provides a chance for any
        // listeners to cancel save operations if validations fail or whatever.
        if ($this->fireModelEvent('saving') === false) {
            return false;
        }

        // If the model already exists in the database we can just update our record
        // that is already in this database using the current IDs in this "where"
        // clause to only update this model. Otherwise, we'll just insert them.
        if ($this->exists) {
            $saved = $this->isDirty() ?
                $this->performUpdate($query) : true;
        }

        // If the model is brand new, we'll insert it into our database and set the
        // ID attribute on the model to the value of the newly inserted row's ID
        // which is typically an auto-increment value managed by the database.
        else {
            $saved = $this->performInsert($query);

            if (!$this->getConnectionName() && $connection = $query->getConnection()) {
                $this->setConnection($connection->getName());
            }
        }

        // If the model is successfully saved, we need to do a few more things once
        // that is done. We will call the "saved" method here to run any actions
        // we need to happen after a model gets successfully saved right here.
        if ($saved) {
            $this->finishSave($options);
        }

        return $saved;
    }
}
