<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait ScopeFilters
{
    public function scopeFilter(Builder $query, Request $request): Builder
    {
        $query->when($request->input('search'), function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        })
            ->when($request->input('price_from'), function ($query, $priceFrom) {
                $query->where('price', '>=', $priceFrom);
            })
            ->when($request->input('price_to'), function ($query, $priceTo) {
                $query->where('price', '<=', $priceTo);
            })
            ->when($request->input('date_from'), function ($query, $dateFrom) {
                $query->whereDate('created_at', '>=', $dateFrom . ' 00:00:00');
            })
            ->when($request->input('date_to'), function ($query, $dateTo) {
                $query->where('created_at', '<=', $dateTo . ' 23:59:59');
            })
            ->when($request->input('category'), function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            });

        return $query;
    }
}
