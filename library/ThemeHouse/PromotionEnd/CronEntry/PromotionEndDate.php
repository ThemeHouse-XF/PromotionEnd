<?php

/**
 * Cron entry for executing user group promotions.
 */
class ThemeHouse_PromotionEnd_CronEntry_PromotionEndDate
{
	/**
	 * Runs the cron-based check for new promotions that users should be awarded.
	 */
	public static function runUserDowngrade()
	{
		/* @var $promotionModel XenForo_Model_UserGroupPromotion */
		$promotionModel = XenForo_Model::create('XenForo_Model_UserGroupPromotion');

		$promotionModel->processExpiredPromotions();
		XenForo_Application::defer('UserGroupPromotion', array('batch' => '100'));
	} /* END runUserDowngrade */ /* END removeExpiredPromotions */
}