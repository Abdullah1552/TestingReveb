<?php
use \Illuminate\Support\Facades\DB;

function woo_state(){
    return \App\Models\WoocommerceSetting::select('state')->first()->state;
}
function generateRowNum ($table, $num_col,$code_col,$prefix_col, $prefix, $date,$digits = 4) {

    $out_put = [];

    $month = date('m', strtotime($date));
    $year = date('y', strtotime($date));

    $business_settings = DB::table('business_settings')->first();
    $format = $business_settings->code_format;
    $separator = $business_settings->code_separator;

    $sql = 'SELECT max(convert(' . $code_col . ', SIGNED INTEGER)) as max, count(*) AS counts FROM ' . $table;

    switch ($format) {
        case "C":
            $sql .= ' where ' . $prefix_col . '= "' . $prefix . '" and code_format = "'.$format.'" ';
            break;
        case "YC":
            $sql .= ' where ' . $prefix_col . '= "' . $prefix . '" and  SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE('.$num_col.','.$prefix_col.',"") ,"'.$separator.'",-2),"'.$separator.'",1) = ' . $year . ' and code_format = "'.$format.'" ';
            break;
        case "MYC":
            $sql .= ' where ' . $prefix_col . '= "' . $prefix . '" and  SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE('.$num_col.','.$prefix_col.',"") ,"'.$separator.'",-2),"'.$separator.'",1) = ' . $year . ' and SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE('.$num_col.','.$prefix_col.',"") ,"'.$separator.'",2),"'.$separator.'",-1) = ' . $month. ' and code_format = "'.$format.'" ';
            break;
        case "YMC":
            $sql .= ' where ' . $prefix_col . '= "' . $prefix . '" and  SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE('.$num_col.','.$prefix_col.',"") ,"'.$separator.'",2),"'.$separator.'",-1) = ' . $year . ' and SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE('.$num_col.','.$prefix_col.',"") ,"'.$separator.'",-2),"'.$separator.'",1) = ' . $month. ' and code_format = "'.$format.'" ';
            break;
    }
    $result = DB::select(DB::raw($sql));


    $maxnum = $result[0]->max;
    $maxnum = (int) preg_replace("/[^0-9]/", "", $maxnum);
    $counts = (int) $result[0]->counts;


    if ($maxnum == '' or $maxnum == null)
        $code = 1;
    else
        $code = $maxnum + 1;

    do {
        $code = str_pad($code, $digits, '0', STR_PAD_LEFT);
        switch ($format) {
            case "C":
                $number = $prefix.$separator.$code;
                $search = $prefix."_".$code;
                break;
            case "YC":
                $number = $prefix.$separator.$year.$separator.$code;
                $search = $prefix."____".$code;
                break;
            case "MYC":
                $number = $prefix.$separator.$month.$separator.$year.$separator.$code;
                $search = $prefix."_______".$code;
                break;
            case "YMC":
                $number = $prefix.$separator.$year.$separator.$month.$separator.$code;
                $search = $prefix."_______".$code;
                break;
        }

        $sql = DB::table($table)->where($num_col,'like', "$search")
            ->where('code_format', $format);

        switch ($format) {
            case "YC":
                $sql = $sql->whereRaw('SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE('.$num_col.','.$prefix_col.',"") ,"'.$separator.'",-2),"'.$separator.'",1) = ' . $year);
                break;
            case "MYC":
                $sql = $sql->whereRaw('SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE('.$num_col.','.$prefix_col.',"") ,"'.$separator.'",-2),"'.$separator.'",1) = ' . $year . ' and SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE('.$num_col.','.$prefix_col.',"") ,"'.$separator.'",2),"'.$separator.'",-1) = ' . $month);
                break;
            case "YMC":
                $sql = $sql->whereRaw('SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE('.$num_col.','.$prefix_col.',"") ,"'.$separator.'",2),"'.$separator.'",-1) = ' . $year . ' and SUBSTRING_INDEX(SUBSTRING_INDEX(REPLACE('.$num_col.','.$prefix_col.',"") ,"'.$separator.'",-2),"'.$separator.'",1) = ' . $month);
                break;
        }

        $is_exist = $sql->get()->count();


        if ($is_exist) {
            $code = (int) $code;
            $code++;
        }
    } while ($is_exist);



    $out_put[$num_col] = $number;
    $out_put[$code_col] = $code;
    $out_put['code_format'] = $format;
    $out_put[$prefix_col] = $prefix;

    return $out_put;
}

