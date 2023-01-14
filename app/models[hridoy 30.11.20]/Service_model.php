<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model
{
	public function __construct() {

		parent::__construct();

	}
	public function getInvoice($data) 

	{

		
        $this->db->where(" sales_type='sale' and (id LIKE '%" . $data . "%' or customer_name  LIKE '%" . $data . "%')  ");

        $this->db->limit(10);

        $q = $this->db->get('sales');


		 if ($q->num_rows() > 0) {

            foreach (($q->result()) as $row) {

                $result[] = $row;

                  }
              return $result;

			}
	    }
		
	  public function getSaleItems($ids){
		
		
	   $this->db->select('sale_items.*, products.name as product_name, products.code as product_code, products.category_id , products.tax_method as tax_method')

        ->join('products', 'products.id=sale_items.product_id')
		
        ->order_by('sale_items.id');
		
		$this->db->where("sale_items.id IN (".$ids.")");
		
        $q = $this->db->get_where('sale_items');
		

        if($q->num_rows() > 0) {

            foreach (($q->result()) as $row) {

                $data[] = $row;

            }

            return $data;

        }

        return FALSE;
    }
	
	  public function getSaleItemsEdit($id){
		 
	  $this->db->select('service_promlem.*, products.name as product_name, products.code as product_code, products.category_id , products.tax_method as tax_method')
	  
	 ->join('products', 'products.id=service_promlem.product_id')	
	 
	 ->order_by('service_promlem.problem_id');
		
	 $q = $this->db->get_where('service_promlem', array('service_id' => $id)); 
		

        if($q->num_rows() > 0) {
			
             return  $q->result();


        }

        return FALSE;
    }
	
	
	 public function getSaleItemsSingel($id){
		
		
	   $this->db->select('sale_items.*, products.name as product_name, products.code as product_code, products.category_id , products.tax_method as tax_method')

        ->join('products', 'products.id=sale_items.product_id')
		
        ->order_by('sale_items.id');
		
		$this->db->where("sale_items.id =".$id);
		
        $q = $this->db->get_where('sale_items');
		

        if($q->num_rows() > 0) {

            foreach (($q->result()) as $row) {

                $data[] = $row;

            }

            return $data;

        }

        return FALSE;
    }
	
	 public function getSaleInfo($id){
		 
		$q = $this->db->get_where('sales', array('id' => $id), 1); 
		
		if( $q->num_rows() > 0 ) {
			
			return $q->row();

		} 

		return FALSE;
		 
	}
	
 public function ChechSaleSarvice($id){
	 
		$q = $this->db->get_where('sales', array('service_id' => $id), 1); 
		
		if( $q->num_rows() > 0 ) {
			
			return $q->row();

		} 

		return FALSE;
		 
	}
 public function AddSaleInfo($data,$id,$type){	
		if($type =='Add'){
			
			$this->db->insert('sales', $data) ;
			
		}if($type =='edit'){
			
			$this->db->update('sales', $data, array('service_id' => $id));
			
		 }
		
		return false;
	 }
	 
 public function listPayment($id) {
		  
		$query = $this->db->get_where('payments', array('service_id' => $id)); 
		if( $query->num_rows() > 0 ) {
			
			return  $query->result(); //$q->rows();

		} 


		return FALSE;
		  
	 }
 public function addPayment($data){
	
		$this->db->insert('payments', $data) ;

	}
 public function getPaymentSingel($id){
	
		$query = $this->db->get_where('payments', array('id' => $id)); 
		if( $query->num_rows() > 0 ) {
			
				return $query->row();

		} 

	}
  public function PaymentDelete($id){
	
		$this->db->delete('payments', array('id' => $id));

	}
	
	 public function  editPayment($data,$id){
	
	 	
		if($this->db->update('payments', $data, array('id' => $id))) {

			return true;

		}

		return false;

	 
	 
	 }
	
	
 public function getSeviceInfo($id){
		 
		$q = $this->db->get_where('service', array('service_id' => $id), 1); 
		
		if( $q->num_rows() > 0 ) {
			
			return $q->row();

		} 

		return FALSE;
		 
	}
 public function getParts($id){
	 
	 
	  $this->db->select('service_parts.*, service.total as total, service.paid  as paid, service.customer_name  as customer_name, service.date_submit  as date_submit  ')
	  
	 ->join('service', 'service.service_id=service_parts.service_id')	
	 
	 ->order_by('service_parts.parts_id');
	 
		$q = $this->db->get_where('service_parts', array('service_parts.service_id' => $id)); 
		
		if( $q->num_rows() > 0 ) {
			
			 return  $q->result();

		} 

		return FALSE;
		 
	}
	
 public function addservice($data){
	 
		
	   if($this->db->insert('service', $data)) {
			
			return $this->db->insert_id();
			
		}
		
		return false;

  }
  

  
   public function addservicePromlem($data)

	{
		
	   if($this->db->insert('service_promlem', $data)) {
			
			return $this->db->insert_id();
			
		}
		
		return false;

  }
  
    public function addserviceParts($data)

	{
		
	   if($this->db->insert('service_parts', $data)) {
			
			return $this->db->insert_id();
			
		}
		
		return false;

  }
  
  
  public function servicePartsSingel($id){
	  
	 $q = $this->db->get_where('service_parts', array('parts_id' => $id), 1); 
	  if( $q->num_rows() > 0 ) {
			
		return $q->row();

	 } 

	return FALSE;

  }
  
   public function  editservicePromlem($data,$id){
	
	 	
		if($this->db->update('service_promlem', $data, array('problem_id' => $id))) {

			return true;

		}

		return false;

	 
	 
	 }
	 
  public function  editservice($data,$id){
	
	 	
		if($this->db->update('service', $data, array('service_id' => $id))) {

			return true;

		}

		return false;

	 }
	 
	 public function  editserviceParts($data,$id){
	
	 	
		if($this->db->update('service_parts', $data, array('parts_id' => $id))) {

			return true;

		}

		return false;

	 
	 
	 }
	 
	public function deleteInvoice($id) {

		if($this->db->delete('service', array('service_id' => $id))) {
			
			$this->db->delete('service_parts', array('service_id' => $id));
			
			$this->db->delete('service_promlem', array('service_id' => $id));
			
			$this->db->delete('payments', array('service_id' => $id));
			
			$this->db->delete('sales', array('service_id' => $id));

			return true;

		}

		return FALSE;

	}
	
	public function deleteParts($id) {
		
			$this->db->delete('service_parts', array('parts_id' => $id));
			return true;

	}
  
}


