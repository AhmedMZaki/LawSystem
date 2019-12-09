<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LawArticl;
use App\judgmentNotes;
class judgments extends Model
{
    protected $fillable = [
        'judgmentfile','judgmentcategory','judgmentDate','year','objectionNo','notes','incompletednotes'
    ];

    public function Articls()
    {
        return $this->belongsToMany(LawArticl::class,'judgments_lawarticles','judgments_id','law_articls_id');
    }

    public function judgmentnotes()
    {
      return $this->hasMany(judgmentNotes::class);
    }
}
