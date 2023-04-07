<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GatePass extends Model
{
    use HasFactory;
    protected $fillable=['date', 'SUPID', 'POID', 'Driver_name', 'Driver_cnic',
        'Vehicle_number', 'Vehicle_type', 'No_bags', 'F_weight', 'S_weight', 'Net_weight',
        'Delivery_address', 'BID', 'Weighing_charges', 'Trans_charges', 'Raw_material_nature', 'Time_in', 'Time_out',
        'Unloading_time', 'Unloading_type', 'WHID', 'Bilty_No', 'DC_No',
        'Fanacial_email', 'Owner_email', 'Created_by', 'Updated_By', 'created_at', 'updated_at'];
}
