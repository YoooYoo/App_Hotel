<?php

class currconverter {
		public $ci = NULL; //codeigniter instance

		public $symbol;
		public $code;
		public $name;
		public $country;
		public $rate;
		public $mulcur;

		function __construct(){
				$this->ci = & get_instance();
				$this->mulcur = $this->ci->settings_model->multiCurrencyStatus();
				$defaultcurr = $this->ci->settings_model->getDefaultCurrency();
				$currencycode = $this->ci->session->userdata('currencycode');
				if(!$this->mulcur || empty($currencycode)){
						$this->code = $defaultcurr['code'];
						$this->symbol = $defaultcurr['symbol'];
						$this->name = $defaultcurr['name'];
						$this->rate = $defaultcurr['rate'];
			        	}else{

                        $this->code = $this->ci->session->userdata('currencycode');
						$this->symbol = $this->ci->session->userdata('currencysymbol');
						$this->name = $this->ci->session->userdata('currencyname');
						$this->rate = $this->ci->session->userdata('currencyrate');

			        	}
		}

		function convertPrice($amount,$round = 2){

                $price = $this->rate * $amount;
				return number_format($price,$round);
		}

        function convertPriceFloat($amount){
             $fprice = (float)str_replace(",","",$amount);
             return $this->rate * $fprice;
        }

        function getCurrencies(){
            $this->ci->db->where('is_active','Yes');
            return $this->ci->db->get('pt_currencies')->result();

        }

}