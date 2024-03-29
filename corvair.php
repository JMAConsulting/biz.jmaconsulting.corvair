<?php

require_once 'corvair.civix.php';

/**
 * Implementation of hook_civicrm_config
 */
function corvair_civicrm_config(&$config) {
  _corvair_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 */
function corvair_civicrm_xmlMenu(&$files) {
  _corvair_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 */
function corvair_civicrm_install() {
  return _corvair_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 */
function corvair_civicrm_uninstall() {
  return _corvair_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 */
function corvair_civicrm_enable() {
  return _corvair_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 */
function corvair_civicrm_disable() {
  return _corvair_civix_civicrm_disable();
}

function corvair_civicrm_buildForm( $formName, &$form ) {
  if ($formName == 'CRM_Contribute_Form_Contribution_Main' && ($form->getVar('_id') == 1 || $form->getVar('_id') == 8)) {
    CRM_Core_Region::instance('page-body')->add(array(
        'template' => 'CRM/Price/Form/CorvairContribute.tpl',
      ));
  }
}

function getMemberID() {
  $memberID = CRM_Core_DAO::singleValueQuery("select max(member_id_1) from civicrm_value_membership_info_1");
  $memberID = $memberID + 1;
  return $memberID;
}

function corvair_civicrm_post( $op, $objectName, $objectId, &$objectRef ) {
  if ($objectName == "Membership" && $op == "create") {
    $memberID = getMemberID();
    civicrm_api3('CustomValue', 'create', array('entity_id' => $objectId, 'custom_1' => $memberID));
  }
}

function corvair_civicrm_postSave_civicrm_membership($dao) {
  $memberID = getMemberID();
  civicrm_api3('CustomValue', 'create', array('entity_id' => $dao->id, 'custom_1' => $memberID));
}

function corvair_civicrm_postProcess($formName, &$form) {
  if (($formName == "CRM_Member_Form_Membership") && ($form->_action & CRM_Core_Action::ADD) && !empty($form->_id)) {
    $memberID = getMemberID();
    civicrm_api3('CustomValue', 'create', array('entity_id' => $form->_id, 'custom_1' => $memberID));
  }
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 */
function corvair_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _corvair_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 */
function corvair_civicrm_managed(&$entities) {
  return _corvair_civix_civicrm_managed($entities);
}
