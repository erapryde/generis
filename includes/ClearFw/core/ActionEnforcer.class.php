<?php
/**
 * ActionEnforcer class
 * TODO ActionEnforcer class documentation.
 * 
 * @author J�r�me Bogaerts <jerome.bogaerts@tudor.lu> <jerome.bogaerts@gmail.com>
 */
class ActionEnforcer implements IExecutable
{
/**
	 * the context to execute
	 * @var Context
	 */
	protected $context;
	
	public function __construct($context)
	{
		$this->context = $context;
	}
	
	public function execute()
	{
		$module = $this->context->getModuleName();
		$action = $this->context->getActionName();
		
		// if module exist include the class
    	if ($module !== null) {
    		
//    		//check if there is a specified context first
//			$isSpecificContext = false;
//    		if(count($this->context->getSpecifiers()) > 0){
//				foreach($this->context->getSpecifiers() as $specifier){
//				
//					$expectedPath = DIR_ACTIONS . $specifier . '/class.' . $module . '.php';
//					
//					//if we find the view in the specialized context, we load it  
//					if (file_exists($expectedPath)){
//						require_once ($expectedPath);
//						$isSpecificContext = true;
//						break;
//					}
//				}
//			}
//			
//			//if there is none, we look at the global context	
//			if(!$isSpecificContext){	
	    		$exptectedPath = DIR_ACTIONS . 'class.'. $module . '.php';
	    		
	    		if (file_exists($exptectedPath)) {
	    			require_once $exptectedPath;
	    		} else {
	    			throw new ActionEnforcingException("Module '" . Camelizer::firstToUpper($module) . "' does not exist in $exptectedPath.",
												   	   $this->context->getModuleName(),
												       $this->context->getActionName());
	    		}
//			}
			
			if(defined('ROOT_PATH')){
				$root = realpath(ROOT_PATH);
			}
			else{
				$root = realpath($_SERVER['DOCUMENT_ROOT']);
			}
			if(preg_match("/^\//", $root) && !preg_match("/\/$/", $root)){
				$root .= '/';
			}
			else if(!preg_match("/\\$/", $root)){
				$root .= '\\';
			}
			
			$relPath = str_replace($root, '', realpath(dirname($exptectedPath)));
			$relPath = str_replace('/', '_', $relPath);
			$relPath = str_replace('\\', '_', $relPath);
			
			$className = $relPath . '_' . $module;
			if(!class_exists($className)){
				throw new ActionEnforcingException("Unable to load  $className in $exptectedPath",
												   	   $this->context->getModuleName(),
												       $this->context->getActionName());
			}
			
    		// File gracefully loaded.
    		$this->context->setModuleName($module);
    		$this->context->setActionName($action);
    		
    		$moduleInstance	= new $className();
    		
    	} else {
    		throw new ActionEnforcingException("No Module file matching requested module.",
											   $this->context->getModuleName(),
											   $this->context->getActionName());
    	}

    	// if the method related to the specified action exists, call it
    	if (method_exists($moduleInstance, $action)) {
    		// search parameters method
    		$reflect	= new ReflectionMethod($className, $action);
    		$parameters	= $reflect->getParameters();

    		$tabParam 	= array();
    		foreach($parameters as $param)
    			$tabParam[$param->getName()] = $this->context->getRequest()->getParameter($param->getName());

    		// Action method is invoked, passing request parameters as
    		// method parameters.
    		common_Logger::d('Invoking '.get_class($moduleInstance).'::'.$action, ARRAY('GENERIS', 'CLEARRFW'));
    		call_user_func_array(array($moduleInstance, $action), $tabParam);
    		
    		// Render the view if selected.
    		if ($view = $moduleInstance->getView())
    		{
    			$renderer = new Renderer();
    			$renderer->render($view);
    		}
    	} 
    	else {
    		throw new ActionEnforcingException("Unable to find the appropriate action for Module '${module}'.",
											   $this->context->getModuleName(),
											   $this->context->getActionName());
    	}
	}
}
?>