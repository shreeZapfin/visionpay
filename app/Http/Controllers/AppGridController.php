<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\AdminRequest;

use App\Models\AppGrid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use function PHPUnit\Framework\isInstanceOf;

class AppGridController extends Controller
{
    //

    function getGrid()
    {

        return ResponseFormatter::success(AppGrid::with('appGridFor')->get());
    }


    function updateGrid(AdminRequest $request)
    {
        $this->validate($request, [
            'app_grid.*.grid_no' => 'in:1,2,3,4,5,6,7,8|distinct',
            'app_grid.*.type' => 'nullable|in:singular,category',
            'app_grid.*.grid_for' => 'nullable|in:App\Models\Biller,App\Models\BillerCategory'  #Add whenever want to add more table relations in grid
        ]);


        $grid = $request->app_grid;

        foreach ($grid as $item) {
            AppGrid::where('id', $item['id'])->update($item);
        }


        return ResponseFormatter::success([],'App grid updated succesfully');
    }

    public function showAppGridPage()
    {
        return view('Settings.grid_view');
    }
}
