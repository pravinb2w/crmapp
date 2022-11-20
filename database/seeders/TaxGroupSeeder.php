<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ins = [
            ['group_name' => 'GST 18%', 'description' => 'cgst and sgst in ', 'company_id' => 1],
            ['group_name' => 'GST 24%', 'description' => 'cgst and sgst in ', 'company_id' => 1],
            ['group_name' => 'GST 14%', 'description' => 'cgst and sgst in ', 'company_id' => 1],
            ['group_name' => 'IGST 7%', 'description' => 'cgst and sgst in ', 'company_id' => 1],
            ['group_name' => 'IGST 12%', 'description' => 'cgst and sgst in ', 'company_id' => 1],
            ['group_name' => 'IGST 18%', 'description' => 'cgst and sgst in ', 'company_id' => 1],
        ];

        foreach ($ins as $inss) {
            $insert_id = DB::table('tax_groups')->insertGetId($inss);
            if( $inss['group_name'] == 'GST 18%') {
                $rins = [ 
                            ['group_id' => $insert_id, 'tax_name' => 'cgst', 'tax_percent' => 9,'status' => 1, 'company_id' => 1],
                            ['group_id' => $insert_id, 'tax_name' => 'sgst', 'tax_percent' => 9,'status' => 1, 'company_id' => 1],
                        ];
                DB::table('taxes')->insert($rins);
            }
            if( $inss['group_name'] == 'GST 24%') {
                $rins = [ 
                            ['group_id' => $insert_id, 'tax_name' => 'cgst', 'tax_percent' => 12,'status' => 1, 'company_id' => 1],
                            ['group_id' => $insert_id, 'tax_name' => 'sgst', 'tax_percent' => 12,'status' => 1, 'company_id' => 1],
                        ];
                DB::table('taxes')->insert($rins);
            }
            if( $inss['group_name'] == 'GST 14%') {
                $rins = [ 
                            ['group_id' => $insert_id, 'tax_name' => 'cgst', 'tax_percent' => 7,'status' => 1, 'company_id' => 1],
                            ['group_id' => $insert_id, 'tax_name' => 'sgst', 'tax_percent' => 7,'status' => 1, 'company_id' => 1],
                        ];
                DB::table('taxes')->insert($rins);
            }
            if( $inss['group_name'] == 'IGST 7%') {
                $rins = [ 
                            ['group_id' => $insert_id, 'tax_name' => 'igst', 'tax_percent' => 7,'status' => 1, 'company_id' => 1],
                        ];
                DB::table('taxes')->insert($rins);
            }
            if( $inss['group_name'] == 'IGST 12%') {
                $rins = [ 
                            ['group_id' => $insert_id, 'tax_name' => 'igst', 'tax_percent' => 12,'status' => 1, 'company_id' => 1],
                        ];
                DB::table('taxes')->insert($rins);
            }
            if( $inss['group_name'] == 'IGST 18%') {
                $rins = [ 
                            ['group_id' => $insert_id, 'tax_name' => 'igst', 'tax_percent' => 18,'status' => 1, 'company_id' => 1],
                        ];
                DB::table('taxes')->insert($rins);
            }
        }
        
    }
}
