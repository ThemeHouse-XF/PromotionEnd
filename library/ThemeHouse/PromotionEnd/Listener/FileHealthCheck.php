<?php

class ThemeHouse_PromotionEnd_Listener_FileHealthCheck
{

    public static function fileHealthCheck(XenForo_ControllerAdmin_Abstract $controller, array &$hashes)
    {
        $hashes = array_merge($hashes,
            array(
                'library/ThemeHouse/PromotionEnd/CronEntry/PromotionEndDate.php' => '46754b3929a5d8beacbfa4c6c1bd004c',
                'library/ThemeHouse/PromotionEnd/Extend/XenForo/ControllerAdmin/UserGroupPromotion.php' => '35f1ee990a0e6b245452dfe7f35cb4ff',
                'library/ThemeHouse/PromotionEnd/Extend/XenForo/DataWriter/UserGroupPromotion.php' => '03093b298813add81fc66619313b36a3',
                'library/ThemeHouse/PromotionEnd/Extend/XenForo/Model/UserGroupPromotion.php' => '71b816848ad482035bbeda3b55c5524c',
                'library/ThemeHouse/PromotionEnd/Install/Controller.php' => '1bcba0e50371458df71aed7290b1b0f9',
                'library/ThemeHouse/PromotionEnd/Listener/LoadClass.php' => 'ec9d3ea3034a96677aa60b345cb76559',
                'library/ThemeHouse/Install.php' => '18f1441e00e3742460174ab197bec0b7',
                'library/ThemeHouse/Install/20151109.php' => '2e3f16d685652ea2fa82ba11b69204f4',
                'library/ThemeHouse/Deferred.php' => 'ebab3e432fe2f42520de0e36f7f45d88',
                'library/ThemeHouse/Deferred/20150106.php' => 'a311d9aa6f9a0412eeba878417ba7ede',
                'library/ThemeHouse/Listener/ControllerPreDispatch.php' => 'fdebb2d5347398d3974a6f27eb11a3cd',
                'library/ThemeHouse/Listener/ControllerPreDispatch/20150911.php' => 'f2aadc0bd188ad127e363f417b4d23a9',
                'library/ThemeHouse/Listener/InitDependencies.php' => '8f59aaa8ffe56231c4aa47cf2c65f2b0',
                'library/ThemeHouse/Listener/InitDependencies/20150212.php' => 'f04c9dc8fa289895c06c1bcba5d27293',
                'library/ThemeHouse/Listener/LoadClass.php' => '5cad77e1862641ddc2dd693b1aa68a50',
                'library/ThemeHouse/Listener/LoadClass/20150518.php' => 'f4d0d30ba5e5dc51cda07141c39939e3',
            ));
    }
}