<?php

declare(strict_types=1);

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProgramController;
use App\Http\Controllers\Api\SolutionController;
use App\Http\Controllers\Api\TelegramController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('auth', [AuthController::class, 'auth'])->name('auth.auth');

Route::group(['middleware' => ['auth:sanctum']], static function () {
    Route::group(['prefix' => 'users'], static function () {
        Route::get('/{id}/childrens', [UserController::class, 'childrens'])->name('users.childrens');
        Route::get('/{id}/achievements', [UserController::class, 'achievements'])->name('users.achievements');
        Route::get('/{id}/programs', [UserController::class, 'programs'])->name('users.programs');
        Route::get('/{user_id}/programs/{program_id}/marks', [SolutionController::class, 'list'])->name('marks.list');
        Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
        Route::post('/{id}', [UserController::class, 'update'])->name('users.update');
    });

    Route::group(['prefix' => 'programs'], static function () {
        Route::get('/{id}/lessons/{lessonId}', [ProgramController::class, 'lesson'])->name('programs.lesson');
        Route::post('/{id}/lessons/{lessonId}/exercises', [ProgramController::class, 'storeExercises'])->name('programs.storeExercises');
        Route::delete('/{id}/lessons/{lessonId}/exercises/{exerciseId}', [ProgramController::class, 'removeExercises'])->name('programs.removeExercises');
        Route::post('/{id}/lessons/{lessonId}/exercises/{exerciseId}/solutions/solve', [ProgramController::class, 'solutionsSolve'])->name('programs.solutionsSolve');
        Route::post('/{id}/lessons/{lessonId}/exercises/{exerciseId}/solutions/verify', [ProgramController::class, 'solutionsVerify'])->name('programs.solutionsVerify');
        Route::get('/{id}/lessons/{lessonId}/exercises/{exerciseId}/solutions', [ProgramController::class, 'getListSolutions'])->name('programs.getListSolutions');
        Route::get('/{id}/lessons/{lessonId}/exercises/{exerciseId}/isSolved', [ProgramController::class, 'isSolved'])->name('programs.isSolved');
        Route::get('/{id}/lessons', [ProgramController::class, 'lessons'])->name('programs.lessons');
        Route::post('/{id}/lessons', [ProgramController::class, 'storeLesson'])->name('programs.storeLesson');
        Route::delete('/{id}/lessons/{lessonId}', [ProgramController::class, 'removeLesson'])->name('programs.removeLesson');
        Route::post('/{id}', [ProgramController::class, 'signUp'])->name('programs.signUp');
        Route::get('/', [ProgramController::class, 'list'])->name('programs.list');
        Route::get('/{id}', [ProgramController::class, 'show'])->name('programs.show');
    });
});

Route::post('sync-telegram', [TelegramController::class, 'syncTelegram'])->name('auth.syncTelegram');
