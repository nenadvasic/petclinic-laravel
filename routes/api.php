<?php

use App\Models\Enum\UserRole;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// TODO CORS

Route::post('sign-up', 'Auth\RegisterController@register');
Route::post('sign-in', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth:api'], function () {

    Route::post('logout', 'Auth\LoginController@logout');

    // Owner CRUD
    Route::post('/owner', 'OwnerController@createOwner');
    Route::get('/owner/{owner_id}', 'OwnerController@readOwner');
    Route::put('/owner/{owner_id}', 'OwnerController@updateOwner');
    Route::delete('/owner/{owner_id}', 'OwnerController@deleteOwner');

    Route::group(['middleware' => 'role:' . UserRole::VET], function () {

        Route::get('/allOwners', 'OwnerController@allOwners');
        Route::get('/owners', 'OwnerController@ownersForAddress');
        Route::get('/ownersWithPets', 'OwnerController@ownersWithPets');
        Route::get('/owner/{owner_id}/pets', 'OwnerController@ownersPets');
        Route::get('/owner-vets', 'OwnerController@ownerVets');

        // Pet CRUD
        Route::post('/pet', 'PetController@createPet');
        Route::get('/pet/{pet_id}', 'PetController@readPet');
        Route::put('/pet/{pet_id}', 'PetController@updatePet');
        Route::delete('/pet/{pet_id}', 'PetController@deletePet');

        Route::get('/pets', 'PetController@pets');
        Route::get('/find-petby-type', 'PetController@findPetbyType');

        // Visit CRUD
        Route::post('/visit', 'VisitController@createVisit');
        Route::get('/visit/{visit_id}', 'VisitController@readVisit');
        Route::put('/visit/{visit_id}', 'VisitController@updateVisit');
        Route::delete('/visit/{visit_id}', 'VisitController@deleteVisit');

        Route::get('/vet-visits', 'VisitController@vetVisits');
        Route::get('/scheduled-visits', 'VisitController@scheduledVisits');
        Route::get('/my-visits', 'VisitController@myVisits');
    });

    Route::group(['middleware' => 'role:' . UserRole::OWNER], function () {
        Route::get('/my-pets', 'OwnerController@myPets');
    });

    Route::group(['middleware' => 'role:' . UserRole::ADMIN], function () {

        // User CRUD
        Route::post('/users', 'UserController@createUser');
        Route::get('/users/{user_id}', 'UserController@readUser');
        Route::put('/users/{user_id}', 'UserController@updateUser');
        Route::delete('/users/{user_id}', 'UserController@deleteUser');

        Route::get('/allUsers', 'UserController@users');
        Route::get('/admins', 'UserController@adminUsers');
        Route::get('/user', 'UserController@getActiveUser');
        Route::put('/active/simple', 'UserController@setUserActiveStatusSimple');

        // Vet CRUD
        Route::post('/vet', 'VetController@createVet');
        Route::get('/vet/{vet_id}', 'VetController@readVet');
        Route::put('/vet/{vet_id}', 'VetController@updateVet');
        Route::delete('/vet/{vet_id}', 'VetController@deleteVet');

        Route::get('/vets', 'VetController@vetsWithSpecialties');
        Route::get('/vet/info/{vet_id}', 'VetController@vetInfo');
    });

    // ADMIN || VET
    Route::group(['middleware' => 'role:' . sprintf('%s,%s', UserRole::ADMIN, UserRole::VET)], function () {
        Route::get('/non-admins', 'UserController@nonAdmins');
    });
});

