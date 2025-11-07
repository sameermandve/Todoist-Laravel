<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    use HasFactory, Notifiable;
    protected $table = "tasks";
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'status',
        'user_id',
    ];

    protected function status(): Attribute{
        return Attribute::make(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower($value),
        );
    }

    protected function createdAtFormatted(): Attribute{
        return Attribute::make(
            get: fn() => $this->created_at->format("d M, Y"),
        );
    }

    protected function deadline(): Attribute{
        return Attribute::make(
            get: fn($value) => date("d M, Y", strtotime($value)),
        );
    }
}
