<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBlogsTable extends Migration
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
            "category_id"=>[
                "type"=> "INT",
                "unsigned"=> true,
                "constraint"=> 5,
                "null"=> false
            ],
            "title"=>[
                "type"=> "VARCHAR",
                "constraint"=> 50,
                "null"=> false
            ],
            "content"=>[
                "type"=> "TEXT",
                "null"=> true
            ],
            "status"=>[
                "type"=> "ENUM",
                "constraint"=> ['1','0'],
                "default"=> "1"
            ]
            
        ]);

        $this->forge->addPrimaryKey("id");

        $this->forge->createTable("blogs");
    }

    public function down()
    {
        $this->forge-> dropTable("blogs");
    }
}
