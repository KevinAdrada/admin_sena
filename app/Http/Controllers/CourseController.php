<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Environment;
use App\Models\Area;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['environment', 'areas'])->orderBy('id', 'asc')->get();
        return view('course.index', compact('courses'));
    }

    public function create()
    {
        $environments = Environment::all();
        $areas = Area::all();
        return view('course.create', compact('environments', 'areas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_name'    => 'required|string|max:255',
            'course_number'  => 'required|string|max:50|unique:courses,course_number',
            'program_type'   => 'required|in:tecnico,tecnologo',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'environment_id' => 'required|exists:environments,id',
            'areas'          => 'nullable|array',
            'areas.*'        => 'exists:areas,id',
        ]);

        $courseData = collect($validated)->except('areas')->toArray();
        $course = Course::create($courseData);

        $course->areas()->sync($request->input('areas', []));

        return redirect()->route('course.index')->with('success', 'Curso creado correctamente.');
    }

    public function show(Course $course)
    {
        $course->load(['environment', 'areas']);
        return view('course.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $environments = Environment::all();
        $areas = Area::all();
        $course->load('areas');
        return view('course.edit', compact('course', 'environments', 'areas'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_name'    => 'required|string|max:255',
            'course_number'  => 'required|string|max:50|unique:courses,course_number,' . $course->id,
            'program_type'   => 'required|in:tecnico,tecnologo',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'environment_id' => 'required|exists:environments,id',
            'areas'          => 'nullable|array',
            'areas.*'        => 'exists:areas,id',
        ]);

        $courseData = collect($validated)->except('areas')->toArray();
        $course->update($courseData);

        $course->areas()->sync($request->input('areas', []));

        return redirect()->route('course.index')->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy(Course $course)
    {
        $course->areas()->detach();
        $course->delete();
        return redirect()->route('course.index')->with('success', 'Curso eliminado correctamente.');
    }
}