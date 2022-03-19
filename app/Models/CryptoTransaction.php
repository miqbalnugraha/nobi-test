<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoTransaction extends Model
{
    use HasFactory;

    protected $table = 'crypto_transaction';
    protected $fillable = ['id', 'name', 'ticker', 'coin_id', 'code', 'exchange', 'invalid', 'record_time', 'usd', 'idr', 'hnst', 'eth', 'btc', 'created_at', 'updated_at'];
}
