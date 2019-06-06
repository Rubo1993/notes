<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "note".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property int $univer_id
 * @property int $language_id
 * @property string $description
 * @property int $type_id
 * @property int $cat_id
 * @property double $price
 * @property int $curency_id
 * @property int $length
 * @property int $year_authored
 * @property string $image
 * @property string $img_url
 * @property string $notes
 * @property string $note_url
 * @property string $slug
 * @property string $downloaded
 * @property string $preview_id
 * @property int $status
 */
class Note extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'note';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'slugAttribute' => 'slug',
                'ensureUnique' => true
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'univer_id', 'language_id', 'type_id', 'cat_id', 'curency_id', 'length', 'year_authored', 'downloaded', 'preview_id', 'status'], 'integer'],
            [['description', 'img_url', 'note_url'], 'string'],
            [['price'], 'number'],
            [['title', 'univer_id', 'language_id', 'description', 'type_id', 'cat_id', 'price', 'curency_id', 'length', 'year_authored'], 'required'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 1, 'extensions' => 'png, jpg, gif', 'maxSize' => 4 * 1024 * 1024],
            [['notes'], 'file', 'skipOnEmpty' => true, 'extensions' => 'txt, doc, docx', 'maxFiles' => 1, 'maxSize' => 4 * 1024 * 1024],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'univer_id' => 'Univer ID',
            'language_id' => 'Language ID',
            'description' => 'Description',
            'type_id' => 'Type ID',
            'cat_id' => 'Cat ID',
            'price' => 'Price',
            'curency_id' => 'Curency ID',
            'length' => 'Length',
            'year_authored' => 'Year Authored',
            'image' => 'Image',
            'img_url' => 'Картинка',
            'notes' => 'Notes',
            'note_url' => 'Note_url',
            'downloaded' => 'downloaded',
            'slug' => 'Slug',
            'preview_id' => 'preview_id',
            'status' => 'Состояние'
        ];
    }
}