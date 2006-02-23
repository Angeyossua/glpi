<?php
/*
 * @version $Id$
 ----------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2006 by the INDEPNET Development Team.
 
 http://indepnet.net/   http://glpi.indepnet.org
 ----------------------------------------------------------------------

 LICENSE

	This file is part of GLPI.

    GLPI is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    GLPI is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with GLPI; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 ------------------------------------------------------------------------
*/

// ----------------------------------------------------------------------
// Original Author of file: Julien Dombre
// Purpose of file:
// ----------------------------------------------------------------------

include ("_relpos.php");
// CLASSES State_Item

class StateItem{
	var $fields	= array();
	var $updates	= array();
	var $state = array();
	var $obj = NULL;	

	function getfromDB ($device_type,$id_device,$template=0) {
		
		$this->fields["state"]=-1;
		// Make new database object and fill variables
		$db = new DB;
		$query = "SELECT * FROM glpi_state_item WHERE (device_type='$device_type' AND id_device = '$id_device' AND is_template='$template' )";

		if ($result = $db->query($query)) 
		if ($db->numrows($result)>0){
			$data = $db->fetch_array($result);
			foreach ($data as $key => $val) {
				$this->fields[$key] = $val;
			}
		if (!isset($this->fields["device_type"]))			
		return false;
			switch ($this->fields["device_type"]){
			case COMPUTER_TYPE :
				$this->obj=new Computer;
				break;
			case NETWORKING_TYPE :
				$this->obj=new Netdevice;
				break;
			case PRINTER_TYPE :
				$this->obj=new Printer;
				break;
			case PHONE_TYPE : 
				$this->obj= new Phone;	
				break;				
			case MONITOR_TYPE : 
				$this->obj= new Monitor;	
				break;
			case PERIPHERAL_TYPE : 
				$this->obj= new Peripheral;	
				break;				
			}
			
			if ($this->obj!=NULL)
			return $this->obj->getfromDB($this->fields["id_device"]);
			else return false;
			
		} else {
			return false;
		}
	}
	function getType (){
		global $lang;
		
		switch ($this->fields["device_type"]){
			case COMPUTER_TYPE :
				return $lang["computers"][44];
				break;
			case NETWORKING_TYPE :
				return $lang["networking"][12];
				break;
			case PRINTER_TYPE :
				return $lang["printers"][4];
				break;
			case MONITOR_TYPE : 
				return $lang["monitors"][4];
				break;
			case PERIPHERAL_TYPE : 
				return $lang["peripherals"][4];
				break;				
			case PHONE_TYPE : 
				return $lang["phones"][4];
				break;				
			}
	
	}
	
	function getItemType (){
		global $lang;
		
		switch ($this->fields["device_type"]){
			case COMPUTER_TYPE :
				return getDropdownName("glpi_type_computers",$this->obj->fields["type"]);
				break;
			case NETWORKING_TYPE :
				return getDropdownName("glpi_type_networking",$this->obj->fields["type"]);
				break;
			case PRINTER_TYPE :
				return getDropdownName("glpi_type_printers",$this->obj->fields["type"]);
				break;
			case MONITOR_TYPE : 
				return getDropdownName("glpi_type_monitors",$this->obj->fields["type"]);
				break;
			case PERIPHERAL_TYPE : 
				return getDropdownName("glpi_type_peripherals",$this->obj->fields["type"]);
				break;				
			case PHONE_TYPE : 
				return getDropdownName("glpi_type_phones",$this->obj->fields["type"]);
				break;				
			}
	
	}
	
	function getName(){
		if (isset($this->obj->fields["name"])&&$this->obj->fields["name"]!="")
	return $this->obj->fields["name"];
	else return "N/A";
	}
	
	function getLink(){
	
		global $cfg_install,$cfg_layout,$INFOFORM_PAGES;
		
		$show=$this->getName();
		// show id if it was configure else nothing
		if ($cfg_layout["view_ID"]||empty($show)) $show.=" (".$this->fields["id_device"].")";


		return "<a href=\"".$cfg_install["root"]."/".$INFOFORM_PAGES[$this->fields["device_type"]]."?ID=".$this->fields["id_device"]."\">$show</a>";
	}
	
	
	function getEmpty () {
		//make an empty database object
		$db = new DB;
		$fields = $db->list_fields("glpi_state_item");
		$columns = $db->num_fields($fields);
		for ($i = 0; $i < $columns; $i++) {
			$name = $db->field_name($fields, $i);
			$this->fields[$name] = "";
		}
	}

	function updateInDB($updates)  {

		$db = new DB;

		for ($i=0; $i < count($updates); $i++) {
			$query  = "UPDATE glpi_state_item SET ";
			$query .= $updates[$i];
			$query .= "='";
			$query .= $this->fields[$updates[$i]];
			$query .= "' WHERE ID='";
			$query .= $this->fields["ID"];	
			$query .= "'";
			$result=$db->query($query);
		}
		
	}
	
	function addToDB() {
		
		$db = new DB;

		// Build query
		$query = "INSERT INTO glpi_state_item (";
		$i=0;
		foreach ($this->fields as $key => $val) {
			$fields[$i] = $key;
			$values[$i] = $val;
			$i++;
		}		
		for ($i=0; $i < count($fields); $i++) {
			$query .= $fields[$i];
			if ($i!=count($fields)-1) {
				$query .= ",";
			}
		}
		$query .= ") VALUES (";
		for ($i=0; $i < count($values); $i++) {
			$query .= "'".$values[$i]."'";
			if ($i!=count($values)-1) {
				$query .= ",";
			}
		}
		$query .= ")";

		$result=$db->query($query);
		return $db->insert_id();
	}

	function deleteFromDB($ID) {

		$db = new DB;

		$query = "DELETE from glpi_state_item WHERE ID = '$ID'";
		if ($result = $db->query($query)) {
			return true;
		} else {
			return false;
		}
	}
	
}


?>