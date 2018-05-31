<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['name', 'description', 'company_id', 'category_id', 'price', 'price_discount', 'discount', 'img', 'data', 'link'];

    public function company()
    {
        return $this->hasOne('App\Company', 'id', 'company_id');
    }
}
