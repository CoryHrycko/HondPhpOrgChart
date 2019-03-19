<?php
namespace App\Http\Controllers;
use App\Contact;
use App\CsvData;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Http\Request;
//use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;



class ImportController extends Controller
{
    public function getImport()
    {
        return view('import');
    }
    public function processImport(Request $request)
    {
//        $data = CsvData::find($request->csv_data_file_id);
//        $csv_data = json_decode($data->csv_data, true);

        if (($handle = fopen ( CsvData::find($request->csv_data_file_id), 'r' )) !== FALSE) {
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

        return view ( 'welcome' )->withData ( $finalData );}

//        foreach ($csv_data as $row) {
//            $contact = new Contact();
//            foreach (config('app.db_fields') as $index => $field) {
//                if ($data->csv_header) {
//                    $contact->$field = $row[$request->fields[$field]];
//                } else {
//                    $contact->$field = $row[$request->fields[$index]];
//                }
//            }
//            $contact->save();
//        }

//
//        return view('import_success');
//    }
//}
public function index()
{
    $FirstName = DB::select('select FirstName from csv_data', [1]);

    return view('import', ['FirstName' => $FirstName]);
}
}
