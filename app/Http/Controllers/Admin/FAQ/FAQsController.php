<?php

namespace App\Http\Controllers\Admin\FAQ;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\FAQ;
use App\Models\FaqCategory;


class FAQsController extends Controller
{
    /**
     * Display a listing of faq.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();
        $items = FAQ::with('category')->get();

        return $this->view('faq.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new faq.
     *
     * @return Response
     */
    public function create()
    {
        $categories = FaqCategory::getAllList();

        return $this->view('faq.create_edit', compact('categories'));
    }

    /**
     * Store a newly created faq in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Requests\AdminRequest $request)
    {
        $this->validate($request, FAQ::$rules);

        $faq = FAQ::create(['answer' => $request->answer, 'question' => $request->question, 'category_id' => $request->category_id]);

        return ResponseFormatter::success([$faq], 'Faq question created');
    }

    /**
     * Display the specified faq.
     *
     * @param FAQ $faq
     * @return Response
     */
    public function show(FAQ $faq)
    {
        return $this->view('faq.show')->with('item', $faq);
    }

    /**
     * Show the form for editing the specified faq.
     *
     * @param FAQ $faq
     * @return Response
     */
    public function edit(FAQ $faq)
    {
        $categories = FaqCategory::getAllList();

        return $this->view('faq.create_edit', compact('categories'))->with('item', $faq);
    }

    /**
     * Update the specified faq in storage.
     *
     * @param FAQ $faq
     * @param Request $request
     * @return Response
     */
    public function update(FAQ $faq, Requests\AdminRequest $request)
    {
        $this->validate($request, FAQ::$rules);

        $faq->update($request->only('question', 'answer', 'category_id'));

        return ResponseFormatter::success([$faq], 'Faq question updated');
    }

    /**
     * Remove the specified faq from storage.
     *
     * @param FAQ $faq
     * @param Request $request
     * @return Response
     */
    public function destroy(FAQ $faq, Requests\AdminRequest $request)
    {
        $this->deleteEntry($faq, $request);

        return redirect_to_resource();
    }
}
