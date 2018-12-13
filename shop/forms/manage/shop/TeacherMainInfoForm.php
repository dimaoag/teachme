<?php
namespace shop\forms\manage\shop;

use shop\entities\shop\City;
use shop\entities\shop\TeacherMainInfo;
use shop\forms\CompositeForm;
use yii\helpers\ArrayHelper;


/* @property TeacherMainInfoPhotoForm $photo */

class TeacherMainInfoForm extends CompositeForm
{
    public $city_id;
    public $firm_name;
    public $address;
    public $phone_1;
    public $phone_2;
    public $instagram_link;
    public $facebook_link;
    public $vk_link;
    public $youtube_link;

    private $_teacherMainInfo;

    public function __construct(TeacherMainInfo $teacherMainInfo = null, $config = [])
    {
        if ($teacherMainInfo) {
            $this->city_id = $teacherMainInfo->city_id;
            $this->firm_name = $teacherMainInfo->firm_name;
            $this->address = $teacherMainInfo->address;
            $this->phone_1 = $teacherMainInfo->phone_1;
            $this->phone_2 = $teacherMainInfo->phone_2;
            $this->instagram_link = $teacherMainInfo->instagram_link;
            $this->facebook_link = $teacherMainInfo->facebook_link;
            $this->vk_link = $teacherMainInfo->vk_link;
            $this->youtube_link = $teacherMainInfo->youtube_link;
            $this->_teacherMainInfo = $teacherMainInfo;
        }
        $this->photo = new TeacherMainInfoPhotoForm();
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['city_id', 'firm_name', 'address', 'phone_1'], 'required'],
            [['firm_name', 'address', 'phone_1', 'phone_2'], 'string', 'max' => 255],
            [['instagram_link', 'facebook_link', 'vk_link', 'youtube_link'], 'string'],
            [['city_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'city_id' => 'Город',
            'firm_name' => 'Название организации',
            'address' => 'Адресс',
            'phone_1' => 'Телефон 1',
            'phone_2' => 'Телефон 2',
            'instagram_link' => 'Instagram',
            'facebook_link' => 'Facebook',
            'vk_link' => 'Vkontakte',
            'youtube_link' => 'Youtube',
        ];
    }


    public function getCitiesList(): array
    {
        return ArrayHelper::map(City::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }



    protected function internalForms(): array
    {
        return ['photo'];
    }



}