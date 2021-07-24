<?php

namespace bachphuc\LaravelFeedback;

class Feedback
{
    public function actionCreateComment(){
        return route('comments.store');
    }

    public function route($route, $params = []){
        return route($route, $params);
    }

    public function trans($value, $default = ''){
        $key = strtolower($value);
        if(\Lang::has($key)) return trans($key);
        if(\Lang::has('feedback::' . $key)) return trans('feedback::' . $key);
        if(\Lang::has('feedback::lang.' . $key)) return trans('feedback::lang.' . $key);
        if(!empty($default)) return $default;

        return $value;
    }
}