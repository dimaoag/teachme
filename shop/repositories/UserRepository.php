<?php
namespace shop\repositories;

use shop\entities\user\User;

class UserRepository
{
    public function save(User $user): void
    {
        if (!$user->save()){
            throw new \RuntimeException('Saving error.');
        }
    }

    public function existByPasswordResetCode(string $code): bool
    {
        return (bool) User::findByPasswordResetCode($code);
    }

    public function getUserByEmail(string $email): User
    {
        return $this->getUserBy(['email'=> $email]);
    }

    public function getUserByPhone(string $phone): User
    {
        return $this->getUserBy(['phone'=> $phone]);
    }

    public function getUserById(string $id): User
    {
        return $this->getUserBy(['id'=> $id]);
    }

    public function getUserByPasswordResetCode(string $code): User
    {
        return $this->getUserBy(['password_reset_code'=> $code]);
    }

    public function getUserByConfirmCode(string $code): User
    {
        return $this->getUserBy(['password_confirm_code'=> $code]);
    }
    public function findByPhone(string $phone): User
    {
        return $this->getUserBy(['phone'=> $phone]);
    }



    /**
     * @param $courseId
     * @return iterable|User[]
     */
    public function getAllByProductInWishList($courseId): iterable
    {
        return User::find()
            ->alias('u')
            ->joinWith('wishlistItems w', false, 'INNER JOIN')
            ->andWhere(['w.course_id' => $courseId])
            ->each();
    }


    private function getUserBy(array $condition): User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()){
            throw new NotFoundException('User not found.');
        }
        return $user;
    }


}