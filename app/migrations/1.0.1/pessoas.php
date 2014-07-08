<?php

use Phalcon\Db\Column as Column;
use Phalcon\Db\Index as Index;

class PessoasMigration_101 extends \Phalcon\Mvc\Model\Migration
{

    public function up()
    {
        $this->morphTable("pessoa", array(
            "columns" => array(
                new Column("id", array(
                    "type"          => Column::TYPE_INTEGER,
                    "size"          => 10,
                    "unsigned"      => true,
                    "notNull"       => true,
                    "autoIncrement" => true,
                    "first"         => true,
                )),
                new Column("nome", array(
                    "type"     => Column::TYPE_VARCHAR,
                    "size"     => 255,
                    "notNull"  => true,
                    "after"    => "id",
                )),
                new Column("sobrenome", array(
                    "type"     => Column::TYPE_VARCHAR,
                    "size"     => 255,
                    "notNull"  => true,
                    "after"    => "nome",
                )),
            ),
            "indexes" => array(
                new Index("PRIMARY", array("id")),
            ),
            "options" => array(
                "ENGINE"          => "InnoDB",
                "TABLE_COLLATION" => "utf8_general_ci",
            )
        ));
    }

}