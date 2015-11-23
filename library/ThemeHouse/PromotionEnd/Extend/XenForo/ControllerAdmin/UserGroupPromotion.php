<?php

/**
 *
 * @see XenForo_ControllerAdmin_UserGroupPromotion
 */
class ThemeHouse_PromotionEnd_Extend_XenForo_ControllerAdmin_UserGroupPromotion extends XFCP_ThemeHouse_PromotionEnd_Extend_XenForo_ControllerAdmin_UserGroupPromotion
{

    /**
     *
     * @see XenForo_ControllerAdmin_UserGroupPromotion::actionManual()
     */
    public function actionManual()
    {
        $this->_assertPostOnly();

        $input = $this->_input->filter(
            array(
                'username' => XenForo_Input::STRING,
                'promotion_id' => XenForo_Input::UINT,
                'action' => XenForo_Input::STRING,
                'end_date' => XenForo_Input::STRING
            ));

        if (!$input['end_date']) {
            return parent::actionManual();
        }
        if ($input['action'] == 'demote') {
            return $this->responseError(
                new XenForo_Phrase('th_end_dates_can_only_be_used_to_promote_users_promotionenddate'));
        }

        $endDate = strtotime(date($input['end_date']) . ' 00:00:00');
        $timestampDifference = XenForo_Application::$time - $endDate;

        if ($timestampDifference >= 0 && $timestampDifference <= 60 * 60 * 24) {
            return $this->responseError(
                new XenForo_Phrase('th_promotion_length_must_be_at_least_one_day_promotionenddate'));
        }
        if ($endDate < XenForo_Application::$time) {
            return $this->responseError(new XenForo_Phrase('th_end_date_cannot_be_in_the_past_promotionenddate'));
        }

        $user = $this->_getUserModel()->getUserByName($input['username']);

        if (!$user) {
            return $this->responseError(new XenForo_Phrase('requested_user_not_found'));
        }

        $promotion = $this->_getPromotionOrError($input['promotion_id']);

        if ($input['action'] == 'promote') {
            $this->_getPromotionModel()->promoteUserWithEndDate($promotion, $user['user_id'], 'manual', $endDate);
        }

        return $this->responseRedirect(XenForo_ControllerResponse_Redirect::SUCCESS,
            XenForo_Link::buildAdminLink('user-group-promotions/manage'));
    } /* END actionManual */

    /**
     * Edits the end date of a user group promotion based on input.
     *
     */
    public function actionEditEndDate()
    {
        $promotion = $this->_getPromotionOrError($this->_input->filterSingle('promotion_id', XenForo_Input::UINT));

        $user = $this->_getUserModel()->getUserById($this->_input->filterSingle('user_id', XenForo_Input::UINT));
        if (!$user) {
            return $this->responseError(new XenForo_Phrase('requested_user_not_found'));
        }

        $promotionModel = $this->_getPromotionModel();

        $entry = $promotionModel->getPromotionLogEntry($promotion['promotion_id'], $user['user_id']);
        $hasEndDate = ($entry['promotion_state'] == 'manual' && isset($entry['promotion_end_date']));

        if ($this->isConfirmedPost() && $hasEndDate) {
            $endDate = strtotime($this->_input->filterSingle('end_date', XenForo_Input::STRING) . ' 00:00:00');
            $promotionModel->editEndDate($entry, $endDate);
            return $this->responseRedirect(XenForo_ControllerResponse_Redirect::SUCCESS, $this->getDynamicRedirect());
        } else {
            $viewParams = array(
                'promotion' => $promotion,
                'user' => $user,
                'entry' => $entry,
                'hasEndDate' => $hasEndDate,
                'redirect' => $this->getDynamicRedirect()
            );
            return $this->responseView('XenForo_ViewAdmin_UserGroupPromotion_Demote', 'th_edit_end_date_promotionenddate',
                $viewParams);
        }
    } /* END actionEditEndDate */
}