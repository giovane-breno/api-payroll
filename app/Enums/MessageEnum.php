<?php

namespace App\Enums;


enum MessageEnum: string
{
    const SUCCESS_CREATED = 'Criado com sucesso!';
    const FAILURE_CREATED = 'Não foi possível cadastrar os dados!';
    const SUCCESS_DELETED = 'Deletado com sucesso!';
    const FAILURE_DELETED = 'Não foi possível deletar os dados!';
    const SUCCESS_UPDATED = 'Atualizado com sucesso!';
    const FAILURE_UPDATED = 'Não foi possível atualizar os dados!';
    const FAILURE_FIND = 'Não foi possível encontrar o objeto solicitado!';
    const ATTR_RELATION = 'Há dados atribuidos a essa chave, verifique-os antes de deletar!';
}
