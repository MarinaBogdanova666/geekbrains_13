<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = $this->getCategory();

        return view('category.index', [
            'category' => $category
        ]);
    }
}
