<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployees extends Migration
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
                "constraint"=> 120,
                "null"=> false
            ],
            "Email"=>[
                "type"=> "VARCHAR",
                "constraint"=> 120,
                "unique"=> true,
                "null"=> false
            ],
            "profile_image"=>[
                "type"=> "VARCHAR",
                "constraint"=> 250,
                "null"=> true
            ]
        ]);
        $this->forge->addPrimaryKey("id");
        $this->forge->CreateTable("employees");
    }

    public function down()
    {
        $this->forge->dropTable("employees");
    }
}
