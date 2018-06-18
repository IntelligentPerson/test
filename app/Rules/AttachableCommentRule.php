<?php

namespace App\Rules;

use App\Category;
use App\Post;
use App\Comment;
use Illuminate\Contracts\Validation\Rule;

class AttachableCommentRule implements Rule
{
    public $attachable_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($attachable_id)
    {
        $this->attachable_id = $attachable_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($value == Comment::TYPE_POST) {
            $post = Post::where('id', $this->attachable_id)->first();
            if (!$post) {
                return false;
            } else {
                return true;
            }
        } elseif ($value == Comment::TYPE_CATEGORY){
            $category = Category::where('id', $this->attachable_id)->first();
            if (!$category) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You shall not pass!';
    }
}
