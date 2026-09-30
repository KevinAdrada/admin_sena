<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Training_center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['trainingCenter', 'images'])->latest()->paginate(10);
        return view('event.index', compact('events'));
    }

    public function create()
    {
        $trainingCenters = Training_center::all();
        return view('event.create', compact('trainingCenters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required|string',
            'location' => 'required|string|max:255',
            'training_center_id' => 'required|exists:training_centers,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $event = Event::create($request->all());

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $nombreArchivo = "ev_" . time() . "." . $file->guessExtension();
            $file->storeAs('images', $nombreArchivo, 'public');

            $event->images()->create([
                'imagen' => $nombreArchivo,
            ]);
        }

        return redirect(route('home') . '#eventos')->with('success', 'Evento creado exitosamente.');
    }

    public function show(Event $event)
    {
        $event->load(['trainingCenter', 'images']);
        return view('event.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $event->load('images');
        $trainingCenters = Training_center::all();
        return view('event.edit', compact('event', 'trainingCenters'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required|string',
            'location' => 'required|string|max:255',
            'training_center_id' => 'required|exists:training_centers,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $event->update($request->all());

        if ($request->hasFile('image')) {
            foreach ($event->images as $oldImage) {
                Storage::disk('public')->delete('images/' . $oldImage->imagen);
            }
            $event->images()->delete();

            $file = $request->file('image');
            $nombreArchivo = "ev_" . time() . "." . $file->guessExtension();
            $file->storeAs('images', $nombreArchivo, 'public');

            $event->images()->create([
                'imagen' => $nombreArchivo,
            ]);
        }

        return redirect()->route('event.show', $event->id)->with('success', 'Evento actualizado exitosamente.');
    }

    public function destroy(Event $event)
    {
        foreach ($event->images as $image) {
            Storage::disk('public')->delete('images/' . $image->imagen);
        }
        
        $event->images()->delete();
        $event->delete();

        return redirect(route('home') . '#eventos') ->with('success', 'Evento eliminado exitosamente.');
    }
}