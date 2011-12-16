<?php

error_reporting(E_ALL);

/**
 * Generis Object Oriented API -
 *
 * $Id$
 *
 * This file is part of Generis Object Oriented API.
 *
 * Automatically generated on 16.12.2011, 16:56:37 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author Cédric Alfonsi, <cedric.alfonsi@tudor.lu>
 * @package core
 * @subpackage kernel_versioning
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/**
 * include core_kernel_versioning_RepositoryInterface
 *
 * @author Cédric Alfonsi, <cedric.alfonsi@tudor.lu>
 */
require_once('core/kernel/versioning/interface.RepositoryInterface.php');

/* user defined includes */
// section 127-0-1-1--548d6005:132d344931b:-8000:0000000000002501-includes begin
// section 127-0-1-1--548d6005:132d344931b:-8000:0000000000002501-includes end

/* user defined constants */
// section 127-0-1-1--548d6005:132d344931b:-8000:0000000000002501-constants begin
// section 127-0-1-1--548d6005:132d344931b:-8000:0000000000002501-constants end

/**
 * Short description of class core_kernel_versioning_RepositoryProxy
 *
 * @access public
 * @author Cédric Alfonsi, <cedric.alfonsi@tudor.lu>
 * @package core
 * @subpackage kernel_versioning
 */
class core_kernel_versioning_RepositoryProxy
        implements core_kernel_versioning_RepositoryInterface
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---

    /**
     * Short description of attribute instance
     *
     * @access private
     * @var RepositoryProxy
     */
    private static $instance = null;

    // --- OPERATIONS ---

    /**
     * Short description of method checkout
     *
     * @access public
     * @author Cédric Alfonsi, <cedric.alfonsi@tudor.lu>
     * @param  Repository vcs
     * @param  string url
     * @param  string path
     * @param  int revision
     * @return boolean
     */
    public function checkout( core_kernel_versioning_Repository $vcs, $url, $path, $revision = null)
    {
        $returnValue = (bool) false;

        // section 127-0-1-1--548d6005:132d344931b:-8000:0000000000002503 begin
        $delegate = $this->getImplementationToDelegateTo($vcs);
        $returnValue = $delegate->checkout($vcs, $url, $path, $revision);
        // section 127-0-1-1--548d6005:132d344931b:-8000:0000000000002503 end

        return (bool) $returnValue;
    }

    /**
     * Short description of method authenticate
     *
     * @access public
     * @author Cédric Alfonsi, <cedric.alfonsi@tudor.lu>
     * @param  Repository vcs
     * @param  string login
     * @param  string password
     * @return boolean
     */
    public function authenticate( core_kernel_versioning_subversion_Repository $vcs, $login, $password)
    {
        $returnValue = (bool) false;

        // section 127-0-1-1-13a27439:132dd89c261:-8000:00000000000016E6 begin
        $delegate = $this->getImplementationToDelegateTo($vcs);
        $returnValue = $delegate->authenticate($vcs, $login, $password);
        // section 127-0-1-1-13a27439:132dd89c261:-8000:00000000000016E6 end

        return (bool) $returnValue;
    }

    /**
     * Short description of method export
     *
     * @access public
     * @author Cédric Alfonsi, <cedric.alfonsi@tudor.lu>
     * @param  Repository vcs
     * @param  string src
     * @param  string target
     * @param  int revision
     * @return boolean
     */
    public function export( core_kernel_versioning_subversion_Repository $vcs, $src, $target = null, $revision = null)
    {
        $returnValue = (bool) false;

        // section 127-0-1-1--7db71b94:134477a2b9c:-8000:000000000000290C begin
        $delegate = $this->getImplementationToDelegateTo($vcs);
        $returnValue = $delegate->export($vcs, $src, $target, $revision);
        // section 127-0-1-1--7db71b94:134477a2b9c:-8000:000000000000290C end

        return (bool) $returnValue;
    }

    /**
     * Short description of method import
     *
     * @access public
     * @author Cédric Alfonsi, <cedric.alfonsi@tudor.lu>
     * @param  Repository vcs
     * @param  string src
     * @param  string target
     * @return boolean
     */
    public function import( core_kernel_versioning_subversion_Repository $vcs, $src, $target)
    {
        $returnValue = (bool) false;

        // section 127-0-1-1--7db71b94:134477a2b9c:-8000:0000000000002912 begin
        $delegate = $this->getImplementationToDelegateTo($vcs);
        $returnValue = $delegate->import($vcs, $src, $target);
        // section 127-0-1-1--7db71b94:134477a2b9c:-8000:0000000000002912 end

        return (bool) $returnValue;
    }

    /**
     * Short description of method listContent
     *
     * @access public
     * @author Cédric Alfonsi, <cedric.alfonsi@tudor.lu>
     * @param  Repository vcs
     * @param  string path
     * @param  int revision
     * @return array
     */
    public function listContent( core_kernel_versioning_subversion_Repository $vcs, $path, $revision = null)
    {
        $returnValue = array();

        // section 127-0-1-1--7db71b94:134477a2b9c:-8000:0000000000002916 begin
        $delegate = $this->getImplementationToDelegateTo($vcs);
        $returnValue = $delegate->listContent($vcs, $path, $revision);
        // section 127-0-1-1--7db71b94:134477a2b9c:-8000:0000000000002916 end

        return (array) $returnValue;
    }

    /**
     * Short description of method getImplementationToDelegateTo
     *
     * @access public
     * @author Cédric Alfonsi, <cedric.alfonsi@tudor.lu>
     * @param  Resource resource
     * @return core_kernel_versioning_RepositoryInterface
     */
    public function getImplementationToDelegateTo( core_kernel_classes_Resource $resource)
    {
        $returnValue = null;

        // section 127-0-1-1--548d6005:132d344931b:-8000:0000000000002513 begin
    	$type = $resource->getType();
        $implClass = '';
        
        // Function of the repository type, define the implementation to attack

        switch ($type->uriResource)
        {
        	case 'http://www.tao.lu/Ontologies/TAOItem.rdf#VersioningRepositoryTypeSubversion':
        		$implClass = 'core_kernel_versioning_subversion_Repository';
        		break;
        	case 'http://www.tao.lu/Ontologies/TAOItem.rdf#VersioningRepositoryTypeSubversionWindows':
        		$implClass = 'core_kernel_versioning_subversionWindows_Repository';
        		break;
        }

        // If an implementation has been found
        if(!empty($implClass)){
			$reflectionMethod = new ReflectionMethod($implClass, 'singleton');
			$delegate = $reflectionMethod->invoke(null);
			$returnValue = $delegate;
        }
        // section 127-0-1-1--548d6005:132d344931b:-8000:0000000000002513 end

        return $returnValue;
    }

    /**
     * Short description of method singleton
     *
     * @access public
     * @author Cédric Alfonsi, <cedric.alfonsi@tudor.lu>
     * @return core_kernel_versioning_RepositoryProxy
     */
    public static function singleton()
    {
        $returnValue = null;

        // section 127-0-1-1--548d6005:132d344931b:-8000:0000000000002517 begin
		if(is_null(self::$instance)){
			self::$instance = new core_kernel_versioning_RepositoryProxy();
		}
		$returnValue = self::$instance;
        // section 127-0-1-1--548d6005:132d344931b:-8000:0000000000002517 end

        return $returnValue;
    }

} /* end of class core_kernel_versioning_RepositoryProxy */

?>