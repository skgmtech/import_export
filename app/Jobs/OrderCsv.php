<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Batchable;

class OrderCsv implements ShouldQueue
{
    use Batchable,Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $path=resource_path('temp');
        $files=glob("$path/*.csv");
        
        $header=[];
        foreach($files as $key=>$file)
        {
            $data=array_map('str_getcsv',file($file));
            if($key ===0)
            {
                $header=$data[0];
                unset($data[0]);
            }

            foreach($data as $sale)
            {
            
            $orderData=array_combine($header,$data);
            Order::create($orderData);
            }
            unlink($file);
        }
        
    }
}
