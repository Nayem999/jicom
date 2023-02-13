<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports_model extends CI_Model
{


	public function __construct()
	{
		parent::__construct();

	}

	public function getAllProducts()
	{
		$q = $this->db->get('products');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}

			return $data;
		}
	}
	
	
	
 public function getAllquantity()
	{
		$this->db->select('sum(quantity) as total');
		 $q = $this->db->get('products');
		 if( $q->num_rows() > 0 )
		  {
			$s = $q->row();
			
			return $s->total;
		  }
		return FALSE;
	}
 public function getAllquantityByStore($warehouse=NULL) {  

		$this->db->select('sum(quantity) as total');
		if($warehouse !=NULL && $warehouse !=0){
		 	$this->db->where('store_id',$warehouse); 
		 }
		 $q = $this->db->get('product_store_qty');
		 		 
		 if( $q->num_rows() > 0 )
		  {
			$s = $q->row();
			
			return $s->total;
		  }
		return FALSE;
	}
	
    public function getAllcost($store_id=0)
	{  
        if($store_id)
        {
            $this->db->join('product_store_qty','product_store_qty.product_id=products.id');
            $this->db->where('product_store_qty.store_id',$store_id);
        }
	    $q = $this->db->get('products');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}	
	
	
	public function getAllCustomers() {
		if(!$this->Admin){
            $this->db->where('store_id',$this->session->userdata('store_id'));
         }
		$q = $this->db->get('customers');

		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	public function topProducts($store_id) {
		$m = date('Y-m');
		$this->db->select($this->db->dbprefix('products').".code as product_code, ".$this->db->dbprefix('products').".name as product_name, sum(".$this->db->dbprefix('sale_items').".quantity) as quantity")
		->join('products', 'products.id=sale_items.product_id', 'left')
		->join('sales', 'sales.id=sale_items.sale_id', 'left')
		->order_by("sum(".$this->db->dbprefix('sale_items').".quantity)", 'desc')
		->group_by('sale_items.product_id')
		->limit(10)
		->like('sales.date', $m, 'both');
		if($store_id !=NULL){ $this->db->where('sale_items.store_id', $store_id);}
		$q = $this->db->get('sale_items');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	public function topProducts1($store_id) {
		$m = date('Y-m', strtotime('first day of last month'));
		$this->db->select($this->db->dbprefix('products').".code as product_code, ".$this->db->dbprefix('products').".name as product_name, sum(".$this->db->dbprefix('sale_items').".quantity) as quantity")
		->join('products', 'products.id=sale_items.product_id', 'left')
		->join('sales', 'sales.id=sale_items.sale_id', 'left')
		->order_by("sum(".$this->db->dbprefix('sale_items').".quantity)", 'desc')
		->group_by('sale_items.product_id')
		->limit(10)
		->like('sales.date', $m, 'both');
		if($store_id !=NULL){ $this->db->where('sale_items.store_id', $store_id);}
		$q = $this->db->get('sale_items');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	public function topProducts3($store_id) {
		$this->db->select($this->db->dbprefix('products').".code as product_code, ".$this->db->dbprefix('products').".name as product_name, sum(".$this->db->dbprefix('sale_items').".quantity) as quantity")
		->join('products', 'products.id=sale_items.product_id', 'left')
		->join('sales', 'sales.id=sale_items.sale_id', 'left')
		->order_by("sum(".$this->db->dbprefix('sale_items').".quantity)", 'desc')
		->group_by('sale_items.product_id')
		->limit(10)
		->where($this->db->dbprefix('sales').'.date >= last_day(now()) + interval 1 day - interval 3 month', NULL, FALSE);
		if($store_id !=NULL){ $this->db->where('sale_items.store_id', $store_id);}
		$q = $this->db->get('sale_items');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	public function topProducts12($store_id)
	{
		$this->db->select($this->db->dbprefix('products').".code as product_code, ".$this->db->dbprefix('products').".name as product_name, sum(".$this->db->dbprefix('sale_items').".quantity) as quantity")
		->join('products', 'products.id=sale_items.product_id', 'left')
		->join('sales', 'sales.id=sale_items.sale_id', 'left')
		->order_by("sum(".$this->db->dbprefix('sale_items').".quantity)", 'desc')
		->group_by('sale_items.product_id')
		->limit(10)
		->where($this->db->dbprefix('sales').'.date >= last_day(now()) + interval 1 day - interval 12 month', NULL, FALSE);
		if($store_id !=NULL){ $this->db->where('sale_items.store_id', $store_id);}
		$q = $this->db->get('sale_items');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}

			return $data;
		}
	}

	public function getDailySales($year, $month,$store=NULL) {		 
		if(!$this->Admin){
			$store_id = $this->session->userdata('store_id');
			$myQuery = "SELECT DATE_FORMAT( date,  '%e' ) AS date, COALESCE(sum(total), 0) as total, COALESCE(sum(grand_total), 0) as grand_total,
		COALESCE(sum(total_tax), 0) as tax, COALESCE(sum(total_discount), 0) as discount FROM (".$this->db->dbprefix('sales').")
		WHERE DATE_FORMAT( date,  '%Y-%m' ) =  '{$year}-{$month}' and store_id={$store_id}
		GROUP BY DATE_FORMAT( date,  '%e' )";
		}else{ 
			$store_id = $store;
			if($store !=NULL){
				$myQuery = "SELECT DATE_FORMAT( date,  '%e' ) AS date, COALESCE(sum(total), 0) as total, COALESCE(sum(grand_total), 0) as grand_total,
		COALESCE(sum(total_tax), 0) as tax, COALESCE(sum(total_discount), 0) as discount FROM (".$this->db->dbprefix('sales').")
		WHERE DATE_FORMAT( date,  '%Y-%m' ) =  '{$year}-{$month}' and store_id={$store_id}
		GROUP BY DATE_FORMAT( date,  '%e' )";
			}else{
			$myQuery = "SELECT DATE_FORMAT( date,  '%e' ) AS date, COALESCE(sum(total), 0) as total, COALESCE(sum(grand_total), 0) as grand_total,
		COALESCE(sum(total_tax), 0) as tax, COALESCE(sum(total_discount), 0) as discount FROM (".$this->db->dbprefix('sales').")
		WHERE DATE_FORMAT( date,  '%Y-%m' ) =  '{$year}-{$month}'
		GROUP BY DATE_FORMAT( date,  '%e' )";

			}
			
		}

		
		$q = $this->db->query($myQuery, false);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}


	public function getMonthlySales($year,$store_id=NULL){
		if(!$this->Admin){
			$store_id = $this->session->userdata('store_id');
			$myQuery = "SELECT DATE_FORMAT( date,'%c' ) AS date, COALESCE(sum(total), 0) as total, COALESCE(sum(grand_total), 0) as grand_total,
			COALESCE(sum(total_tax), 0) as tax, COALESCE(sum(total_discount), 0) as discount
			FROM (".$this->db->dbprefix('sales').")
			WHERE DATE_FORMAT( date,  '%Y' ) =  '{$year}' && store_id={$store_id}
			GROUP BY date_format( date, '%c' ) ORDER BY date_format( date, '%c' ) ASC";
		} else {
			if($store_id !=NULL){
				$myQuery = "SELECT DATE_FORMAT( date,'%c' ) AS date, COALESCE(sum(total), 0) as total, COALESCE(sum(grand_total), 0) as grand_total,
			COALESCE(sum(total_tax), 0) as tax, COALESCE(sum(total_discount), 0) as discount
			FROM (".$this->db->dbprefix('sales').")
			WHERE DATE_FORMAT( date,  '%Y' ) =  '{$year}' && store_id={$store_id}
			GROUP BY date_format( date, '%c' ) ORDER BY date_format( date, '%c' ) ASC";

			}else{
				$myQuery = "SELECT DATE_FORMAT( date,'%c' ) AS date, COALESCE(sum(total), 0) as total, COALESCE(sum(grand_total), 0) as grand_total,
		COALESCE(sum(total_tax), 0) as tax, COALESCE(sum(total_discount), 0) as discount
		FROM (".$this->db->dbprefix('sales').")
		WHERE DATE_FORMAT( date,  '%Y' ) =  '{$year}'
		GROUP BY date_format( date, '%c' ) ORDER BY date_format( date, '%c' ) ASC";
			}
			
		}
 
		$q = $this->db->query($myQuery, false);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	public function getTotalSalesforCustomer($customer_id, $user = NULL, $start_date = NULL, $end_date = NULL)
	{
		if($start_date && $end_date) {
			$this->db->where('date >=', $start_date);
			$this->db->where('date <=', $end_date);
		}
		if($user) {
			$this->db->where('created_by', $user);
		}
		 $q=$this->db->get_where('sales', array('customer_id' => $customer_id));
		 return $q->num_rows();

	}

	public function getTotalSalesValueforCustomer($customer_id, $user = NULL, $start_date = NULL, $end_date = NULL)
	{
		$this->db->select('sum(grand_total) as total');
		if($start_date && $end_date) {
			$this->db->where('date >=', $start_date);
			$this->db->where('date <=', $end_date);
		}
		if($user) {
			$this->db->where('created_by', $user);
		}
		 $q=$this->db->get_where('sales', array('customer_id' => $customer_id));
		 if( $q->num_rows() > 0 )
		  {
			$s = $q->row();
			return $s->total;
		  }
		return FALSE;
	}
	
 public function getTotalPaidSalesValueforCustomer($customer_id, $user = NULL, $start_date = NULL, $end_date = NULL)
{
	$this->db->select('sum(paid) as paid');
	if($start_date && $end_date) {
		$this->db->where('date >=', $start_date);
		$this->db->where('date <=', $end_date);
	}
	if($user) {
		$this->db->where('created_by', $user);
	}
		$q=$this->db->get_where('sales', array('customer_id' => $customer_id));
		
		if( $q->num_rows() > 0 )
		{
		$s = $q->row();
		return $s->paid;
		}
	return FALSE;
}
	
 public function getTotalQuantityValueforCustomer($customer_id, $user = NULL, $start_date = NULL, $end_date = NULL)
	{
		$this->db->select('sum(total_quantity) as total_quantity');
		if($start_date && $end_date) {
			$this->db->where('date >=', $start_date);
			$this->db->where('date <=', $end_date);
		}
		if($user) {
			$this->db->where('created_by', $user);
		}
		 $q=$this->db->get_where('sales', array('customer_id' => $customer_id));
		 if( $q->num_rows() > 0 )
		  {
			$s = $q->row();
			return $s->total_quantity;
		  }
		return FALSE;
	}
	
	public function getTotalItemValueforCustomer($customer_id, $user = NULL, $start_date = NULL, $end_date = NULL) {
		$this->db->select('sum(total_items) as total_items');
		if($start_date && $end_date) {
			$this->db->where('date >=', $start_date);
			$this->db->where('date <=', $end_date);
		}
		if($user) {
			$this->db->where('created_by', $user);
		}
		 $q=$this->db->get_where('sales', array('customer_id' => $customer_id));
		 if( $q->num_rows() > 0 )
		  {
			$s = $q->row();
			return $s->total_items;
		  }
		return FALSE;
	}

	public function getAllStaff() {
		if(!$this->Admin){
			$this->db->where('store_id',$this->session->userdata('store_id'));
		}

        $q = $this->db->get('users');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

	public function getTotalSales($start, $end,$store=NULL) {
		if(!$this->Admin){
			$store_id = $this->session->userdata('store_id');
		}else{ 
			$store_id = $store;
		}
        $this->db->select('count(id) as total, sum(COALESCE(grand_total, 0)) as total_amount, SUM(COALESCE(paid, 0)) as paid, SUM(COALESCE(total_tax, 0)) as tax', FALSE)
            ->where("date >= '{$start}' and date <= '{$end}'", NULL, FALSE);
        if($store_id !=NULL){$this->db->where('store_id',$store_id);}
        $q = $this->db->get('sales');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getTotalPurchases($start, $end,$store=NULL) {
    	if(!$this->Admin){
			$store_id = $this->session->userdata('store_id');
		}else{ 
			$store_id = $store;
		}
        $this->db->select('count(id) as total, sum(COALESCE(total, 0)) as total_amount', FALSE)
            ->where("date >= '{$start}' and date <= '{$end}'", NULL, FALSE);
        if($store_id !=NULL){$this->db->where('store_id',$store_id);}
        $q = $this->db->get('purchases');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getTotalExpenses($start, $end,$store=NULL) {
    	if(!$this->Admin){
			$store_id = $this->session->userdata('store_id');
		}else{ 
			$store_id = $store;
		}
        $this->db->select('count(id) as total, sum(COALESCE(amount, 0)) as total_amount', FALSE)
            ->where("date >= '{$start}' and date <= '{$end}'", NULL, FALSE);
        if($store_id !=NULL){$this->db->where('store_id',$store_id);}
        $q = $this->db->get('expenses');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
    public function saleAndPurseCount($store_id=NULL){  
    	if($store_id !=NULL){
    		$query = $this->db->query("SELECT PR.id,PR.name,code,( SELECT COALESCE(sum(sa.quantity), 0) FROM tec_sale_items sa WHERE sa.product_id=PR.id && sa.store_id= $store_id ) sold,
                        ( SELECT COALESCE(sum(pur.quantity), 0)
                          FROM tec_purchase_items pur
                          WHERE pur.product_id=PR.id && pur.store_id= $store_id) purchase,
                          ( SELECT COALESCE(sum(rt.return_qty), 0)
                          FROM tec_sreturn_items rt WHERE rt.product_id=PR.id && rt.store_id = $store_id) sreturn 
                    FROM tec_products PR group by PR.id");   		 

    	}else{ 
    		$query = $this->db->query("SELECT PR.id,PR.name,code,
    					( SELECT COALESCE(sum(sa.quantity), 0) 
    					  FROM tec_sale_items sa WHERE sa.product_id=PR.id ) sold,

                        ( SELECT COALESCE(sum(pur.quantity), 0)
                          FROM tec_purchase_items pur WHERE pur.product_id=PR.id ) purchase, 

                        ( SELECT COALESCE(sum(rt.return_qty), 0)
                          FROM tec_sreturn_items rt WHERE rt.product_id=PR.id ) sreturn
                    FROM tec_products PR group by PR.id"); 
    			
    	}
       
        $query->result_array();  
        return $query->result_array(); 
    }

    public function pquery($type,$code,$warehouse=NULL){

    	$q=$this->db->get_where('products', array('code' => $code));
		$saleid=array();
	    if( $q->num_rows() > 0 ) {
	    	$s = $q->row();

		    $this->db->from('sreturn_items'); 
	        $this->db->where('product_id', $s->id); 
	        $this->db->where('store_id', $warehouse);  
	        $query = $this->db->get();
	        $results = $query->result();
	        foreach ($results as $row){ 
	    	 	$saleid[] = $row->sale_id;
	    	} 
		   //query seles tbl 

		   if($type=='sales'){
				$saleidin=implode(",",$saleid);
		        $this->db->from('sale_items'); 
		        $this->db->where('product_id', $s->id);  
		        $this->db->where('store_id', $warehouse);  
				if($saleidin!=''){$this->db->where_not_in('sale_id', $saleidin); }		              
		        $query = $this->db->get(); ; 
		        $results = $query->result();
		        return $results ;
		   }

		   if($type=='purchase'){
		    $this->db->from('purchase_items'); 
		        $this->db->where('product_id', $s->id);  
		        $this->db->where('store_id', $warehouse);      
		        $query = $this->db->get(); ; 
		        $results = $query->result();		        
		        return $results;
		   }	   
	    } 
	}
	public function getSupplierInfo($id){
		

		$this->db->from('suppliers');  
		$this->db->where('id',$id);  
        $this->db->group_by('id');     
        $query = $this->db->get();
		$results = $query->result();    

		return $results;
	}
	public function get_supplier_id($id){
		

		$this->db->from('today_purchase_payment');  
		$this->db->where('today_payment_id',$id);  
        $this->db->group_by('today_payment_id');     
        $query = $this->db->get();
		$results = $query->result();    

		return $results;
	}
	// test purpose//////////////////////////////////
	public function payableSupplier($value){ 
    	if(!$this->Admin){
	        $this->db->where('store_id',$this->session->userdata('store_id'));
	     }
	   
		 $value = $value[0];
		//  print_r($value->id);
		//  exit;
            $i++;
            $Purchases = array() ;
            $supplier_id = $value->id;             
            $opening_blance = $value->opening_blance;  
            $openBColl = $value->opening_blance_coll;            

			
            // purchases //
            $this->db->select('supplier_id as sid, SUM(total) as gtotal, SUM(paid) as tpaid, SUM(deu) as tdue');
            $this->db->from('purchases'); 
            $this->db->where('supplier_id',$supplier_id);     
            $queryPurchases = $this->db->get();
            $resultsPurchases = $queryPurchases->row();

            // adv payment
            $this->db->select(' SUM(adv_amount) as adv_amount ');
            $this->db->from('adv_payment'); 
            $this->db->where('suppliers_id',$supplier_id);    
            $queryadv = $this->db->get();
            $advresults = $queryadv->row(); 

            // adv marge
            $this->db->from('marge'); 
            $this->db->where('supplier_id',$supplier_id);    
            $querymarge = $this->db->get();
            $margeresults = $querymarge->row(); 

            if(isset($margeresults->marge_id)){              
              $marge =  $margeresults->marge_id;
            }else{
              $marge =  '' ;
            }

            if(isset($advresults->adv_amount)){              
              $tdue =  $resultsPurchases->tdue - $advresults->adv_amount ;
            }else{
               
              $tdue = $resultsPurchases->tdue ;
            }
            
            $tpaid = $resultsPurchases->tpaid + $advresults->adv_amount;
            
            $Purchases['id'] = $value->id;
            $Purchases['name'] = $value->name ;
            $Purchases['sid'] = $resultsPurchases->sid ;
            $Purchases['gtotal'] = $resultsPurchases->gtotal + $opening_blance ;
            $Purchases['tpaid'] = $tpaid ;
            $Purchases['tdue'] =  - ($tdue + $opening_blance);
            $Purchases['marge_id'] =  $marge ; 
            $Purchases['store_id'] =  $value->store_id ;         
            $resultsOut[] =  $Purchases ;                
        
        return $resultsOut ; 
    } 
	// test purpose//////////////////////////////////
    public function payablelist(){ 
    	if(!$this->Admin){
	        $this->db->where('store_id',$this->session->userdata('store_id'));
	     }
        $this->db->from('suppliers');  
        $this->db->group_by('id');     
        $query = $this->db->get();
        $results = $query->result();    
        $i=0;   
        foreach ($results as $key => $value) {
            $i++;
            $Purchases = array() ;
            $supplier_id = $value->id;             
            $opening_blance = $value->opening_blance;  
            //$openBColl = $value->opening_blance_coll;            

            // purchases //
            $this->db->select('supplier_id as sid, SUM(total) as gtotal, SUM(paid) as tpaid, SUM(deu) as tdue');
            $this->db->from('purchases'); 
            $this->db->where('supplier_id',$supplier_id);     
            $queryPurchases = $this->db->get();
            $resultsPurchases = $queryPurchases->row();

            // adv payment
            $this->db->select(' SUM(adv_amount) as adv_amount ');
            $this->db->from('adv_payment'); 
            $this->db->where('suppliers_id',$supplier_id);    
            $queryadv = $this->db->get();
            $advresults = $queryadv->row(); 

            // adv marge
            $this->db->from('marge'); 
            $this->db->where('supplier_id',$supplier_id);    
            $querymarge = $this->db->get();
            $margeresults = $querymarge->row(); 

            if(isset($margeresults->marge_id)){              
              $marge =  $margeresults->marge_id;
            }else{
              $marge =  '' ;
            }

            if(isset($advresults->adv_amount)){              
              $tdue =  $resultsPurchases->tdue - $advresults->adv_amount ;
            }else{
               
              $tdue = $resultsPurchases->tdue ;
            }
            
            $tpaid = $resultsPurchases->tpaid + $advresults->adv_amount;
            
            $Purchases['id'] = $value->id;
            $Purchases['name'] = $value->name ;
            $Purchases['sid'] = $resultsPurchases->sid ;
            $Purchases['gtotal'] = $resultsPurchases->gtotal + $opening_blance ;
            $Purchases['tpaid'] = $tpaid ;
            $Purchases['tdue'] =  - ($tdue + $opening_blance);
            $Purchases['marge_id'] =  $marge ; 
            $Purchases['store_id'] =  $value->store_id ;         
            $resultsOut[] =  $Purchases ;                
        }    
        return $resultsOut ; 
	} 
	
	public function customerInfo($id=NULL){

		$this->db->from('customers');  
		$this->db->where('id',$id);  
        $this->db->group_by('id');     
        $query = $this->db->get();
		$results = $query->result();    

		return $results;
	}

    public function recablelist($id = NULL){
    	if(!$this->Admin){
	        $this->db->where('store_id',$this->session->userdata('store_id'));
	    }
	    if($id){
	    	$this->db->where('id',$id);
	    }
        $this->db->from('customers');  
        $this->db->group_by('id');     
        $query = $this->db->get();
        $results = $query->result();      
        foreach ($results as $key => $value) {
            $Sales = array() ;
            $customer_id = $value->id;
            $opening_blance = $value->opening_blance;
            $returnDue = 0;
            $sreturnid = array(); 

            // sales //
            $this->db->select('customer_id as cid,SUM(grand_total) as gtotal');
            $this->db->from('sales'); 
            $this->db->where('customer_id',$customer_id);     
            $queryCustomer = $this->db->get();
            $resultsCustomar = $queryCustomer->row();   
            
            // Collection
            /* $this->db->select('SUM(payment_amount) as payment_amount ');
            $this->db->from('today_collection'); 
            $this->db->where('customer_id',$customer_id); */    
           
            $this->db->select("sum(if(paid_by='Cheque' && type='Approved',payments.amount,0)) as chk_amount, sum(if(paid_by='TT' || paid_by='cash', payments.amount,0)) as other_amount ");
            $this->db->from('payments');
            $this->db->join('bank_pending',"payments.collect_id=bank_pending.collection_id and bank_pending.customer_id=$customer_id and bank_pending.payment_type=1",'left');
            $this->db->where('payments.customer_id', $customer_id);
            $querycollection = $this->db->get();
            $collectionResults = $querycollection->row(); 
            // echo $this->db->last_query();die;
  
	        $this->db->from('salesreturn'); 
	        $this->db->where('customer_id', $customer_id);
	        $query = $this->db->get();
	        $results = $query->result();
	        foreach ($results as $row){ 
        	 	$sreturnid[] =$row->sreturn_id;				
        	} 
			$sreturnidall=implode(",",$sreturnid);
           $this->db->select('sum(real_unit_price * return_qty) as returnamount, sum(return_amount) as return_amount');
            $this->db->from('sreturn_items'); 
            // $this->db->where_in('sreturn_id', $sreturnid); 
            $this->db->where_in('sreturn_id', $sreturnidall); 
            $riten = $this->db->get(); 
            $return = $riten->row(); 
			$returnDue = $return->returnamount - $return->return_amount ;  

            // marge
            $this->db->from('marge'); 
            $this->db->where('customer_id',$customer_id);    
            $querymarge = $this->db->get();
            $margeresults = $querymarge->row(); 

            if(isset($margeresults->marge_id)){              
              $marge =  $margeresults->marge_id ;
            }else{
              $marge = '' ;
            } 

            // $tdue = $resultsCustomar->gtotal - $collectionResults->payment_amount;      
            $tdue = $resultsCustomar->gtotal - $collectionResults->chk_amount - $collectionResults->other_amount;      

            $Sales['id'] = $value->id;
            $Sales['cname'] = $value->name ;
            // $Sales['cid'] = $resultsPurchases->cid ;
            $Sales['cid'] = $resultsCustomar->cid ;
            $Sales['gtotal'] = $resultsCustomar->gtotal + $value->opening_blance - $returnDue;
            // $Sales['tpaid'] = $collectionResults->payment_amount;
            $Sales['tpaid'] = $collectionResults->chk_amount + $collectionResults->other_amount;
            $Sales['due'] =  $tdue + $value->opening_blance - $returnDue;
            $Sales['marge_id'] =  $marge ;
            $Sales['store_id'] =  $value->store_id ; 
            $Sales['return'] =  $returnDue;     
            $returnDue = 0;  
            $resultsOut[] =  $Sales ;                
        }    
        return $resultsOut ; 
    }

    public function allSales(){
    	$this->db->from('sale_items');    	
    	$this->db->group_by('sale_id'); 
    	$query = $this->db->get(''); 
    	return $query->result(); 
    }

    public function salesReturnAmount($store_id){ 
    	$this->db->select('SUM(return_amount) as return_amount');
    	$this->db->from('sreturn_items'); 
    	if($store_id){
    		$this->db->where('store_id',$store_id);
    	} 
    	$query = $this->db->get('');  
    	return $query->result();
    }

    public function cashInHand($store_id=NULL){  
    	$this->db->select('SUM(cash_in_hand) as cash_in_hand');
    	$this->db->from('registers'); 
    	$this->db->where('status','open');
    	if($store_id){
    		$this->db->where('store_id',$store_id);
    	} 
    	$query = $this->db->get('');  
    	return $query->result();
    }

    public function invoiceProfit($store_id=0){ 
    	$store_id_per = $this->session->userdata('store_id');
    	if(!$this->Admin){
    		$query = $this->db->query("SELECT PR.id,PR.date,PR.customer_name,PR.total,PR.store_id,( SELECT COALESCE(sum(sa.quantity*sa.cost), 0) FROM tec_sale_items sa WHERE sa.sale_id=PR.id ) as cost_price,( SELECT COALESCE(sum(sa.quantity), 0) FROM tec_sale_items sa WHERE sa.sale_id=PR.id ) as qty FROM tec_sales PR WHERE PR.store_id=$store_id_per group by PR.id");

    	}else{
            if($store_id){$filterStore=" WHERE PR.store_id=$store_id ";}else{$filterStore='';}

    		$query = $this->db->query("SELECT PR.id,PR.date,PR.customer_name,PR.total,PR.store_id,( SELECT COALESCE(sum(sa.quantity*sa.cost), 0) FROM tec_sale_items sa WHERE sa.sale_id=PR.id ) as cost_price,( SELECT COALESCE(sum(sa.quantity), 0) FROM tec_sale_items sa WHERE sa.sale_id=PR.id ) as qty FROM tec_sales PR $filterStore group by PR.id");
    	}
    	
        $query->result_array();  
        return $query->result_array(); 
    }

    public function salaryReport($start_date,$end_date){ 
    	$this->db->select($this->db->dbprefix('paysalary').".pay_id,pay_date,month_id,year,amount,".
    	$this->db->dbprefix('paysalary').".store_id,".
        $this->db->dbprefix('employee').".name,note");
        $this->db->join('employee', 'employee.id=paysalary.emp_id'); 
        if($start_date) { $this->db->where('pay_date >=', $start_date.' 00:00:00'); }
        if($end_date) { $this->db->where('pay_date <=', $end_date.' 23:59:59'); } 
        if(!$this->Admin){
        	$this->db->where('paysalary.store_id', $this->session->userdata('store_id'));
        }
        $q = $this->db->get('paysalary');       

        if($q->num_rows() > 0) {
			 
			return $q->result();
		} 
    }

    public function warrantyReport(){
    	$this->db->from('pro_sequence');   
    	$query = $this->db->get('');  
    	return $query->result();
    }
    
    public function loanRecieve(){

    	if($this->Admin){
    	 
    		 $q = $this->db->select('SUM(tec_payloaner.amount) as loanRecieveAmount')->where(array('type'=>'receive', 'payment_type'=>'cash'))->get('payloaner');
    		 
    		if ($q->num_rows() > 0) {
    			return $q->row()->loanRecieveAmount;
    		}
    	}
    }

    public function loanPay(){

    	if($this->Admin){
    	 
    		 $q = $this->db->select('SUM(tec_payloaner.amount) as loanPayAmount')->where(array('type'=>'pay', 'payment_type'=>'cash'))->get('payloaner');
    		 
    		if ($q->num_rows() > 0) {
    			return $q->row()->loanPayAmount;
    		}
    	}
    }
    public function bankLoanRecieve(){

    	if($this->Admin){
    	 	
    		$this->db->select('SUM(tec_payloaner.amount) as loanRecieveAmount') ;
    		$this->db->where('type', 'receive');
    		$this->db->where_in('payment_type', array('card','cheque'));  
    		$q = $this->db->get('payloaner');
    		if ($q->num_rows() > 0) {
    			return $q->row()->loanRecieveAmount;
    		}
    	}
    }
    public function bankLoanPay(){

    	if($this->Admin){
    	 
    		$this->db->select('SUM(tec_payloaner.amount) as loanPayAmount');
		 	$this->db->where('type', 'pay');
		 	$this->db->where_in('payment_type', array('card','cheque'));  
		 	$q = $this->db->get('payloaner');
    		 
    		if ($q->num_rows() > 0) {
    			return $q->row()->loanPayAmount;
    		}
    	}
    }

    public function todaySale($start_date=NULL,$end_date=NULL,$store_id=0){
        $this->db->select('sales.id as sale_id, sales.paid, sales.date, sales.grand_total, sales.customer_name, sales.customer_id, sales.invno, sales.collection_id,  today_collection.payment_amount'); 
        $this->db->from('sales');  
        $this->db->join('customers','customers.id=sales.customer_id');
        $this->db->join('today_collection','today_collection.today_collect_id=sales.collection_id','left');  
        if($start_date && $end_date){ 
            $this->db->where('sales.date >=', $start_date.' 00:00:00'); 
            $this->db->where('sales.date <=', $end_date.' 23:59:59');   
        }
		elseif($start_date)
		{
            $this->db->where('sales.date >=', $start_date.' 00:00:00'); 
            $this->db->where('sales.date <=', $start_date.' 23:59:59');  
		}
		else{
            $this->db->like('sales.date', date('Y-m-d'));
        }  
        if($store_id){$this->db->where('sales.store_id', $store_id); }
        $query = $this->db->get();
        return $query->result(); 
    }
    public function todayCollection($start_date=NULL,$end_date=NULL,$store_id=0){
    	$coll_id = array();
    	$sales = $this->todaySale($start_date);
    	foreach ($sales as $key => $value) {
    		$coll_id[] = $value->collection_id;
    	} 
        $this->db->select('today_collection.*, customers.name as customer_name ');  
        $this->db->from('today_collection');  
        if($coll_id){
        	$this->db->where_not_in('today_collection.today_collect_id',$coll_id);
        }
        $this->db->join('customers','customers.id=today_collection.customer_id');  
		if($start_date && $end_date){ 
            $this->db->where('today_collection.payment_date >=', $start_date); 
            $this->db->where('today_collection.payment_date <=', $end_date);   
        }
        else if($start_date){ 
            $this->db->like('today_collection.payment_date', $start_date);
        }else{ 
            $this->db->like('today_collection.payment_date', date('Y-m-d'));
        } 
        if($store_id){$this->db->where('today_collection.store_id', $store_id); }
        $query = $this->db->get();
        return $query->result(); 
    }
    public function expenses($start_date=NULL,$end_date=NULL,$store_id=0){ 
        $this->db->select('expenses.date, expenses.amount, expens_category.name, expenses.reference'); 
        $this->db->from('expenses'); 
        $this->db->join('expens_category','expens_category.cat_id=expenses.c_id','left');
        //if(!$this->Admin){ $this->db->where('expenses.store_id',$this->session->userdata('store_id'));} 
        //if($store_id){ $this->db->where('expenses.store_id',$store_id);}   
		if($start_date && $end_date){ 
            $this->db->where('expenses.date >=', $start_date.' 00:00:00'); 
            $this->db->where('expenses.date <=', $end_date.' 23:59:59');   
        }  
        else if($start_date) {
            $this->db->where('expenses.date >=', $start_date.' 00:00:00'); 
            $this->db->where('expenses.date <=', $start_date.' 23:59:59');
        }
        if(!$start_date) {
            $data = $this->db->like('expenses.date', date('Y-m-d'));
        } 
        if($store_id){$this->db->where('expenses.store_id', $store_id); }
        $query = $this->db->get();
        return $query->result(); 
    }
    public function bankPays($start_date=NULL,$end_date=NULL,$store_id=0){ 
        $this->db->select('tranjiction.tran_date, tranjiction.tran_amount, tranjiction.tran_type, bank_account.bank_name, bank_account.account_name, bank_account.account_no'); 
        $this->db->from('tranjiction'); 
        $this->db->join('bank_account','bank_account.bank_account_id=tranjiction.bank_account_id','left');
        $this->db->where('tranjiction.tran_type',1);   
		if($start_date && $end_date){ 
            $this->db->where('tranjiction.tran_date >=', $start_date); 
            $this->db->where('tranjiction.tran_date <=', $end_date);   
        }  
        else if($start_date){
            $this->db->like('tranjiction.tran_date', $start_date);
        }else{
            $this->db->like('tranjiction.tran_date', date('Y-m-d'));
        } 
        if($store_id){$this->db->where('tranjiction.store_id', $store_id); }
        $query = $this->db->get();
        return $query->result(); 
    }
    public function totalBankCash2($bank_id=NULL,$end_date=NULL,$start_date=NULL,$store_id=0){ 
		$this->db->select('tranjiction.tran_date, SUM(tran_amount) as tran_amount, tranjiction.tran_type');         
        $this->db->where('tranjiction.tran_type',1); 
		if($start_date && $end_date){ 
            $this->db->where('tranjiction.tran_date >=', $start_date.' 00:00:00'); 
            $this->db->where('tranjiction.tran_date <=', $end_date.' 23:59:59');   
        }  
        else if($end_date){
            $this->db->where('tranjiction.tran_date <=', $end_date.' 23:59:59');
        }
        if($bank_id){
            $this->db->where('tranjiction.bank_account_id', $bank_id);
        }    
		$this->db->join('tranjiction','bank_account.bank_account_id=tranjiction.bank_account_id');
		$this->db->from('bank_account');
		$query = $this->db->get();
		$result = $query->row();

		$this->db->select('tranjiction.tran_date, SUM(tran_amount) as tran_amount, tranjiction.tran_type');         
        $this->db->where('tranjiction.tran_type',0); 
		if($start_date && $end_date){ 
            $this->db->where('tranjiction.tran_date >=', $start_date.' 00:00:00'); 
            $this->db->where('tranjiction.tran_date <=', $end_date.' 23:59:59');   
        }  
        else if($end_date){
            $this->db->where('tranjiction.tran_date <=', $end_date.' 23:59:59');
        }  
        if($bank_id){
            $this->db->where('tranjiction.bank_account_id', $bank_id);
        }  
		$this->db->join('tranjiction','bank_account.bank_account_id=tranjiction.bank_account_id');
		$this->db->from('bank_account');
        if($store_id){$this->db->where('bank_account.store_id', $store_id); }
		$query = $this->db->get();
		$result2 = $query->row(); 
		return $result->tran_amount - $result2->tran_amount;
	}
	public function banksWithdrow($start_date=NULL,$end_date=NULL,$store_id=0){ 
		$this->db->select('tranjiction.tran_date, tranjiction.tran_amount, tranjiction.tran_type, bank_account.bank_name, bank_account.account_name, bank_account.account_no'); 
        $this->db->from('tranjiction'); 
        $this->db->join('bank_account','bank_account.bank_account_id=tranjiction.bank_account_id','left');
        $this->db->where('tranjiction.tran_type',0);   
		if($start_date && $end_date){ 
            $this->db->where('tranjiction.tran_date >=', $start_date.' 00:00:00'); 
            $this->db->where('tranjiction.tran_date <=', $end_date.' 23:59:59');   
        }  
        else if($start_date){
            $this->db->like('tranjiction.tran_date', $start_date);
        }else{
            $this->db->like('tranjiction.tran_date', date('Y-m-d'));
        } 
        if($store_id){$this->db->where('tranjiction.store_id', $store_id); }
        $query = $this->db->get();
        return $query->result();

        /*$this->db->select('tranjiction.tran_date, tran_amount, tranjiction.tran_type, bank_account.bank_name, bank_account.account_name, bank_account.account_no'); 
        $this->db->from('tranjiction'); 
        $this->db->join('bank_account','bank_account.bank_account_id=tranjiction.bank_account_id','left');         
        //$this->db->where('tranjiction.tran_type',0);  
        if($start_date){
            $this->db->like('tranjiction.tran_date', $start_date);
        }else{
            $this->db->like('tranjiction.tran_date', date('Y-m-d'));
        } 
        $query = $this->db->get();
        return $query->result();*/ 
    }
    public function supplierPayment($start_date=NULL,$end_date=NULL,$store_id=0){ 
        $this->db->select('today_purchase_payment.*, suppliers.*');  
        $this->db->from('today_purchase_payment'); 
        $this->db->join('suppliers','suppliers.id=today_purchase_payment.supplier_id');      
		if($start_date && $end_date){ 
            $this->db->where('today_purchase_payment.payment_date >=', $start_date.' 00:00:00'); 
            $this->db->where('today_purchase_payment.payment_date <=', $end_date.' 23:59:59');   
        }  
        else if($start_date) {
            $this->db->where('today_purchase_payment.payment_date >=', $start_date.' 00:00:00'); 
            $this->db->where('today_purchase_payment.payment_date <=', $start_date.' 23:59:59');
        }
        if(!$start_date) {
            $data = $this->db->like('today_purchase_payment.payment_date', date('Y-m-d'));
        } 
        if($store_id){$this->db->where('today_purchase_payment.store_id', $store_id); }
        $query = $this->db->get();
        return $query->result(); 
    }
    public function loanPays($start_date=NULL,$end_date=NULL,$store_id=0){ 
        $this->db->select('payloaner.entry_date, payloaner.amount, payloaner.type, loaner.name '); 
        $this->db->from('payloaner');          
        $this->db->where('payloaner.type','pay');  
        $this->db->join('loaner','loaner.id=payloaner.loaner_id');
		if($start_date && $end_date){ 
            $this->db->where('payloaner.entry_date >=', $start_date); 
            $this->db->where('payloaner.entry_date <=', $end_date);   
        }  
        else if($start_date){
            $this->db->like('payloaner.entry_date', $start_date);
        }else{
            $this->db->like('payloaner.entry_date', date('Y-m-d'));
        } 

        $query = $this->db->get();
        return $query->result(); 
    }
    public function loanCollect($start_date=NULL,$end_date=NULL,$store_id=0){ 
        $this->db->select('entry_date, amount, payloaner.type,  loaner.name'); 
        $this->db->from('payloaner');    
        //$this->db->group_by('payloaner.loaner_id');
        $this->db->join('loaner','loaner.id=payloaner.loaner_id');      
        $this->db->where('payloaner.type','receive');  
		if($start_date && $end_date){ 
            $this->db->where('payloaner.entry_date >=', $start_date); 
            $this->db->where('payloaner.entry_date <=', $end_date);   
        }  
        else if($start_date){
            $this->db->like('payloaner.entry_date', $start_date);
        }else{
            $this->db->like('payloaner.entry_date', date('Y-m-d'));
        } 
        $query = $this->db->get();
        return $query->result(); 
    }
    public function donationsPay($start_date = NULL,$end_date=NULL,$store_id=0){   
    	$this->db->select('amount, donations_persons_id, entry_date, type, payment_type, name');
    	$this->db->join('donations_persons','donations_persons.id=donations_pay.donations_persons_id'); 
		if($start_date && $end_date){ 
            $this->db->where('entry_date >=', $start_date); 
            $this->db->where('entry_date <=', $end_date);   
        }  
        else if($start_date){
            $this->db->like('entry_date', $start_date);
        }else{
            $this->db->like('entry_date', date('Y-m-d'));
        } 
    	$this->db->from('donations_pay');  
    	// $query = $this->db->get('');  
    	$query = $this->db->get();  
    	return $query->result();
    }
    public function donations(){  
    	$this->db->select('SUM(amount) as amount');
    	$this->db->from('donations_pay');  
    	$query = $this->db->get('');  
    	return $query->row();
	} 
	

	public function store_sms($data){
		$this->db->insert('sms_corner', $data);

		return $this->db->insert_id();
	}

	public function sms_history()
	{
		if(!$this->Admin){
	        $this->db->where('store_id',$this->session->userdata('store_id'));
	    }
	    if($id){
	    	$this->db->where('id',$id);
	    }
        $this->db->from('sms_corner');  
        $this->db->group_by('id');     
        $query = $this->db->get();
		$results = $query->result();    
		return $results;
	}


	public function last_sms($type,$cID){

		$customerinfo = $this->reports_model->customerInfo($cID); 
		// echo '<pre>';
		// print_r($customerinfo[0]->id);

		// exit;

		$this->db->from('sms_corner');  
		$this->db->order_by('id','DESC');    
		$this->db->where('user_type',$type);   
		$this->db->where('user_id',$customerinfo[0]->id);   
        $query = $this->db->get();
		$results = $query->row();  

		return $results->created_at;
	}
	public function last_sms_supplier($type,$supplier_id){
		// 		$a = intval($supplier_id);
		// return $a;
		$customerinfo = $this->reports_model->get_supplier_id($supplier_id); 
		$supplier = $customerinfo[0]->supplier_id;
		// if ($customerinfo){

		// 	return 'hwllo';
		// }else{
		// 	return 'hi';
		// }


		// exit;
		// if($supplier_id){
		// 	return 'hi';
		// }

		$this->db->from('sms_corner');  
		$this->db->order_by('id','DESC');    
		$this->db->where('user_type',$type);   
		$this->db->where('user_id',$supplier);   
        $query = $this->db->get();
		$results = $query->row();  

		return $results->created_at;
	}
    /*     
    public function assetPay($start_date=NULL){ 
        $this->db->select('asset_transection.created_at, amount, asset_transection.type, asset.name'); 
        $this->db->from('asset_transection');          
        $this->db->where('asset_transection.type','out'); 
        //$this->db->group_by('asset_transection.asset_id');
        $this->db->join('asset','asset.id=asset_transection.asset_id');
        if($start_date){
            $this->db->like('asset_transection.created_at', $start_date);
        }else{
            $this->db->like('asset_transection.created_at', date('Y-m-d'));
        } 
        $query = $this->db->get();
        return $query->result(); 
    }
    public function assetCollect($start_date=NULL){ 
        $this->db->select('asset_transection.created_at, amount, asset_transection.type, asset.name '); 
        $this->db->from('asset_transection');    
        //$this->db->group_by('asset_transection.asset_id');
        $this->db->join('asset','asset.id=asset_transection.asset_id');      
        $this->db->where('asset_transection.type','in');  
        if($start_date){
            $this->db->like('asset_transection.created_at', $start_date);
        }else{
            $this->db->like('asset_transection.created_at', date('Y-m-d'));
        } 
        $query = $this->db->get();
        return $query->result(); 
    }
    public function expansesPay($start_date=NULL){ 
        $this->db->select('income_expense_transection.created_at, amount, income_expense_transection.type, income_expense.name '); 
        $this->db->from('income_expense_transection');          
        $this->db->where('income_expense_transection.type','out'); 
        //$this->db->group_by('income_expense_transection.income_expense_id');
        $this->db->join('income_expense','income_expense.id=income_expense_transection.income_expense_id');
        if($start_date){
            $this->db->like('income_expense_transection.created_at', $start_date);
        }else{
            $this->db->like('income_expense_transection.created_at', date('Y-m-d'));
        } 
        $query = $this->db->get();
        return $query->result(); 
    }
    public function incomeCollect($start_date=NULL){ 
        $this->db->select('income_expense_transection.created_at, amount, income_expense_transection.type,  income_expense.name'); 
        $this->db->from('income_expense_transection');    
        //$this->db->group_by('income_expense_transection.income_expense_id');
        $this->db->join('income_expense','income_expense.id=income_expense_transection.income_expense_id');      
        $this->db->where('income_expense_transection.type','in');  
        if($start_date){
            $this->db->like('income_expense_transection.created_at', $start_date);
        }else{
            $this->db->like('income_expense_transection.created_at', date('Y-m-d'));
        } 
        $query = $this->db->get();
        return $query->result(); 
	}*/
	
    public function dailySaleReport($start_date=NULL,$end_date=NULL,$store_id=0){
        $this->db->select('sales.id as sale_id, sales.paid_by, sales.status, sales.grand_total, sales.paid, sales.customer_name, sales.customer_id, sales.collection_id,  today_collection.payment_amount, bank_account.bank_name as bank_name '); 
        $this->db->from('sales');  
        // $this->db->join('customers','customers.id=sales.customer_id');
        $this->db->join('today_collection','today_collection.today_collect_id=sales.collection_id','left');  
        $this->db->join('bank_pending','bank_pending.collection_id=sales.collection_id','left');  
        $this->db->join('bank_account','bank_pending.bank_id=bank_account.bank_account_id','left');  
        if($start_date && $end_date){ 
            $this->db->where('sales.date >=', $start_date.' 00:00:00'); 
            $this->db->where('sales.date <=', $end_date.' 23:59:59');   
        }
		elseif($start_date)
		{
            $this->db->where('sales.date >=', $start_date.' 00:00:00'); 
            $this->db->where('sales.date <=', $start_date.' 23:59:59');  
		}
		else{
            $this->db->like('sales.date', date('Y-m-d'));
        }  
        if($store_id){$this->db->where('sales.store_id', $store_id);  }
        $query = $this->db->get();
        return $query->result(); 
    }

    public function dailySaleItemReport($start_date=NULL,$end_date=NULL,$store_id=0){
        $this->db->select('sales.id as sale_id, products.name as product_name, products.id as product_id, sale_items.quantity, sale_items.subtotal '); 
        $this->db->from('sales');  
        $this->db->join('sale_items','sale_items.sale_id=sales.id');
        $this->db->join('products','products.id=sale_items.product_id');
        if($start_date && $end_date){ 
            $this->db->where('sales.date >=', $start_date.' 00:00:00'); 
            $this->db->where('sales.date <=', $end_date.' 23:59:59');   
        }
		elseif($start_date)
		{
            $this->db->where('sales.date >=', $start_date.' 00:00:00'); 
            $this->db->where('sales.date <=', $start_date.' 23:59:59');  
		}
		else{
            $this->db->like('sales.date', date('Y-m-d'));
        }  
        if($store_id){$this->db->where('sales.store_id', $store_id);  }
        $query = $this->db->get();
        return $query->result(); 
    }
	
    public function saleReport($start_date=NULL,$end_date=NULL){
        $this->db->select('sales.id as sale_id, sales.paid_by, sales.status, sales.store_id, sales.collection_id, stores.name as store_name, sales.grand_total, sales.paid '); 
        $this->db->from('sales');  
        $this->db->join('stores','stores.id=sales.store_id');  
  
        if($start_date && $end_date){ 
            $this->db->where('sales.date >=', $start_date.' 00:00:00'); 
            $this->db->where('sales.date <=', $end_date.' 23:59:59');   
        }
		elseif($start_date)
		{
            $this->db->where('sales.date >=', $start_date.' 00:00:00'); 
            $this->db->where('sales.date <=', $start_date.' 23:59:59');  
		}
		else{
            $this->db->like('sales.date', date('Y-m-d'));
        }  
        $query = $this->db->get();
        return $query->result(); 
    }

    public function saleItemReport($start_date=NULL,$end_date=NULL){
        $this->db->select('sales.id as sale_id, sales.store_id, stores.name as store_name, products.name as product_name, products.id as product_id, sale_items.quantity, sale_items.subtotal '); 
        $this->db->from('sales');  
		$this->db->join('stores','stores.id=sales.store_id');
        $this->db->join('sale_items','sale_items.sale_id=sales.id');
        $this->db->join('products','products.id=sale_items.product_id');
        if($start_date && $end_date){ 
            $this->db->where('sales.date >=', $start_date.' 00:00:00'); 
            $this->db->where('sales.date <=', $end_date.' 23:59:59');   
        }
		elseif($start_date)
		{
            $this->db->where('sales.date >=', $start_date.' 00:00:00'); 
            $this->db->where('sales.date <=', $start_date.' 23:59:59');  
		}
		else{
            $this->db->like('sales.date', date('Y-m-d'));
        }  
        $query = $this->db->get();
        return $query->result(); 
    }

    public function saleCollectionReport($start_date=NULL,$end_date=NULL){
        $this->db->select('today_collection.payment_amount , today_collection.store_id, stores.name as store_name, payments.paid_by '); 
        $this->db->from('today_collection');  
		$this->db->join('payments','today_collection.today_collect_id=payments.collect_id');
		$this->db->join('stores','stores.id=today_collection.store_id');

        if($start_date && $end_date){ 
            $this->db->where('payments.date >=', $start_date.' 00:00:00'); 
            $this->db->where('payments.date <=', $end_date.' 23:59:59');   
        }
		elseif($start_date)
		{
            $this->db->where('payments.date >=', $start_date.' 00:00:00'); 
            $this->db->where('payments.date <=', $start_date.' 23:59:59');  
		}
		else{
            $this->db->like('payments.date', date('Y-m-d'));
        }  
        $query = $this->db->get();
        return $query->result(); 
    }

    public function creditCollectionReport($start_date=NULL,$end_date=NULL,$store_id=0){

		$this->db->select('collection_id');
		$this->db->from('sales');
		$where_clause = $this->db->get_compiled_select();

        $this->db->select('today_collection.today_collect_id as collection_id, today_collection.payment_amount,  payments.paid_by, payments.date as payments_date, customers.name as customers_name, bank_account.bank_name '); 
        $this->db->from('today_collection');  
		$this->db->join('payments','today_collection.today_collect_id=payments.collect_id');
		$this->db->join('customers','customers.id=today_collection.customer_id');
		$this->db->join('bank_pending','bank_pending.collection_id=today_collection.today_collect_id','left');  
        $this->db->join('bank_account','bank_pending.bank_id=bank_account.bank_account_id','left');  

        if($start_date && $end_date){ 
            $this->db->where('payments.date >=', $start_date.' 00:00:00'); 
            $this->db->where('payments.date <=', $end_date.' 23:59:59');   
        }
		elseif($start_date)
		{
            $this->db->where('payments.date >=', $start_date.' 00:00:00'); 
            $this->db->where('payments.date <=', $start_date.' 23:59:59');  
		}
		else{
            $this->db->like('payments.date', date('Y-m-d'));
        }  
        if($store_id){$this->db->where('today_collection.store_id', $store_id); }
		$this->db->where("`today_collect_id` NOT IN ($where_clause)", NULL, FALSE);

        $query = $this->db->get();
        return $query->result(); 
    }
    
    public function getAllBank()
	{
		$q = $this->db->get('bank_account');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}

			return $data;
		}
	}

    public function getAllBankInfo($id=null)
	{ 

        $this->db->select('bank_account.bank_account_id as bank_id, bank_account.bank_name, bank_account.account_no, tranjiction.tran_amount as amount, tranjiction.tran_type as payment_type,bank_account.create_date '); 
        $this->db->from('bank_account');  
		$this->db->join('tranjiction','bank_account.bank_account_id =tranjiction.bank_account_id');

        if($id){ 
            $this->db->where('bank_account.bank_account_id ',$id);   
        }
  
		$this->db->order_by("bank_account.bank_account_id", 'asc');

        $query = $this->db->get();
        return $query->result(); 
	}

    public function agingReport($start_date=NULL,$end_date=NULL,$store_id=0){

        $this->db->select('sales.id as invoice, sales.date, sales.paid_by, sales.customer_name, customers.phone, sales.total,  stores.name as storename, sales.total_tax, sales.total_discount, sales.grand_total, sales.paid, sales.paid_by, sales.status, sales.aging_day, bank_pending.type '); 
        $this->db->from('sales');  

        $this->db->join('customers', 'customers.id=sales.customer_id');  
        $this->db->join('stores', 'stores.id=sales.store_id');	     
        $this->db->join('payments', 'payments.sale_id=sales.id', 'LEFT');	    
        $this->db->join('bank_pending', 'bank_pending.collection_id=payments.collect_id and bank_pending.payment_type=1', 'LEFT');	
        
        $this->db->where('sales.aging_status', '1');  
        $this->db->where('sales.aging_day >', '0');  
        if($start_date && $end_date){ 
            $this->db->where('sales.date >=', $start_date.' 00:00:00'); 
            $this->db->where('sales.date <=', $end_date.' 23:59:59');   
        }
		elseif($start_date)
		{
            $this->db->where('sales.date >=', $start_date.' 00:00:00'); 
            $this->db->where('sales.date <=', $start_date.' 23:59:59');  
		}
		else{
            $this->db->like('sales.date', date('Y-m-d'));
        }  

        if($store_id){$this->db->where('stores.id', $store_id); }

        $query = $this->db->get();
        return $query->result(); 
    }
}

