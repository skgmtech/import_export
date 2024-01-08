<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Order;
use App\Jobs\OrderCsv;
use Illiminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;


class OrderController extends Controller
{

    public function index()
    {
        return view('upload-file');
    }


    public function upload()
    {
       if(request()->has('mycsv'))
       {
       // $data=array_map('str_getcsv',file(request()->mycsv));
        $data=file(request()->mycsv);
        $header=$data[0];
        unset($data[0]);

        $chunks=array_chunk($data,1000);
       // dd($chunks);

        foreach($chunks as $key => $chunk)
        {
            $name="/tmp{$key}.csv";
            $path=resource_path("temp");
           // return $path . $name;
            file_put_contents($path.$name,$chunk);
        }

        // foreach($data as $value)
        // {
        //     $orderData=array_combine($header,$value);
        //     Order::create($orderData);
        // }
        return 'Done';
       } 


    }

    public function store()
    {
        OrderCsv::dispatch();
         return 'stored';
    }
}