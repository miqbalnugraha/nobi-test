<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use App\Models\Balance;

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
            return response()->json(['message' => 'insufficient of amount']);
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
}
