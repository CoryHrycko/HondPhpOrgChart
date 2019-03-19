<?php
/**
 * Created by PhpStorm.
 * User: cory-sfg
 * Date: 3/14/2019
 * Time: 1:03 AM
 */

if (($handle = fopen ( public_path () . '/DATA.csv', 'r' )) !== FALSE) {
    while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {

        //saving to db logic goes here
        $csv_data = new Csvdata ();
        $csv_data->id = $data [0];
        $csv_data->EmployeeId = $data [1];
        $csv_data->FirstName = $data [2];
        $csv_data->LastName = $data [3];
        $csv_data->Title = $data [4];
        $csv_data->ManagerId = $data [5];
        $csv_data->save ();
    }
    fclose ( $handle );
}
    $finalData = $csv_data::all ();

    return view ( 'welcome' )->withData ( $finalData );
