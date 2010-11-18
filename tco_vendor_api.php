<?php
/******************************************************************
<<<<<<< HEAD:tco_vendor_api.php
 * 					File: TCO_Vendor_API  Copyright 2010 - Rik Davis
 * 			 Version: 1.0b
 * 				Author: Rik Davis
 * 			 License: GNU GPL
=======
 * File: TCO_Vendor_API  Copyright 2010 - Rik Davis
 * Version: 1.0b
 * Author: Rik Davis
 * License: GNU GPL
>>>>>>> 2Checkout Vendor API PHP Class:tco_vendor_api.php
 * License Terms: This file has been released & distrubted under
 *                the terms of the GNU General Public License.
<<<<<<< HEAD:tco_vendor_api.php
 *								Please include this information when copying &
 *								redistrubuting.
=======
 *                Please include this information when copying &
 *                redistrubuting.
>>>>>>> 2Checkout Vendor API PHP Class:tco_vendor_api.php
 ******************************************************************/

class TCO_Vendor_API {
	# PUBLIC PROPERTIES
	public $api_base_url = "https://www.2checkout.com/api/";

	# PRIVATE PROPERTIES
	private $user;
	private $pass;
	private $format = 'xml';
	private $accept = 'application';

	/*!
	* @function Class constructor that optionally allows for
	* setting username & password during instantiation.
	* @param string $user
	* @param string $pass
	* @access public
	*/
	function __construct($user='', $pass='') {
		# trigger a fatal error if curl is not available
		if(!function_exists('curl_init')) {
			trigger_error('You must have curl enabled in your PHP installation to use this class.', E_ERROR);
		}

		if(!function_exists('json_encode')) {
			trigger_error('You must have JSON support enabled in your PHP installation to use this class.', E_ERROR);
		}

		$this->set_credentials($user, $pass);
	}

	/*!
	* @function set_credentials
	* @param string $user sets the class' user property
	* @param string $pass sets the class' passw property
	* @access public
	*/
	function set_credentials($user, $pass) {
		$this->user = $user;
		$this->pass = $pass;
	}

	/*!
	* @function set_format
	* @param string $type Sets the class' format property that return values should be displayed in
	* @access public
	*/
	function set_format($type) {
		if(preg_match('/(xml|json|html)/', $type)) {
			if($type == 'html') {
				$this->accept = 'text';
			} else {
				$this->accept = 'application';
			}
			$this->format = $type;
		} else {
			return $this->return_resp(array('Error' => 'Format must only be xml, json or html. (defaults to xml)'));
		}
	}

	# BEGIN API CALLS

	# ACCOUNT RELATED CALLS
	/**
	* @detail_company_info
	* @param None
	* @access public
	*/
	function detail_company_info() {
		$url_suffix = 'acct/detail_company_info';
		return $this->do_call($url_suffix);
	}

	/**
	* detail_contact_info
	* @param None
	* @access public
	*/
	function detail_contact_info() {
		$url_suffix = 'acct/detail_contact_info';
		return $this->do_call($url_suffix);
	}

	/**
	* list_payments
	* @param None
	* @access public
	*/
	function list_payments() {
		$url_suffix ='acct/list_payments';
		return $this->do_call($url_suffix, $args);
	}

	/**
	* detail_pending_payment
	* @param None
	* @access public
	*/
	function detail_pending_payment() {
		$url_suffix ='acct/detail_pending_payment';
		return $this->do_call($url_suffix, $args);
	}

	# SALES RELATED CALLS

	/**
	* detail_contact_info
	* @param Array $args
	* @access public
	*/
	function list_sales($args) {
		$url_suffix ='sales/list_sales';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function detail_sale($args) {
		$url_suffix ='sales/detail_sale';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function mark_shipped($args) {
		$url_suffix ='sales/mark_shipped';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function reauth($args) {
		$url_suffix ='sales/reauth';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function refund_invoice($args) {
		$url_suffix ='sales/refund_invoice';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function refund_lineitem($args) {
		$url_suffix ='sales/refund_lineitem';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function stop_lineitem_recurring($args) {
		$url_suffix ='sales/stop_lineitem_recurring';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function update_lineitem_recurring($args) {
		$url_suffix ='sales/update_lineitem_recurring';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	/**
	* @function create_comment
	* @param array $args  'sale_id'      (required) => 1234567890,
	*                     'sale_comment' (required) => 'Test sale comment',
	*                     'cc_vendor'    (optional) => 0 (default),
	*                     'cc_customer'  (optional) => 0 (default)
	* @access public
	*/
	function create_comment($args) {
		$url_suffix ='sales/create_comment';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	# PRODUCT RELATED CALLS

	function create_coupon($args) {
		$url_suffix ='products/create_coupon';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function update_coupon($args) {
		$url_suffix ='products/update_coupon';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function list_coupons($args) {
		$url_suffix ='products/list_coupons';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function detail_coupon($args) {
		$url_suffix ='products/detail_coupon';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function delete_coupon($args) {
		$url_suffix ='products/delete_coupon';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function create_option($args) {
		$url_suffix ='products/create_option';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function update_option($args) {
		$url_suffix ='products/update_option';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function list_options($args) {
		$url_suffix ='products/list_options';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function detail_option($args) {
		$url_suffix ='products/detail_option';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function delete_option($args) {
		$url_suffix ='products/delete_option';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function create_product($args) {
		$url_suffix ='products/create_product';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function update_product($args) {
		$url_suffix ='products/update_product';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function list_products($args) {
		$url_suffix ='products/list_products';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function detail_product($args) {
		$url_suffix ='products/detail_product';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}

	function delete_product($args) {
		$url_suffix ='products/delete_product';
		if(!is_array($args)) {
			return $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			return $this->do_call($url_suffix, $args);
		}
	}
	# END API CALLS

	# PRIVATE METHODS

	/*!
	* @function do_call
	* @param array $contents An array where keys are nodes and values are the node data
	* @access private
	*/
	private function do_call($url_suffix, $data=array()) {
		if(!is_array($data)) {
			$resp = $this->return_resp(array('Error' => 'Value passed in was not an array of at least one key/value pair.'));
		} else {
			$url = $this->api_base_url . $url_suffix;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: {$this->accept}/{$this->format}"));
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, "{$this->user}:{$this->pass}");
			if(count($data) > 0) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			}
			$resp = curl_exec($ch);
			curl_close($ch);
		}
		return $this->return_resp($resp);
	}

	/*!
	* @function return_resp
	* @param array $contents An array where keys are nodes and values are the node data
	* @access private
	*/
	private function return_resp($contents) {
		switch($this->format) {
			case 'xml':
				if(preg_match('/<response>/', $contents)) {
					return $contents;
				} else {
					$xml = new XmlConstruct('response');
					$xml->fromArray($contents);
					return $xml->getDocument();
					return $xml->output();
				}
			break;
			case 'json':
				if(preg_match('/response :/', $contents)) {
					return $contents;
				} else {
					$jsonData = json_encode($contents);
					return json_decode($jsonData);
				}
			break;
			case 'html':
				if(preg_match('/\<dt\>response_code\<\/dt\>/', $contents)) {
					return $contents;
				} else {
					$htmlOut = '';
					foreach($contents as $key => $val) {
						$htmlOut .= "<ul>$key<li>$val</li></ul>\n";
					}
					return $htmlOut;
				}
			break;
		}
	}
}

/**
 * XMLParser Class
 *
 * This class loads an XML document into a SimpleXMLElement that can
 * be processed by the calling application.  This accepts xml strings,
 * files, and DOM objects.  It can also perform the reverse, converting
 * an SimpleXMLElement back into a string, file, or DOM object.
 *
 * I am not sure who the original author of this class is as it was
 * never documented. Henceforth, I am reliquishing ownership of this
 * class.
 */
class XmlConstruct extends XMLWriter
{
	private $formal = false;
	/**
	* Constructor.
	* @param string $prm_rootElementName A root element's name of a current xml document
	* @param string $prm_xsltFilePath Path of a XSLT file.
	* @access public
	* @param null
	*/
	public function __construct($prm_rootElementName, $formal=false, $prm_xsltFilePath='') {
		$this->formal = $formal;
		$this->openMemory();
		$this->setIndent(true);
		$this->setIndentString(' ');
		if($this->formal) {
		        $this->startDocument('1.0', 'UTF-8');
		}

	        if($prm_xsltFilePath) {
			$this->writePi('xml-stylesheet', 'type="text/xsl" href="'.$prm_xsltFilePath.'"');
		}

		$this->startElement($prm_rootElementName);
	}

	/**
	* Set an element with a text to a current xml document.
	* @access public
	* @param string $prm_elementName An element's name
	* @param string $prm_ElementText An element's text
	* @return null
	*/
	public function setElement($prm_elementName, $prm_ElementText) {
		$this->startElement($prm_elementName);
		$this->text($prm_ElementText);
		$this->endElement();
	}

	/**
	* Construct elements and texts from an array.
	* The array should contain an attribute's name in index part
	* and a attribute's text in value part.
	* @access public
	* @param array $prm_array Contains attributes and texts
	* @return null
	*/
	public function fromArray($prm_array) {
		if(is_array($prm_array)) {
			foreach ($prm_array as $index => $element) {
				if(is_array($element)) {
					$this->startElement($index);
					$this->fromArray($element);
					$this->endElement();
				}
				else
					$this->setElement($index, $element);
			}
		}
	}

	/**
	* Return the content of a current xml document.
	* @access public
	* @param null
	* @return string Xml document
	*/
	public function getDocument() {
		$this->endElement();
		if($this->formal) {
		        $this->endDocument();
		}
		return $this->outputMemory();
	}

	/**
	* Output the content of a current xml document.
	* @access public
	* @param null
	*/
	public function output() {
		#header('Content-type: text/xml');
		return $this->getDocument();
	}
}
?>
