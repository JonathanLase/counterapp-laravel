<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function dashboard()
    {
        // Set locale untuk bahasa Indonesia
        setlocale(LC_TIME, 'id_ID');

        $dataCounter = Counter::all()->map(function ($counter) {
            $created_at = Carbon::parse($counter->created_at);
            $counter['created_at_formatted'] = ucfirst($created_at->translatedFormat('l, j F Y')); // Format tanggal dengan nama hari, tanggal, bulan, dan tahun dalam bahasa Indonesia
            $counter['created_at_time'] = $created_at->toTimeString(); // Mendapatkan waktu
            return $counter;
        });

        $data = [
            'title' => 'Dashboard',
            'data' => $dataCounter
        ];

        return view('dashboard', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
        ];

        $this->validate($request, $rules);

        Counter::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Data created successfully');
    }

    public function delete($id)
    {
        $counter = Counter::find($id);
        $counter->delete();
        return redirect()->route('dashboard')->with('success', 'Data deleted successfully');
    }

    public function update($id)
    {
        $counter = Counter::find($id);
        return view('counter', compact('counter'));
    }

    public function increment($id)
    {
        $counter = Counter::findOrFail($id);
        $counter->count++;
        $counter->save();
        return response()->json(['count' => $counter->count]);
    }

    public function decrement($id)
    {
        $counter = Counter::findOrFail($id);
        $counter->count--;
        $counter->save();
        return response()->json(['count' => $counter->count]);
    }
}
