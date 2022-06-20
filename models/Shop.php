<?php

namespace app\models;

use http\Exception\UnexpectedValueException;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "shops".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $phone
 * @property string|null $photo
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Shop extends ActiveRecord
{
    public $image;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'shops';
    }

    /**
     * @return string[]
     */
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['photo'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 256],
            [['phone'], 'string', 'max' => 10, 'min' => 9],
            [['phone'], 'match', 'pattern' => '/^[0-9]{9,10}$/'],
            [
                ['image'],
                'file',
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'checkExtensionByMimeType' => true,
                'maxSize' => 512000, // 500 килобайт = 500 * 1024 байта = 512 000 байт
                'tooBig' => 'Limit is 500KB',
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'phone' => Yii::t('app', 'Phone'),
            'photo' => Yii::t('app', 'Photo'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return bool
     */
    public function uploadPhoto(): bool
    {
        $result = true;
        $this->image = UploadedFile::getInstance($this, 'image');
        if ($this->image && $this->validate(['image'])) {
            $path = "images/{$this->image->baseName}.{$this->image->extension}";
            if ($result = $this->image->saveAs($path)) {
                $this->photo = $path;
                $this->image = null;
            }else {
                throw new UnexpectedValueException('Failed on save image');
            }
        }

        return $result;
    }
}
