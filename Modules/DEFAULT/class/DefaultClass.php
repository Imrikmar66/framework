<?php

class DefaultClass extends ObjectModel {
    
    protected function getBddDescription() {
        return array(
            'table' => 'default',
            'parameters' => array(
                'id' => 'id',
            )
        );
    }
    
}
