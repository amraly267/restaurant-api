<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meal;

class MealController extends Controller
{
    public function menu()
    {
        return Meal::all();
    }
}
