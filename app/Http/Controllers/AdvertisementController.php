<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdvertisementStoreRequest;
use App\Http\Requests\AdvertisementUpdateRequest;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $advertisements = Advertisement::orderBy('order');

        if ($request->status)
            $advertisements->where('status', $request->status);

        if ($request->request_origin == 'web')
            return datatables($advertisements)->toJson();

        return ResponseFormatter::success($advertisements->get(), 'Advertisement list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertisementStoreRequest $request)
    {

        if ($request->advertisement_type == 'IMAGE')
            $advertisementImage = (new FileHelper())->storeFileOnS3($request->file('advertisement_image'), 'advertisement_images');

        $ad = Advertisement::create(
            $request->except('advertisement_img_url') +
            [
                'order' => Advertisement::latest('order')->first()->order + 1,
            ] +
            (isset($advertisementImage) ? ['advertisement_img_url' => $advertisementImage] : [])
        );

        return ResponseFormatter::success($ad, 'Advertisement created succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertisement $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertisement $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $advertisement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Advertisement $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertisementUpdateRequest $request, Advertisement $advertisement)
    {
        if ($request->advertisement_image) {
            $advertisementImage = (new FileHelper())->storeFileOnS3($request->file('advertisement_image'), 'advertisement_images');
            $advertisement->advertisement_img_url = $advertisementImage;
        }

        $advertisement->fill($request->all());
        $advertisement->save();

        return ResponseFormatter::success($advertisement, 'Advertisement updated success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertisement $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdvertisementUpdateRequest $request, Advertisement $advertisement)
    {

        $advertisement->delete();

        return ResponseFormatter::success([], 'Advertisement deleted success');

    }

    function updateStatus(AdvertisementUpdateRequest $request, Advertisement $advertisement)
    {
        $advertisement->status = $request->status;
        $advertisement->save();

        return ResponseFormatter::success($advertisement, 'Advertisement updated success');
    }


    function changeOrder(AdvertisementUpdateRequest $request)
    {

        $order = collect($request->all());

        $advertisments = Advertisement::whereIn('id', $order->pluck('id'))->get();

        $advertisments->each(function ($ad) use ($order) {
            $ad->order = $order->where('id', $ad->id)->first()['order'];
            $ad->save();
        });

        $newOrder = Advertisement::where('status', true)->orderBy('order')->get();

        return ResponseFormatter::success($newOrder, 'Advertisement order updated');
    }

    public function showAdvertisementPage()
    {
        return view('Settings.advertisement_list');
    }
}
