<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Playing;
use Illuminate\Support\Facades\DB;

class PlayingTableSeeder extends Seeder {

    public function run()
    {
        DB::table('playing')->delete();

        if (($handle = fopen(dirname(__FILE__, 3)."\\CollegePlaying.csv", "r")) !== FALSE) {
          fgets($handle);
          while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
            try {
              $new = new Playing();
              $new->playerID = $data[0];
              $new->schoolID = $data[1];
              $new->yearID = $data[2];
              $new->save();
            } catch (Exception $e) {
              $message = 'Error: ' . $e->getCode() . ', message:' . $e->getMessage();
              error_log($message);
            }
          }
          fclose($handle);
        }
    }

}