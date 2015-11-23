<?php

class ThemeHouse_PromotionEnd_Install_Controller extends ThemeHouse_Install
{

    protected $_resourceManagerUrl = 'http://xenforo.com/community/resources/promotion-end-date.2480/';

    protected $_minVersionId = 1020000;

    protected $_minVersionString = '1.2.0';

    protected function _getTableChanges()
    {
        return array(
            'xf_user_group_promotion_log' => array(
                'promotion_end_date' => 'int(10) UNSIGNED NOT NULL DEFAULT 0', /* END 'promotion_end_date' */
            ), /* END 'xf_user' */
        );
    } /* END _getTableChanges */
}