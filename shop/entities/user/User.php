<?php
namespace shop\entities\user;

use shop\entities\InstantiateTrait;
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
 * @property integer $publications
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
    const LEARNER = 'leaner';

    public static function signupLeaner(string $first_name, string $phone, string $password):self
    {
        $user = new static();
        $user->first_name = $first_name;
        $user->phone = $phone;
        $user->generateAuthKey();
        $user->setPassword($password);
        $user->created_at = $time = time();
        $user->updated_at = $time;
        $user->status = self::STATUS_WAIT;
        $user->designation = self::LEARNER;
        $user->generatePasswordConfirmCode();
        return $user;
    }

    public static function signupTeacher(string $first_name, string $last_name,string $phone, string $email, string $password):self
    {
        $user = new static();
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->phone = $phone;
        $user->email = $email;
        $user->generateAuthKey();
        $user->setPassword($password);
        $user->created_at = $time = time();
        $user->updated_at = $time;
        $user->status = self::STATUS_WAIT;
        $user->designation = self::TEACHER;
        $user->generatePasswordConfirmCode();
        return $user;
    }

    public function edit(string $first_name, string $last_name, string $email, string $phone):void
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->phone = $phone;
        $this->email = $email;
        $this->updated_at = time();
    }


    public function editProfile(string $firstName, string $lastName, string $email, string $phone): void
    {
        $this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->updated_at = time();
    }

    public function changePassword($password) :void
    {
        $this->setPassword($password);
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
        if (!empty($this->password_reset_token)){
            throw new \DomainException('Код восстановления пароля уже сформирован.');
        }
        $this->password_reset_code = rand(10000000,99999999);
        Yii::$app->turbosms->send($this->password_reset_code, $this->phone);
    }

    public function resetPassword($password) :void
    {
        if (empty($this->password_reset_code)){
            throw new \DomainException('Password resetting is not requested.');
        }
        $this->setPassword($password);
        $this->password_reset_code = null;
    }


    public function isActive() :bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isWait() :bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function deletePublication(){
        $this->publications -= 1;
        if ($this->publications < 0){
            $this->publications = 0;
        }
    }

    public function addPublication(){
        $this->publications += 1;
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


    public static function findByPhone($phone)
    {
        return static::findOne(['phone' => $phone, 'status' => self::STATUS_ACTIVE]);
    }


    public static function findByPasswordResetCode($code)
    {

        return static::findOne([
            'password_reset_code' => $code,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public function sendSms(){
        return Yii::$app->turbosms->send($this->password_confirm_code, $this->phone);
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
        $this->password_confirm_code = rand(100000,999999);
    }

    private function removePasswordConfirmCode()
    {
        $this->password_confirm_code = null;
    }








}
