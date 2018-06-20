<?php
//use Drupal\Core\Database\Database;
namespace Drupal\publish_remote\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Serialization\Json;

class PublishRemoteController {
	public function publish_remote_content( Request $request) {
		/*$item = array(
			'#markup' => 'Done',
			);*/
		$output = array();
		//$output = json::decode($request->getContent());
		$title = $output[0]['title'][0]['value'];
		$body = $output[0]['body'][0]['value'];
		$cio_case_study_tid = $output[0]['cio_case_study_industry_vertical'][0]['target_id'];
		$cio_case_study_technology_tid = $output[0]['cio_case_study_technology'][0]['target_id'];
		$content_category_tid = $output[0]['content_category'][0]['target_id'];
		$field_about_person = $output[0]['field_about_person'][0]['value'];
		$field_author_name = $output[0]['field_author_name'][0]['value'];
		$field_channelworld_url = $output[0]['field_channelworld_url'][0]['value'];
		$field_cio_url = $output[0]['field_cio_url'][0]['value'];
		$field_company = $output[0]['field_company'][0]['value'];
		$field_computerworld_url = $output[0]['field_computerworld_url'][0]['value'];
		$field_cso_url = $output[0]['field_cso_url'][0]['value'];
		$field_design = $output[0]['field_design'][0]['value'];
		$field_detail_video_script = $output[0]['field_detail_video_script'][0]['value'];
		$field_edited_by = $output[0]['field_edited_by'][0]['target_id'];
		$field_guid = $output[0]['field_guid'][0]['value'];
		$field_guid_version = $output[0]['field_guid_version'][0]['value'];
		$field_hidden_agency_name = $output[0]['field_hidden_agency_name'][0]['value'];
		$field_hidden_company_name = $output[0]['field_hidden_company_name'][0]['value'];
		$field_idgns_image_url = $output[0]['field_idgns_image_url'][0]['value'];
		$field_image_credit = $output[0]['field_image_credit'][0]['value'];
		$field_local_guid = $output[0]['field_local_guid'][0]['value'];
		$field_local_guid = $output[0]['field_local_guid'][0]['value'];
		$field_new_guid = $output[0]['field_new_guid'][0]['value'];
		$field_nwsl_teaser = $output[0]['field_nwsl_teaser'][0]['value'];
		$field_nwsl_title = $output[0]['field_nwsl_title'][0]['value'];
		$field_org_ref = $output[0]['field_org_ref'][0]['value'];
		$field_org_type = $output[0]['field_org_type'][0]['value'];
		$field_org_url = $output[0]['field_org_url'][0]['value'];
		$field_person_name = $output[0]['field_person_name'][0]['value'];
		$field_quote = $output[0]['field_quote'][0]['value'];
		$field_sponsored = $output[0]['field_sponsored'][0]['value'];
		$field_teaser = $output[0]['field_teaser'][0]['value'];
		$field_video_script = $output[0]['field_video_script'][0]['value'];
		$idg_new_taxonomy = $output[0]['idg_new_taxonomy'][0]['target_id'];
		$it_road_map = $output[0]['it_road_map'][0]['target_id'];

		$field_select_agency = ''; //$output[0]['field_select_agency']; //Pending..
		$field_select_company = ''; //$output[0]['field_select_company']; //Pending
		$field_send_content = ''; //$output[0]['field_send_content']; //Pending

		$array_field_author_profile_name = $output[0]['field_author_profile_name'];
		$array_field_home_page_image = $output[0]['field_home_page_image'];
		$array_field_slideshow_image = $output[0]['field_slideshow_image'];
		$array_field_slide_caption = $output[0]['field_slide_caption'];
		$array_field_slide_desc = $output[0]['field_slide_desc'];
		$array_upload = $output[0]['upload'];
    
        $values = array(
        'nid' => NULL,
        'type' => 'common_content',
        'status' => 0,
        'uid' => 1,
        'title' => $title,
        'field_about_person' => $field_about_person,
        'field_author_profile_name' => $array_field_author_profile_name,
        'field_channelworld_url' => $field_channelworld_url,
        'cio_case_study_industry_vertical' => $cio_case_study_tid,
        'cio_case_study_technology' => $cio_case_study_technology_tid,
        'field_cio_url' => $field_cio_url,
        'field_company' => $field_company,
        'field_computerworld_url' => $field_computerworld_url,
        'field_cso_url' => $field_cso_url,
        'field_design' => $field_design,
        'field_detail_video_script' => '',
        'field_edited_by' => $field_edited_by,
        'field_guid_version' => $field_guid_version,
        'field_hidden_agency_name' => $field_hidden_agency_name,
        'field_hidden_company_name' => $field_hidden_company_name,
        'field_home_page_image' => $array_field_home_page_image,
        'field_video_script' => $field_video_script,
        'field_local_guid' => $field_local_guid,
        'idg_new_taxonomy' => $idg_new_taxonomy,
        'field_guid' => $field_guid,
        'body' => $body,
        'created'=> time(),
        'field_author_name' => $field_author_name,
        'content_category' => $content_category_tid,
        'field_idgns_image_url' => $field_idgns_image_url,
        'field_image_credit' => $field_image_credit,
        'it_road_map' => $it_road_map,
        'field_new_guid' => $field_new_guid,
        'field_nwsl_teaser' => $field_nwsl_teaser,
        'field_nwsl_title' => $field_nwsl_title,
        'field_org_ref' => $field_org_ref,
        'field_org_type' => $field_org_type,
        'field_org_url' => $field_org_url,
        'field_person_name' => $field_person_name,
        'field_quote' => $field_quote,
        'field_select_agency' => $field_select_agency,
        'field_select_company' => $field_select_company,
        'field_send_content' => $field_send_content,
        'field_slide_caption' => $array_field_slide_caption,
        'field_slide_desc' => $array_field_slide_desc,
        'field_slideshow_image' => $array_field_slideshow_image,
        'field_sponsored' => $field_sponsored,
        'field_teaser' => $field_teaser,
        'upload' => $array_upload
      );

      $node = entity_create('node', $values);
      $node->save();
      return $item;
    }
}