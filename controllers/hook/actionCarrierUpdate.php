<?php

class FrankActionCarrierUpdateController
{
    public function __construct($module, $file, $path)
    {
        $this->file = $file;
        $this->module = $module;
        $this->context = Context::getContext();
        $this->_path = $path;
    }

    public function run($params)
    {
        $old_id_carrier = (int)$params['id_carrier'];
        $new_id_carrier = (int)$params['carrier']->id;
        if (Configuration::get('FRANK_FLEX') == $old_id_carrier)
            Configuration::updateValue('FRANK_FLEX', $new_id_carrier);
        if (Configuration::get('FRANK_GREEN') == $old_id_carrier)
            Configuration::updateValue('FRANK_GREEN', $new_id_carrier);
        if (Configuration::get('FRANK_CLASSIC') == $old_id_carrier)
            Configuration::updateValue('FRANK_CLASSIC', $new_id_carrier);
    }
}