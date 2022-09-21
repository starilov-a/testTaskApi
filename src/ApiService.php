<?php

namespace Src;

class ApiService
{
    private $apiUrl = 'https://jsonplaceholder.typicode.com/';

    /**
     * Получение списка пользователей в json формате
     */
    public function getUsers(array $ids = null) {
        return $this->request('users'.($ids ? '?id='.$this->parametersFilter('id', $ids) : '' ), 'GET');
    }

    /**
     * Получение списка постов в json формате
     */
    public function getPosts(array $users = null) {
        return $this->request('posts'.($users ? '?userId='.$this->parametersFilter('userId', $users) : '' ), 'GET');
    }

    /**
     * Получение списка задач в json формате
     */
    public function getTasks(array $users = null) {
        return $this->request('todos'.($users ? '?userId='.$this->parametersFilter('userId', $users) : '' ), 'GET');
    }

    /**
     * Работа с отдельно с постом
     */
    public function post($action, $data) {

        if ($action == 'create') {
            return $this->request('posts', 'POST', $data);
        } elseif($action == 'update') {
            return $this->request('posts/' . $data['id'], 'PATCH');
        } elseif($action == 'delete') {
            return $this->request('posts/' . $data['id'], 'DELETE');
        }
    }

    /**
     * Формирование запроса
     */
    private function request($resourse, $method, $data = null) {
        $result = file_get_contents(
            $this->apiUrl . $resourse,
            false,
            stream_context_create([
                    'http' => [
                        'method' => $method,
                        'header' => 'Content-type: application/json; charset=UTF-8',
                        'content' => ($data ? json_encode($data) : '')
                    ]
                ]
            )
        );

        return var_dump(json_decode($result));
    }

    /**
     * Вспомогательная функция для фильтрации через GET параметры
     */
    private function parametersFilter(string $param, array $ids) {
        return implode('&'.$param.'=', $ids);
    }
}