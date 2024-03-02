<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'dia'];

    public function user() {
        $this->belongsTo(User::class);
    }

    public function exercicios() {
        return $this->hasMany(Exercicio::class);
    }
}
