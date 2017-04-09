<?php

namespace FlSouto;

class HtForm implements \IteratorAggregate{

	protected $fields = [];
	protected $inline = false;
	protected $readonly = false;
	protected $context = [];
	protected $attrs = [];

	function __construct(){
		$this->attrs = new HtAttrs;
		$this->attrs['id'] = uniqid();
	}

	function attrs(array $attrs){
		$this->attrs->merge($attrs);
		return $this;
	}

	function method($method){
		$this->attrs(['method'=>$method]);
		return $this;
	}

	function action($action){
		$this->attrs(['action'=>$action]);
		return $this;
	}

	function context($context){
		$this->context = $context;
		return $this;
	}

	function inline($bool=true){
		$this->inline = $bool;
		return $this;
	}

	function readonly($bool=true){
		$this->readonly = $bool;
		return $this;
	}

	function getIterator(){
		return new \ArrayObject($this->fields);
	}

	function value($field){
		if(!isset($this->fields[$field])){
			throw new \Exception("No field named '$field' has been defined.");
		}
		return $this->fields[$field]->value();
	}

	function process(){
		$formResult = new HtFormResult;
		foreach($this->fields as $name => $field){
			if(substr($name,0,1)=='_'){
				continue;
			}
			$result = $field->process();
			$formResult->data[$name] = $result->output;
			if($result->error){
				$formResult->errors[$name] = $result->error;
				if($field instanceof HtWidget){
					$field->error(true);
				}
			}
		}
		return $formResult;
	}

	protected function render(){
		echo "<form ".$this->attrs.">";
		foreach($this->fields as $field){
			echo $field;
		}
		echo "</form>";
	}

	function __toString(){
		ob_start();
		try{
			$this->render();
		} catch(\Exception $e) {
			echo $e->getMessage();
		}
		return ob_get_clean();
	}

	protected function addField($name, $class, array $args = []){
		if(isset($this->fields[$name])){
			return $this->fields[$name];
		}
		$fqn_class = "FlSouto\\$class";
		if(!class_exists($fqn_class)){
			throw new \Exception("Class not found: $fqn_class. Run 'composer require ".strtolower($fqn_class)."' in the terminal if you wish to install it.");
		}
		array_unshift($args, $name);
		$refl = new \ReflectionClass($fqn_class);
		$field = $refl->newInstanceArgs($args);
		
		if($field instanceof HtWidget){
			$field->readonly($this->readonly);
			$field->inline($this->inline);
		} else if($field instanceof HtButton) {
			$field->inline($this->inline);
		}
		$field->context($this->context);
		$this->fields[$name] = $field;
		return $field;
	
	}

	function add(HtField $field){
		$this->fields[$field->name()] = $field;
		return $this;
	}

	/** 
	 * @return HtHidden
	*/
	function hidden($name, $value=1){
		return $this->addField($name, 'HtHidden', [$value]);
	}

	/** 
	 * @return HtButton
	*/
	function button($name, $label=null){
		return $this->addField($name, 'HtButton', [$label]);
	}

	/** 
	 * @return HtTextin
	*/
	function textin($name){
		return $this->addField($name, 'HtTextin');
	}

	/** 
	 * @return HtTextar
	*/
	function textar($name){
		return $this->addField($name, 'HtTextar');
	}

	/** 
	 * @return HtCheckb
	*/
	function checkb($name, $label=null){
		return $this->addField($name, 'HtCheckb',[$label]);
	}

	/** 
	 * @return HtSelect
	*/
	function select($name){
		return $this->addField($name, 'HtSelect');
	}

	/** 
	 * @return HtRadios
	*/
	function radios($name){
		return $this->addField($name, 'HtRadios');
	}

	/** 
	 * @return HtCklist
	*/
	function cklist($name){
		return $this->addField($name, 'HtCklist');
	}

}


class HtFormResult{

	var $data = [];
	var $errors = [];

	function unfold(){}

}