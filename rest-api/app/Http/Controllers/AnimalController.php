<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public $animals = [
        ["name" => "Panda"],
        ["name" => "Nyamuk"],
        ["name" => "Ayam"]
    ];

    public function index()
    {
        foreach ($this->animals as $animal) {
            echo "Nama Hewan : $animal[name] <br>";
        }
    }

    public function store(Request $request)
    {
        array_push($this->animals, $request);
        $this->index();
    }

    public function update(Request $request, $id)
    {
        $this->animals[$id] = $request;
        $this->index();
    }

    public function destroy($id)
    {
        unset($this->animals[$id]);
        $this->index();
    }
}
