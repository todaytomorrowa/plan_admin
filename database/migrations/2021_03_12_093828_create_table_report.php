<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE OR REPLACE FUNCTION count_estimate(query text) RETURNS INTEGER AS
            $function$
            DECLARE
              rec   record;
              ROWS  INTEGER;
            BEGIN
              FOR rec IN EXECUTE \'EXPLAIN \' || query LOOP
                ROWS := SUBSTRING(rec."QUERY PLAN" FROM \' rows=([[:digit:]]+)\');
                EXIT WHEN ROWS IS NOT NULL;
              END LOOP;

              RETURN ROWS;
            END
            $function$
            LANGUAGE plpgsql;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
