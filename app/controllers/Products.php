<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Products extends MY_Controller
{



    function __construct() {

        parent::__construct();

        if (!$this->loggedIn) {

            redirect('login');

        }



        $this->load->library('form_validation');

        $this->load->model('products_model');
        
		$ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);

    }



    function index() {

        $data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

        $this->data['page_title'] = lang('products');

        $bc = array(array('link' => '#', 'page' => lang('products')));

        $meta = array('page_title' => lang('products'), 'bc' => $bc);

        $this->page_construct('products/index', $this->data, $meta);
    }

    function get_products() {

        $this->load->library('datatables');

        if ($this->Admin) {

            $this->datatables->select($this->db->dbprefix('products').".id as pid, ".
                 $this->db->dbprefix('products').".code as code, ".$this->db->dbprefix('products').".name as pname, type, ".$this->db->dbprefix('categories').".name as cname, quantity , tax, tax_method, cost, price, ".$this->db->dbprefix('products').".barcode_symbology as barcodeSymbology", FALSE);

        } else {

            $store_id = $this->session->userdata('store_id');

            $this->datatables->select($this->db->dbprefix('products').".id as pid, ".
                 
                $this->db->dbprefix('products').".code as code, ".
                $this->db->dbprefix('products').".name as pname,".
                $this->db->dbprefix('products').".type, ".
                $this->db->dbprefix('categories').".name as cname, ".
                $this->db->dbprefix('product_store_qty').".quantity as qty , ".
                $this->db->dbprefix('products').".tax, ".
                $this->db->dbprefix('products').".tax_method, ".
                $this->db->dbprefix('products').".price, ".
                $this->db->dbprefix('products').".barcode_symbology as barcodeSymbology", FALSE);

        }

        $this->datatables->join('categories', 'categories.id=products.category_id');

       if (!$this->Admin) {

         $this->datatables->join('product_store_qty',  'product_store_qty.product_id=products.id' );
        }

        $this->datatables->from('products');

        $this->datatables->group_by('products.id');

        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'><a href='".site_url('products/view/$1')."' title='" . lang("view") . "' class='tip btn btn-primary btn-xs' data-toggle='ajax'><i class='fa fa-file-text-o'></i></a><a onclick=\"window.open('".site_url('products/single_barcode/$1')."', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;\" href='#' title='".lang('print_barcodes')."' class='tip btn btn-default btn-xs'><i class='fa fa-print'></i></a> <a onclick=\"window.open('".site_url('products/single_label/$1')."', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;\" href='#' title='".lang('print_labels')."' class='tip btn btn-default btn-xs'><i class='fa fa-print'></i></a> <a id='$4 ($3)' href='" . site_url('products/php_barcode/$3/$5') . "' title='" . lang("view_barcode") . "' class='barcode tip btn btn-primary btn-xs'><i class='fa fa-barcode'></i></a> <a class='tip image btn btn-primary btn-xs' id='$4 ($3)' href='" . base_url('uploads/$2') . "' title='" . lang("view_image") . "'><i class='fa fa-picture-o'></i></a> 
        <a href='" . site_url('products/edit/$1') . "' title='" . lang("edit_product") . "' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>
        <a href='" . site_url('products/delete/$1') . "' onClick=\"return confirm('" . lang('alert_x_product') . "')\" title='" . lang("delete_product") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>
                </div></div>", "pid, image, code, pname, barcodeSymbology");

        //<a href='" . site_url('products/edit/$1') . "' title='" . lang("edit_product") . "' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a> <a href='" . site_url('products/delete/$1') . "' onClick=\"return confirm('" . lang('alert_x_product') . "')\" title='" . lang("delete_product") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>

        $this->datatables->unset_column('pid')->unset_column('barcodeSymbology');

        if (!$this->Admin) {

            $this->datatables->where('product_store_qty.store_id', $store_id );
        }

        echo $this->datatables->generate();

    }

    function view($id = NULL) {

        $data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

        $product = $this->site->getProductByID($id);

        if($this->Admin){
            $storeList = $this->site->getStoreList($id);
            $this->data['storeList'] = $storeList; 
        }

        if(!$this->Admin){
          $ProSequence = $this->site->getSequence($id);
          $this->data['ProSequence'] = $ProSequence;  
        }

        $this->data['product'] = $product;

        $this->data['category'] = $this->site->getCategoryByID($product->category_id);

        $this->data['combo_items'] = $product->type == 'combo' ? $this->products_model->getComboItemsByPID($id) : NULL;

        $this->load->view($this->theme.'products/view', $this->data);

    }



    function barcode($product_code = NULL) {

        if ($this->input->get('code')) {

            $product_code = $this->input->get('code');

        }



        $data['product_details'] = $this->products_model->getProductByCode($product_code);

        $data['img'] = "<img src='" . base_url() . "index.php?products/php_barcode&code={$product_code}' alt='{$product_code}' />";

        $this->load->view('barcode', $data);



    }



    function product_barcode($product_code = NULL, $bcs = 'code39', $height = 60) {

        if ($this->input->get('code')) {

            $product_code = $this->input->get('code');

        }

        return "<img src='" . base_url() . "products/php_barcode/{$product_code}/{$bcs}/{$height}' alt='{$product_code}' />";

    }



    function gen_barcode($product_code = NULL, $bcs = 'code39', $height = 60, $text = 1) {

        $drawText = ($text != 1) ? FALSE : TRUE;

        $this->load->library('zend');

        $this->zend->load('Zend/Barcode');

        $barcodeOptions = array('text' => $product_code, 'barHeight' => $height, 'drawText' => $drawText);

        $rendererOptions = array('imageType' => 'png', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle');

        $imageResource = Zend_Barcode::render($bcs, 'image', $barcodeOptions, $rendererOptions);

        return $imageResource;

    }





    function print_barcodes() {

        $this->load->library('pagination');

        $per_page = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        $config['base_url'] = site_url('products/print_barcodes');

        $config['total_rows'] = $this->products_model->products_count();

        $config['per_page'] = 10000;

        $config['num_links'] = 5;

        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';

        $config['full_tag_close'] = '</ul>';

        $config['first_tag_open'] = '<li>';

        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li>';

        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li>';

        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li>';

        $config['prev_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li>';

        $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a>';

        $config['cur_tag_close'] = '</a></li>';

        $this->pagination->initialize($config);

        $products = $this->products_model->fetch_products($config['per_page'], $per_page);

        $r = 1;

        $html = "";

        $html .= '<table class="table table-bordered">

        <tbody><tr>';

        foreach ($products as $pr) {

            if ($r != 1) {

                $rw = (bool)($r & 1);

                $html .= $rw ? '</tr><tr>' : '';

            }

            $html .= '<td><h4>' . $this->Settings->site_name . '</h4><p>' . $pr->name . '</p>' . $this->product_barcode($pr->code, $pr->barcode_symbology, 25) . '</td>';

            $r++;

        }

        $html .= '</tr></tbody>

        </table>';

        $this->data['html'] = $html;

        $this->data['page_title'] = lang("print_barcodes");

        $this->load->view($this->theme.'products/print_barcodes', $this->data);

    }

    function print_labels() {

        $this->load->library('pagination');

        $per_page = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        $config['base_url'] = site_url('products/print_labels');

        $config['total_rows'] = $this->products_model->products_count(); 

        $config['per_page'] = 50000;

        $config['num_links'] = 5;

        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';

        $config['full_tag_close'] = '</ul>';

        $config['first_tag_open'] = '<li>';

        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li>';

        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li>';

        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li>';

        $config['prev_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li>';

        $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a>';

        $config['cur_tag_close'] = '</a></li>';

        $this->pagination->initialize($config);

        $products = $this->products_model->fetch_products($config['per_page'], $per_page); 

        $html = "";

        foreach ($products as $pr) {

            $html .= '<div class="labels"><strong>' . $pr->name . '</strong><br>' . $this->product_barcode($pr->code, $pr->barcode_symbology, 25) . '<br><span class="price">'.lang('price') .': ' .$this->Settings->currency_prefix. ' ' . $pr->price . '</span></div>';

        }

        $this->data['html'] = $html;         

        $this->data['page_title'] = lang("print_labels");

        $this->load->view($this->theme.'products/print_labels', $this->data);

    }

    function single_barcode($product_id = NULL) {

        $product = $this->site->getProductByID($product_id);

        $html = "";

        $html .= '<table class="table table-bordered">

        <tbody><tr>';

        if($product->quantity > 0) {

            for ($r = 1; $r <= $product->quantity; $r++) {

                if ($r != 1) {

                    $rw = (bool)($r & 1);

                    $html .= $rw ? '</tr><tr>' : '';

                }

                $html .= '<td><h4>' . $this->Settings->site_name . '</h4><strong>' . $product->name . '</strong><br>' . $this->product_barcode($product->code, $product->barcode_symbology, 25) . '</td>';

            }

        } else {

            for ($r = 1; $r <= 6; $r++) {

            if ($r != 1) {

                $rw = (bool)($r & 1);

                $html .= $rw ? '</tr><tr>' : '';

            }

            $html .= '<td><h4>' . $this->Settings->site_name . '</h4><p>' . $product->name . '</p>' . $this->product_barcode($product->code, $product->barcode_symbology, 25) . '</td>';

        }

        }

        $html .= '</tr></tbody>

        </table>';

        $this->data['html'] = $html;

        $this->data['page_title'] = lang("print_barcodes");

        $this->load->view($this->theme . 'products/single_barcode', $this->data);

    }



    function single_label($product_id = NULL, $warehouse_id = NULL) {

        $product = $this->site->getProductByID($product_id);

        $html = "";

        if($product->quantity > 0) {

            for ($r = 1; $r <= $product->quantity; $r++) {

                $html .= '<div class="labels"><p>' . $product->name . '</p>' . $this->product_barcode($product->code, $product->barcode_symbology, 25) . '</div>';

            }

        } else {

            for ($r = 1; $r <= 4; $r++) {

                $html .= '<div class="labels"><p>' . $product->name . '</p>' . $this->product_barcode($product->code, $product->barcode_symbology, 25) . '</div>';

            }

        }

        $this->data['html'] = $html;

        $this->data['page_title'] = lang("barcode_label");

        $this->load->view($this->theme . 'products/single_label', $this->data);

    }


    function add() { 

        $this->form_validation->set_rules('code', lang("product_code"), 'trim|is_unique[products.code]|min_length[2]|max_length[50]|required|alpha_numeric');

        $this->form_validation->set_rules('name', lang("product_name"), 'required');

        $this->form_validation->set_rules('category', lang("category"), 'required');

        $this->form_validation->set_rules('price', lang("product_price"), 'required|is_numeric');

        $this->form_validation->set_rules('cost', lang("product_cost"), 'required|is_numeric');

        $this->form_validation->set_rules('product_tax', lang("product_tax"), 'required|is_numeric');

        $this->form_validation->set_rules('quantity', lang("quantity"), 'is_numeric');

        $this->form_validation->set_rules('alert_quantity', lang("alert_quantity"), 'is_numeric');

        if ($this->form_validation->run() == true) {

            $data = array(

                'type' => $this->input->post('type'),

                'code' => $this->input->post('code'),

                'name' => $this->input->post('name'),
                
                'brands_id' => $this->input->post('brand'),

                'category_id' => $this->input->post('category'),

                'price' => $this->input->post('price'),

                'cost' => $this->input->post('cost'),

                'tax' => $this->input->post('product_tax'),

                'tax_method' => $this->input->post('tax_method'),

                'quantity' => $this->input->post('quantity'),

                'alert_quantity' => $this->input->post('alert_quantity'),

                'details' => $this->input->post('details'),

                );

            if ($this->input->post('type') == 'combo') {

                $c = sizeof($_POST['combo_item_code']) - 1;

                for ($r = 0; $r <= $c; $r++) {

                    if (isset($_POST['combo_item_code'][$r]) && isset($_POST['combo_item_quantity'][$r])) {

                        $items[] = array(

                            'item_code' => $_POST['combo_item_code'][$r],

                            'quantity' => $_POST['combo_item_quantity'][$r]

                        );

                    }

                }

            } else {

                $items = array();

            }

            if ($_FILES['userfile']['size'] > 0) {

                $this->load->library('upload');

                $config['upload_path'] = 'uploads/';

                $config['allowed_types'] = 'gif|jpg|png';

                $config['max_size'] = '500';

                $config['max_width'] = '800';

                $config['max_height'] = '800';

                $config['overwrite'] = FALSE;

                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {

                    $error = $this->upload->display_errors();

                    $this->session->set_flashdata('error', $error);

                    redirect("products/add", 'refresh');

                }

                $photo = $this->upload->file_name;

                $data['image'] = $photo;

                $this->load->library('image_lib');

                $config['image_library'] = 'gd2';

                $config['source_image'] = 'uploads/' . $photo;

                $config['new_image'] = 'uploads/thumbs/' . $photo;

                $config['maintain_ratio'] = TRUE;

                $config['width'] = 110;

                $config['height'] = 110;

                $this->image_lib->clear();

                $this->image_lib->initialize($config);

                if (!$this->image_lib->resize()) {

                    $this->session->set_flashdata('error', $this->image_lib->display_errors());

                    redirect("products/add");

                }

            }

            // $this->tec->print_arrays($data, $items);

        }



        if ($this->form_validation->run() == true && $this->products_model->addProduct($data, $items)) {

            $this->session->set_flashdata('message', lang("product_added"));

            redirect('products');

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

            $this->data['categories'] = $this->site->getAllCategories();

            $this->data['page_title'] = lang('add_product');

            $bc = array(array('link' => site_url('products'), 'page' => lang('products')), array('link' => '#', 'page' => lang('add_product')));

            $meta = array('page_title' => lang('add_product'), 'bc' => $bc);

            $this->page_construct('products/add', $this->data, $meta);



        }

    }



    function edit($id = NULL) {


        if ($this->input->get('id')) {

            $id = $this->input->get('id');

        }



        $pr_details = $this->site->getProductByID($id);

        if ($this->input->post('code') != $pr_details->code) {

            $this->form_validation->set_rules('code', lang("product_code"), 'is_unique[products.code]');

        }

        $this->form_validation->set_rules('code', lang("product_code"), 'trim|min_length[2]|max_length[50]|required|alpha_numeric');

        $this->form_validation->set_rules('name', lang("product_name"), 'required');

        $this->form_validation->set_rules('category', lang("category"), 'required');

        $this->form_validation->set_rules('price', lang("product_price"), 'required|is_numeric');

        $this->form_validation->set_rules('cost', lang("product_cost"), 'required|is_numeric');

        $this->form_validation->set_rules('product_tax', lang("product_tax"), 'required|is_numeric');

        $this->form_validation->set_rules('quantity', lang("quantity"), 'is_numeric');

        $this->form_validation->set_rules('alert_quantity', lang("alert_quantity"), 'is_numeric');



        if ($this->form_validation->run() == true) {





            $data = array(

                'type' => $this->input->post('type'),

                'code' => $this->input->post('code'),

                'name' => $this->input->post('name'),

                'category_id' => $this->input->post('category'),

                'price' => $this->input->post('price'),

                'cost' => $this->input->post('cost'),

                'tax' => $this->input->post('product_tax'),

                'tax_method' => $this->input->post('tax_method'),

                'quantity' => $this->input->post('quantity'),

                'alert_quantity' => $this->input->post('alert_quantity'),

                'details' => $this->input->post('details'),

                );



            if ($this->input->post('type') == 'combo') {

                $c = sizeof($_POST['combo_item_code']) - 1;

                for ($r = 0; $r <= $c; $r++) {

                    if (isset($_POST['combo_item_code'][$r]) && isset($_POST['combo_item_quantity'][$r])) {

                        $items[] = array(

                            'item_code' => $_POST['combo_item_code'][$r],

                            'quantity' => $_POST['combo_item_quantity'][$r]

                        );

                    }

                }

            } else {

                $items = array();

            }



            if ($_FILES['userfile']['size'] > 0) {



                $this->load->library('upload');



                $config['upload_path'] = 'uploads/';

                $config['allowed_types'] = 'gif|jpg|png';

                $config['max_size'] = '500';

                $config['max_width'] = '800';

                $config['max_height'] = '800';

                $config['overwrite'] = FALSE;

                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);



                if (!$this->upload->do_upload()) {

                    $error = $this->upload->display_errors();

                    $this->upload->set_flashdata('error', $error);

                    redirect("products/edit/" . $id);

                }



                $photo = $this->upload->file_name;



                $this->load->helper('file');

                $this->load->library('image_lib');

                $config['image_library'] = 'gd2';

                $config['source_image'] = 'uploads/' . $photo;

                $config['new_image'] = 'uploads/thumbs/' . $photo;

                $config['maintain_ratio'] = TRUE;

                $config['width'] = 110;

                $config['height'] = 110;



                $this->image_lib->clear();

                $this->image_lib->initialize($config);



                if (!$this->image_lib->resize()) {

                    $this->upload->set_flashdata('error', $this->image_lib->display_errors());

                    redirect("products/edit/" . $id);

                }



            } else {

                $photo = NULL;

            }



        }



        if ($this->form_validation->run() == true && $this->products_model->updateProduct($id, $data, $items, $photo)) {



            $this->session->set_flashdata('message', lang("product_updated"));

            redirect("products");



        } else {



            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

            $product = $this->site->getProductByID($id);

            if($product->type == 'combo') {

                $combo_items = $this->products_model->getComboItemsByPID($id);

                foreach ($combo_items as $combo_item) {

                    $cpr = $this->site->getProductByID($combo_item->id);

                    $cpr->qty = $combo_item->qty;

                    $items[] = array('id' => $cpr->id, 'row' => $cpr);

                }

                $this->data['items'] = $items;

            }

            $this->data['product'] = $product;

            $this->data['categories'] = $this->site->getAllCategories();

            $this->data['page_title'] = lang('edit_product');

            $bc = array(array('link' => site_url('products'), 'page' => lang('products')), array('link' => '#', 'page' => lang('edit_product')));

            $meta = array('page_title' => lang('edit_product'), 'bc' => $bc);

            $this->page_construct('products/edit', $this->data, $meta);



        }

    }

    function import() { 

        $this->load->helper('security');

        $this->form_validation->set_rules('userfile', lang("upload_file"), 'xss_clean');

        if ($this->form_validation->run() == true) {

            if (DEMO) {

                $this->session->set_flashdata('warning', lang("disabled_in_demo"));

                redirect('pos');

            } 
            if (isset($_FILES["userfile"])) { 

                $this->load->library('upload'); 

                $config['upload_path'] = 'uploads/';

                $config['allowed_types'] = 'csv';

                $config['max_size'] = '500';

                $config['overwrite'] = TRUE; 

                $this->upload->initialize($config); 

                if (!$this->upload->do_upload()) {

                    $error = $this->upload->display_errors();

                    $this->session->set_flashdata('error', $error);

                    redirect("products/import");

                }
 

                $csv = $this->upload->file_name;
 
                $arrResult = array();

                $handle = fopen("uploads/" . $csv, "r");

                if ($handle) {

                    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {

                        $arrResult[] = $row;

                    }

                    fclose($handle);

                }

                array_shift($arrResult);



                $keys = array('code', 'name', 'cost', 'tax', 'price', 'category');



                $final = array();

                foreach ($arrResult as $key => $value) {

                    $final[] = array_combine($keys, $value);

                }
 

                if (sizeof($final) > 1001) {

                    $this->session->set_flashdata('error', lang("more_than_allowed"));

                    redirect("products/import");

                }



                foreach ($final as $csv_pr) {

                    if ($this->products_model->getProductByCode($csv_pr['code'])) {

                        $this->session->set_flashdata('error', lang("check_product_code") . " (" . $csv_pr['code'] . "). " . lang("code_already_exist"));

                        redirect("products/import");

                    }

                    if (!is_numeric($csv_pr['tax'])) {

                        $this->session->set_flashdata('error', lang("check_product_tax") . " (" . $csv_pr['tax'] . "). " . lang("tax_not_numeric"));

                        redirect("products/import");

                    } 

                    if(! ($category = $this->site->getCategoryByCode($csv_pr['category']))) {

                        $this->session->set_flashdata('error', lang("check_category") . " (" . $csv_pr['category'] . "). " . lang("category_x_exist"));

                        redirect("products/import");

                    }

                    $data[] = array(

                        'type' => 'standard',

                        'code' => $csv_pr['code'],

                        'name' => $csv_pr['name'],

                        'cost' => $csv_pr['cost'],

                        'tax' => $csv_pr['tax'],

                        'price' => $csv_pr['price'],

                        'category_id' => $category->id

                    );

                }

                //print_r($data); die();

            }



        }



        if ($this->form_validation->run() == true && $this->products_model->add_products($data)) {



            $this->session->set_flashdata('message', lang("products_added"));

            redirect('products');



        } else {



            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

            $this->data['categories'] = $this->site->getAllCategories();

            $this->data['page_title'] = lang('import_products');

            $bc = array(array('link' => site_url('products'), 'page' => lang('products')), array('link' => '#', 'page' => lang('import_products')));

            $meta = array('page_title' => lang('import_products'), 'bc' => $bc);

            $this->page_construct('products/import', $this->data, $meta);



        }

    }





    function delete($id = NULL) {

        if(DEMO) {

            $this->session->set_flashdata('error', lang('disabled_in_demo'));

            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'welcome');

        }



        if ($this->input->get('id')) {

            $id = $this->input->get('id');

        }



        if (!$this->Admin) {

            $this->session->set_flashdata('error', lang('access_denied'));

            redirect('pos');

        }



        if ($this->products_model->deleteProduct($id)) {

            $this->session->set_flashdata('message', lang("product_deleted"));

            redirect('products');

        }



    }



    function suggestions() {

         $term = $this->input->get('term', TRUE);

         $rows = $this->products_model->getProductNames($term);

         if ($rows) {

             foreach ($rows as $row) {

                 $row->qty = 1;

                 $pr[] = array('id' => str_replace(".", "", microtime(true)), 'item_id' => $row->id, 'label' => $row->name . " (" . $row->code . ")", 'row' => $row);

             }

             echo json_encode($pr);

         } else {

             echo json_encode(array(array('id' => 0, 'label' => lang('no_match_found'), 'value' => $term)));

         }

     }

     function  SequenceSearch($keyword){
        if($keyword !=''){
        $results = $this->site->SequenceSearch($keyword);
        if(count($results) >0){
         ?>
        
        <div  class="sequence-search">
            <ul>
            <?php foreach ($results as $key => $value) { 
              echo '<li><a href="'.base_url('products').'/view/'.$value->pro_id.'" title="'.$value->sequence.'" class="" data-toggle="ajax" data-original-title="View">'.$value->sequence.'</a></li>';
            } ?>
              
            </ul>
        </div>
        <?php 
            }
        }
     }

     function php_barcode( $text="0", $code_type="code39", $size="20", $filepath="", $orientation="horizontal", $print=true, $SizeFactor=1 ) {
        $code_string = "";
        // Translate the $text into barcode the correct $code_type
        if ( in_array(strtolower($code_type), array("code128", "code128b")) ) {
            $chksum = 104;
            // Must not change order of array elements as the checksum depends on the array's key to validate final code
            $code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","\`"=>"111422","a"=>"121124","b"=>"121421","c"=>"141122","d"=>"141221","e"=>"112214","f"=>"112412","g"=>"122114","h"=>"122411","i"=>"142112","j"=>"142211","k"=>"241211","l"=>"221114","m"=>"413111","n"=>"241112","o"=>"134111","p"=>"111242","q"=>"121142","r"=>"121241","s"=>"114212","t"=>"124112","u"=>"124211","v"=>"411212","w"=>"421112","x"=>"421211","y"=>"212141","z"=>"214121","{"=>"412121","|"=>"111143","}"=>"111341","~"=>"131141","DEL"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","FNC 4"=>"114131","CODE A"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
            $code_keys = array_keys($code_array);
            $code_values = array_flip($code_keys);
            for ( $X = 1; $X <= strlen($text); $X++ ) {
                $activeKey = substr( $text, ($X-1), 1);
                $code_string .= $code_array[$activeKey];
                $chksum=($chksum + ($code_values[$activeKey] * $X));
            }
            $code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];
    
            $code_string = "211214" . $code_string . "2331112";
        } elseif ( strtolower($code_type) == "code128a" ) {
            $chksum = 103;
            $text = strtoupper($text); // Code 128A doesn't support lower case
            // Must not change order of array elements as the checksum depends on the array's key to validate final code
            $code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","NUL"=>"111422","SOH"=>"121124","STX"=>"121421","ETX"=>"141122","EOT"=>"141221","ENQ"=>"112214","ACK"=>"112412","BEL"=>"122114","BS"=>"122411","HT"=>"142112","LF"=>"142211","VT"=>"241211","FF"=>"221114","CR"=>"413111","SO"=>"241112","SI"=>"134111","DLE"=>"111242","DC1"=>"121142","DC2"=>"121241","DC3"=>"114212","DC4"=>"124112","NAK"=>"124211","SYN"=>"411212","ETB"=>"421112","CAN"=>"421211","EM"=>"212141","SUB"=>"214121","ESC"=>"412121","FS"=>"111143","GS"=>"111341","RS"=>"131141","US"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","CODE B"=>"114131","FNC 4"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
            $code_keys = array_keys($code_array);
            $code_values = array_flip($code_keys);
            for ( $X = 1; $X <= strlen($text); $X++ ) {
                $activeKey = substr( $text, ($X-1), 1);
                $code_string .= $code_array[$activeKey];
                $chksum=($chksum + ($code_values[$activeKey] * $X));
            }
            $code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];
    
            $code_string = "211412" . $code_string . "2331112";
        } elseif ( strtolower($code_type) == "code39" ) {
            $code_array = array("0"=>"111221211","1"=>"211211112","2"=>"112211112","3"=>"212211111","4"=>"111221112","5"=>"211221111","6"=>"112221111","7"=>"111211212","8"=>"211211211","9"=>"112211211","A"=>"211112112","B"=>"112112112","C"=>"212112111","D"=>"111122112","E"=>"211122111","F"=>"112122111","G"=>"111112212","H"=>"211112211","I"=>"112112211","J"=>"111122211","K"=>"211111122","L"=>"112111122","M"=>"212111121","N"=>"111121122","O"=>"211121121","P"=>"112121121","Q"=>"111111222","R"=>"211111221","S"=>"112111221","T"=>"111121221","U"=>"221111112","V"=>"122111112","W"=>"222111111","X"=>"121121112","Y"=>"221121111","Z"=>"122121111","-"=>"121111212","."=>"221111211"," "=>"122111211","$"=>"121212111","/"=>"121211121","+"=>"121112121","%"=>"111212121","*"=>"121121211");
    
            // Convert to uppercase
            $upper_text = strtoupper($text);
    
            for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
                $code_string .= $code_array[substr( $upper_text, ($X-1), 1)] . "1";
            }
    
            $code_string = "1211212111" . $code_string . "121121211";
        } elseif ( strtolower($code_type) == "code25" ) {
            $code_array1 = array("1","2","3","4","5","6","7","8","9","0");
            $code_array2 = array("3-1-1-1-3","1-3-1-1-3","3-3-1-1-1","1-1-3-1-3","3-1-3-1-1","1-3-3-1-1","1-1-1-3-3","3-1-1-3-1","1-3-1-3-1","1-1-3-3-1");
    
            for ( $X = 1; $X <= strlen($text); $X++ ) {
                for ( $Y = 0; $Y < count($code_array1); $Y++ ) {
                    if ( substr($text, ($X-1), 1) == $code_array1[$Y] )
                        $temp[$X] = $code_array2[$Y];
                }
            }
    
            for ( $X=1; $X<=strlen($text); $X+=2 ) {
                if ( isset($temp[$X]) && isset($temp[($X + 1)]) ) {
                    $temp1 = explode( "-", $temp[$X] );
                    $temp2 = explode( "-", $temp[($X + 1)] );
                    for ( $Y = 0; $Y < count($temp1); $Y++ )
                        $code_string .= $temp1[$Y] . $temp2[$Y];
                }
            }
    
            $code_string = "1111" . $code_string . "311";
        } elseif ( strtolower($code_type) == "codabar" ) {
            $code_array1 = array("1","2","3","4","5","6","7","8","9","0","-","$",":","/",".","+","A","B","C","D");
            $code_array2 = array("1111221","1112112","2211111","1121121","2111121","1211112","1211211","1221111","2112111","1111122","1112211","1122111","2111212","2121112","2121211","1121212","1122121","1212112","1112122","1112221");
    
            // Convert to uppercase
            $upper_text = strtoupper($text);
    
            for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
                for ( $Y = 0; $Y<count($code_array1); $Y++ ) {
                    if ( substr($upper_text, ($X-1), 1) == $code_array1[$Y] )
                        $code_string .= $code_array2[$Y] . "1";
                }
            }
            $code_string = "11221211" . $code_string . "1122121";
        }
    
        // Pad the edges of the barcode
        $code_length = 20;
        if ($print) {
            $text_height = 30;
        } else {
            $text_height = 0;
        }
        
        for ( $i=1; $i <= strlen($code_string); $i++ ){
            $code_length = $code_length + (integer)(substr($code_string,($i-1),1));
            }
    
        if ( strtolower($orientation) == "horizontal" ) {
            $img_width = $code_length*$SizeFactor;
            $img_height = $size;
        } else {
            $img_width = $size;
            $img_height = $code_length*$SizeFactor;
        }
    
        $image = imagecreate($img_width, $img_height + $text_height);
        $black = imagecolorallocate ($image, 0, 0, 0);
        $white = imagecolorallocate ($image, 255, 255, 255);
    
        imagefill( $image, 0, 0, $white );
        if ( $print ) {
            imagestring($image, 5, 31, $img_height, $text, $black );
        }
    
        $location = 10;
        for ( $position = 1 ; $position <= strlen($code_string); $position++ ) {
            $cur_size = $location + ( substr($code_string, ($position-1), 1) );
            if ( strtolower($orientation) == "horizontal" )
                imagefilledrectangle( $image, $location*$SizeFactor, 0, $cur_size*$SizeFactor, $img_height, ($position % 2 == 0 ? $white : $black) );
            else
                imagefilledrectangle( $image, 0, $location*$SizeFactor, $img_width, $cur_size*$SizeFactor, ($position % 2 == 0 ? $white : $black) );
            $location = $cur_size;
        }
        
        // Draw barcode to the screen or save in a file
        if ( $filepath=="" ) {
            header ('Content-type: image/png');
            imagepng($image);
            imagedestroy($image);
        } else {
            imagepng($image,$filepath);
            imagedestroy($image);		
        }
    }

}

