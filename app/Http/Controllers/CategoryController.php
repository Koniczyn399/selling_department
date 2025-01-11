<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Categories\CategoryRepository;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Category::class);
        return view(
            'categories.index',
            data: [
                'categories' => Category::paginate(
                    config('pagination.default')
                )
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Category::class);

        return view(
            'categories.form'
        );
    }



    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('update', $category);

        return view(
            'categories.form',
            [
                'category'=> $category,
            ]
        );
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
    }



    // public function search(Request $request)
    // {
    //     $this->authorize('viewAny', Category::class);

    //     return CategoryRepository::search($request->search, $request->selected);
    // }

}
