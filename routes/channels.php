<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('futbol-femeni', function ($user) {
    return true; // Autorització
});
