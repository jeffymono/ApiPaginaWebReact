<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    /**
     * Get the author that this book belongs to
     */
    public function category()
    {
        return $this->belongsTo('\App\Category');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pro_marca', 'pro_modelo', 'pro_imagen', 'pro_descripcion', 'pro_dimesiones', 'pro_estado', 'categoria_id', 'created_at', 'updated_at'
    ];
    /**
     * The attributes that are excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}