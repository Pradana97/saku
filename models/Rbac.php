<?php
namespace app\models;
use yii\rbac\DbManager;
use yii\rbac\Assignment;
use yii\db\Query;
class Rbac extends DbManager{
    public function getAssignments($userId){
        if ($this->isEmptyUserId($userId)) {
            return [];
        }
        $query = (new Query())
            ->from($this->assignmentTable)->cache(100)
            ->where(['user_id' => (string) $userId]);
        $assignments = [];
        foreach ($query->all($this->db) as $row) {
            $assignments[$row['item_name']] = new Assignment([
                'userId' => $row['user_id'],
                'roleName' => $row['item_name'],
                'createdAt' => $row['created_at'],
            ]);
        }
        return $assignments;
    }
}