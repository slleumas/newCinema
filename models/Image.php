<?php

class Image
{
    public static function imageGenerateName()
    {
        return bin2hex(random_bytes(60));
    }
}
