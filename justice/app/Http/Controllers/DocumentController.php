<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('dossier','user')->latest()->get();

        return view('documents.index', compact('documents'));
    }
}