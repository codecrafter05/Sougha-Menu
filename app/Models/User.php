<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    // لو عندك fillable/hidden/ casts خلها مثل ما هي

    public function canAccessPanel(Panel $panel): bool
    {
        // مؤقتًا للسماح للجميع – جرّب الدخول.
        // لاحقًا تقدر تستبدلها بشرط مثل: return (bool) $this->is_admin;
        return true;
    }
}
