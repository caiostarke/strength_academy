<?php

use App\Http\Controllers\Admin\Treino;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;
use App\Models\Progressao;
use App\Models\ProgressaoRecord;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/home', function() {
    return Inertia::render('Home', [
        'name' => 'Kaer',
        'frameworks' => ['Laravel', 'Inertia', 'vue3'],
    ]);
});

Route::middleware([CheckRole::class . ':admin'],)->group(function () {
    Route::get('/admin/users', [Treino::class, 'index'])
    ->middleware('auth', 'verified')
    ->name('admin.users');

    Route::get('/admin/user/{id}', [Treino::class, 'create'])
    ->middleware('auth', 'verified')
    ->name('admin.treinos.create');

    Route::post('/admin/user/{id}', [Treino::class, 'store'])
    ->middleware('auth', 'verified')
    ->name('admin.treinos.store');

    Route::get('/admin/treino/{id}', [Treino::class, 'get'])
    ->middleware('auth', 'verified')
    ->name('admin.treinos.get');

    Route::post('/admin/treino/{id}', [Treino::class, 'createExercise'])
    ->middleware('auth', 'verified')
    ->name('admin.exercicio.create');

    Route::delete('/admin/treino/{id}', [Treino::class, 'destroy'])
    ->middleware('auth', 'verified')
    ->name('admin.treino.destroy');
});

Route::middleware([CheckRole::class . ':user'],)->group(function () {
    Route::get('/treinos', function () {
        $user = auth()->user();
        $user = User::with('treinos.exercicios')->find($user->id);
    
    
        return Inertia::render('User/Treinos', [
            'user' => $user,
        ]);
    })->middleware(['auth', 'verified'])->name('user.treinos');

    Route::get('/progressao', function() {
        $userID = auth()->user()->id;
        $user = User::with('progressao_records.progressaos')->find($userID);

        return Inertia::render('User/Progressao', [
            'user' =>  $user,
        ]);
    })->middleware(['auth', 'verified'])->name('user.progressao');

    Route::post('/progressao', function(Request $request) {
        $validated = $request->validate([
            'progressaoRecordID' => ['nullable'],
            'exerciseName' => ['required', 'string', 'max:255'],
            'weight' => ['required', 'integer'],
        ]);

        if (!$validated['progressaoRecordID']) {
            $progressao_record = new ProgressaoRecord();
            $progressao_record->user_id = auth()->user()->id;
            $progressao_record->exercise_name = $validated['exerciseName'];
            $progressao_record->save(); 
        } else {
            $progressao_record = ProgressaoRecord::findOrFail($validated['progressaoRecordID']);
        }

        $progressao = new Progressao();
        $progressao->progressao_record_id = $progressao_record->id;
        $progressao->weight = $validated['weight'];
        $progressao->save();

        return back()->with('success', 'Progressao Record created succesfully!');

    })->middleware(['auth', 'verified'])->name('user.progressao.new');

    
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'user' => [
            'user' => auth()->user(),
            'plan' => auth()->user()->plan,
        ]
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
