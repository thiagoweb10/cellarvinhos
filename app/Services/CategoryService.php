<?php

namespace App\Services;

use Exception;
use App\Models\Category;
use App\DTOs\CategoryDTO;

class CategoryService {

    public function list()
    {
        $categories = Category::orderBy('name')->paginate(10);

        $categories->getCollection()->transform(function($category){
            return CategoryDTO::fromModel($category);
        });

        return $categories->toArray();
    }

    public function create(CategoryDTO $category)
    {
        return Category::create($category->toArray());
    }

    public function update(CategoryDTO $categoryDTO, Category $category){

        return $category->update($categoryDTO->toArray());
    }

    public function show(Category $category)
    {
        return CategoryDTO::fromModel($category);
    }

    public function delete(Category $category){
       
        $category = Category::withCount('ticket')->find($category->id);

        if ($category->ticket_count > 0) {
            throw new Exception("Não é possível excluir: existem tickets vinculados.");
        }

        $category->delete();
    }
}