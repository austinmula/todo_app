<?php

namespace App\Models;

use App\Models\Presenters\TodoPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TheHiveTeam\Presentable\HasPresentable;

class Todo extends Model
{
    use HasFactory;
    use HasPresentable;

    protected $presenter = TodoPresenter::class;
    protected $fillable = [
        'name', 'description', 'status', 'image'
    ];
}
