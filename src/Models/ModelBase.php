<?php

namespace bachphuc\LaravelFeedback\Models;

use Illuminate\Database\Eloquent\Model;

use bachphuc\PhpLaravelHelpers\WithModelBase;
use bachphuc\PhpLaravelHelpers\WithImage;

class ModelBase extends Model
{
    use WithModelBase, WithImage;
}