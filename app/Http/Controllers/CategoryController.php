<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Service\CategoryService;
use App\Service\UserService;

class CategoryController extends BaseController
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService, UserService $userService)
    {
        $this->middleware('auth');
        parent::__construct($userService);
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryService->allCategory();

        return view('admin.categories.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryService->allCategory();

        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $name = $request->name;
        $parentId = $request->parent_id;
        $this->categoryService->createCategory($name, $parentId);
        $categories = $this->categoryService->allCategory();

        return redirect()->route('categories.index', compact('categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        $categories = $this->categoryService->allCategory();

        return view(
            'admin.categories.edit',
            [
                'categories' => $categories,
                'category' =>$category,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->name;
        $parentId = $request->parent_id;
        $this->categoryService->updateCategory($id, $name, $parentId);
        $categories = $this->categoryService->allCategory();

        return redirect()->route('categories.index', compact('categories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->categoryService->deleteCategory($id);
        $categories = $this->categoryService->allCategory();

        return response()->json($product);

    }
}
