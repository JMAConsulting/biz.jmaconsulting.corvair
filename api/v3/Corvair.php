<?php

/**
 * This api holds Corvair functions responsible for various functionality.
 *
 * @package CiviCRM_APIv3
 */

/**
 * Job to generate membership ID custom field for all memberships
 *
 * @param array $params
 *
 * @return array
 *   API result array
 */
function civicrm_api3_corvair_generateMembershipId($params) {
  $onlyMissing = CRM_Utils_Array::value('onlyMissing', $params, 1);
  
  $tablename = civicrm_api3('CustomGroup', 'getvalue', array(
    'name' => 'Membership_Info',
    'return' => 'table_name',
  ));
  $columnName = civicrm_api3('CustomField', 'getvalue', array(
    'name' => 'Member_ID',
    'return' => 'column_name',
  ));

  if ($onlyMissing) {
    CRM_Core_DAO::executeQuery("UPDATE {$tablename} SET {$columnName} = entity_id WHERE {$columnName} = 0");
    CRM_Core_DAO::executeQuery("UPDATE {$tablename} SET {$columnName} = entity_id WHERE {$columnName} IS NULL");
  }
  else {
    CRM_Core_DAO::executeQuery("UPDATE {$tablename} SET {$columnName} = entity_id WHERE {$columnName} <> entity_id");
  }
}