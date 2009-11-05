<?php 
class ModelPaymentPSIGate extends Model {
  	public function getMethod($country_id, $zone_id) {
		$this->load->language('payment/psigate');
		
		if ($this->config->get('psigate_status')) {
      		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('psigate_geo_zone_id') . "' AND country_id = '" . (int)$country_id . "' AND (zone_id = '" . (int)$zone_id . "' OR zone_id = '0')");
			
			if (!$this->config->get('psigate_geo_zone_id')) {
        		$status = TRUE;
      		} elseif ($query->num_rows) {
      		  	$status = TRUE;
      		} else {
     	  		$status = FALSE;
			}	
      	} else {
			$status = FALSE;
		}
		
		$method_data = array();
	
		if ($status) {  
      		$method_data = array( 
        		'id'         => 'psigate',
        		'title'      => $this->language->get('text_title'),
				'sort_order' => $this->config->get('psigate_sort_order')
      		);
    	}
   
    	return $method_data;
  	}
}
?>