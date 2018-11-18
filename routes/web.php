<?php

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

Route::group(['midlleware' => 'web'], function() {

    // Auth
    Auth::routes();

    // Index
    Route::get('/', 'HomeController@index');

    Route::get('/home', 'HomeController@index');

    //
    // Member
    //

    // Daftar Peminjaman
    Route::get('member/books', 'BooksController@memberBook');

    // Daftar Buku untuk dipinjam
    Route::get('books/{books}/borrow', [
        'middleware' => ['auth', 'role:member'],
        'as' => 'member.books.borrow',
        'uses' => 'BooksController@borrow'
    ]);

    // Pengembalian buku
    Route::put('books/{book}/return', [
        'middleware' => ['auth', 'role:member'],
        'as' => 'member.books.return',
        'uses' => 'BooksController@returnBack'
    ]);

    //
    // Berlaku untuk Member & Admin
    //

    // Profile
    Route::get('settings/profile', 'SettingsController@profile');

    // Edit Profile
    Route::get('settings/profile/edit', 'SettingsController@editProfile');

    // Update Profile
    Route::post('settings/profile', 'SettingsController@updateProfile');

    // Ubah password
    Route::get('settings/password', 'SettingsController@editPassword');
    Route::post('settings/password', 'SettingsController@updatePassword');

    //
    // Aktiviasi & Verifikasi Email
    //

    // Kirim Email Verifikasi waktu Register
    Route::get('auth/verify/{token}', 'Auth\RegisterController@verify');

    // Kirim Ulang email Verifikasi
    Route::get('auth/send-verification', 'Auth\RegisterController@sendVerification');

    // Admin
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function() {
        Route::resource('authors', 'AuthorsController');
        Route::resource('books', 'BooksController');
        Route::resource('members', 'MembersController', [
            'only' => ['index', 'show', 'destroy']
        ]);

        // Daftar peminjaman
        Route::get('statistics', [
            'as' => 'statistics.index',
            'uses' => 'StatisticsController@index'
        ]);

        // Export buku
        Route::get('export/books', [
            'as' => 'export.books',
            'uses' => 'BooksController@export'
        ]);

        Route::post('export/books', [
            'as' => 'export.books.post',
            'uses' => 'BooksController@exportPost'
        ]);

        // Download template buku
        Route::get('template/books', [
            'as' => 'template.books',
            'uses' => 'BooksController@generateExcelTemplate'
        ]);

        // Import dari excel
        Route::post('import/books', [
            'as' => 'import.books',
            'uses' => 'BooksController@importExcel'
        ]);
    });
});
