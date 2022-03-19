<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use App\Models\Balance;
use Maatwebsite\Excel\Facades\Excel; 
use Illuminate\Support\Facades\Config;
use App\Imports\CryptoTransactionImport;

class TransactionController extends Controller
{
    public function transaction(Request $request) {
        $user_id = $request->user_id;

        if($request->amount == 0.00000001) {
            return response()->json(['message' => 'the amount must be more than 0.00000001']);
        }

        $validator = Validator::make($request->all(), [
            'trx_id' => 'required|string|max:255|unique:transaction,trx_id',
            'amount' => 'required|numeric|between:0.00000001,50.00000000',
            'user_id' => 'required|integer'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        $balance = Balance::findOrFail($user_id);

        if($balance->amount_available < $request->amount) {
            return response()->json(['message' => 'insufficient of balance']);
        }

        $data = Transaction::create([
            'trx_id' => $request->trx_id,
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        sleep(30);

        $balance->amount_available = $balance->amount_available - $request->amount;
        $balance->updated_at = \Carbon\Carbon::now();
        $query = $balance->save();

        if($query){
            return response()
                ->json([
                    'trx_id' => $data->trx_id,
                    'amount' => bcdiv($data->amount, 1, 6),   
                    'balance' => bcdiv($balance->amount_available, 1, 6),        
                    'message' => 'Transaction success',
                ]);
        } else {
            return response()->json(['code' => 0, 'massage'=>'Something went wrong']);
        }
    }

    public function import(Request $request) {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt|max:100000'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        try{
            Config::set('excel::csv.delimiter', ',');
            Excel::import(new CryptoTransactionImport, request()->file('file')->store('temp'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
        
            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
                }
            return response()->json($failures);
            }
            
        return response()
            ->json([       
                'message' => 'Data has been successfully imported',
            ]);
        }
}
