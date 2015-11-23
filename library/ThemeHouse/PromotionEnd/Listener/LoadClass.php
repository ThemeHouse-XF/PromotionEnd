<?php

class ThemeHouse_PromotionEnd_Listener_LoadClass extends ThemeHouse_Listener_LoadClass
{
    protected function _getExtendedClasses()
    {
        return array(
            'ThemeHouse_PromotionEnd' => array(
                'controller' => array(
                    'XenForo_ControllerAdmin_UserGroupPromotion',
                ), /* END 'controller' */
                'datawriter' => array(
                    'XenForo_DataWriter_UserGroupPromotion',
                ), /* END 'datawriter' */
                'model' => array(
                    'XenForo_Model_UserGroupPromotion',
                ), /* END 'model' */
            ), /* END 'ThemeHouse_PromotionEnd' */
        );
    } /* END _getExtendedClasses */

    public static function loadClassController($class, array &$extend)
    {
        $loadClassController = new ThemeHouse_PromotionEnd_Listener_LoadClass($class, $extend, 'controller');
        $extend = $loadClassController->run();
    } /* END loadClassController */

    public static function loadClassDataWriter($class, array &$extend)
    {
        $loadClassDataWriter = new ThemeHouse_PromotionEnd_Listener_LoadClass($class, $extend, 'datawriter');
        $extend = $loadClassDataWriter->run();
    } /* END loadClassDataWriter */

    public static function loadClassModel($class, array &$extend)
    {
        $loadClassModel = new ThemeHouse_PromotionEnd_Listener_LoadClass($class, $extend, 'model');
        $extend = $loadClassModel->run();
    } /* END loadClassModel */
}