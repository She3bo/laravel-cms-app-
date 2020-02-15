<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\category;
class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title','description','content','category_id','image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
