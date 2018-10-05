<?php
namespace shop\repositories;

use shop\entities\User;
use Yii;

class UserRepository
{
    public function save(User $user): void
    {
        if (!$user->save()){
            throw new \RuntimeException('Saving error.');
        }
    }

    public function existByPasswordResetToken(string $token): bool
    {
        return (bool) User::findByPasswordResetToken($token);
    }

    public function getUserByEmail(string $email): User
    {
        return $this->getUserBy(['email'=> $email]);
    }

    public function getUserByPasswordResetToken(string $token): User
    {
        return $this->getUserBy(['password_reset_token'=> $token]);
    }

    public function getUserByConfirmCode(string $code): User
    {
        return $this->getUserBy(['password_confirm_code'=> $code]);
    }
    public function findByPhone(string $phone): User
    {
        return $this->getUserBy(['phone'=> $phone]);
    }

    private function getUserBy(array $condition): User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()){
            throw new NotFoundException('User not found.');
        }
        return $user;
    }


}