<?php

namespace App\Traits;

/**
 *
 * General Scope Trait
 *
 * @author      Muhammad Cahya
 * @copyright   Copyright (c) 2022, Myna Creative.
 */
trait Scope
{
    /**
     * Scope a query for selecting.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return void
     */
    public function scopeSelecting($query, $request)
    {
        $query->when($request->selects, function ($query) use ($request) {
            $query->select($request->selects);
        });
    }
    
    /**
     * Scope a query for ordering.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return void
     */
    public function scopeOrdering($query, $request)
    {
        $query->when($request->sort, function ($query) use ($request) {
            $attribute = $request->sort;
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $query->orderBy($attribute, $sort_order);
        });
    }

    /**
     * Scope a query for filtering.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return void
     */
    public function scopeFiltering($query, $request)
    {
        $query->when($request->filters, function ($query) use ($request) {
            foreach($request->filters as $field => $filter){
                if(!str($field)->startsWith(['relation.', 'specific.'])){
                    if(is_array($filter) || is_object($filter)){
                        $query->whereIn($field, $filter);
                    }else{
                        $query->where($field, $filter);
                    }
                }
            }
        });
    }

    /**
     * Scope a query for filtering.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return void
     */
    public function scopeSearching($query, $request, $columns)
    {
        $query->when($request->keyword, function ($query) use ($request, $columns) {
            $query->whereLike($columns, $request->keyword);
        });
    }
}
