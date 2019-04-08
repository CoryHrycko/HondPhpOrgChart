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
    public function parseImport(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();

            $data = array_map('str_getcsv', file($path));

        if (count($data) > 0) {
            if ($request->has('header')) {
                $csv_header_fields = [];
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
                }
            }
            $csv_data = array_slice($data, 0, 2);
            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }
        return view('import_fields', compact( 'csv_header_fields', 'csv_data', 'csv_data_file'));
    }
    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $contact = new Contact();
            foreach (config('app.db_fields') as $index => $field) {
                if ($data->csv_header) {
                    $contact->$field = $row[$request->fields[$field]];
                } else {
                    $contact->$field = $row[$request->fields[$index]];
                }
            }
            $contact->save();
        }
        return view('import_success');
    }




































//    public function getImport()
//    {
//        return view('import');
//    }
//    public function processImport(Request $request)
//    {
////        $data = CsvData::find($request->csv_data_file_id);
////        $csv_data = json_decode($data->csv_data, true);
//
//        if (($handle = fopen ( CsvData::find($request->csv_data_file_id), 'r' )) !== FALSE) {
//            while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
//
//                //saving to db logic goes here
//                $csv_data = new Csvdata ();
//                $csv_data->EmployeeId = $data [0];
//                $csv_data->FirstName = $data [1];
//                $csv_data->LastName = $data [2];
//                $csv_data->Title = $data [3];
//                $csv_data->ManagerId = $data [4];
//                $csv_data->save ();
//            }
//            fclose ( $handle );
//        }
//        $finalData = $csv_data::all ();
//
//        return view ( 'welcome' )->withData ( $finalData );}
//
////        foreach ($csv_data as $row) {
////            $contact = new Contact();
////            foreach (config('app.db_fields') as $index => $field) {
////                if ($data->csv_header) {
////                    $contact->$field = $row[$request->fields[$field]];
////                } else {
////                    $contact->$field = $row[$request->fields[$index]];
////                }
////            }
////            $contact->save();
////        }
//
////
////        return view('import_success');
////    }
////}
//public function index()
//{
//    $FirstName = DB::select('select FirstName from csv_data', [1]);
//
//    return view('import', ['FirstName' => $FirstName]);
//}
//
//    public function insert($request)
//    {
//        if (($handle = fopen ( CsvData::find($request->csv_data_file_id), 'r' )) !== FALSE) {
//            while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
//
//                //saving to db logic goes here
//                $csv_data = new Csvdata ();
//                $csv_data->EmployeeId = $data [0];
//                $csv_data->FirstName = $data [1];
//                $csv_data->LastName = $data [2];
//                $csv_data->Title = $data [3];
//                $csv_data->ManagerId = $data [4];
//                $csv_data->save ();
//            }
//            fclose ( $handle );
//        }
//        $finalData = $csv_data::all ();
//
//
//        DB::table('csv_data')->insert([
//            [ 'EmployeeId' => $finalData[0], 'FirstName' => $finalData[1], 'LastName' => $finalData[2]], 'Title' => $finalData[3],'ManagerId'=>$finalData[4]
//        ]);
//
//            DB::insert('insert into csv_data(EmployeeId,FirstName,LastName,Title,ManagerId) values (?,?,?,?,?)', ($_FILES['file']));
//
//
//        $FirstName = DB::select('select FirstName from csv_data', [1]);
//
//        return view('import', ['FirstName' => $FirstName]);
//    }
}
