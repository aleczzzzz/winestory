<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'total', 'quantity', 'status', 'reference_id', 'signature'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function setReferenceIdAttribute($value)
    {
        $last = $this->all()->last();
        $id = $last ? $last->id + 1 : 1;
        $this->attributes['reference_id'] = 'WINESTORY' . date('Ym') . str_pad((string)$id, 6, '0', STR_PAD_LEFT);
    }

    public function setSignatureAttribute($value)
    {
        $this->attributes['signature'] = strtoupper(md5(strrev(config('services.paynamics.client_id') . $this->reference_id . $this->total)));
    }
}
