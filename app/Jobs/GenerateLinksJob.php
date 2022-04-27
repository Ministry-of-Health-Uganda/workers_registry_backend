<?php

namespace App\Jobs;

use App\Models\DataLink;
use App\Models\DataSource;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateLinksJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $per_page;
    protected $total_rows;
    protected $datasource;

    public function __construct($per_page,$total_rows, DataSource $dataSource)
    {
        ini_set('max_execution_time', '300');

        $this->per_page   = intval($per_page);
        $this->total_rows = $total_rows;
        $this->datasource = $dataSource;
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [];
        
        for($i=0; $i<$this->total_rows; $i+=$this->per_page){

            $row=  array(
                'data_source_id'=>$this->datasource->id,
                'url'=>$this->datasource->base_url.$this->datasource->api_key."/".$i
            );

            DataLink::insert($row);

        }

        
    }
}
