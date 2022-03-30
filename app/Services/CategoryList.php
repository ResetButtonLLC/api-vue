<?php

namespace App\Services;

use App\Models\Category;

class CategoryList
{
    /** categorys [ $name ] = $id */
    protected $categories = [];

    public function loadFromDB()
    {
        Category::all()->each(function ($category) {
            $this->categories[$category->name] = $category->id;
        });
    }

    /** @return int Category Id | 0 */
    public function contains(string $categoryName)
    {
        return $this->categories[$categoryName] ?? 0;
    }

    /** @return int Category Id */
    public function push(string $categoryName, bool $changeExistStatus = false)
    {
        $categoryId = $this->contains($categoryName);

        if ($categoryId) {
            return $categoryId;
        }

        if (isset($this->categories[$categoryName])) {
            return $this->categories[$categoryName];
        }

        $category = Category::firstOrCreate(
            ['name' => $categoryName],
            ['is_exist' => true]
        );

        if (!$category) {
            throw new \Exception('Cant save category ' . $categoryName);
        }

        $this->categories[$categoryName] = $category->id;

        if ($changeExistStatus && !$category->is_exist) {
            $category->is_exist = true;
            $category->save();
        }

        return $category->id;
    }

    public function dd()
    {
        dd($this->categories);
    }
}
