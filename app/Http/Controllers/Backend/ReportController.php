<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    public function ReportView(){

        return view('backend.report.report_view');

    }// end method


    public function SearchByDate(Request $request){

        $date= new DateTime($request->date);
        $dateFormate= $date->format('d F Y');

        $orders= Order::where('order_date',$dateFormate)->latest()->get();
        return view('backend.report.report_by_date',compact('orders','dateFormate'));


    }// end method


    public function SearchByMonth(Request $request){

        $month= $request->month;
        $year= $request->year_name;

        $orders= Order::where('order_month',$month)->where('order_year',$year)->latest()->get();
        return view('backend.report.report_by_month',compact('orders','month','year'));


    }// end method

    public function SearchByYear(Request $request){
        $year= $request->year;

        $orders= Order::where('order_year',$year)->latest()->get();
        return view('backend.report.report_by_year',compact('orders','year'));

    }// end method


    public function UserReport(){

        $orders= User::where('role','user')->latest()->get();
        return view('backend.report.user_report_view',compact('orders'));

    }// end method

    public function UserByReport(Request $request){

        $user= $request->user;
        $orders= Order::where('user_id',$user)->latest()->get();
        return view('backend.report.user_by_report',compact('orders','user'));

    }// end method



}
