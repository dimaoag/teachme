<?php
namespace shop\entities\shop;


use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use shop\entities\user\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use \Webmozart\Assert\Assert;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $city_id
 * @property string $firm_name
 * @property string $firm_photo
 * @property string $address
 * @property string $phone_1
 * @property string $phone_2
 * @property string $instagram_link
 * @property string $facebook_link
 * @property string $vk_link
 * @property string $youtube_link
 * @property integer $created_at
 *
 *
 * @property City $city
 * @property User $user
 * @property TeacherMainInfoPhoto $photo
 */

class TeacherMainInfo  extends  ActiveRecord{


    public static function create($userId, $cityId, $firmName, $address, $phone_1, $phone_2, $instagramLink, $facebookLink, $vkLink, $youtugeLink): self
    {
        $teacterMainInfo = new static();
        $teacterMainInfo->user_id = $userId;
        $teacterMainInfo->city_id = $cityId;
        $teacterMainInfo->firm_name = $firmName;
        $teacterMainInfo->address = $address;
        $teacterMainInfo->phone_1 = $phone_1;
        $teacterMainInfo->phone_2 = $phone_2;
        $teacterMainInfo->instagram_link = $instagramLink;
        $teacterMainInfo->facebook_link = $facebookLink;
        $teacterMainInfo->vk_link = $vkLink;
        $teacterMainInfo->youtube_link = $youtugeLink;
        $teacterMainInfo->created_at = time();
        return $teacterMainInfo;
    }


    public function edit($cityId, $firmName, $address, $phone_1, $phone_2, $instagramLink, $facebookLink, $vkLink, $youtugeLink): void
    {
        $this->city_id = $cityId;
        $this->firm_name = $firmName;
        $this->address = $address;
        $this->phone_1 = $phone_1;
        $this->phone_2 = $phone_2;
        $this->instagram_link = $instagramLink;
        $this->facebook_link = $facebookLink;
        $this->vk_link = $vkLink;
        $this->youtube_link = $youtugeLink;
    }



    // Photos

    public function addPhoto(UploadedFile $file): void
    {
        $photos = $this->photo;
        $photos[] = TeacherMainInfoPhoto::create($file);
        $this->updatePhotos($photos);

    }

    private function updatePhotos(array $photos): void
    {
        $this->photo = $photos;
    }

    public function removePhoto($id): void
    {
        $photos = $this->photo;

        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                unset($photos[$i]);
                $this->updatePhotos($photos);
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }






    public function getCity(): ActiveQuery
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getPhoto(): ActiveQuery
    {
        return $this->hasMany(TeacherMainInfoPhoto::class, ['teacher_main_info_id' => 'id']);
    }


    public function behaviors(): array
    {
        return [
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['photo'],
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function beforeDelete(): bool
    {
        if (parent::beforeDelete()) {
            foreach ($this->photo as $item) {
                $item->delete();
            }
            return true;
        }
        return false;
    }



    public static function tableName()
    {
        return '{{%teachers_main_info}}';
    }




}