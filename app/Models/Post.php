<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    // relación con el modelo de Usuario
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']); // un post pertenece a un solo usuario
    }

    // relación con el modelo de comentario
    public function comentarios()
    {
        return $this->hasMany(Comentario::class); // relación muchos a muchos
    }

    // relación con el modelo de likes
    public function likes()
    {
        return $this->hasMany(Like::class); // relación muchos a muchos
    }

    // revisa si un usuario ya dio like a un post
    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

}
