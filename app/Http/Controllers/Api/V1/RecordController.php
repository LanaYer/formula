<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class RecordController extends Controller
{
    /**
     * @param $param
     * @return string
     */
    public function get($param) {
        if (is_numeric($param)) {
            $record = DB::table('records')
                ->select(['date', 'time_start', 'time_end', 'box_id', 'car_num', 'car_id', 'card_id'])
                ->where('id', $param)
                ->get()
                ->first();

            return json_encode($record);
        } else {
            $record = DB::table('records')
                ->select(['date', 'time_start', 'time_end', 'box_id', 'car_num', 'car_id', 'card_id'])
                ->where('date', $param)
                ->get()
                ->toArray();

            return json_encode($record);
        }
    }

    /**
     * @return string
     */
    public function create() {
        if (!request()->get('date') && request()->get('time_start')
            && request()->get('time_end') && request()->get('box_id')) {
            return json_encode([
                'status' => 'error',
                'message' => 'Не переданы обязательные параметры!'
            ]);
        }

        try {
            $record = new Record();
            $record->date = request()->get('date');
            $record->time_start = request()->get('time_start');
            $record->time_end = request()->get('time_end');
            $record->box_id = request()->get('box_id');
            $record->description = request()->get('description', '');
            $record->car_num = request()->get('car_num', '');
            $record->car_id = request()->get('car_id', 1);
            $record->card_id = request()->get('card_id', 1);
            $record->save();

            return json_encode([
                'status' => 'success',
                'id' => $record->id
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
            $record = DB::table('records')
                ->where('id', request()->get('id'));

            try {
                $record->delete();
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
