<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"=>[
                "type"=> "INT",
                "auto_increament"=> true,
                "unsigned"=> true,
                "constraint"=> 5
            ],
            "name"=>[
                "type"=> "VARCHAR",
                "constraint"=> 50,
                "null"=> false
            ],
            "status"=>[
                "type"=> "ENUM",
                "constraint"=> ['1','0'],
                "default"=> "1"
            ]
            
        ]);

        $this->forge->addPrimaryKey("id");

        $this->forge->createTable("categories");

    }

    public function down()
    {
        $this->forge->dropTable("categories");
    }
}
