<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){

        return inertia()->render('Comments/Index', [
            'greeting' => 'Hello World',
        ]);
    }
}
