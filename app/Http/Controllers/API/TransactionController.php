<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function transaction(Request $request) {
        $validator = Validator::make($request->all(), [
            'trx_id' => 'required|string|max:255|unique:transaction,trx_id',
            'amount' => 'required|float|unique:users,email',
            'user_id' => 'required|integer'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        $data = Transaction::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()
        ->json([
            'data' => $data,
            'user_id' => $data->id,            
            'message' => 'Register success',
        ]);
    }
}
