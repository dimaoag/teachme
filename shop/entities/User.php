<?php
namespace shop\entities;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $auth_key
 * @property string $password_hash
 * @property integer $password_confirm_code
 * @property integer $password_reset_code
 * @property string $email
 * @property integer $status
 * @property string $designation
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    use InstantiateTrait;
    const STATUS_WAIT = 0;
    const STATUS_ACTIVE = 10;
    const TEACHER = 'teacher';
    const LEANER = 'leaner';

    public static function signupLeaner(string $first_name, string $phone, string $password):self
    {
        $user = new static();
        $user->first_name = $first_name;
        $user->phone = $phone;
        $user->generateAuthKey();
        $user->setPassword($password);
        $user->created_at = $time = time();
        $user->updated_at = $time;
        $user->status = self::STATUS_ACTIVE;
        $user->designation = self::LEANER;
        $user->generatePasswordConfirmCode();
        return $user;
    }

    public static function signupTeacher(string $first_name, string $phone, string $email, string $password):self
    {
        $user = new static();
        $user->first_name = $first_name;
        $user->phone = $phone;
        $user->email = $email;
        $user->generateAuthKey();
        $user->setPassword($password);
        $user->created_at = $time = time();
        $user->updated_at = $time;
        $user->status = self::STATUS_ACTIVE;
        $user->designation = self::TEACHER;
        $user->generatePasswordConfirmCode();
        return $user;
    }


    public function confirmSignup()
    {
        if (!$this->isWait()){
            throw new \DomainException('User is already active.');
        }
        $this->status = self::STATUS_ACTIVE;
        $this->removePasswordConfirmCode();
    }


    public function requestPasswordReset() :void
    {
        if (!empty($this->password_reset_token) && self::isPasswordResetTokenValid($this->password_reset_token)){
            throw new \DomainException('Password resetting is already requested.');
        }
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function resetPassword($password) :void
    {
        if (empty($this->password_reset_token)){
            throw new \DomainException('Password resetting is not requested.');
        }
        $this->setPassword($password);
        $this->password_reset_token = null;
    }


    public function isActive() :bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isWait() :bool
    {
        return $this->status === self::STATUS_WAIT;
    }


    public static function tableName()
    {
        return '{{%users}}';
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_WAIT]],
        ];
    }


    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }


    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }


    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }


    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }


    public function getAuthKey()
    {
        return $this->auth_key;
    }


    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    private function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    private function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    private function generatePasswordConfirmCode()
    {
        $this->password_confirm_code = rand(1000,9999);
    }

    private function removePasswordConfirmCode()
    {
        $this->password_confirm_code = null;
    }








}
