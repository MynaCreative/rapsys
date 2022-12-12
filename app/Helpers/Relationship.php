<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Relations\Relation;

/**
 *
 * Relationship
 *
 * @author Muhammad Cahya
 */
class Relationship {
    /**
     *
     * Method to store the relationship create or edit
     * 
     * @return  array
     *
     */
    public static function proccesRelationWithRequest(Relation $relation, array $items, $key = 'id')
    {
        $relation->getResults()->each(function($model) use ($items, $key) {
            foreach ($items as $item) {
                if ($model->{$key} === ((int) $item[$key] ?? null)) {
                    $model->fill($item)->save();
                    return;
                }
            }
            return $model->delete();
        });
        foreach ($items as $item) {
            if (!isset($item[$key])){
                $relation->create($item);
            }
        };
    }
}
