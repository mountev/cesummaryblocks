<?php
use CRM_Cesummaryblocks_ExtensionUtil as E;

const REL_TYPE_COAUTHOR = 24;
const REL_TYPE_PUBLISHED_IN = 25;

/**
 * CovidEconomics.Getpaperblock API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_covid_economics_Getpaperblock_spec(&$spec) {
  $spec['contact_id']['api.required'] = 1;
}

/**
 * CovidEconomics.Getpaperblock API
 *
 * @param array $params
 *
 * @return array
 *   API result descriptor
 *
 * @throws \CiviCRM_API3_Exception|\CRM_Core_Exception
 * @see civicrm_api3_create_success
 */
function civicrm_api3_covid_economics_Getpaperblock(array $params) {
  $sql = "
    SELECT DISTINCT civicrm_contact.id AS id, civicrm_contact.display_name AS civicrm_contact_display_name,
      civicrm_contact.modified_date AS civicrm_contact_modified_date,
      civicrm_value_submission_de_35.abstract_188 AS civicrm_value_submission_de_35_abstract_188,
      civicrm_value_submission_de_35.additional_comments_189 AS civicrm_value_submission_de_35_additional_comments_189,
      civicrm_contact_civicrm_relationship.display_name AS civicrm_contact_civicrm_relationship_display_name,
      civicrm_contact_civicrm_relationship.id AS civicrm_contact_civicrm_relationship_id,
      civicrm_relationship_civicrm_contact.relationship_type_id AS civicrm_relationship_civicrm_contact_relationship_type_id,
      civicrm_contact_civicrm_relationship.employer_id AS civicrm_contact_civicrm_relationship_employer_id,
      civicrm_contact_civicrm_relationship_1.display_name AS civicrm_contact_civicrm_relationship_1_display_name,
      civicrm_contact_civicrm_relationship_1.id AS civicrm_contact_civicrm_relationship_1_id,
      civicrm_contact_civicrm_relationship_1c.id AS civicrm_contact_civicrm_relationship_1c_id,
      civicrm_case_civicrm_relationship__civicrm_value_cep_paper_sub_36.paper_191 AS civicrm_case_civicrm_relationship__civicrm_value_cep_paper_s,
      civicrm_case_civicrm_relationship__civicrm_value_cep_paper_sub_36.entity_id AS civicrm_case_civicrm_relationship__civicrm_value_cep_paper_s_1,
      GROUP_CONCAT(DISTINCT civicrm_contact_civicrm_relationship_2.display_name SEPARATOR '<br/> ') AS civicrm_contact_civicrm_relationship_2_display_name,
      GROUP_CONCAT(DISTINCT civicrm_contact_civicrm_relationship_3.display_name SEPARATOR '<br/> ') AS civicrm_contact_civicrm_relationship_3_display_name,
      GROUP_CONCAT(DISTINCT civicrm_contact_civicrm_relationship_1c.display_name SEPARATOR ', ') AS civicrm_contact_civicrm_relationship_1c_display_name,
      civicrm_contact_civicrm_relationship_2.id AS civicrm_contact_civicrm_relationship_2_id,
      civicrm_relationship_civicrm_contact__civicrm_case.id AS civicrm_relationship_civicrm_contact__civicrm_case_id
    FROM
      civicrm_contact civicrm_contact
    LEFT JOIN civicrm_relationship civicrm_relationship_civicrm_contact ON civicrm_contact.id = civicrm_relationship_civicrm_contact.contact_id_a
              AND (civicrm_relationship_civicrm_contact.relationship_type_id = '21' AND civicrm_relationship_civicrm_contact.is_active = '1')
    LEFT JOIN civicrm_contact civicrm_contact_civicrm_relationship ON civicrm_relationship_civicrm_contact.contact_id_b = civicrm_contact_civicrm_relationship.id
    LEFT JOIN civicrm_relationship civicrm_relationship_civicrm_contact_1 ON civicrm_contact.id = civicrm_relationship_civicrm_contact_1.contact_id_a
              AND (civicrm_relationship_civicrm_contact_1.relationship_type_id = '23' AND civicrm_relationship_civicrm_contact_1.is_active = '1')
    LEFT JOIN civicrm_contact civicrm_contact_civicrm_relationship_1 ON civicrm_relationship_civicrm_contact_1.contact_id_b = civicrm_contact_civicrm_relationship_1.id
    LEFT JOIN civicrm_relationship civicrm_relationship_civicrm_contact_1c ON civicrm_contact_civicrm_relationship_1.id = civicrm_relationship_civicrm_contact_1c.contact_id_a
              AND (civicrm_relationship_civicrm_contact_1c.relationship_type_id = '15' AND civicrm_relationship_civicrm_contact_1c.is_active = '1')
    LEFT JOIN civicrm_contact civicrm_contact_civicrm_relationship_1c ON civicrm_relationship_civicrm_contact_1c.contact_id_b = civicrm_contact_civicrm_relationship_1c.id
    LEFT JOIN civicrm_case civicrm_case_civicrm_relationship ON civicrm_relationship_civicrm_contact_1.case_id = civicrm_case_civicrm_relationship.id
    LEFT JOIN civicrm_relationship civicrm_relationship_civicrm_contact_2 ON civicrm_contact.id = civicrm_relationship_civicrm_contact_2.contact_id_a
              AND (civicrm_relationship_civicrm_contact_2.relationship_type_id = '24' AND civicrm_relationship_civicrm_contact_2.is_active = '1')
    LEFT JOIN civicrm_contact civicrm_contact_civicrm_relationship_2 ON civicrm_relationship_civicrm_contact_2.contact_id_b = civicrm_contact_civicrm_relationship_2.id
    LEFT JOIN civicrm_relationship civicrm_relationship_civicrm_contact_3 ON civicrm_contact.id = civicrm_relationship_civicrm_contact_3.contact_id_a
              AND (civicrm_relationship_civicrm_contact_3.relationship_type_id = '25' AND civicrm_relationship_civicrm_contact_3.is_active = '1')
    LEFT JOIN civicrm_contact civicrm_contact_civicrm_relationship_3 ON civicrm_relationship_civicrm_contact_3.contact_id_b = civicrm_contact_civicrm_relationship_3.id
    LEFT JOIN civicrm_value_cep_paper_sub_36 civicrm_case_civicrm_relationship__civicrm_value_cep_paper_sub_36
              ON civicrm_case_civicrm_relationship.id = civicrm_case_civicrm_relationship__civicrm_value_cep_paper_sub_36.entity_id
    LEFT JOIN civicrm_value_submission_de_35 civicrm_value_submission_de_35 ON civicrm_contact.id = civicrm_value_submission_de_35.entity_id
    LEFT JOIN civicrm_case civicrm_relationship_civicrm_contact__civicrm_case ON civicrm_relationship_civicrm_contact.case_id = civicrm_relationship_civicrm_contact__civicrm_case.id
    WHERE (( civicrm_contact.id = %1 AND (civicrm_contact.contact_sub_type LIKE '%CEJ_Submission%' )
      AND (civicrm_case_civicrm_relationship__civicrm_value_cep_paper_sub_36.paper_191 IS NOT NULL ) ))
    GROUP BY id
    LIMIT 1 OFFSET 0";
  $dao = CRM_Core_DAO::executeQuery($sql, [1 => [$params['contact_id'], 'Integer']]);
  $dao->fetch();
  $returnValues = $dao->toArray();
  if ($returnValues['civicrm_case_civicrm_relationship__civicrm_value_cep_paper_s']) {
    $fileId = $returnValues['civicrm_case_civicrm_relationship__civicrm_value_cep_paper_s'];
    $entityId = $returnValues['civicrm_case_civicrm_relationship__civicrm_value_cep_paper_s_1'];
    $fileHash = CRM_Core_BAO_File::generateFileHash($entityId, $fileId);
    $paperUrl = CRM_Utils_System::url('civicrm/file',"reset=1&id={$fileId}&eid={$entityId}&fcs={$fileHash}", TRUE);
    $returnValues['paper_url'] = $paperUrl;
    $returnValues['paper_name'] = CRM_Core_DAO::getFieldValue('CRM_Core_DAO_File', $fileId, 'uri');
  }

  $relations = _civicrm_api3_covid_economics_getRelatedMembersWithUrl($params);
  if (!empty($relations[REL_TYPE_COAUTHOR])) {
    $returnValues['civicrm_contact_civicrm_relationship_2_display_name'] = $relations[REL_TYPE_COAUTHOR];
  }
  if (!empty($relations[REL_TYPE_PUBLISHED_IN])) {
    $returnValues['civicrm_contact_civicrm_relationship_3_display_name'] = $relations[REL_TYPE_PUBLISHED_IN];
  }
  if (!empty($returnValues['civicrm_contact_civicrm_relationship_1_display_name'])) {
    $url = CRM_Utils_System::url("civicrm/contact/view", "reset=1&cid={$returnValues['civicrm_contact_civicrm_relationship_1_id']}");
    $returnValues['civicrm_contact_civicrm_relationship_1_display_name'] = "<a href='{$url}'>{$returnValues['civicrm_contact_civicrm_relationship_1_display_name']}</a>";

    $result = civicrm_api3('EntityTag', 'get', [
      'sequential' => 1,
      'entity_table' => "civicrm_contact",
      'entity_id' => $returnValues['civicrm_contact_civicrm_relationship_1_id'],
      'tag_id' => "CEPR Researcher",
    ]);
    if (!empty($result['id'])) {
      $returnValues['civicrm_contact_civicrm_relationship_1_tag'] = ts('CEPR Researcher');
    }
  }
  if (!empty($returnValues['civicrm_contact_civicrm_relationship_1c_display_name'])) {
    $url = CRM_Utils_System::url("civicrm/contact/view", "reset=1&cid={$returnValues['civicrm_contact_civicrm_relationship_1c_id']}");
    $returnValues['civicrm_contact_civicrm_relationship_1c_display_name'] = "<a href='{$url}'>{$returnValues['civicrm_contact_civicrm_relationship_1c_display_name']}</a>";
  }

  // Spec: civicrm_api3_create_success($values = 1, $params = [], $entity = NULL, $action = NULL)
  return civicrm_api3_create_success($returnValues, $params, 'CovidEconomics', 'Getpaperblock');
}

/**
 * @param array $params
 *
 * @return array
 * @throws \CiviCRM_API3_Exception
 */
function _civicrm_api3_covid_economics_getRelatedMembersWithUrl(array $params): array {
  $result = civicrm_api3('Relationship', 'get', [
    'sequential' => 1,
    'return' => ["contact_id_b", "contact_id_b.display_name", "relationship_type_id"],
    'contact_id_a' => $params['contact_id'],
    'relationship_type_id' => ["IN" => [REL_TYPE_COAUTHOR, REL_TYPE_PUBLISHED_IN]],
    'is_active' => 1,
  ]);
  $relations = [];
  if (!empty($result['values'])) {
    foreach ($result['values'] as $rel) {
      $url = CRM_Utils_System::url("civicrm/contact/view", "reset=1&cid={$rel['contact_id_b']}");
      $relations[$rel['relationship_type_id']][$rel['contact_id_b']] = "<a href='{$url}'>{$rel['contact_id_b.display_name']}</a>";
    }
    if (!empty($relations)) {
      foreach ($relations as $typeId => $rel) {
        $relations[$typeId] = implode('<br/>', $rel);
      }
    }
  }
  return $relations;
}
