<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
            // Инициатива: Использование whereBetween для фильтрации по интервалу дат создания продуктов
            ->when($request->input('date_from') && $request->input('date_to'), function ($query) use ($request) {
                $start = Carbon::parse($request->input('date_from'))->startOfDay();
                $end = Carbon::parse($request->input('date_to'))->endOfDay();

                $query->whereBetween('created_at', [$start, $end]);
            })
            // Если передана только дата "от", используем обычное условие "больше или равно"
            ->when($request->input('date_from') && !$request->input('date_to'), function ($query, $dateFrom) {
                $query->where('created_at', '>=', Carbon::parse($dateFrom)->startOfDay());
            })
            // Если передана только дата "до", используем обычное условие "меньше или равно"
            ->when(!$request->input('date_from') && $request->input('date_to'), function ($query, $dateTo) {
                $query->where('created_at', '<=', Carbon::parse($dateTo)->endOfDay());
            })
            ->when($request->input('category'), function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            });

        return $query;
    }
}
