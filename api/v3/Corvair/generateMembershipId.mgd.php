<?php
// This file declares a managed database record of type "Job".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// http://wiki.civicrm.org/confluence/display/CRMDOC42/Hook+Reference
return array (
  0 => 
  array (
    'name' => 'Generate Missing membership IDs',
    'entity' => 'Job',
    'params' => 
    array (
      'version' => 3,
      'name' => 'Generate Missing membership IDs',
      'description' => 'This scheduled job adds membership IDs to membership custom field',
      'run_frequency' => 'Daily',
      'api_entity' => 'Corvair',
      'api_action' => 'generateMembershipId',
      'parameters' => 'onlyMissing=1',
    ),
  ),
);