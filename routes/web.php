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
use App\Csvdata;
use App\Http\Controllers\ImportController;

Route::match(['get','post'],'/demo', function () {

    if (($handle = fopen ( public_path () . '/DATA.csv', 'r' )) !== FALSE) {
        while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {

            //saving to db logic goes here
            $csv_data = new Csvdata ();
            $csv_data->EmployeeId = $data [0];
            $csv_data->FirstName = $data [1];
            $csv_data->LastName = $data [2];
            $csv_data->Title = $data [3];
            $csv_data->ManagerId = $data [4];
            $csv_data->save ();
        }
        fclose ( $handle );
    }
    $finalData = $csv_data::all ();

    return view ( 'welcome' )->withData ( $finalData );
}
    );
//Route::match(['get','post'],'/destroy', function () {
//    $finalData = 0;
//    mysqli->query('DROP TABLE IF EXISTS `dbName`.`tableName`') or die(mysqli_error($finalData));
//} );
//Route::get('/', 'ImportController@getImport')->name('index');
Route::get('/', 'ImportController@getImport')->name('import');
Route::post('/import_parse', 'ImportController@parseImport')->name('import_parse');
Route::post('/import_process', 'ImportController@processImport')->name('import_process');
//Route::match(['get','post'],'/', 'ImportController@index')->name ('index');
Route::match(['get','post'],'/import', 'ImportController@import')->name ('index');
