<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercicio;
use App\Models\Treino as ModelsTreino;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class Treino extends Controller
{
    public function index() {
        $users = User::query()
        ->when(FacadesRequest::input('search'), function($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })
        ->paginate(10)
        ->withQueryString();

        $transformedUsers = $users->through(fn($user) => [
            'id' => $user->id,
            'name' => $user->name,
        ]);
 

        return Inertia::render('Admin/Treinos', [
            'users' => [
                'users' => $transformedUsers,
                'user' => Auth::user(),
                'filters' => FacadesRequest::only(['search']),
            ]
        ]);
    }

    public function create($id) {
        $user = User::with('treinos.exercicios')->find($id);

        return Inertia::render('Admin/CreateTreinos', [
            'id' => $id,
            'targetUser' => $user,
            'user' => auth()->user(),
        ]);
    }

    public function store(Request $request, $id) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dia' => ['required', 'string', 'max:255']
        ]);

        $user = User::find($id);

        $treino = new ModelsTreino();

        $treino->user_id = $user->id;
        $treino->name = $validated['name'];
        $treino->dia = $validated['dia'];

        $treino->save();
 
        return Redirect::route('admin.treinos.create', $id)->with('success', 'Treino created successfully!');
    }

    public function get($id) {
        $treino = ModelsTreino::findOrFail($id);
        

        return Inertia::render('Admin/AddExercise', [
            'treino' => $treino,
            'user' => Auth::user(),
            'exercicios' => $treino->exercicios,
        ]);
    }

    public function createExercise(Request $request, $id) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'repeticoes' => ['required', 'string', 'max:255'],
            'series' => ['required', 'string', 'max:255'],
            'descanso' => ['required', 'string', 'max:255'],
        ]);

        $treino = ModelsTreino::findOrFail($id);
        
        $exercicio = new Exercicio();

        $exercicio->treino_id = $treino->id;
        $exercicio->name = $validated['name'];
        $exercicio->repeticoes = $validated['repeticoes'];
        $exercicio->series = $validated['series'];
        $exercicio->descanso = $validated['descanso'];

        $exercicio->save();

        return Redirect::route('admin.exercicio.create', $id)->with('success', 'Exercicio created successfully!');
    }

    public function destroy($id ) {
        $treino = ModelsTreino::findOrFail($id);

        $treino->delete();

        return back()->with('success', 'Treino deleted successfully!');

    }
}
