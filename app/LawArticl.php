<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Law;
use App\judgments;
class LawArticl extends Model
{
    protected $fillable =
        [
            'laws_id','articleno','articlebody'
        ];
        //protected $with = ['Law'];
    public function law()
    {
        return $this->belongsTo(Law::class,'laws_id');
    }

    public function Judgments()
    {
        return $this->belongsToMany(judgments::class,'judgments_lawarticles','judgments_id','law_articls_id');
    }
}
