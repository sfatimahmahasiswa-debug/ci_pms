<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Get_ajax_value extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('CommonModel');
	}

	public
	function get_purchase_statement()
	{

			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
			$medicine_name = $this->input->post('medicine_name');
			//$invoice = $this->input->post('invoice');
			$supplier = $this->input->post('supplier');
			$checking_array = array();
			if (!empty($date_from) && !empty($date_to)) {
				$checking_array['date>='] = $date_from;
				$checking_array['date<='] = $date_to;
			}
			if (!empty($medicine_name)) {
				$checking_array['medicine_name'] = $medicine_name;
			}
//			if (!empty($invoice)) {
//				$checking_array['invoice_no'] = $invoice;
//			}
			if (!empty($supplier)) {
				$checking_array['supplier_name'] = $supplier;
			}
			$result = $this->CommonModel->get_distinct_value_where('medicine_name', "insert_purchase_info", $checking_array);
			$count = 0;
			foreach ($result as $info) {
				$count++;
				$checking_array['medicine_name'] = $info->medicine_name;
				$data['product_result' . $count] = $this->CommonModel->get_all_info_by_array("insert_purchase_info", $checking_array);
			}
			$data['count_it'] = $count;
			$this->load->view('inventory/purchase_statement', $data);
	}

	function show_purchase_due()
	{
			$s_supplier= $this->input->post('s_supplier');

//			if (empty($s_supplier)) {
//				echo "<p style='color: #E13300;font-size: 20px;'>Please select a Supplier.</p>";
//			} else {
				$data['all_value'] = $this->CommonModel->get_allinfo_byid('insert_purchase_info', 'supplier_name', $s_supplier,'date(date)','asc');
				$total = 0;
				$paid = 0;
				foreach ($data['all_value'] as $info) {
					$total += $info->purchase_price;
					$paid += $info->purchase_paid;
				}
				$old_due = $total - $paid;
				$data['old_due'] = $old_due;
				$data['supplier_name'] = $s_supplier;
				$this->load->view('inventory/show_purchase_due', $data);
//			}
	}
	public function get_medicine_price() {
		$medicine_name= $this->input->post('medicine_name');
		$result = $this->CommonModel->get_allinfo_byid('insert_purchase_info', 'medicine_name', $medicine_name);
		$price = 0;
		foreach ($result as $info) {
			$price = $info->unit_sales_price;
		}
		echo $price;
	}

	public function sales_confirm() {
		$all_purchase = $this->input->post('all_purchase');
		$amount = $this->input->post('amount');
		$discount = $this->input->post('discount');
		$sub_total = $this->input->post('sub_total');
		$pay = $this->input->post('pay');
		//$due = $this->input->post('due');

		$invoice = 0;
		//Invoice Create Sales
		$result = $this->CommonModel->find_last_id('invoice', 'sales_product');
		if (!$result) {
			$invoice = 1;
		} else {
			foreach ($result as $row) {
				$invoice = ($row->invoice) + 1;
			}
		}
		//Invoice Create Sales END
		$medicine_collection="";

			foreach ($all_purchase as $single_purchase) {
				$date = $single_purchase[0];
				$medicine_name = $single_purchase[1];
				$unit_sales_price = $single_purchase[2];
				$sales_qty = $single_purchase[3];
				$purchase_price = $single_purchase[4];
				$medicine_name_id = $single_purchase[5];
				$generic_name = $single_purchase[6];
				$medicine_presentation = $single_purchase[7];
				$customer_email = isset($single_purchase[8]) ? $single_purchase[8] : '';
				$medicine_collection .= $medicine_name." (Rp ".number_format((float)$purchase_price, 0, ',', '.')."), ";

				$insert_data = array(
					'date' => $date,
					'invoice' => $invoice,
					'particular' => "Sales Medicine",
					//	'patient_id' => $medicine_name,
					//	'customer_name' => $customer_name,
					'customer_email' => $customer_email,
					'medicine_presentation' => $medicine_presentation,
					'medicine_name' => $medicine_name,
					'medicine_name_id' => $medicine_name_id,
					'generic_name' => $generic_name,
					'qty' => $sales_qty,
					'unit_sales_price' => $unit_sales_price,
					'total_price' => $purchase_price,
					'total_amount' => $amount,
					'total_discount' => $discount,
					'discount_price' => $sub_total,
					'sales_paid' => $pay,
					//'sales_due' => $due
				);
				$this->CommonModel->insert_data('sales_product', $insert_data);
		//	}
				// Update Medicine Qty
				// $result = $this->CommonModel->get_allinfo_byid('insert_purchase_info', 'medicine_name_id', $medicine_name_id);
				// $p_qty=0;
				// foreach ($result as $info) {
				// 	$p_qty = $info->qty;
				// }
				// $new_qty = $p_qty - $sales_qty;
				// $update_data = array(
				// 	'qty' => $new_qty
				// );

		        // $this->CommonModel->update_data_onerow('insert_purchase_info', $update_data, 'medicine_name_id', $medicine_name_id);
				// Update Medicine Qty END
			}
		  			// Invoice Data Goes Here
		$data['date'] = $date;
		$data['invoice'] = $invoice;
		//$data['customer_id'] = $customer_id;
		//$data['customer_name'] = $customer_name;
		$data['email'] = $customer_email;
		$data['medicine_name'] = $medicine_collection;
		$data['medicine_presentation'] = $medicine_presentation;
		$data['unit_sales_price'] = $unit_sales_price;
		$data['qty'] = $sales_qty;
		$data['amount'] = $amount;
		$data['discount'] = $discount;
		$data['sub_total'] = $sub_total;
		$data['pay'] = $pay;
		//$data['due'] = $due;

		$this->load->view('sales/sales_invoice', $data);
	}

	public
	function get_sales_statement()
	{

		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');
		$medicine_name = $this->input->post('medicine_name');
		//$invoice = $this->input->post('invoice');
		//$supplier = $this->input->post('supplier');
		$checking_array = array();
		if (!empty($date_from) && !empty($date_to)) {
			$checking_array['date>='] = $date_from;
			$checking_array['date<='] = $date_to;
		}
		if (!empty($medicine_name)) {
			$checking_array['medicine_name'] = $medicine_name;
		}
//			if (!empty($invoice)) {
//				$checking_array['invoice_no'] = $invoice;
//			}
//		if (!empty($supplier)) {
//			$checking_array['supplier_name'] = $supplier;
//		}
		$result = $this->CommonModel->get_distinct_value_where('invoice', "sales_product", $checking_array);
		$count = 0;
		foreach ($result as $info) {
			$count++;
			$checking_array['invoice'] = $info->invoice;
			$data['product_result' . $count] = $this->CommonModel->get_all_info_by_array("sales_product", $checking_array);
		}
		$data['count_it'] = $count;
		$this->load->view('sales/get_sales_statement', $data);
	}
	// Account profit Loss
	public
	function get_product_profit_loss_info()
	{
		if ($this->session->userdata('username') != '') {
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
			$medicine_name_id = $this->input->post('medicine_name_id');
			$checking_array = array();

			if (!empty($medicine_name_id)) {
				$checking_array['medicine_name_id'] = $medicine_name_id;
			}
			$data['all_product_info'] = $this->CommonModel->check_value_get_data('insert_purchase_info', $checking_array);
			if (!empty($data['all_product_info'])) {
				$count = 0;
				foreach ($data['all_product_info'] as $p) {
					$purchase_price = $p->purchase_price;
					$array_check = array();
					$array_check['medicine_name_id'] = $p->medicine_name_id;
					if (!empty($date_from) && !empty($date_to)) {
						// $array_check['date >='] = $date_from;
						$array_check['date <='] = $date_to;
					}
					$sold_qty = 0;
					$total_sale = 0;
					$sales = $this->CommonModel->get_all_info_by_array('sales_product', $array_check);
					foreach ($sales as $s) {
						$sold_qty += $s->qty;
						$total_sale += $s->unit_sales_price * $s->qty ;
					}
					if ($sold_qty != 0) {
						$count++;
						$data['name' . $count] = $p->medicine_name;
						$data['purchase_price' . $count] = $p->purchase_price;
						$data['sold_qty' . $count] = $sold_qty;
//						$data['selling_price' . $count] = round($total_sale / $sold_qty, 2);
						$data['selling_price' . $count] = $total_sale;
						$data['profit_loss_unit' . $count] = ($data['selling_price' . $count])- $purchase_price;
//						$data['profit_loss_total' . $count] = $data['profit_loss_unit' . $count] * $sold_qty;
						$data['total_sale' . $count] = $total_sale;
					}
				}
				$data['c'] = $count;
				$data['start_date'] = $date_from;
				$data['end_date'] = $date_to;
				$this->load->view('account/show_product_profit_loss_info', $data);
			}
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('Main/login', $data);
		}
	}


	public function get_rekap_obat()
	{
		if ($this->session->userdata('username') != '') {
			$date_from  = $this->input->post('date_from');
			$date_to    = $this->input->post('date_to');
			$rekap_type = $this->input->post('rekap_type'); // 'obat_keluar', 'pembelian', or 'stok_habis'

			// Stok habis handled separately
			if ($rekap_type === 'stok_habis') {
				$data['results']   = $this->_get_rekap_stok_habis($date_from, $date_to);
				$data['date_from'] = $date_from;
				$data['date_to']   = $date_to;
				$this->load->view('inventory/ajax_laporan_stok_habis', $data);
				return;
			}

			// Build shared WHERE clause and params
			$where_parts = array("medicine_name IS NOT NULL AND medicine_name != ''");
			$params      = array();
			if (!empty($date_from)) { $where_parts[] = "date >= ?"; $params[] = $date_from; }
			if (!empty($date_to))   { $where_parts[] = "date <= ?"; $params[] = $date_to;   }
			$where_sql = 'WHERE ' . implode(' AND ', $where_parts);

			$common_select = "
				IFNULL(NULLIF(TRIM(medicine_presentation),''), 'Lainnya') AS medicine_presentation,
				IFNULL(NULLIF(TRIM(generic_name),''), 'Lainnya')          AS generic_name,
				IFNULL(NULLIF(TRIM(medicine_name),''), 'Lainnya')         AS medicine_name,
				SUM(qty) AS total_qty,";

			if ($rekap_type === 'pembelian') {
				$sql = "SELECT $common_select SUM(purchase_price) AS total_harga
				FROM insert_purchase_info $where_sql
				GROUP BY medicine_presentation, generic_name, medicine_name
				ORDER BY medicine_presentation, generic_name, medicine_name";
			} else {
				$sql = "SELECT $common_select SUM(total_price) AS total_harga
				FROM sales_product $where_sql
				GROUP BY medicine_presentation, generic_name, medicine_name
				ORDER BY medicine_presentation, generic_name, medicine_name";
			}

			$results = $this->CommonModel->raw_query($sql, $params);

			// Group flat results: type -> category -> items[]
			$grouped           = array();
			$grand_total_qty   = 0;
			$grand_total_harga = 0;

			foreach ($results as $row) {
				$type     = $row->medicine_presentation;
				$category = $row->generic_name;

				if (!isset($grouped[$type])) {
					$grouped[$type] = array('total_qty' => 0, 'total_harga' => 0, 'categories' => array());
				}
				if (!isset($grouped[$type]['categories'][$category])) {
					$grouped[$type]['categories'][$category] = array('total_qty' => 0, 'total_harga' => 0, 'items' => array());
				}

				$grouped[$type]['categories'][$category]['items'][]     = $row;
				$grouped[$type]['categories'][$category]['total_qty']   += $row->total_qty;
				$grouped[$type]['categories'][$category]['total_harga'] += $row->total_harga;
				$grouped[$type]['total_qty']                            += $row->total_qty;
				$grouped[$type]['total_harga']                          += $row->total_harga;
				$grand_total_qty                                        += $row->total_qty;
				$grand_total_harga                                      += $row->total_harga;
			}

			$data['grouped']           = $grouped;
			$data['grand_total_qty']   = $grand_total_qty;
			$data['grand_total_harga'] = $grand_total_harga;
			$data['rekap_type']        = $rekap_type;
			$data['date_from']         = $date_from;
			$data['date_to']           = $date_to;

			$this->load->view('account/rekap_hasil', $data);
		} else {
			$data['wrong_msg'] = '';
			$this->load->view('Main/login', $data);
		}
}

// ── LAPORAN STOK BARANG MASUK (AJAX) ────────────────────────────
public function get_laporan_stok_masuk()
{
if ($this->session->userdata("username") != "") {
$date_from = $this->input->post("date_from");
$date_to   = $this->input->post("date_to");
$supplier  = $this->input->post("supplier");

$where_parts = array("particulars = 'Purchase Medicine'", "medicine_name IS NOT NULL AND medicine_name != ''");
$params = array();
$where_sql = "WHERE " . implode(" AND ", $where_parts);

$sql = "SELECT * FROM insert_purchase_info $where_sql ORDER BY date DESC, purchase_id DESC";
$data["results"]   = $this->CommonModel->raw_query($sql, $params);
$data["date_from"] = $date_from;
$data["date_to"]   = $date_to;
$data["supplier"]  = $supplier;
$this->load->view("inventory/ajax_laporan_stok_masuk", $data);
} else {
echo "<div class='alert alert-danger'>Sesi tidak valid.</div>";
}
}

// ── LAPORAN STOK BARANG HABIS (AJAX) ────────────────────────────
public function get_laporan_stok_habis()
{
if ($this->session->userdata("username") != "") {
$threshold = (int)$this->input->post("threshold");
if ($threshold < 0) $threshold = 0;

$sql = "
SELECT
IFNULL(NULLIF(TRIM(p.medicine_presentation),''),'Lainnya') AS medicine_presentation,
IFNULL(NULLIF(TRIM(p.generic_name),''),'Lainnya')          AS generic_name,
p.medicine_name,
p.supplier_name,
p.expiredate,
SUM(p.qty) AS total_masuk,
IFNULL(SUM(s.qty_keluar),0)                                AS total_keluar,
SUM(p.qty) - IFNULL(SUM(s.qty_keluar),0)                  AS sisa_stok
FROM insert_purchase_info p
LEFT JOIN (
SELECT medicine_name_id, SUM(qty) AS qty_keluar
FROM sales_product
GROUP BY medicine_name_id
) s ON s.medicine_name_id = p.medicine_name_id
WHERE p.particulars = 'Purchase Medicine'
  AND p.medicine_name IS NOT NULL AND p.medicine_name != ''
GROUP BY p.medicine_presentation, p.generic_name, p.medicine_name, p.supplier_name, p.expiredate
HAVING sisa_stok <= ?
ORDER BY sisa_stok ASC, p.medicine_name ASC";
$data["results"]   = $this->CommonModel->raw_query($sql, array($threshold));
$data["threshold"] = $threshold;
$this->load->view("inventory/ajax_laporan_stok_habis", $data);
} else {
echo "<div class='alert alert-danger'>Sesi tidak valid.</div>";
}
}

// ── KARTU STOK BARANG (AJAX) ─────────────────────────────────────
public function get_kartu_stok()
{
if ($this->session->userdata("username") != "") {
$medicine_name_id = (int)$this->input->post("medicine_name_id");
echo "<div class='alert alert-info'><i class='fa fa-info-circle'></i> Pilih obat terlebih dahulu.</div>";
return;
}

$sql_masuk = "SELECT date, no_faktur, supplier_name, qty AS jumlah, unit_price, purchase_price, expiredate
  FROM insert_purchase_info
  WHERE medicine_name_id = ? AND particulars = 'Purchase Medicine'
  ORDER BY date ASC, purchase_id ASC";
$masuk = $this->CommonModel->raw_query($sql_masuk, array($medicine_name_id));

$sql_keluar = "SELECT date, invoice, qty AS jumlah, unit_sales_price, total_price
   FROM sales_product
   WHERE medicine_name_id = ?
   ORDER BY date ASC, sales_id ASC";
$keluar = $this->CommonModel->raw_query($sql_keluar, array($medicine_name_id));

$med_info = $this->CommonModel->get_allinfo_byid("create_medicine_name", "medicine_name_id", $medicine_name_id);

$data["masuk"]    = $masuk;
$data["keluar"]   = $keluar;
$this->load->view("inventory/ajax_kartu_stok", $data);
} else {
echo "<div class='alert alert-danger'>Sesi tidak valid.</div>";
}
}

// ── LAPORAN STOK BARANG KELUAR (AJAX) ────────────────────────────
public function get_laporan_stok_keluar()
{
if ($this->session->userdata("username") != "") {
$date_from = $this->input->post("date_from");
$date_to   = $this->input->post("date_to");

$where_parts = array("medicine_name IS NOT NULL AND medicine_name != ''");
$params = array();
$where_sql = "WHERE " . implode(" AND ", $where_parts);

$sql = "SELECT * FROM sales_product $where_sql ORDER BY date DESC, invoice DESC, sales_id ASC";
$data["results"]   = $this->CommonModel->raw_query($sql, $params);
$data["date_from"] = $date_from;
$data["date_to"]   = $date_to;
$this->load->view("sales/ajax_laporan_stok_keluar", $data);
} else {
echo "<div class='alert alert-danger'>Sesi tidak valid.</div>";
}
}

// ── GET REKAP STOK HABIS for rekapan (used by get_rekap_obat) ───
private function _get_rekap_stok_habis($date_from, $date_to)
{
$sql = "
SELECT
IFNULL(NULLIF(TRIM(p.medicine_presentation),''),'Lainnya') AS medicine_presentation,
IFNULL(NULLIF(TRIM(p.generic_name),''),'Lainnya')          AS generic_name,
p.medicine_name,
p.supplier_name,
p.expiredate,
SUM(p.qty) AS total_masuk,
IFNULL(SUM(s.qty_keluar),0)                                AS total_keluar,
SUM(p.qty) - IFNULL(SUM(s.qty_keluar),0)                  AS sisa_stok
FROM insert_purchase_info p
LEFT JOIN (
SELECT medicine_name_id, SUM(qty) AS qty_keluar
FROM sales_product
GROUP BY medicine_name_id
) s ON s.medicine_name_id = p.medicine_name_id
WHERE p.particulars = 'Purchase Medicine'
  AND p.medicine_name IS NOT NULL AND p.medicine_name != ''
GROUP BY p.medicine_presentation, p.generic_name, p.medicine_name, p.supplier_name, p.expiredate
HAVING sisa_stok <= 0
ORDER BY p.medicine_presentation, p.generic_name, p.medicine_name";
return $this->CommonModel->raw_query($sql);
}

} //END
