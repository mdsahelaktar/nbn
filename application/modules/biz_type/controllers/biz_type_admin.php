<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Biz Type Admin Class
 *
 * @package		CodeIgniter
 * @subpackage	Modules
 * @section		Controllers
 * @category	Biz Type
 * @author		Webzstore Solutions
 */
class Biz_type_admin extends MX_Controller {

    /**
     * 	Autoload varible.
     * 	Loads other accessories required for this model.
     */
    public $autoload = array(
        'language' => array(
            'biz_type'
        ),
        'config' => array(
            'biz_type_configure',
            'biz_type_validation',
            'pagination'
        ),
        'libraries' => array(
            'form_validation',
            'pagination'
        ),
        'helpers' => array(
            'form'
        )
    );

    /**
     * 	Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('biz_type_model', 'btype');
    }

    /**
     * getBizTypes
     *
     * This function return biz types
     *
     * @param	empty
     * @return	array	records
     */
    function getBizTypes() {
        $array = array();

        ## Load config and store
        $CFG = $this->config->item('biz_type_configure');

        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
        $groupby = $CFG['d_id'];
        $group_select[] = $CFG['groupby_select'];
        $biztypes = array();
        $records = $this->btype->getRecords($where, '', '', '', $groupby, $group_select);
        foreach ($records as $record) {
            $tbiz_type_ids = explode('[@]', $record->ai_biz_type_ids);
            $tbiz_types = explode('[@]', $record->biz_types);
            $array = array();
            foreach ($tbiz_type_ids as $key => $id)
                $array[$id] = $tbiz_types[$key];
            $biztypes[$record->domain] = $array;
        }
        return $biztypes;
    }

    /**
     * getBizDomain
     *
     * This function return biz domain
     *
     * @param	empty
     * @return	array	records
     */
    function getBizDomain() {
        $array = array();                
        ## Load config and store
        $CFG = $this->config->item('biz_type_configure');

        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['is_trashed'], 0);
        $groupby = $CFG['d_id'];
        $records = $this->btype->getRecords($where, '', '', '', $groupby, '');
        foreach ($records as $record) {
            $array[$record->domain_id] = $record->domain;
        }
        return $array;
    }

    /**
     * getBizTypeByTypeId
     *
     * This function called for get biz type name by type id
     *
     * @param	type_id
     * @return	type_name
     */
    function getBizTypeByTypeId($type_id) {
        $array = array();

        ## Load config and store
        $CFG = $this->config->item('biz_type_configure');

        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['edit_id'], $type_id);
        $records = $this->btype->getRecords($where, '', '', '', '', '');
        $type_name = $records[0]->biz_type;
        return $type_name;
    }

    /**
     * getBizDomainByTypeId
     *
     * This function called for get biz domain id by type id
     *
     * @param	type_id
     * @return	domain_id
     */
    function getBizDomainByTypeId($type_id) {
        $array = array();

        ## Load config and store
        $CFG = $this->config->item('biz_type_configure');

        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['edit_id'], $type_id);
        $records = $this->btype->getRecords($where, '', '', '', '', '');
        $domain_id = $records[0]->domain_id;
        return $domain_id;
    }

    /**
     * getBizTypesByDomain
     *
     * This function called for get biz type during select drop down
     *
     * @param	biz_domain
     * @return	array
     */
    function getBizTypesByDomain($biz_domain) {
        $array = array();

        ## Load config and store
        $CFG = $this->config->item('biz_type_configure');

        $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['domain'], $biz_domain);
        $records = $this->btype->getRecords($where, '', '', '', '', '');
        foreach ($records as $record) {
            $array[$record->ai_biz_type_id] = $record->biz_type;
        }
        return $array;
    }

    /**
     * json
     *
     * This function called during ajax only
     *
     * @param	empty
     * @return	json	records
     */
    function json() {
        if (isAjax()) {
            ## Load config and store
            $CFG = $this->config->item('biz_type_configure');

            $method = $this->input->post('method');
            switch ($method) {
                case 'gettype' :
                    $where[] = array($CFG['table_name'] . '.' . $CFG['possible_where']['domain'], $this->input->post('domain_id'));
                    $type = array();
                    $records = $this->btype->getRecords($where, '', '', '', '', '');
                    foreach ($records as $record)
                        $type[$record->ai_biz_type_id] = $record->biz_type;
                    echo json_encode($type);
                    break;
            }
        }
    }

}

// END Biz Type Admin Class

/* End of file biz_type_admin.php */
/* Location: ./application/modules/biz_type/controllers/biz_type_admin.php */