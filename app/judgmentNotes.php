<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\judgments;
class judgmentNotes extends Model
{
    protected $fillable = [
      'judgment_id','judgrule','judgshort',
    ];

  public function judgments()
  {
    return $this->belongsTo(judgments::class);
  }
}
