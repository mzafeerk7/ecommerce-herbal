
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|-----------------------------------------------------
|	 Get data for datatables, get category list		 |
|-----------------------------------------------------
*/
function get_data($parameters, $table_columns){
    $model = $parameters['model_name'];
    $id = $parameters['columns'][0];
    //$column_title =  $parameters['columns'][1];

    $ci =& get_instance();
    $ci->load->model($model);
    $get_result = $ci->$model->data_for_datatables($parameters);
        $data = array();
        $s_no = 1;
        foreach($get_result as $row){
            $sub_array = array();
            $sub_array[] = $s_no; 

            foreach($table_columns as $column){
                $sub_array[] = ucwords($row[$column]);
            }

            if(isset($parameters['link']) && $parameters['link'] === true){
                $sub_array[] = '<a href="'.base_url().$parameters['path'].'?id='.$row[$id].'" class="btn btn-xs btn-icon btn-icon-circle btn-dark btn-icon-style-2"><span class="btn-icon-wrap"><i class="fa fa-pencil"></i></span></a>'." ".
                '<button type="button" onclick="'.$parameters['delete_function'].'" id="'.$row[$id].'" class="btn btn-xs btn-icon btn-icon-circle btn-danger btn-icon-style-2"><span class="btn-icon-wrap"><i class="icon-trash"></i></span></button>';
            }else{
                $sub_array[] = '<a href="javascript:void(0);" onclick="'.$parameters['update_function'].'" id="'.encrypt_id($row[$id]).'" class="text-success" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'." / ".
                           '<a href="javascript:void(0);" onclick="'.$parameters['delete_function'].'" id="'.encrypt_id($row[$id]).'"class="text-danger"><i class="fa fa-times mr-5" aria-hidden="true"></i></a>';
            }
            
            $data[] = $sub_array;

            $s_no++;
        }
        $output = array(
            'draw' =>   intval($_POST['draw']),
            'recordsTotal' => $ci->$model->get_total_record_count($parameters),
            'recordsFiltered' =>$ci->$model->get_filtered_data($parameters),
            'data' => $data,
        );
        return json_encode($output);
}


/*
|-----------------------------------------------------
|	 Get data for datatables, get Quantity,           |
|    Calculate Price, total Price of the parts	      |
|-----------------------------------------------------
*/
function get_part_data($parameters, $table_columns=null){
    $model = $parameters['model_name'];
    $id = $parameters['columns'][0];
    //$column_title =  $parameters['columns'][1];

    $ci =& get_instance();
    $ci->load->model($model);
    $get_result = $ci->$model->data_for_datatables($parameters);
        $data = array();
        $total_cost = 0;
        $remain_quantity = 0;
        foreach($get_result as $row){

            $sub_array = array();
            $sub_array[] = $row['ph_id'];
            $sub_array[] = '$'.number_format($row['ph_unit_cost'], 2);
            $sub_array[] = $row['ph_qty'];
            $sub_array[] = '$'.number_format(($row['ph_unit_cost'] * $row['ph_qty']), 2);
            $sub_array[] = $row['ph_purchase_date'];

            $sub_array[] = '<button type="button" onclick="'.$parameters['update_function'].'" id="'.$row[$id].'" class="btn btn-xs btn-icon btn-icon-circle btn-dark btn-icon-style-2"><span class="btn-icon-wrap"><i class="fa fa-pencil"></i></span></button>';
        
            $data[] = $sub_array;

            $total_cost += ($row['ph_unit_cost'] * $row['ph_qty']);
            $remain_quantity +=  $row['ph_remain_qty'];
        }
        $output = array(
            'draw' =>   intval($_POST['draw']),
            'recordsTotal' => $ci->$model->get_total_record_count($parameters),
            'recordsFiltered' =>$ci->$model->get_filtered_data($parameters),
            'data' => $data,
            'total_amount' => number_format($total_cost, 2),
            'remain_quantity' => $remain_quantity
        );
        return json_encode($output);
}





?>