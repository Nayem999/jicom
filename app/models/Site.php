<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getQtyAlerts() {
        $this->db->where('quantity < alert_quantity', NULL, FALSE);
        return $this->db->count_all_results('products');
    }

    public function getSettings()
    { 
        
     $q = $this->db->get('settings');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;  
    }
    public function getAllSales() {
      $q = $this->db->get('sales');
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function whereRows($table,$fild,$data){ 
        $q = $this->db->get_where($table, array($fild => $data));
        if ($q->num_rows() > 0) {
            return $q->result();
        }
        return FALSE;
    }

    public function whereRow($table,$fild,$data){
        $q = $this->db->get_where($table, array($fild => $data), 1);        
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
    public function getAllBanks($store_id=NULL) {
        if($this->session->userdata('store_id') !=0){
            $this->db->where('store_id', $this->session->userdata('store_id'));
        }
        if($store_id !=NULL){$this->db->where('store_id', $store_id);}
        $q = $this->db->get('bank_account');
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getAllCustomers($store_id=NULL) {
        if($this->session->userdata('store_id') !=0){
            $this->db->where('store_id', $this->session->userdata('store_id'));
        }     
        if($store_id !=NULL){
            $this->db->where('store_id', $store_id);
        }   
        $q = $this->db->get('customers');
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getAllSuppliers($id=NULL) {
        if($id==NULL){
            if($this->session->userdata('store_id') !=0){
                $this->db->where('store_id', $this->session->userdata('store_id'));
            }  
        } else {
             $this->db->where('store_id', $id);
        }
        
        $q = $this->db->get('suppliers');
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getAllMfSuppliers($id=NULL) {
        if($id){
            $this->db->where('store_id', $id);
        }
        
        $q = $this->db->get('mf_suppliers');
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getAllStores($id=0)
    {
        if($id){ $this->db->where('id',$id);}
        $this->db->where('store_type',1);
        $q = $this->db->get('stores');
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getAllFactoryStores($id=0)
    {
        if($id){ $this->db->where('id',$id);}
        $this->db->where('store_type',2);
        $q = $this->db->get('stores');
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getAllUsers()
    {
        $this->db->select("users.id as id, first_name, last_name, email, company,store_id," . $this->db->dbprefix('groups') . ".name as group,active");
        //$this->db->join('stores', 'users.store_id=stores.id','left');  
        $this->db->join('groups', 'users.group_id=groups.id','left');       
         
        //".$this->db->dbprefix('stores') . ".name as storename,   
        $this->db->group_by('users.id');
        $q = $this->db->get('users');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getUser($id = NULL)
    {
        if (!$id) {
            $id = $this->session->userdata('user_id');
        }
        $q = $this->db->get_where('users', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function wheres_rows($table,$data = NULL)
    {
        $q = $this->db->get_where($table, $data );
        if ($q->num_rows() > 0) {
            return $q->result();
        }
        return FALSE;
    }

    public function getProductByID($id)
    {
        
        $q = $this->db->get_where('products', array('id' => $id), 1);
        // echo $this->db->last_query();die;
        // echo "<pre>".print_r($q);die;
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
    public function getMaterialByID($id)
    {
        
        $q = $this->db->get_where('mf_material', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getAllCategories()
    {
        $this->db->order_by('code');
        $q = $this->db->get('categories');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getAllMfCategories()
    {
        $this->db->order_by('code');
        $q = $this->db->get('mf_categories');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getCategoryByID($id)
    {
        $q = $this->db->get_where('categories', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getMfCategoryByID($id)
    {
        $q = $this->db->get_where('mf_categories', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getCategoryByCode($code)
    {
        $q = $this->db->get_where('categories', array('code' => $code), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getGiftCard($no)
    {
        $q = $this->db->get_where('gift_cards', array('card_no' => $no), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getUpcomingEvents()
    {
        $dt = date('Y-m-d');
        $this->db->where('date >=', $dt)->order_by('date')->limit(5);
        if ($this->Settings->restrict_calendar) {
            $q = $this->db->get_where('calendar', array('user_id' => $this->session->userdata('iser_id')));
        } else {
            $q = $this->db->get('calendar');
        }
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getUserGroup($user_id = NULL) {
        if($group_id = $this->getUserGroupID($user_id)) {
            $q = $this->db->get_where('groups', array('id' => $group_id), 1);
            if ($q->num_rows() > 0) {
                return $q->row();
            }
        }
        return FALSE;
    }

    public function getUserGroupID($user_id = NULL) {
        if($user = $this->getUser($user_id)) {
            return $user->group_id;
        }
        return FALSE;
    }

    public function getUserSuspenedSales()
    {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('id, date, customer_name, hold_ref')
        ->order_by('id desc');
        //->limit(10);
        $q = $this->db->get_where('suspended_sales', array('created_by' => $user_id));
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

     public function findMergeIdbycp($fiend,$id) { 
        $q = $this->db->get_where('marge', array($fiend => $id), 1);
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function findeNameByID($table,$fiend,$id){
         $q = $this->db->get_where($table, array($fiend => $id), 1);
            if($q->num_rows() > 0) {
            foreach (($q->result()) as $row)  
            return $row;
        }
        return FALSE;
    }
    public function getDataByElement($table,$field,$data){
        $q = $this->db->get_where($table, array($field => $data));
        if( $q->num_rows() > 0 ) {
         return  $q->result();
        }
        return FALSE; 
    }

    public function getWhereDataByElement($table,$field1,$field2,$data1,$data2){
        $q = $this->db->get_where($table, array($field1 => $data1,$field2 => $data2));
        if( $q->num_rows() > 0 ) {
         return  $q->result();
        }
        return FALSE; 
    }


    public function getSequence($item_id){

        $store_id = $this->session->userdata('store_id');

        $q = $this->db->get_where('pro_sequence', array('pro_id' => $item_id, 'store_id' => $store_id, 'status' => 0));
             if ($q->num_rows() > 0) {
                    foreach (($q->result()) as $row) {
                        $data[] = $row;
                    }
                      return $data;
                }
            return FALSE;
    
    }
    public function getStoreList($item_id){
        $this->db->select('pro_sequence.pro_id, pro_sequence.store_id ,stores.name');
        $this->db->where( array('pro_id' => $item_id))
        ->join('stores', 'stores.id=pro_sequence.store_id')
        ->group_by('pro_sequence.store_id')
        ->order_by('pro_sequence.store_id');
        $q = $this->db->get('pro_sequence');
        if($q->num_rows() > 0) {
            //$newArry[] = NULL ; 
            foreach (($q->result()) as $row) {
                
                $newArry['store'] =  $row ; 
                $this->db->select('pro_sequence.sequence, pro_sequence.entry_date');
                $this->db->where( array('pro_id' => $item_id, 'store_id' => $row->store_id, 'status' => 0 ));
                $q2 = $this->db->get('pro_sequence');
                    if($q2->num_rows() > 0) {
                        $newArry['sequence'] = $q2->result() ;
                    }

                $data[] = $newArry;

            }

            return $data;

        }

        return FALSE;
    }
    public function seleteQuery($table){
       $q = $this->db->get($table);
        if($q->num_rows() > 0) 
        return $q->result();
        else return false;
    }
    public function insertQuery($table,$data= array()){   
        if($this->db->insert($table,$data)) 
        return $this->db->insert_id();
        else return false;
    }
    public function insertBatch($table,$data = array()) {
        if ($this->db->insert_batch($table, $data)) {
            return true;
        }
        return false;
    }
    public function updateQuery($table,$data,$array){ 
        if($this->db->update($table, $data, $array))
        return true;
        else return false;
    }
    public function deleteQuery($table,$data){ 
        if($this->db->delete($table,$data))
        return true;
        else return false;
    }

    function SequenceSearch ($keyword){

        if(!$this->Admin){
            $store_id = $this->session->userdata('store_id');
            $this->db->where(array('store_id' => $store_id));
        }
        $this->db->where("(sequence  LIKE '%" . $keyword . "%')");
        
        $this->db->limit(10);
        $q = $this->db->get('pro_sequence');
         if ($q->num_rows() > 0) {
                    foreach (($q->result()) as $row) {
                        $data[] = $row;
                    }
                      return $data;
                }
            return FALSE;

    }

    public function permission_data()
    {
        if ($this->session->userdata('group_id')) {
            $this->db->select('permissions.*');
            $this->db->where('permissions.group_id', $this->session->userdata('group_id'));
            $q2  =  $this->db->get('permissions');
            return $q2->row();
        } else {
            return false;
        }
    }

    public function permission_route_data()
    {
        if ($this->session->userdata('group_id')) {
            $this->db->select('module_routes.*');
            $this->db->where('module_routes.group_id', $this->session->userdata('group_id'));
            $q2  =  $this->db->get('module_routes');
            return $q2->row();
        } else {
            return false;
        }
    }

    public function permission($row_name)
    {
        $group_id = $this->session->userdata('group_id');
        if ($group_id) {
            if ($this->permissionData->$row_name  ==  1) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function route_permission($row_name)
    {
        $group_id = $this->session->userdata('group_id');
        if ($group_id) {
            if ($this->permissionRouteData->$row_name  ==  1) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

      
}
