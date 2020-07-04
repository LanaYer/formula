<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Box;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class BoxController extends Controller
{
    /**
     * @param null $id
     * @return string
     */
    public function get($id = null) {
        if ($id) {
            $box = DB::table('boxes')
                ->select(['box_name', 'description'])
                ->where('id', $id)
                ->get()
                ->first();

            return json_encode($box);
        } else {
            $box = DB::table('boxes')
                ->select(['box_name', 'description'])
                ->get()
                ->toArray();

            return json_encode($box);
        }
    }

    /**
     * @return string
     */
    public function create() {
        try {
            $box = new Box();
            $box->box_name = request()->get('box_name');
            $box->description = request()->get('description');
            $box->save();
            return json_encode([
                'status' => 'success',
                'id' => $box->id
            ]);
        } catch (Exception $e) {
            return json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * @return string
     */
    public function delete() {
        if (request()->get('id')) {
            $box = DB::table('boxes')
                ->where('id', request()->get('id'));

            try {
                $box->delete();
                return json_encode([
                    'status' => 'success'
                ]);
            } catch (Exception $e) {
                return json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }
    }
}
