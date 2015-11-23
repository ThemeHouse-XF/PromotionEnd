<?php

/**
 *
 * @see XenForo_Model_UserGroupPromotion
 */
class ThemeHouse_PromotionEnd_Extend_XenForo_Model_UserGroupPromotion extends XFCP_ThemeHouse_PromotionEnd_Extend_XenForo_Model_UserGroupPromotion
{

    /**
     * Gives a user the specified promotion.
     *
     * @param array $promotion
     * @param integer $userId
     * @param string $state Type of promotion (automatic, manual); this affects
     * automatic demotion
     * @param integer $endDate
     */
    public function promoteUserWithEndDate(array $promotion, $userId, $state = 'automatic', $endDate)
    {
        $db = $this->_getDb();
        XenForo_Db::beginTransaction($db);
        
        $this->_getUserModel()->addUserGroupChange($userId, "ugPromotion$promotion[promotion_id]", 
            $promotion['extra_user_group_ids']);
        
        $this->insertPromotionLogEntryWithEndDate($promotion['promotion_id'], $userId, $state, $endDate);
        
        XenForo_Db::commit($db);
    } /* END promoteUserWithEndDate */

    /**
     * Inserts a promotion log entry.
     *
     * @param integer $promotionId
     * @param integer $userId
     * @param string $state Values: automatic, manual, disabled
     * @param integer $endDate
     */
    public function insertPromotionLogEntryWithEndDate($promotionId, $userId, $state = 'automatic', $endDate)
    {
        $this->_getDb()->query(
            '
			INSERT INTO xf_user_group_promotion_log
				(promotion_id, user_id, promotion_date, promotion_state, promotion_end_date)
			VALUES
				(?, ?, ?, ?,?)
			ON DUPLICATE KEY UPDATE
				promotion_date = VALUES(promotion_date),
				promotion_state = VALUES(promotion_state)
		', 
            array(
                $promotionId,
                $userId,
                XenForo_Application::$time,
                $state,
                $endDate
            ));
    } /* END insertPromotionLogEntryWithEndDate */

    /**
     * Get all user group promotions that have expired.
     *
     * @return array [promotion_id] => info
     */
    public function processExpiredPromotions()
    {
        return $this->_getDb()->query(
            '
        UPDATE xf_user_group_promotion_log 
            SET
        promotion_state = ?,
        promotion_end_date = ?
        	WHERE promotion_end_date < ?
				AND promotion_end_date > 0
		', 
            array(
                'automatic',
                '0',
                XenForo_Application::$time
            ));
    } /* END processExpiredPromotions */

    public function editEndDate(array $logEntry, $endDate)
    {
        return $this->_getDb()->query(
            '
        UPDATE xf_user_group_promotion_log
            SET
        promotion_end_date = ?
        	WHERE promotion_id = ? AND 
            user_id = ?
		', 
            array(
                $endDate,
                $logEntry['promotion_id'],
                $logEntry['user_id']
            ));
    } /* END editEndDate */
}