<?php

namespace shop\entities\shop\course;


use shop\entities\EventTrait;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use shop\entities\AggregateRoot;
use shop\entities\shop\City;
use shop\entities\shop\Category;
use shop\entities\shop\course\queries\CourseQuery;
use shop\entities\shop\CourseType;
use shop\entities\user\User;
use shop\entities\shop\TeacherMainInfo;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use shop\entities\user\WishlistItem;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $city_id
 * @property integer $course_type_id
 * @property integer $firm_id
 * @property integer $main_photo_id
 * @property integer $price_modification_id
 * @property integer $created_at
 * @property integer $date_start_sale
 * @property integer $date_stop_sale
 * @property string $name
 * @property integer $price
 * @property integer $old_price
 * @property string $description
 * @property integer $rating
 * @property integer $status
 *
 *
 * @property City $city
 * @property CourseType $courseType
 * @property User $user
 * @property PriceModification $priceModification
 * @property Error $error
 * @property Category $category
 * @property Value[] $values
 * @property Photo[] $photos
 * @property Photo $mainPhoto
 * @property Gallery[] $gallery
 * @property TeacherMainInfo $firm
 * @property Review[] $reviews
 * @property Order[] $orders
 * @property WishlistItem[] $wishlistItems
 */
class Course extends ActiveRecord implements AggregateRoot
{
    use EventTrait;

    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ON_MODERATION = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_FAIL = 3;

    public $meta;

    public static function create($userId, $cityId, $courseTypeId, $firmId, $categoryId, $priceModificationId, $name, $price, $oldPrice, $description): self
    {
        $course = new static();
        $course->user_id = $userId;
        $course->city_id = $cityId;
        $course->course_type_id = $courseTypeId;
        $course->firm_id = $firmId;
        $course->category_id = $categoryId;
        $course->price_modification_id = $priceModificationId;
        $course->name = $name;
        $course->price = $price;
        $course->old_price = $oldPrice;
        $course->description = $description;
        $course->status = self::STATUS_NOT_ACTIVE;
        $course->created_at = time();
        return $course;
    }


    public function edit($cityId, $priceModificationId, $name, $price, $oldPrice, $description): void
    {
        $this->city_id = $cityId;
        $this->price_modification_id = $priceModificationId;
        $this->name = $name;
        $this->price = $price;
        $this->old_price = $oldPrice;
        $this->description = $description;
    }

    public function changeMainCategory($categoryId): void
    {
        $this->category_id = $categoryId;
    }

    public function activate(): void
    {
        if ($this->isActive()) {
            throw new \DomainException('Course is already active.');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function deactivate(): void
    {
        if ($this->isNoActive()) {
            throw new \DomainException('Course is already not activate.');
        }
        $this->status = self::STATUS_NOT_ACTIVE;
    }

    public function onModeration(): void
    {
        if ($this->isOnModeration()) {
            throw new \DomainException('Course is already on moderation.');
        }
        $this->status = self::STATUS_ON_MODERATION;
    }

    public function failure(): void //отказ
    {
        if ($this->isFail()) {
            throw new \DomainException('Course is already on moderation.');
        }
        $this->status = self::STATUS_FAIL;
    }

    public function isActive(): bool
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function isNoActive(): bool
    {
        return $this->status == self::STATUS_NOT_ACTIVE;
    }

    public function isOnModeration(): bool
    {
        return $this->status == self::STATUS_ON_MODERATION;
    }

    public function isFail(): bool
    {
        return $this->status == self::STATUS_FAIL;
    }


    public function setDateActivate(){
        $currentTime = time();
        $dateStop =  date('d-m-Y h:i:s', strtotime('+31 day', $currentTime));
        $this->date_start_sale = $currentTime;
        $this->date_stop_sale = Yii::$app->formatter->asTimestamp($dateStop);
    }


    public function countOrders(){
        return count($this->orders) ?: 0;
    }


    //errors for moderation

    public function createError($id, $message)
    {
        $error = Error::create($id, $message);
        $this->error = $error;
    }


    public function editError(Error $error)
    {
        $this->error = $error;
    }




    // Photos

    public function addPhoto(UploadedFile $file): void
    {
        $photos = $this->photos;
        $photos[] = Photo::create($file);
        $this->updatePhotos($photos);
    }

    public function addGalleryImage(UploadedFile $file): void
    {
        $gallery = $this->gallery;
        $gallery[] = Gallery::create($file);
        $this->updateGallery($gallery);
    }


    public function removePhoto($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                unset($photos[$i]);
                $this->updatePhotos($photos);
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    public function removeGalleryImage($id): void
    {
        $gallery = $this->gallery;
        foreach ($gallery as $i => $galleryItem) {
            if ($galleryItem->isIdEqualTo($id)) {
                unset($gallery[$i]);
                $this->updateGallery($gallery);
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }


    public function removePhotos(): void
    {
        $this->updatePhotos([]);
    }

    public function removeGallery(): void
    {
        $this->updateGallery([]);
    }


    private function updatePhotos(array $photos): void
    {
        foreach ($photos as $i => $photo) {
            $photo->setSort($i);
        }
        $this->photos = $photos;
        $this->populateRelation('mainPhoto', reset($photos));
    }

    private function updateGallery(array $gallery): void
    {
        foreach ($gallery as $i => $galleryItem) {
            $galleryItem->setSort($i);
        }
        $this->gallery = $gallery;
    }



    // Values

    public function setValue($id, $value): void
    {
        $values = $this->values;
        foreach ($values as $val) {
            if ($val->isForCharacteristic($id)) {
                $val->change($value);
                $this->values = $values;
                return;
            }
        }
        $values[] = Value::create($id, $value);
        $this->values = $values;
    }

    public function getValue($id): Value
    {
        $values = $this->values;
        foreach ($values as $val) {
            if ($val->isForCharacteristic($id)) {
                return $val;
            }
        }
        return Value::blank($id);
    }

    //category

    public function getCategoryParents()
    {
        $categories = ArrayHelper::getColumn($this->category->parents, 'id');
        foreach ($categories as $key => $value){
            if ($value == 1){
                unset($categories[$key]);
            }
        }
        return $categories;
    }

    // Reviews

    public function addReview($userId, $vote, $text): void
    {
        $reviews = $this->reviews;
        $reviews[] = Review::create($userId, $vote, $text);
        $this->updateReviews($reviews);
    }



    public function editReview($id, $vote, $text): void
    {
        $this->doWithReview($id, function (Review $review) use ($vote, $text) {
            $review->edit($vote, $text);
        });
    }



    public function activateReview($id): void
    {
        $this->doWithReview($id, function (Review $review) {
            $review->activate();
        });
    }



    public function draftReview($id): void
    {
        $this->doWithReview($id, function (Review $review) {
            $review->draft();
        });
    }


    private function doWithReview($id, callable $callback): void
    {
        $reviews = $this->reviews;
        foreach ($reviews as $review) {
            if ($review->isIdEqualTo($id)) {
                $callback($review);
                $this->updateReviews($reviews);
                return;
            }
        }
        throw new \DomainException('Review is not found.');
    }



    public function removeReview($id): void
    {
        $reviews = $this->reviews;
        foreach ($reviews as $i => $review) {
            if ($review->isIdEqualTo($id)) {
                unset($reviews[$i]);
                $this->updateReviews($reviews);
                return;
            }
        }
        throw new \DomainException('Review is not found.');
    }



    private function updateReviews(array $reviews): void
    {
        $amount = 0;
        $total = 0;

        foreach ($reviews as $review) {
            /**
             * @var Review $review
             */
            if ($review->isActive()) {
                $amount++;
                $total += $review->getRating();
            }
        }

        $this->reviews = $reviews;
        $this->rating = $amount ? $total / $amount : null;
    }



    public function getCountsReviews() :int
    {
        return $this->reviews ? count($this->reviews) : 0;
    }

    // Orders

    public function createOrder($teacher_id, $username, $phone, $price) :void
    {
        $orders = $this->orders;
        $orders[] = Order::create($teacher_id, $username, $phone, 'Новая заявка', $price);
        $this->orders = $orders;
    }

    public function editOrder(Order $order, $title, $status) :void
    {
        $order->edit($title,$status);
    }



    // wishlistItems

    public function checkInWishlistItems($userId)
    {
        $items = $this->wishlistItems;
        foreach ($items as $i => $item) {
            if ($item->isForUser($userId)) {
                return true;
            }
        }
        return false;
    }



    ##########################

    public function getCity(): ActiveQuery
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    public function getCourseType(): ActiveQuery
    {
        return $this->hasOne(CourseType::class, ['id' => 'course_type_id']);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getPriceModification(): ActiveQuery
    {
        return $this->hasOne(PriceModification::class, ['id' => 'price_modification_id']);
    }

    public function getFirm(): ActiveQuery
    {
        return $this->hasOne(TeacherMainInfo::class, ['id' => 'firm_id']);
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getValues(): ActiveQuery
    {
        return $this->hasMany(Value::class, ['course_id' => 'id']);
    }

    public function getError(): ActiveQuery
    {
        return $this->hasOne(Error::class, ['course_id' => 'id']);
    }

    public function getPhotos(): ActiveQuery
    {
        return $this->hasMany(Photo::class, ['course_id' => 'id'])->orderBy('sort');
    }

    public function getGallery(): ActiveQuery
    {
        return $this->hasMany(Gallery::class, ['course_id' => 'id'])->orderBy('sort');
    }

    public function getMainPhoto(): ActiveQuery
    {
        return $this->hasOne(Photo::class, ['id' => 'main_photo_id']);
    }

    public function getReviews(): ActiveQuery
    {
        return $this->hasMany(Review::class, ['course_id' => 'id']);
    }

    public function getOrders(): ActiveQuery
    {
        return $this->hasMany(Order::class, ['course_id' => 'id']);
    }

    public function getWishlistItems(): ActiveQuery
    {
        return $this->hasMany(WishlistItem::class, ['course_id' => 'id']);
    }

    ##########################

    public static function tableName(): string
    {
        return '{{%course_courses}}';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['values', 'photos', 'gallery', 'error', 'reviews', 'orders'],
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
            foreach ($this->photos as $photo) {
                $photo->delete();
            }
            foreach ($this->gallery as $gallery_item){
                $gallery_item->delete();
            }
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes): void
    {
        $related = $this->getRelatedRecords();
        parent::afterSave($insert, $changedAttributes);
        if (array_key_exists('mainPhoto', $related)) {
            $this->updateAttributes(['main_photo_id' => $related['mainPhoto'] ? $related['mainPhoto']->id : null]);
        }
    }

    public static function find(): CourseQuery
    {
        return new CourseQuery(static::class);
    }
}