<?php

namespace App\Repositories\Categories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    public function search(?string $search, ?array $selected): Collection
    {
        return Category::query()
            ->select('id', 'category_name')
            ->orderBy('category_name')
            ->when(
                $search,
                fn (Builder $query) => $query->where('category_name', 'like', "%{$search}%")
            )
            ->when(
                $selected,
                fn (Builder $query) => $query->whereIn('id', $selected),
                fn (Builder $query) => $query
            )
            ->get();
    }
}
