<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cities;


class FileModificationController extends Controller
{
    function getFileFromUrl(){
        

        //get headers info
        $file_headers = get_headers("http://download.geonames.org/export/dump/RU.zip", 1);
        //get URL last modified date
        $last_modified = date("Y-m-d H:i:s.", strtotime($file_headers['Last-Modified']));
        //get last modification date from database
        $last_modification_date = DB::table('cities_modification_date')->where('updated_at', '=', $last_modified)->first();
        
    	if(empty($last_modification_date)){


    		DB::table('cities_modification_date')->updateOrInsert(['id' => 1], ['updated_at' => $last_modified]);

    		        $file = 'http://download.geonames.org/export/dump/RU.zip';
                    $tmp_file = 'cities/RU.zip';
              
                    if (!copy($file, $tmp_file)) {
                        echo "failed to copy $file...\n";
                    }else{

                      $zip = new \ZipArchive();
                      if ($zip->open($tmp_file, \ZipArchive::CREATE) !== TRUE) {
                          exit("cannot open directory");
                      }
 
                      $zip->extractTo('cities');
                    
                
                     set_time_limit(999);
                     ini_set('memory_limit', '4096M');
                     
                     $cities_text_file  = fopen('cities/RU.txt','r');

                        $cities = [];
			            $columns = [
			                'geonameid',
			                'name',
			                'asciiname',
			                'alternatenames',
			                'latitude',
			                'longitude',
			                'feature_class',
			                'feature_code',
			                'country_code',
			                'cc2',
			                'admin1_code',
			                'admin2_code',
			                'admin3_code',
			                'admin4_code',
			                'population',
			                'elevation',
			                'dem',
			                'timezone',
			                'modification_date',
			            ];

			            

                      //converting .txt file to array
						while (!feof($cities_text_file))
						{
						    $line=fgets($cities_text_file);
						    
                            if($line){
	                            $explode_line = explode("\t", $line);
	                            array_push($cities, array_combine($columns, $explode_line));
	                        }

						}
						fclose($cities_text_file);

						$collection = collect($cities);
			            $chunks = $collection->chunk(8000);

			            cities::truncate();
			            foreach ($chunks->toArray() as $chunk) {
			                cities::insert($chunk);
			            }


    				}
   			 }
      }
}
