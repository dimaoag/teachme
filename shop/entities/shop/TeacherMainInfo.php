<?php
namespace shop\entities\shop;



use shop\entities\user\User;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
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
 * @mixin ImageUploadBehavior
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
        $this->firm_photo = $file;
    }


    public function removePhoto($id): void
    {
        $this->cleanFiles();
        unset($this->firm_photo);
        $this->firm_photo = null;
        Yii::$app->db->createCommand("UPDATE teachers_main_info SET firm_photo = NULL WHERE id = $id")->execute();
    }



    public function getCity(): ActiveQuery
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }



    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'firm_photo',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/teacher_main_info/[[attribute_id]]/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/teacher_main_info/[[attribute_id]]/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/teacher_main_info/[[attribute_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/teacher_main_info/[[attribute_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                    'thumb' => ['width' => 640, 'height' => 480],
                    'favorite_list' => ['width' => 150, 'height' => 150],
                    'favorite_widget_list' => ['width' => 57, 'height' => 57],
                    'search_list' => ['width' => 400, 'height' => 228],
//                    'catalog_product_main' => ['processor' => function (GD $thumb){
//                        $thumb->adaptiveResize(750,1000);  // my resize
//                    }],
                ],
            ],
        ];
    }



    public static function tableName()
    {
        return '{{%teachers_main_info}}';
    }




}