<?php

namespace App\Http\Controllers\Website;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\FAQ;
use App\Models\FaqCategory;


class FAQController extends Controller
{
    public function index(Request $request)
    {


        $categories = FaqCategory::getAllList();
        $questions = FaqCategory::with('faqs')->orderBy('name');

        if (isset($request->category_id))
            $questions =  $questions->whereHas('faqs', function ($x) use ($request) {
                $x->where('category_id', $request->category_id);
            });


        $questions = $questions->get();

        if ($request->request_origin == 'web')
            return datatables($questions)->toJson();


        return ResponseFormatter::success([compact('questions', 'categories')]);

        //         return view('website.faq.faq', compact('items', 'categories'));
    }

    /**
     * Increments the total views
     * @param FAQ    $faq
     * @param string $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function incrementClick(FAQ $faq, $type = 'total_read')
    {
        if ($type == 'total_read' || $type == 'helpful_yes' || $type == 'helpful_no') {
            $faq->increment($type);
        }

        return json_response('');
    }

    public function showFaqPage()
    {
        //return view('Settings.faq');
        $faq_categories = FaqCategory::all();
        return view('Settings.faq', compact('faq_categories'));
    }



    /* public function showFaqPage()
    {
        $categories = FaqCategory::all();
        return view('showFaqPage', compact('categories'));
    } */
}
