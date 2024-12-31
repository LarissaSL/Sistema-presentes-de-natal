<?php

namespace App\Enums;

enum RelationshipType: string {
    case FAMILIA = 'Familia';
    case AMIGO = 'Amigo';
    case TRABALHO = 'Trabalho';
    case ROMANTICO = 'Romantico';
    case CONHECIDO = 'Conhecido';
    case OUTROS = 'Outros';
    
    public static function values(): array {
        return array_column(RelationshipType::cases(), 'value');
    }
}
?>