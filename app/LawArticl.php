<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Law;
use App\judgments;
class LawArticl extends Model
{
  protected $fillable =
  [
    'law_id','articleno','articlebody'
  ];
  
    public function Law()
    {
      return $this->belongsTo(Law::class,'law_id');
    }

    public function Judgments()
    {
        return $this->belongsToMany(judgments::class,'judgments_lawarticles','judgments_id','law_articls_id');
    }
}
