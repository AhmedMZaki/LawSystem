<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LawArticl;
class Law extends Model
{
    protected $fillable = [
      'lawtype','lawno','lawyear','lawrelation','lawcategory','lawfile','slug'
    ];

  //protected $with = ['LawArticles'];

    public function lawArticles()
    {
      return $this->hasMany(LawArticl::class,'laws_id');
    }


}
