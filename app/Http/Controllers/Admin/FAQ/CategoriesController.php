<?php

namespace App\Http\Controllers\Admin\FAQ;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\FaqCategory;

class CategoriesController extends Controller
{
    /**
     * Display a listing of faq_category.
     *
     * @return Response
     */
    public function index()
    {
//        save_resource_url();

//        return $this->view('faq.categories.index')->with('items', FaqCategory::all());

    }

    /**
     * Show the form for creating a new faq_category.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('faq.categories.create_edit');
    }

    /**
     * Store a newly created faq_category in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Requests\AdminRequest $request)
    {
        $this->validate($request, FaqCategory::$rules);

        FaqCategory::create(['name' => $request->name]);

        return ResponseFormatter::success([],'Faq category created succesfully');
    }

    /**
     * Display the specified faq_category.
     *
     * @param FaqCategory $category
     * @return Response
     */
    public function show(Requests\AdminRequest $category)
    {
        return $this->view('faq..categories.show')->with('item', $category);
    }

    /**
     * Show the form for editing the specified faq_category.
     *
     * @param FaqCategory $category
     * @return Response
     */
    public function edit(Requests\AdminRequest $category)
    {
        return $this->view('faq.categories.create_edit')->with('item', $category);
    }

    /**
     * Update the specified faq_category in storage.
     *
     * @param FaqCategory $category
     * @param Request     $request
     * @return Response
     */
    public function update(FaqCategory $category, Requests\AdminRequest $request)
    {
        $this->validate($request, FaqCategory::$rules);

        $category->name = $request->name;

        return ResponseFormatter::success([],'Category updated succesfully');

    }

    /**
     * Remove the specified faq_category from storage.
     *
     * @param FaqCategory $category
     * @param Request     $request
     * @return Response
     */
    public function destroy(FaqCategory $category, Requests\AdminRequest $request)
    {
        $this->deleteEntry($category, $request);

        return redirect_to_resource();
    }
}
