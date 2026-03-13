<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'user_id',
        'nama_customer',
        'total_quantity',
        'total_transaksi',
        'tanggal_transaksi',
        'updated_at'
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}